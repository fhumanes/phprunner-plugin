<?php 
class EditTimmy extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("format", ($this->settings["format"]?$this->settings["format"]:"DD/MM/YYYY HH:mm") );
		$this->addJSSetting("shortTime", $this->settings["shortTime"]);
		$this->addJSSetting("minDate", $this->settings["minDate"]);
		$this->addJSSetting("maxDate", $this->settings["maxDate"]);
		$this->addJSSetting("currentDate", $this->settings["currentDate"]);
		$this->addJSSetting("date", $this->settings["date"]);
		$this->addJSSetting("time", $this->settings["time"]);
		$this->addJSSetting("clearButton", $this->settings["clearButton"]);
		$this->addJSSetting("nowButton", $this->settings["nowButton"]);
		$this->addJSSetting("switchOnClick", $this->settings["switchOnClick"]);
		$this->addJSSetting("cancelText", ($this->settings["cancelText"]?$this->settings["cancelText"]:"Cancel"));
		$this->addJSSetting("okText", ($this->settings["okText"]?$this->settings["okText"]:"OK"));
		$this->addJSSetting("clearText", ($this->settings["clearText"]?$this->settings["clearText"]:"Clear"));
		$this->addJSSetting("nowText", ($this->settings["nowText"]?$this->settings["nowText"]:"Now"));
		$this->addJSSetting("lang", ($this->settings["lang"]?$this->settings["lang"]:"en"));
		$this->addJSSetting("weekStart", $this->settings["weekStart"]);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' style="text-align:left;" readonly=true type="text"  class="form-control"'
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'" >'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controlesmib/timmy/javascript/bootstrap-material-datetimepicker.js"); }
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controlesmib/timmy/style/bootstrap-material-datetimepicker.css"); }
}
?>