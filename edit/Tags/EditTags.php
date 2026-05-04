<?php 
class EditTags extends UserControl
{	
	
	public function initUserControl()
	{

		$this->required = 				(isset($this->settings["required"])?$this->settings["required"]:false);
		$this->defaultLabel = 			(isset($this->settings["defaultLabel"])?$this->settings["defaultLabel"]:'Type here');
		$this->defaultTagClass = 		(isset($this->settings["defaultTagClass"])?$this->settings["defaultTagClass"]:'');
		$this->trimValue = 				(isset($this->settings["trimValue"])?$this->settings["trimValue"]:false);
		$this->dashspaces = 			(isset($this->settings["dashspaces"])?$this->settings["dashspaces"]:false);
		$this->lowercase = 				(isset($this->settings["lowercase"])?$this->settings["lowercase"]:false);
		$this->tagLimit = 				(isset($this->settings["tagLimit"])?$this->settings["tagLimit"]:0);
		$this->isSuggestions = 			(isset($this->settings["isSuggestions"])?$this->settings["isSuggestions"]:false);
		$this->noSuggestionMsg = 		(isset($this->settings["noSuggestionMsg"])?$this->settings["noSuggestionMsg"]:"< +");
		$this->sqlTagsSuggestions = 	(isset($this->settings["sqlTagsSuggestions"])?$this->settings["sqlTagsSuggestions"]:"SELECT 'a' fron dual");
		$this->whiteList = 				(isset($this->settings["whiteList"])?$this->settings["whiteList"]:false);
		$this->showAllSuggestions = 	(isset($this->settings["showAllSuggestions"])?$this->settings["showAllSuggestions"]:false);


		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("defaultLabel", $this->defaultLabel); 
		$this->addJSSetting("defaultTagClass", $this->defaultTagClass); 
		$this->addJSSetting("trimValue", $this->trimValue); 
		$this->addJSSetting("dashspaces", $this->dashspaces); 
		$this->addJSSetting("lowercase", $this->lowercase); 
		$this->addJSSetting("tagLimit", $this->tagLimit); 
		$this->addJSSetting("isSuggestions", $this->isSuggestions); 
		$this->addJSSetting("noSuggestionMsg", $this->noSuggestionMsg); 
		// $this->addJSSetting("sqlTagsSuggestions", $this->sqlTagsSuggestions); 
		// $this->addJSSetting("data",$dataAll); // Pararm for javasript
		$this->addJSSetting("whiteList", $this->whiteList);  
		$this->addJSSetting("showAllSuggestions", $this->showAllSuggestions);  

		if ($this->isSuggestions) { // Set labels suggestions

			// Read values of options
			$dataAll = [];
			// global $conn; 
			$rs = DB::Query($this->sqlTagsSuggestions);
			while ( $data = $rs->fetchNumeric() )
				{
					$dataAll[] = $data[0];
				}

			$this->addJSSetting("data",$dataAll); // Pararm for javasript
		}

	}

	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) { 
				
		echo $this->getSetting("label")
			.'<div class="form-group">'
			.'<input id="'.$this->cfield
			.'" class="form-control"  type="text" '				                     
			// .($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			// .(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '
			.'value="'.$value.'" >'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
			.'</div>';
		
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

		$this->pageObject->AddJSFile("plugins/controles/tags/js/jquery.amsify.suggestags.js");

		

	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object*/
	 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("plugins/controles/tags/css/amsify.suggestags.css");

	} 
}
?>