<?php 
class EditSqlcodemirror5 extends UserControl
{		
	public function initUserControl()
	{
		$this->tooltip = (isset($this->settings["tooltip"])?$this->settings["tooltip"]:'Press "F11" to move to full screen or "Crtl+space" for "autocomplete"');
		$this->addJSSetting("tooltip", $this->tooltip);
                $this->hintOptions = (isset($this->settings["hintOptions"])?$this->settings["hintOptions"]:[]);
		$this->addJSSetting("hintOptions", $this->hintOptions);
	}
	
	public function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{	

		echo $this->getSetting("label")
			.'<textarea id="'.$this->cfield .'" class="form-control textarea-control" '  
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' 
			.' title="' . $this->tooltip  .'" >'.$value. '</textarea>'
			. ( $this->tooltip <> '' ? "\n".$this->tooltip .'  ' : '' ) 
			// . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
            .' ';
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
		$lib[] ='plugins/controles/Sqlcodemirror5/js/codemirror.js';
                $lib[] ='plugins/controles/Sqlcodemirror5/js/sql.js';
                $lib[] ='plugins/controles/Sqlcodemirror5/addon/fullscreen.js';
                $lib[] ='plugins/controles/Sqlcodemirror5/addon/matchbrackets.js';
                $lib[] ='plugins/controles/Sqlcodemirror5/addon/show-hint.js';
                $lib[] ='plugins/controles/Sqlcodemirror5/addon/sql-hint.js';

		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/Sqlcodemirror5.min.js';
		$fileUrl = 'templates_c/Sqlcodemirror5.min.js';
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
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/custom_codemirror.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/codemirror.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/fullscreen.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/show-hint.css");
	} 
}
?>