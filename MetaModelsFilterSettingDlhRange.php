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
 * Class MetaModelsFilterSettingDlhRange
 *
 * Filter "value in range of 2 fields" for FE-filtering, based on filters by the meta models team.
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsFilterSettingDlhRange extends MetaModelFilterSetting
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
		$objAttribute2 = $objMetaModel->getAttributeById($this->get('attr_id2'));

		$strParamName = $this->getParamName();
		$strParamValue = $arrFilterUrl[$strParamName];
		$strMore = $this->get('moreequal') ? '>=' : '>';
		$strLess = $this->get('lessequal') ? '<=' : '<';

		if ($objAttribute && $objAttribute2 && $strParamName && $strParamValue)
		{
			$objQuery = Database::getInstance()->prepare(sprintf(
				'SELECT id FROM %s WHERE (?%s%s AND ?%s%s)',
				$this->getMetaModel()->getTableName(),
				$strLess,
				$objAttribute2->getColName(),
				$strMore,
				$objAttribute->getColName()
				))
				->execute($strParamValue, $strParamValue);

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
		$objAttribute2 = $this->getMetaModel()->getAttributeById($this->get('attr_id2'));
		$arrOptions = $objAttribute->getFilterOptions();

		return array(
			$this->getParamName() => array
			(
				'label'   => ($this->get('label') ? $this->get('label') : $objAttribute->getName()),
				'inputType'    => 'text'
			)
		);
	}
}

?>