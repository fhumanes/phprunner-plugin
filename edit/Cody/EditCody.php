<?php 
class EditCody extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->width = ( $this->settings["width"] ? $this->settings["width"] : 'auto' );
		$this->addJSSetting("allowDropdown", $this->settings["allowDropdown"]);
		$this->addJSSetting("autoPlaceholder", $this->settings["autoPlaceholder"]);
		$this->addJSSetting("excludeCountries", $this->settings["excludeCountries"] ? $this->settings["excludeCountries"] : "");
		$this->addJSSetting("initialCountry", $this->settings["initialCountry"] ? $this->settings["initialCountry"] : "auto");
		$this->addJSSetting("onlyCountries", $this->settings["onlyCountries"] ? $this->settings["onlyCountries"] : "");
		$this->addJSSetting("preferredCountries", $this->settings["preferredCountries"] ? $this->settings["preferredCountries"] : "");
		$this->addJSSetting("separateDialCode", $this->settings["separateDialCode"]);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' style="width:'.$this->width.';" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'">'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controlesmib/cody/javascript/intlTelInput.js"); }
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controlesmib/cody/style/intlTelInput.css"); }
}
?>