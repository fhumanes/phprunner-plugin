<?php 
class EditPersianDatePicker extends UserControl
{	
	
	public function initUserControl()
	{

		$this->required = 				(isset($this->settings["required"])?$this->settings["required"]:false);
		$this->onlySelectOnDate = 		(isset($this->settings["onlySelectOnDate"])?$this->settings["onlySelectOnDate"]:true);
		$this->onlyTimePicker = 		(isset($this->settings["onlyTimePicker"])?$this->settings["onlyTimePicker"]:false);
		$this->format = 				(isset($this->settings["format"])?$this->settings["format"]:'YYYY-MM-DD HH:mm:ss');
		$this->minDate = 				(isset($this->settings["minDate"])?$this->settings["minDatet"]:0);
		$this->maxDate = 				(isset($this->settings["maxDate"])?$this->settings["smaxDate"]:99999999999999);
		$this->endDate = 				(isset($this->settings["endDate"])?$this->settings["endDate"]:'');
		$this->autoClose = 				(isset($this->settings["autoClose"])?$this->settings["autoClose"]:true);
		$this->btnNextText = 			(isset($this->settings["btnNextText"])?$this->settings["btnNextText"]:"< +");
		$this->btnPrevText = 			(isset($this->settings["btnPrevText"])?$this->settings["btnPrevText"]:"- >");
		$this->timePicker_enabled = 	(isset($this->settings["timePicker_enabled"])?$this->settings["timePicker_enabled"]:false);


		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("onlySelectOnDate", $this->onlySelectOnDate); 
		$this->addJSSetting("onlyTimePicker", $this->onlyTimePicker); 
		$this->addJSSetting("format", $this->format); 
		$this->addJSSetting("minDate", $this->minDate); 
		$this->addJSSetting("maxDate", $this->maxDate); 
		$this->addJSSetting("autoClose", $this->autoClose); 
		$this->addJSSetting("btnNextText", $this->btnNextText); 
		$this->addJSSetting("btnPrevText", $this->btnPrevText); 
		$this->addJSSetting("timePicker_enabled", $this->timePicker_enabled); 

	}


	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
        $fecha = new DateTime();
		if ($value == null or $value == '' ){
			$fecha2 = '';
		} else {
			$fecha->setTimestamp($value);
			$fecha2 = $fecha->format('Y-m-d H:i:s');
			// $fecha2 = $fecha->format('Y-m-d');	
		}      
		echo ''
			.$this->getSetting("label")
			.'<DIV class="input-group date"> <input id="'.$this->cfield.'_alter" '.$this->inputStyle.' class="form-control"'
			.' class="form-control"  style="text-align:left;" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->tooltip . '" value="'.$fecha2.'" >'
			.'<span class="input-group-addon" id="imgCal_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-remove"></span></span>'
			.'<span class="input-group-addon" style="cursor:auto"><span class="glyphicon glyphicon-calendar"></span></span>'
			.'</DIV>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )

			// Second entrance field. The real one. It is hidden
            .'<DIV>'
			.'<input id="'.$this->cfield.'"'
			.$this->inputStyle
			.' class="form-control"  style="text-align:left;" type="hidden" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->tooltip . '" value="'.$fecha2.'" >'
			// .'<span class="input-group-addon" id="imgCal_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-th"></span></span>'
			.'</DIV>';
			// . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
			
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
		$lib[] ='plugins/controles/persiandatepicker/js/persian-date.min.js';
		$lib[] ='plugins/controles/persiandatepicker/js/persian-datepicker.min.js';
	
		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/persian-datepicker.min.js';
		$fileUrl = 'templates_c//persian-datepicker.min.js';
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
		$this->pageObject->AddCSSFile("plugins/controles/persiandatepicker/css/persian-datepicker.min.css");

	} 
}
?>