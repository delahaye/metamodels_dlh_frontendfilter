<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 * Class FormTagsField
 *
 * Form field "tags", based on form field by Leo Feyer
 * @author     Christian de la Haye <service@delahaye.de>
 */
class FormTagsField extends Widget
{

	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'form_widget';


	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'maxlength':
				if ($varValue > 0)
				{
					$this->arrAttributes['maxlength'] =  $varValue;
				}
				break;

			case 'mandatory':
				if ($varValue)
				{
					$this->arrAttributes['required'] = 'required';
				}
				else
				{
					unset($this->arrAttributes['required']);
				}
				parent::__set($strKey, $varValue);
				break;

			case 'placeholder':
				$this->arrAttributes['placeholder'] = $varValue;
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}


	/**
	 * Trim values
	 * @param mixed
	 * @return mixed
	 */
	protected function validator($varInput)
	{
		if (is_array($varInput))
		{
			return parent::validator($varInput);
		}

		return parent::validator(trim($varInput));
	}


	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$return = sprintf('<fieldset id="ctrl_%s" class="checkbox_container">
		<legend>%s</legend>
		',
		$this->strName,
		$this->strLabel
		);

		foreach($this->options as $key=>$val)
		{
			$return .= sprintf('<span><input type="checkbox" name="%s[]" id="opt_%s" class="checkbox" value="%s"%s%s <label id="lbl_%s" for="opt_%s">%s</label></span>',
				$this->strName,
				$this->strName.'_'.$key,
				$val['value'],
				(is_array($this->varValue) ? (in_array($val['value'],$this->varValue) ? ' checked="checked"' : ''):''),
				$this->strTagEnding,
				$this->strName.'_'.$key,
				$this->strName.'_'.$key,
				$val['label']
				);
		}
		
		$return .='</fieldset>';

		return $return;
	}
}

?>