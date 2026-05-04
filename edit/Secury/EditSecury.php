<?php 
class EditSecury extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->width = ( $this->settings["width"] ? $this->settings["width"] : 'auto' );
		$this->addJSSetting("minlength", $this->settings["minlength"] ? $this->settings["minlength"] : 8);
		$this->addJSSetting("number", $this->settings["number"]);
		$this->addJSSetting("capital", $this->settings["capital"]);
		$this->addJSSetting("special", $this->settings["special"]);
		$this->addJSSetting("specialtooltipbgcolor", $this->settings["specialtooltipbgcolor"] ? $this->settings["specialtooltipbgcolor"] : "#F2F5A9");
		$this->addJSSetting("labelgeneral", $this->settings["labelgeneral"]);
		$this->addJSSetting("labelminlength", $this->settings["labelminlength"]);
		$this->addJSSetting("labelnumber", $this->settings["labelnumber"]);
		$this->addJSSetting("labelcapital", $this->settings["labelcapital"]);
		$this->addJSSetting("labelspecial", $this->settings["labelspecial"]);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control" style="width:'.$this->width.';" type="password" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'">'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controlesmib/secury/javascript/passwordstrength.js"); }
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controlesmib/secury/style/passwordstrength.css"); }
}
?>