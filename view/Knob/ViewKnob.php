<?php 
class ViewKnob extends ViewUserControl
{
	var $cursor, $thickness, $min, $max, $width, $height, $displayInput, $displayPrevious, $fgColor, $inputColor, $bgColor;
	
	function initUserControl()
	{	
		$this->cursor = false;
		$this->thickness = 0.35;
		$this->min = 0;
		$this->max = 100;
		$this->width = 200;
		$this->height = 200;
		$this->displayInput = false;
		$this->displayPrevious = false;
		$this->fgColor = '#222222';
		$this->inputColor = '#222222';	
		$this->bgColor = '#CCCCCC';

		if($this->settings["cursor"])
			$this->cursor=$this->settings["cursor"];
		if($this->settings["thickness"])
			$this->thickness=$this->settings["thickness"];
		if($this->settings["min"])
			$this->min=$this->settings["min"];
		if($this->settings["max"])
			$this->max=$this->settings["max"];
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
		
		$this->addJSControlSetting("cursor", $this->cursor);	
		$this->addJSControlSetting("thickness", $this->thickness);	
		$this->addJSControlSetting("width", $this->width);
		$this->addJSControlSetting("min", $this->min);
		$this->addJSControlSetting("max", $this->max);
		$this->addJSControlSetting("height", $this->height);
		$this->addJSControlSetting("displayInput", $this->displayInput);
		$this->addJSControlSetting("displayPrevious", $this->displayPrevious);
		$this->addJSControlSetting("fgColor", $this->fgColor);
		$this->addJSControlSetting("inputColor", $this->inputColor);
		$this->addJSControlSetting("bgColor", $this->bgColor);
	}
	
	function showDBValue(&$data, $keylink, $html = true)
	{	
		$id_field = explode('=',$keylink);
		return '<input type="text" id="knob_'.$this->field.'_'.$id_field[1].'" name="'.$this->field.'" value="'.$data[$this->field].'"/>';
	}

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{
		$this->addJSFile("include/Knob_plugin/jquery.knob.js");
	}
}