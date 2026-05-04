<?php 
class EditKnob extends UserControl
{
	var $required, $min, $max, $angleOffset, $angleArc, $stopper, $readOnly, $cursor, $thickness, $width, $height, $displayInput, $displayPrevious, $fgColor, $inputColor, $bgColor;
	
	function initUserControl()
	{
		$this->required = false;
		$this->min = 0;
		$this->max = 100;
		$this->angleOffset = 0;
		$this->angleArc = 360;
		$this->stopper = false;
		$this->readOnly = false;
		$this->cursor = false;
		$this->thickness = 0.35;
		$this->width = 200;
		$this->height = 200;
		$this->displayInput = false;
		$this->displayPrevious = false;
		$this->fgColor = '#222222';
		$this->inputColor = '#222222';
		$this->bgColor = '#CCCCCC';
		
		if($this->settings["required"])
			$this->required=$this->settings["required"];		
		if($this->settings["min"])
			$this->min=$this->settings["min"];		
		if($this->settings["max"])
			$this->max=$this->settings["max"];
		if($this->settings["angleOffset"])
			$this->angleOffset=$this->settings["angleOffset"];
		if($this->settings["angleArc"])
			$this->angleArc=$this->settings["angleArc"];
		if($this->settings["stopper"])
			$this->stopper=$this->settings["stopper"];		
		if($this->settings["readOnly"])
			$this->readOnly=$this->settings["readOnly"];
		if($this->settings["cursor"])
			$this->cursor=$this->settings["cursor"];
		if($this->settings["thickness"])
			$this->thickness=$this->settings["thickness"];
		if($this->settings["width"])
			$this->width=$this->settings["width"];
		if($this->settings["height"])
			$this->height=$this->settings["height"];
		if($this->settings["displayInput"])
			$this->displayInput=$this->settings["displayInput"];
		if($this->settings["displayPrevious"])
			$this->displayPrevious=$this->settings["displayPrevious"];
		if($this->settings["fgColor"])
			$this->fgColor=$this->settings["fgColor"];
		if($this->settings["inputColor"])
			$this->inputColor=$this->settings["inputColor"];
		if($this->settings["bgColor"])
			$this->bgColor=$this->settings["bgColor"];


		$this->addJSSetting("required", $this->required);			
		$this->addJSSetting("min", $this->min);
		$this->addJSSetting("max", $this->max);
		$this->addJSSetting("angleOffset", $this->angleOffset);
		$this->addJSSetting("angleArc", $this->angleArc);
		$this->addJSSetting("stopper", $this->stopper);
		$this->addJSSetting("readOnly", $this->readOnly);	
		$this->addJSSetting("cursor", $this->cursor);	
		$this->addJSSetting("thickness", $this->thickness);	
		$this->addJSSetting("width", $this->width);
		$this->addJSSetting("height", $this->height);
		$this->addJSSetting("displayInput", $this->displayInput);
		$this->addJSSetting("displayPrevious", $this->displayPrevious);
		$this->addJSSetting("fgColor", $this->fgColor);
		$this->addJSSetting("inputColor", $this->inputColor);
		$this->addJSSetting("bgColor", $this->bgColor);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{		
		echo '<input type="text" id="'.$this->cfield.'" name="'.$this->cfield.'" value="'.str_replace(',','.',$value).'" />';
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
		$this->pageObject->AddJSFile("include/Knob_plugin/jquery.knob.js");
	}	
}