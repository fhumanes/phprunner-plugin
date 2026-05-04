<?php 
class EditBootstrapDatePicker extends UserControl
{	
	
	public function initUserControl()
	{

		$this->required = 				(isset($this->settings["required"])?$this->settings["required"]:false);
		$this->tooltip = 				(isset($this->settings["tooltip"])?$this->settings["tooltip"]:'Enter the date of ......');
		$this->format = 				(isset($this->settings["format"])?$this->settings["format"]:'mm/dd/yyyy');
		$this->weekStart = 				(isset($this->settings["weekStart"])?$this->settings["weekStart"]:'0');
		$this->startDate = 				(isset($this->settings["startDate"])?$this->settings["startDate"]:'');
		$this->endDate = 				(isset($this->settings["endDate"])?$this->settings["endDate"]:'');
		$this->todayBtn = 				(isset($this->settings["todayBtn"])?$this->settings["todayBtn"]:true);
		$this->clearBtn = 				(isset($this->settings["clearBtn"])?$this->settings["clearBtn"]:true);
		$this->daysOfWeekDisabled = 	(isset($this->settings["daysOfWeekDisabled"])?$this->settings["daysOfWeekDisabled"]:"0,6");
		$this->daysOfWeekHighlighted = 	(isset($this->settings["daysOfWeekHighlighted"])?$this->settings["daysOfWeekHighlighted"]:"0,6");
		$this->calendarWeeks = 			(isset($this->settings["calendarWeeks"])?$this->settings["calendarWeeks"]:false);
		$this->autoclose = 				(isset($this->settings["autoclose"])?$this->settings["autoclose"]:true);
		$this->todayHighlight = 		(isset($this->settings["todayHighlight"])?$this->settings["todayHighlight"]:true);
		$this->language = 				(isset($this->settings["language"])?$this->settings["language"]:'en-GB');
		$this->datesDisabled = 			(isset($this->settings["datesDisabled"])?$this->settings["datesDisabled"]:'');

		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("tooltip", $this->tooltip); 
		$this->addJSSetting("format", $this->format);
		// $this->addJSSetting("formatPHP", $this->formatPHP);  
		$this->addJSSetting("weekStart", $this->weekStart); 
		$this->addJSSetting("startDate", $this->startDate); 
		$this->addJSSetting("endDate", $this->endDate); 
		$this->addJSSetting("todayBtn", $this->todayBtn); 
		$this->addJSSetting("clearBtn", $this->clearBtn); 
		$this->addJSSetting("daysOfWeekDisabled", $this->daysOfWeekDisabled); 
		$this->addJSSetting("daysOfWeekHighlighted", $this->daysOfWeekHighlighted); 
		$this->addJSSetting("calendarWeeks", $this->calendarWeeks); 
		$this->addJSSetting("autoclose", $this->autoclose); 
		$this->addJSSetting("todayHighlight", $this->todayHighlight); 
		$this->addJSSetting("language", $this->language); 
		$this->addJSSetting("datesDisabled", $this->datesDisabled);  
	}


	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
        $formatPHP = $this->format;
		$searchVal = array("yyyy", "mm", "dd");
        $replaceVal = array("Y", "m", "d");
		$formatPHP = str_replace($searchVal, $replaceVal, $formatPHP);

		if ( $value ==  NULL || $value ==  '' ) {
				$value = '';
		} else {
			$value = date($formatPHP, strtotime($value));	
		}    
		echo $this->getSetting("label")
            .'<DIV class="input-group date"><input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->tooltip . '" value="'.$value.'" >'
			.'<span class="input-group-addon" id="imgCal_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-th"></span></span>'
			.'</DIV>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
			
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
		$lib = [];
		$lib[] ='plugins/controles/bootstrapdatepicker/js/bootstrap-datepicker.min.js';
		$lib[] ='plugins/controles/bootstrapdatepicker/locales/bootstrap-datepicker.'.$this->language.'.min.js';
	
		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/bootstrap-datepicker-'.$this->language.'.min.js';
		$fileUrl = 'templates_c//bootstrap-datepicker-'.$this->language.'.min.js';
		$fjs =''; // For concat content file of JS
		if (!file_exists($filename)) {
            for ( $i=0;$i < count($lib); $i++) {
				$fjs .= file_get_contents($lib[$i]);
			}            
			$fp = $filename;			
			if(!$fp) { die('Could not create / open text file for writing'.$filename);}		
			$status = file_put_contents($fp, $fjs);
			if($status === false) { die('Could not write file. '.$filename);}
		}
		
		$this->pageObject->AddJSFile($fileUrl);

		

	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object*/
	 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("plugins/controles/bootstrapdatepicker/css/bootstrap-datepicker.min.css");

	} 
}
?>