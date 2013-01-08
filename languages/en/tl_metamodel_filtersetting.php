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
 * filter types
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['text']     = 'Text filter';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['fromto']   = 'Value from/to';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['checkbox'] = 'Checkbox yes/no';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['select']   = 'Selection';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['range']    = 'Value within 2 fields';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['tags']     = 'Filtered tags';


/**
 * fields
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal']    = array('Value 1 included', 'Standard: excluded.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal']    = array('Value 2 included', 'Standard: excluded.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield']    = array('Field for value 1', 'Show FE field for value no 1.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield']      = array('Field for value 2', 'Show FE field for value no 2.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['yesfield']     = array('Yes instead of attribute name', 'Show yes instead of attribute name and provide attribute name as a headline.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['blankoption']  = array('Empty option', 'Show empty options in select.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['defaultid']    = array('Default', 'Default value for selection.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['textsearch']   = array('Search type', 'Finding text parts.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2']     = array('Attribute 2', 'Second attribute for higher value.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['label']        = array('Label', 'Show label instead of attribute name.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['useor']        = array('OR', 'OR-linking of the tags.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlyused']     = array('Assigned tags only', 'Show only options, that are assigned somewhere in the MetaModel.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlypossible'] = array('Remaining tags only', 'Show only options, that are still assigned somewhere after the actual filter is set.');


/**
 * references
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['exact']      = 'exact search';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['beginswith'] = 'begins with search term';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['endswith']   = 'ends with search term';

/**
 * BE-listing of filters
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typedesc']['fefilter'] = '%s <strong>%s</strong><br> for attribute <em>%s</em> (%s)';

?>