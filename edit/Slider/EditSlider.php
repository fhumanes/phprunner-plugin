<?php 
class EditSlider extends UserControl
{
	var $lowerBound, $upperBound, $decimals;
	function initUserControl()
	{
		$this->lowerBound=1;
		$this->upperBound=10;
		$this->decimals=0;
		
		if (isset($this->settings["lowerBound"]))
			$this->lowerBound=$this->settings["lowerBound"];
		if (isset($this->settings["upperBound"]))
			$this->upperBound=$this->settings["upperBound"];
		if (isset($this->settings["decimals"]))
			$this->decimals=$this->settings["decimals"];			
		
		$this->addJSSetting("lowerBound", $this->lowerBound);
		$this->addJSSetting("upperBound", $this->upperBound);
		$this->addJSSetting("decimals", $this->decimals);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		echo '<div id="slider_'.$this->cfield.'">'.
			$this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' value="'
			.htmlspecialchars($value).'" class="slideControl" maxlength="3" ></div>';	
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
		$this->pageObject->AddJSFile("include/jquery.slideControl.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/slideControl.css");
	}
}
?>