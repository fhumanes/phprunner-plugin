<?php 
class EditSpinner extends UserControl
{	
	var $min, $max, $required;
	
	function initUserControl()
	{
		$this->min=-999999999;
		$this->max=999999999;
		$this->required=false;

		if (isset($this->settings["min"]))
			$this->min=$this->settings["min"];
		if (isset($this->settings["max"]))
			$this->max=$this->settings["max"];		
		if (isset($this->settings["required"]))
			$this->required=$this->settings["required"];

		$this->addJSSetting("min", $this->min);
		$this->addJSSetting("max", $this->max);
		$this->addJSSetting("required", $this->required);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' value="'
			.htmlspecialchars($value).'">';	
	}
	
	function getUserSearchOptions()
	{
		return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS);		
	}

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{
		$this->pageObject->AddJSFile("include/jquery-ui-1.9.1.spinner.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/jquery-ui-1.9.1.spinner.css");
	}
}
?>