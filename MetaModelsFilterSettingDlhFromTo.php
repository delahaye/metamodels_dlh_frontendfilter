<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Frontend filter for Contao MetaModels
 *
 * @copyright  2013 de la Haye Kommunikationsdesign <http://www.delahaye.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @package    metamodels_dlh_frontendfilter
 * @license    LGPL 
 * @filesource
 */


/**
 * Class MetaModelsFilterSettingDlhFromTo
 *
 * Filter "value from x to y" for FE-filtering, based on filters by the meta models team.
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsFilterSettingDlhFromTo extends MetaModelFilterSetting
{
	/**
	 * {@inheritdoc}
	 */
	protected function getParamName()
	{
		if ($this->get('urlparam'))
		{
			return $this->get('urlparam');
		}

		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));
		if ($objAttribute)
		{
			return $objAttribute->getColName();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function prepareRules(IMetaModelFilter $objFilter, $arrFilterUrl)
	{
		$objMetaModel = $this->getMetaModel();
		$objAttribute = $objMetaModel->getAttributeById($this->get('attr_id'));
		$strParamName = $this->getParamName();
		$arrParamValue = $arrFilterUrl[$strParamName];
		$strColname = $objAttribute->getColName();

		if ($objAttribute && $strParamName && $arrParamValue)
		{
			$strMore = $this->get('moreequal') ? '>=' : '>';
			$strLess = $this->get('lessequal') ? '<=' : '<';

			if($arrParamValue[0] > 0 && $arrParamValue[1] > 0)
			{
				// from to
				$strWhere = $strColname.' '.$strMore.'? AND '.$strColname.' '.$strLess.'?';
				$arrSearch = array($arrParamValue[0], $arrParamValue[1]);
			}
			elseif($arrParamValue[0] > 0)
			{
				// from
				$strWhere = $strColname.' '.$strMore.'?';
				$arrSearch = array($arrParamValue[0]);
			}
			elseif($arrParamValue[1] > 0)
			{
				// to
				$strWhere = $strColname.' '.$strLess.'?';
				$arrSearch = array($arrParamValue[1]);
			}
			else
			{
				// nothing
				$strWhere = '';
			}

			if($strWhere)
			{
				$objQuery = Database::getInstance()->prepare(sprintf(
					'SELECT id FROM %s WHERE (%s)',
					$this->getMetaModel()->getTableName(),
					$strWhere
					))
					->execute($arrSearch);

				$arrIds = $objQuery->fetchEach('id');

				$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList($arrIds));
				return;
			}

			$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList(NULL));
		}

		$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList(NULL));
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameters()
	{
		return ($strParamName = $this->getParamName()) ? array($strParamName) : array();
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameterDCA()
	{
		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));
		$arrOptions = $objAttribute->getFilterOptions();

		$strLabel = ($this->get('label') ? $this->get('label') : $objAttribute->getName());

		if($this->get('fromfield') && $this->get('tofield'))
		{
			$strLabel .= ' '.$GLOBALS['TL_LANG']['metamodels_dlh_frontendfilter_filter']['fromto'];
		}
		elseif($this->get('fromfield') && !$this->get('tofield'))
		{
			$strLabel .= ' '.$GLOBALS['TL_LANG']['metamodels_dlh_frontendfilter_filter']['from'];
		}
		else
		{
			$strLabel .= ' '.$GLOBALS['TL_LANG']['metamodels_dlh_frontendfilter_filter']['to'];
		}

		return array(
			$this->getParamName() => array
			(
				'label'   => $strLabel,
				'inputType'    => 'doubletext',
				'eval' => array('size'=>2,'fromfield'=>($this->get('fromfield')? true:false), 'tofield'=>($this->get('tofield')? true:false))
			)
		);
	}
}

?>