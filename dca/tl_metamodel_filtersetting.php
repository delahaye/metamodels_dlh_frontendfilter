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
 * palettes
 */

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['text extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'label', 'textsearch'),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['fromto extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'label', 'moreequal', 'lessequal', 'fromfield', 'tofield'),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['checkbox extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'label', 'yesfield'),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['select extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'label', 'defaultid', 'blankoption', 'onlyused', 'onlypossible'),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'attr_id2', 'label', 'moreequal', 'lessequal'),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['tags extends default'] = array
(
	'+config' => array('attr_id', 'urlparam', 'label', 'useor', 'onlyused', 'onlypossible'),
);


/**
 * fields
 */

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['label'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['label'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array(
		'tl_class'            => 'clr',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['textsearch'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['textsearch'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'     			  => array('exact','beginswith','endswith'),
	'reference'               => $GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references'],
	'eval'                    => array('tl_class'=>'w50', 'includeBlankOption'=>true)
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['moreequal'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50 clr',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['lessequal'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox'
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['fromfield'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['tofield'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['yesfield'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['yesfield'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['blankoption'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['blankoption'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['onlyused'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlyused'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50 clr',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['onlypossible'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['onlypossible'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['defaultid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['defaultid'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_metamodel_filtersetting_dlh','getSelectdefault'),
	'eval'                    => array('tl_class'=>'w50', 'includeBlankOption'=>true)
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['attr_id2'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('TableMetaModelFilterSetting', 'getAttributeNames'),
	'eval'                    => array(
		'doNotSaveEmpty'      => true,
		'alwaysSave'          => true,
		'submitOnChange'      => true,
		'includeBlankOption'  => true,
		'mandatory'           => true,
		'tl_class'            => 'w50 clr',
	),
	'load_callback'           => array(array('TableMetaModelFilterSetting', 'attrIdToName')),
	'save_callback'           => array(array('TableMetaModelFilterSetting', 'nameToAttrId')),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['useor'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['useor'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(
		'tl_class'            => 'w50',
	),
);


/**
 * Class tl_metamodel_filtersetting_dlh
 *
 * provide be-functionalities
 * @copyright  2013 de la Haye Kommunikationsdesign <http://www.delahaye.de>
 * @author     Christian de la Haye <service@delahaye.de>
 */
class tl_metamodel_filtersetting_dlh extends Backend
{

	/**
	 * provide options for default selection
	 * @param object
	 * @return array
	 */
	public function getSelectdefault($objRow)
	{
		$return = array();

		if(!$objRow->activeRecord->attr_id)
		{
			return $return;
		}

		$objData1 = $this->Database->prepare("SELECT select_table, select_column, select_id FROM tl_metamodel_attribute WHERE id=(SELECT attr_id FROM tl_metamodel_filtersetting WHERE id=?)")
			->execute($objRow->activeRecord->id);

		$objData2 = $this->Database->prepare("SELECT ".$objData1->select_id." as id, ".$objData1->select_column." as name FROM ".$objData1->select_table." ORDER BY name")
			->execute();

		while($objData2->next())
		{
			$return[$objData2->id] = $objData2->name;
		}

		return $return;
	}


	/**
	 * backend list display of fe-filter
	 * @param array
	 * @param string
	 * @param object
	 * @param string
	 * @param string
	 * @return string
	 */
	public function infoCallback($arrRow, $strLabel, $objDC, $imageAttribute, $strImage)
	{
		$objAttrib = $this->Database->prepare("SELECT name FROM tl_metamodel_attribute WHERE id=?")
			->limit(1)
			->execute($arrRow['attr_id']);

		if($arrRow['attr_id2'])
		{
			$objAttrib2 = $this->Database->prepare("SELECT name FROM tl_metamodel_attribute WHERE id=?")
				->limit(1)
				->execute($arrRow['attr_id2']);
		}

		$strReturn = sprintf(
			$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typedesc']['fefilter'],
			'<a href="' . $this->addToUrl('act=edit&amp;id='.$arrRow['id']). '">' . $strImage . '</a>',
			$strLabel,
			$objAttrib->name.($objAttrib2->name ? '/'.$objAttrib2->name : ''),
			$arrRow['urlparam']
			);

		return $strReturn;
	}
		
}

?>