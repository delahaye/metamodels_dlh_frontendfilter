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
 * Class ModuleMetaModelsDlhFrontendFilter
 *
 * FE-module for FE-filtering
 * @copyright  2013 de la Haye Kommunikationsdesign <http://www.delahaye.de>
 * @author     Christian de la Haye <service@delahaye.de>
 */
class ModuleMetaModelsDlhFrontendFilter extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'metamodels_dlh_frontendfilter_default';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### METAMODELS FE-FILTERBLOCK ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->title;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		// get filter data
		$objFilter = new MetaModelsDlhFrontendFilter();
		$arrFilter = $objFilter->getFrontendFilter($this);

		// get template
		$objTemplate = new FrontendTemplate(($this->metamodels_dlh_frontendfilter_template ? $this->metamodels_dlh_frontendfilter_template : 'metamodels_dlh_frontendfilter_default'));

		// fill template
		$this->Template->action = $arrFilter['action'];
		$this->Template->parameters = $arrFilter['parameters'];
		$this->Template->filters = $arrFilter['filter'];
		$this->Template->submit = $arrFilter['submit'];
	}

}

?>