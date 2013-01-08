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
 * Class MetaModelsFilterSettingDlhText
 *
 * Filter "text field" for FE-filtering, based on filters by the meta models team.
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsFilterSettingDlhText extends MetaModelFilterSetting
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
		$strTextsearch = $this->get('textsearch');

		// react on wildcard, overriding the search type
		if(strpos($strParamValue,'*')!==false)
		{
			$strTextsearch = 'exact';
		}

		// type of search
		switch($strTextsearch)
		{
			case 'beginswith':
				$strWhat = $strParamValue.'%';
				break;
			case 'endswith':
				$strWhat = '%'.$strParamValue;
				break;
			case 'exact':
				$strWhat = $strParamValue;
				break;
			default:
				$strWhat = '%'.$strParamValue.'%';
				break;
		}

		if ($objAttribute && $strParamName && $strParamValue)
		{
			$objQuery = Database::getInstance()->prepare(sprintf(
				'SELECT id FROM %s WHERE %s LIKE ?',
				$this->getMetaModel()->getTableName(),
				$objAttribute->getColName()
				))
				->execute(str_replace(array('*', '?'), array('%', '_'), $strWhat));

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