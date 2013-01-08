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
 * Class MetaModelsDlhFrontendFilter
 *
 * FE-filtering for Contao MetaModels
 * @copyright  2013 de la Haye Kommunikationsdesign <http://www.delahaye.de>
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelsDlhFrontendFilter extends Frontend
{
	/**
	 * Generate module
	 */
	public function getFrontendFilter($objFilterConfig)
	{
		$arrResetParams = array();
		$arrPreserveKeys = array();
		$arrPreserveParams = array();

		$objFilterSetting = MetaModelFilterSettingsFactory::byId($objFilterConfig->metamodels_dlh_frontendfilter_filter);
		$arrParameterDca = $objFilterSetting->getParameterDCA();

		$arrParameters =array();
		foreach(unserialize($objFilterConfig->metamodels_dlh_frontendfilter_attributes) as $strAttribute)
		{
			$arrParameters[$strAttribute] = $arrParameterDca[$strAttribute];
		}

		foreach($arrParameters as $key=>$val)
		{
			// show only possible options based on the current filtered list
			if($val['eval']['onlypossible'])
			{
				if(!$arrItems)
				{
					$objItemRenderer = new MetaModelList();
					$objItemRenderer->setMetaModel($objFilterConfig->metamodels_dlh_frontendfilter_metamodel, 0);
					$objItemRenderer->setFilterParam($objFilterConfig->metamodels_dlh_frontendfilter_filter, array(), $_GET);
					$arrItems = $objItemRenderer->prepare()->getItems()->parseAll();
				}

				// count if option is used
				foreach($val['options'] as $keyOpt=>$valOpt)
				{
					$count = 0;
					foreach($arrItems as $tmpItem)
					{
						if(is_array($tmpItem['raw'][$val['eval']['colname']]))
						{
							// select fields
							if($tmpItem['raw'][$val['eval']['colname']]['alias']== $keyOpt)
							{
								$count++;
							}
							else
							{
								// tag fields
								foreach($tmpItem['raw'][$val['eval']['colname']] as $tmpOpt)
								{
									if($tmpOpt['alias'] == $keyOpt)
									{
										$count++;
									}
								}
							}
						}
					}
					
					// option is not used, so dont show
					if($count < 1)
					{
						unset($val['options'][$keyOpt]);
					}
				}
			}

			$arrResetParams[] = $key;
			
			$val['value'] = $this->Input->get($key);
			$strClass = $GLOBALS['TL_FFL'][$val['inputType']];
			$objWidget = new $strClass($this->prepareForWidget($val, $key, $val['value']));
			$strField = $objWidget->generate();

			// alter widget code if filter auto-submits
			if($objFilterConfig->metamodels_dlh_frontendfilter_autosubmit)
			{
				// standard
				$strField = str_replace('id="ctrl_'.$key.'"', 'id="ctrl_'.$key.'" onchange="submit();"', $strField);
				
				// from-to-fields need only submit on the second field
				if(strpos($strField,'ctrl_'.$key.'_1')!==false)
				{
					$strField = str_replace('id="ctrl_'.$key.'_1"', 'id="ctrl_'.$key.'_1" onchange="submit();"', $strField);
				}
				elseif(strpos($strField,'ctrl_'.$key.'_0')!==false)
				{
					$strField = str_replace('id="ctrl_'.$key.'_0"', 'id="ctrl_'.$key.'_0" onchange="submit();"', $strField);
				}
			}

			$arrFilters[] = array
			(
				'class' => $objFilters->type,
				'label' => $objWidget->generateLabel(),
				'field' => $strField
			);

		}

		// collect parameters to keep
		foreach($_GET as $key=>$val)
		{
			if(!in_array($key, $arrResetParams) && $val)
			{
				$arrPreserveKeys[] = $key;
			}
		}
		
		// build hidden fields for kept parameters
		$arrPreserveKeys = is_array($arrPreserveKeys) ? array_unique($arrPreserveKeys) : array();

		foreach($arrPreserveKeys as $strKey)
		{
			if($this->Input->get($strKey))
			{
				// tags
				if(is_array($this->Input->get($strKey)))
				{
					foreach($this->Input->get($strKey) as $tmpVal)
					{
						$arrPreserveParams[] =array(
							'key' => $strKey.'[]',
							'value' => $tmpVal
							);
					}
				}
				else
				{
					// standard
					$arrPreserveParams[] =array(
						'key' => $strKey,
						'value' => $this->Input->get($strKey)
						);
				}
			}
		}

		// page to jump to when filter submit
		if($objFilterConfig->jumpTo)
		{
			$objJump = $this->Database->prepare("SELECT id, alias FROM tl_page WHERE id=?")
				->limit(1)
				->execute($objFilterConfig->jumpTo);
		}

		// return filter data
		return array(
			'action' => ($objFilterConfig->jumpTo ? $this->generateFrontendUrl($objJump->row()) : ''),
			'parameters' => $arrPreserveParams,
			'filter' => $arrFilters,
			'submit' => ($objFilterConfig->metamodels_dlh_frontendfilter_autosubmit ? '' : $GLOBALS['TL_LANG']['metamodels_dlh_frontendfilter_filter']['submit'])
			);
	}

}

?>