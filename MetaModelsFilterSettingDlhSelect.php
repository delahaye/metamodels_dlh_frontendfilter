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
 * Class MetaModelsFilterSettingDlhSelect
 *
 * Filter "select field" for FE-filtering, based on filters by the meta models team.
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsFilterSettingDlhSelect extends MetaModelFilterSetting
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
		$strParamValue = $arrFilterUrl[$strParamName];

		if ($objAttribute && $strParamName && $strParamValue)
		{
			$objQuery = Database::getInstance()->prepare(sprintf(
				'SELECT id FROM %s WHERE %s=(SELECT %s FROM %s WHERE %s=?)',
				$this->getMetaModel()->getTableName(),
				$objAttribute->getColName(),
				$objAttribute->get('select_id'),
				$objAttribute->get('select_table'),
				$objAttribute->get('select_alias')
				))
				->execute($strParamValue);

			$arrIds = $objQuery->fetchEach('id');

			$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList($arrIds));
			return;
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

		if($this->get('onlyused'))
		{
			foreach($arrOptions as $key=>$val)
			{
				if(count($objAttribute->searchFor($key)) < 1)
				{
					unset($arrOptions[$key]);
				}
			}
		}

		return array(
			$this->getParamName() => array
			(
				'label'   => ($this->get('label') ? $this->get('label') : $objAttribute->getName()),
				'inputType'    => 'select',
				'options' => $arrOptions,
				'eval' => array('includeBlankOption' => ($this->get('blankoption') ? true : false), 'colname'=>$objAttribute->getColname(),'onlyused'=>$this->get('onlyused'),'onlypossible'=>$this->get('onlypossible'))
			)
		);
	}
}

?>