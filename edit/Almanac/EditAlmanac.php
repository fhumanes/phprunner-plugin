<?php 
class EditAlmanac extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("animate", $this->settings["animate"]);
		$this->addJSSetting("init_animation", ($this->settings["init_animation"]?$this->settings["init_animation"]:"bounce") );
		$this->addJSSetting("format", ($this->settings["format"]?$this->settings["format"]:"m-d-Y") );
		$this->addJSSetting("lang", ($this->settings["lang"]?$this->settings["lang"]:"en") );
		$this->addJSSetting("lock", $this->settings["lock"]);
		$this->addJSSetting("maxYear", $this->settings["maxYear"]);
		$this->addJSSetting("minYear", $this->settings["minYear"]);
		$this->addJSSetting("yearsRange", $this->settings["yearsRange"]);
		$this->addJSSetting("dropPrimaryColor", ($this->settings["dropPrimaryColor"]?$this->settings["dropPrimaryColor"]:"#045FB4") );
		$this->addJSSetting("dropTextColor", ($this->settings["dropTextColor"]?$this->settings["dropTextColor"]:"#333") );
		$this->addJSSetting("dropBackgroundColor", ($this->settings["dropBackgroundColor"]?$this->settings["dropBackgroundColor"]:"#FFFFFF") );
		$this->addJSSetting("dropBorder", ($this->settings["dropBorder"]?$this->settings["dropBorder"]:"1px solid #045FB4") );
		$this->addJSSetting("dropBorderRadius", $this->settings["dropBorderRadius"]);
		$this->addJSSetting("dropShadow", ($this->settings["dropShadow"]?$this->settings["dropShadow"]:"0 0 10px 0 rgba(4, 95, 180, 0.45)") );
		$this->addJSSetting("dropWidth", $this->settings["dropWidth"]);
		$this->addJSSetting("dropTextWeight", ($this->settings["dropTextWeight"]?$this->settings["dropTextWeight"]:"bold") );
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" readonly=true type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.substr($value,0,10).'" >'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controlesmib/almanac/javascript/datedropper.js"); }
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controlesmib/almanac/style/datedropper.css"); }
}
?>