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
 * palette
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['metamodels_dlh_frontendfilter'] = '{title_legend},name,headline,type;{filter_legend},jumpTo,metamodels_dlh_frontendfilter_metamodel,metamodels_dlh_frontendfilter_filter,metamodels_dlh_frontendfilter_attributes,metamodels_dlh_frontendfilter_autosubmit,metamodels_dlh_frontendfilter_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['metamodels_dlh_frontendfilter_metamodel'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['metamodels_dlh_frontendfilter_metamodel'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'              => 'tl_metamodel.name',
	'eval'                    => array('mandatory'=>true,'includeBlankOption'=>true,'submitOnChange'=>true,'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['metamodels_dlh_frontendfilter_filter'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['metamodels_dlh_frontendfilter_filter'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_metamodels_dlh_frontendfilter','getFilter'),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['metamodels_dlh_frontendfilter_attributes'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['metamodels_dlh_frontendfilter_attributes'],
	'exclude'                 => true,
	'inputType'               => 'checkboxWizard',
	'options_callback'        => array('tl_module_metamodels_dlh_frontendfilter','getAttributes'),
	'eval'                    => array('multiple'=>true, 'tl_class'=>'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['metamodels_dlh_frontendfilter_autosubmit'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['metamodels_dlh_frontendfilter_autosubmit'],
	'exclude'                 => true,
	'default'                 => '1',
	'inputType'               => 'checkbox'
);

$GLOBALS['TL_DCA']['tl_module']['fields']['metamodels_dlh_frontendfilter_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['metamodels_dlh_frontendfilter_template'],
	'default'                 => 'event_full',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_metamodels_dlh_frontendfilter', 'getTemplates')
);


/**
 * Class tl_module_metamodels_dlh_frontendfilter
 *
 * provide be-functionalities
 * @copyright  2013 de la Haye Kommunikationsdesign <http://www.delahaye.de>
 * @author     Christian de la Haye <service@delahaye.de>
 */
class tl_module_metamodels_dlh_frontendfilter extends Backend
{

	/**
	 * get filters
	 * @param object
	 * @return array
	 */
	public function getFilter($objRow)
	{
		$return = array();

		$objFilter = $this->Database->prepare("SELECT id,name FROM tl_metamodel_filter WHERE pid=? ORDER BY name")
			->execute($objRow->activeRecord->metamodels_dlh_frontendfilter_metamodel);
		
		while($objFilter->next())
		{
			$return[$objFilter->id] = $objFilter->name;
		}

		return $return;
	}


	/**
	 * get attributes for checkbox wizard
	 * @param object
	 * @return array
	 */
	public function getAttributes($objRow)
	{
		$return = array();

		if(!$objRow->activeRecord->metamodels_dlh_frontendfilter_filter)
		{
			return $return;
		}

		$objFilterSetting = MetaModelFilterSettingsFactory::byId($objRow->activeRecord->metamodels_dlh_frontendfilter_filter);
		$arrParameterDca = $objFilterSetting->getParameterDCA();

		foreach($arrParameterDca as $key=>$val)
		{
			if(is_array($val['label']))
			{
				$return[$key] = $val['label'][0];
			}
			else
			{
				$return[$key] = $val['label'];
			}
		}

		return $return;
	}


	/**
	 * get frontend templates
	 * @param DataContainer
	 * @return array
	 */
	public function getTemplates(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;

		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}

		return $this->getTemplateGroup('metamodels_dlh_frontendfilter_', $intPid);
	}
}


?>