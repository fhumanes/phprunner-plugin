<?php
class ViewColors extends ViewUserControl
{
        var $width, $height, $border, $border_radius;

	public function initUserControl()
	{
            	$this->width = '15px';
		$this->height = '15px';
		$this->border = '1px';
		$this->border_radius = '3px';
		
		if($this->settings["width"]) $this->width=$this->settings["width"];	
		if($this->settings["height"]) $this->height=$this->settings["height"];
		if($this->settings["border"]) $this->border=$this->settings["border"];
                if($this->settings["border_radius"]) $this->border_radius=$this->settings["border_radius"];

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $id_field = explode('=',$keylink);
            $colors = $data[$this->field];
            // $value='<div id="colors'.$id_field[1].'" style="background-color:'.$value.';width:15px ; height: 15px;  border:1px solid black;border-radius: 3px;"> </div>';
            $field_value = '<div id="colors_'.$id_field[1].'" style="background-color: '
                    .$colors.';width: '.$this->width.' ; height: '. $this->height.';  border: '.$this->border.' solid #DDDDDD ;border-radius:'.$this->border_radius.';">'
                    .' </div>';

            return $field_value;
        }

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 
	function addJSFiles()
	{
		$this->pageObject->AddJSFile("jquery.minicolors.min.js");

	}
         * 
         */

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("jquery.minicolors.css");
	}
         */
}
?>