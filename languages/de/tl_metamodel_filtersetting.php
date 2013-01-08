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

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['text']     = 'Textfilter';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['fromto']   = 'Wert von-/bis';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['checkbox'] = 'Checkbox ja/nein';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['select']   = 'Select-Auswahl';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['range']    = 'Wert innerhalb 2 Felder';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['tags']     = 'Gefilterte Tags';


/**
 * fields
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal']    = array('Wert 1 eingeschlossen', 'Standard: nicht eingeschlossen.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal']    = array('Wert 2 eingeschlossen', 'Standard: nicht eingeschlossen.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield']    = array('Feld für Wert 1', 'FE-Feld für Wert 1 zeigen.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield']      = array('Feld für Wert 2', 'FE-Feld für Wert 2 zeigen.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['yesfield']     = array('Ja statt Attributname', 'Ja statt Attributnamen anzeigen und Attributnamen als Überschrift verwenden.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['blankoption']  = array('Leerer Wert', 'Leere Auswahl einbinden.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['defaultid']    = array('Standardwert', 'Standardwert für Auswahlen.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['textsearch']   = array('Suchart', 'Teiltext-Findung bei Textsuche.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2']     = array('Attribut 2', 'Zweites Attribut für höheren Wert.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['label']        = array('Label', 'Label, falls nicht der Attributname genommen werden soll.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['useor']        = array('ODER', 'ODER-Verknüpfung der Tags.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlyused']     = array('Nur zugeordnete Werte', 'In den Optionen nur Werte zeigen, die einem Datensatz zugeordnet sind.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlypossible'] = array('Nur verbleibende Werte', 'In den Optionen nur Werte zeigen, die mit dem aktuellen Filter weiterhin vorkommen.');


/**
 * references
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['exact']      = 'exakte Suche';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['beginswith'] = 'beginnt mit Suchtext';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['endswith']   = 'endet mit Suchtext';

/**
 * BE-listing of filters
 */

$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typedesc']['fefilter'] = '%s <strong>%s</strong><br> für Attribut <em>%s</em> (%s)';

?>