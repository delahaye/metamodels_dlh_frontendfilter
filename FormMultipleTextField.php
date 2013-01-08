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
 * Class FormMultipleTextField
 *
 * Form field "multiple text", based on form field by Leo Feyer
 * @author     Christian de la Haye <service@delahaye.de>
 */
class FormMultipleTextField extends Widget
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
		for($i=0; $i<$this->size; $i++)
		{
			$return .= sprintf('<input type="%s" name="%s[]" id="ctrl_%s_%s" class="text%s%s" value="%s"%s%s',
						($this->hideInput ? 'password' : 'text'),
						$this->strName,
						$this->strId,
						$i,
						($this->hideInput ? ' password' : ''),
						(strlen($this->strClass) ? ' ' . $this->strClass : ''),
						specialchars($this->varValue[$i]),
						$this->getAttributes(),
						$this->strTagEnding);
		}

		return $return;
	}
}

?>