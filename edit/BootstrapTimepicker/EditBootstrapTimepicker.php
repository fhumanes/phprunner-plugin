<?php 
class EditBootstrapTimepicker extends UserControl
{
	var $minuteStep, $secondStep, $showSeconds, $showMeridian, $required;
	function initUserControl()
	{
	
		$this->minuteStep=15;
		$this->secondStep=15;
		$this->showSeconds=false;
		$this->showMeridian=true;
		$this->required=false;
	
		if (isset($this->settings["minuteStep"]))
			$this->minuteStep=$this->settings["minuteStep"];
		if (isset($this->settings["secondStep"]))
			$this->secondStep=$this->settings["secondStep"];
		if (isset($this->settings["showSeconds"]))
			$this->showSeconds=$this->settings["showSeconds"];
		if (isset($this->settings["showMeridian"]))
			$this->showMeridian=$this->settings["showMeridian"];
		if (isset($this->settings["required"]))
			$this->required=$this->settings["required"];
	
		$this->addJSSetting("minuteStep", $this->minuteStep);
		$this->addJSSetting("secondStep", $this->secondStep);
		$this->addJSSetting("showSeconds", $this->showSeconds);
		$this->addJSSetting("showMeridian", $this->showMeridian);
		$this->addJSSetting("required", $this->required);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		// truncate date part if required
		$arr=explode(' ',$value);
		if (count($arr)>1)
			$value=$arr[1];
		
		echo '<div class="bootstrap-input-append bootstrap-timepicker-component"><input id="'.$this->cfield.'" '.$this->inputStyle.' class="bootstrap-input-small" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' value="'
			.htmlspecialchars($value).'"><span class="bootstrap-add-on"><i class="icon-time"></i></span></div>';	
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
		$this->pageObject->AddJSFile("include/js/bootstrap-timepicker.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/css/timepicker.css");
	}
	
	
	
	function readWebValue(&$avalues, &$blobfields, $strWhereClause = "", $oldValuesRead = false, &$filename_values = null)
	{


		$this->getPostValueAndType();
		if (FieldSubmitted($this->goodFieldName."_".$this->id))
			$this->webValue = prepare_for_db($this->field, $this->webValue, $this->webType);
		else
			$this->webValue = false;
			
		$this->webValue = localtime2db($this->webValue);	
		global $strTableName;
		$pSet = new ProjectSettings($strTableName);

		if(IsDateFieldType($pSet->getFieldType($this->field)))
		{
			$this->webValue = substr(now(),0,11).$this->webValue;
		}
		

				
		if(!($this->webValue===false))
		{
			$avalues[$this->field] = $this->webValue;
		}
	} 
	
}
?>