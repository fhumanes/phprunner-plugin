<?php 
class EditHijriDatePicker extends UserControl
{
	function initUserControl() {
 
		$this->addJSSetting("required", ($this->settings["required"]?$this->settings["required"]:false) );
		$this->addJSSetting("tooltip", ($this->settings["tooltip"]?$this->settings["tooltip"]:"Click here to enter date") );
		$this->addJSSetting("format", ($this->settings["format"]?$this->settings["format"]:"M/D/YYYY") );
		$this->addJSSetting("viewMode", ($this->settings["viewMode"]?$this->settings["viewMode"]:'days') );
                $this->addJSSetting("hijri", ($this->settings["hijri"]?$this->settings["hijri"]:true) );
                $this->addJSSetting("hijriFormat", ($this->settings["hijriFormat"]?$this->settings["hijriFormat"]:'iYYYY-iM-iD') );
                $this->addJSSetting("useCurrent", ($this->settings["useCurrent"]?$this->settings["useCurrent"]:true) );
                $this->addJSSetting("minDate", ($this->settings["minDate"]?$this->settings["minDate"]:"1950-01-01") );
                $this->addJSSetting("maxDate", ($this->settings["maxDate"]?$this->settings["maxDate"]:"2070-01-01") );
                $this->addJSSetting("viewDate", ($this->settings["viewDate"]?$this->settings["viewDate"]:"2020-01-01") );
                $this->addJSSetting("locale", ($this->settings["locale"]?$this->settings["locale"]:'ar-sa') );
                $this->addJSSetting("showClear", ($this->settings["showClear"]?$this->settings["showClear"]:false) );
                $this->addJSSetting("showClose", ($this->settings["showClose"]?$this->settings["showClose"]:false) );
                $this->addJSSetting("showTodayButton", ($this->settings["showTodayButton"]?$this->settings["showTodayButton"]:false) );
                $this->addJSSetting("iconPrevious", ($this->settings["iconPrevious"]?$this->settings["iconPrevious"]:'<') );
                $this->addJSSetting("iconNext", ($this->settings["iconNext"]?$this->settings["iconNext"]:'>') );
                $this->addJSSetting("iconToday", ($this->settings["iconToday"]?$this->settings["iconToday"]:'Today') );
                $this->addJSSetting("iconClear", ($this->settings["iconClear"]?$this->settings["iconClear"]:'Clear') );
                $this->addJSSetting("iconClose", ($this->settings["iconClose"]?$this->settings["iconClose"]:'Close') ); 
                $this->addJSSetting("showSwitcher", ($this->settings["showSwitcher"]?$this->settings["showSwitcher"]:false) );
                $this->addJSSetting("hijriText", ($this->settings["hijriText"]?$this->settings["hijriText"]:'Hijri') );
                $this->addJSSetting("gregorianText", ($this->settings["gregorianText"]?$this->settings["gregorianText"]:'Gregorian') );
	}
        
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
            
		echo $this->getSetting("label")
                        .'<DIV class="input-group date"><input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'" >'
                        .'<span class="input-group-addon" id="imgCal_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-calendar"></span></span>'
                        .'</DIV>'
                        . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { // $this->pageObject->AddJSFile("plugins/controles/hijridatepicker/js/moment.min.js");
                                $this->pageObject->AddJSFile("plugins/controles/hijridatepicker/js/bootstrap-hijri-datetimepicker.js");}
                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/hijridatepicker/css/bootstrap-datetimepicker.min.css"); }
}
?>