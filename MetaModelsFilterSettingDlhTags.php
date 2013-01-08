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
 * Class MetaModelsFilterSettingDlhTags
 *
 * Filter "tags" for FE-filtering, based on filters by the meta models team.
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsFilterSettingDlhTags extends MetaModelFilterSetting
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
		$arrOptions = $objAttribute->getFilterOptions();

		if ($objAttribute && $strParamName && is_array($arrParamValue) && $arrOptions)
		{

			$arrIds = array();
 
			foreach($arrParamValue as $strParamValue)
			{
				if($arrOptions[$strParamValue])
				{
					$arrIds[] = $objAttribute->searchFor($strParamValue);
				}
			}

			// AND / OR tags
			for($i = 0; $i<count($arrIds); $i++)
			{
				$arrIds[0] = $this->get('useor') ? array_unique(array_merge($arrIds[0],$arrIds[$i])) : array_unique(array_intersect($arrIds[0],$arrIds[$i]));
			}

			$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList($arrIds[0]));
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
		$strLabel = ($this->get('label') ? $this->get('label') : $objAttribute->getName());
		$arrOptions = $objAttribute->getFilterOptions();

		// show only tags used somewhere
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
				'inputType'    => 'tags',
				'options'    => $arrOptions,
				'eval' => array('colname'=>$objAttribute->getColname(),'onlyused'=>$this->get('onlyused'),'onlypossible'=>$this->get('onlypossible'))
			)
		);
	}
}

?>