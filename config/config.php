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
 * Frontend widgets
 */
 
$GLOBALS['TL_FFL']['doubletext'] = 'FormMultipleTextField';
$GLOBALS['TL_FFL']['tags'] = 'FormTagsField';


/**
 * Frontend module
 */

array_insert($GLOBALS['FE_MOD']['metamodels'], 9, array
(
	'metamodels_dlh_frontendfilter' => 'ModuleMetaModelsDlhFrontendFilter'
)
);


/**
 * Content element
 */

array_insert($GLOBALS['TL_CTE']['metamodels'], 9, array
(
	'metamodels_dlh_frontendfilter' => 'ContentMetaModelsDlhFrontendFilter'
)
);


/**
 * Frontend filter
 */
 
// text fields
$GLOBALS['METAMODELS']['filters']['text'] = array
(
	'class' => 'MetaModelsFilterSettingDlhText',
	'attr_filter' => array('text','longtext'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

// value from x to y
$GLOBALS['METAMODELS']['filters']['fromto'] = array
(
	'class' => 'MetaModelsFilterSettingDlhFromTo',
	'attr_filter' => array('numeric','decimal'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

// y/n checkbox
$GLOBALS['METAMODELS']['filters']['checkbox'] = array
(
	'class' => 'MetaModelsFilterSettingDlhCheckbox',
	'attr_filter' => array('checkbox'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

// select fields
$GLOBALS['METAMODELS']['filters']['select'] = array
(
	'class' => 'MetaModelsFilterSettingDlhSelect',
	'attr_filter' => array('select'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

// value in range of 2 fields
$GLOBALS['METAMODELS']['filters']['range'] = array
(
	'class' => 'MetaModelsFilterSettingDlhRange',
	'attr_filter' => array('numeric','decimal'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

// tags
$GLOBALS['METAMODELS']['filters']['tags'] = array
(
	'class' => 'MetaModelsFilterSettingDlhTags',
	'attr_filter' => array('tags'),
	'image' => 'system/modules/metamodels_dlh_frontendfilter/html/filter_frontend.png',
	'info_callback' => array('tl_metamodel_filtersetting_dlh','infoCallback'),
);

?>