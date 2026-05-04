<?php 

class EditTelegramia extends UserControl {

	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->width = ( $this->settings["width"] ? $this->settings["width"] : 'auto' );
		$this->addJSSetting("type", $this->settings["type"]);
		$this->addJSSetting("min", $this->settings["min"]);
		$this->addJSSetting("max", $this->settings["max"]);
		$this->addJSSetting("countContainerElement", $this->settings["countContainerElement"]);
		$this->addJSSetting("countContainerClass", $this->settings["countContainerClass"]);
		$this->addJSSetting("inputErrorClass", $this->settings["inputErrorClass"]);
		$this->addJSSetting("counterErrorClass", $this->settings["counterErrorClass"]);
		$this->addJSSetting("counterText", $this->settings["counterText"]);
		$this->addJSSetting("errorTextElement", $this->settings["errorTextElement"]);
		$this->addJSSetting("minimumErrorText", $this->settings["minimumErrorText"]);
		$this->addJSSetting("maximumErrorText", $this->settings["maximumErrorText"]);
		$this->addJSSetting("displayErrorText", $this->settings["displayErrorText"]);
		$this->addJSSetting("stopInputAtMaximum", $this->settings["stopInputAtMaximum"]);
		$this->addJSSetting("countSpaces", $this->settings["countSpaces"]);
		$this->addJSSetting("countDown", $this->settings["countDown"]);
		$this->addJSSetting("countDownText", $this->settings["countDownText"]);
		$this->addJSSetting("countExtendedCharacters", $this->settings["countExtendedCharacters"]);
		$this->addJSSetting("maxcount", $this->settings["maxcount"]);
		$this->addJSSetting("mincount", $this->settings["mincount"]);
		$this->addJSSetting("init", $this->settings["init"]);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo 	$this->getSetting("label")
			.'<textarea id="'.$this->cfield .'" class="form-control" '  . 
                        //' style="width:' . $this->width . ';' . $this->settings["style"] . '" ' .
			'rows="' . $this->settings["rows"] . '"'
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' // .$this->pageObject->pSetEdit->getEditParams($this->field)
			.'" placeholder="'. $this->settings["placeholder"]
			.'" title="' . $this->settings["tooltip"] . '"'
			.'>' . htmlspecialchars($value) . '</textarea>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { 
		$this->pageObject->AddJSFile('plugins/controlesmib/telegramia/javascript/textcounter.js');
		// $this->pageObject->AddJSFile('plugins/controlesmib/telegramia/javascript/sweetalert.js');
	}

	function addCSSFiles() { $this->pageObject->AddCSSFile('plugins/controlesmib/telegramia/style/sweetalert.css'); }

}

?>