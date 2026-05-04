<?php 
class EditTagEditor extends UserControl
{
	var $theme, $autocomplete;
	function initUserControl()
	{
		$this->theme="flick";
		$this->autocomplete=false;
		
		if (isset($this->settings["theme"]))
			$this->theme=$this->settings["theme"];
		if (isset($this->settings["autocomplete"]))
			$this->autocomplete=$this->settings["autocomplete"];		
		$this->addJSSetting("autocomplete", $this->autocomplete);			
			
		if ($this->autocomplete) {
			$_SESSION['tagit_table']=$this->settings["table"];
			$_SESSION['tagit_field']=$this->settings["display_field"];
		}
		
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		echo '<div id="TagEditor_'.$this->cfield.'">'.
			$this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' value="'
			.htmlspecialchars($value).'"></div>';	
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
		$this->pageObject->AddJSFile("include/js/jquery-ui.min.js");
		$this->pageObject->AddJSFile("include/js/tag-it.js", "include/js/jquery-ui.min.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		
		$this->pageObject->AddCSSFile("include/css/jquery.tagit.css");
		$url = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/".$this->theme."/jquery-ui.css";
		$this->pageObject->AddCSSFile($url);
		
	}
}
?>