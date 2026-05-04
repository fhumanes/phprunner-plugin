<?php 
class EditGestury extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("width", $this->settings["width"] ? $this->settings["width"] : 300);
		$this->addJSSetting("height", $this->settings["height"] ? $this->settings["height"] : 300);
		$this->addJSSetting("backgroundColor", $this->settings["backgroundColor"] ? $this->settings["backgroundColor"] : "#2980B9");
		$this->addJSSetting("color", $this->settings["color"] ? $this->settings["color"] : "#FFFFFF");
		$this->addJSSetting("roundRadii", $this->settings["roundRadii"] ? $this->settings["roundRadii"] : 20);
		$this->addJSSetting("pointRadii", $this->settings["pointRadii"] ? $this->settings["pointRadii"] : 9);
		$this->addJSSetting("space", $this->settings["space"] ? $this->settings["space"] : 60);
		$this->addJSSetting("lineColor", $this->settings["lineColor"] ? $this->settings["lineColor"] : "#ECF0F1");
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo '<input id="'.$this->cfield.'" style="display:none"'
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" ><div id="gest'.$this->cfield.'"></div>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controlesmib/gestury/javascript/gesture.password.js"); }
	function addCSSFiles() {  }
}
?>