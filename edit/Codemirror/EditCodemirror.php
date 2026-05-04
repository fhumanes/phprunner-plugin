<?php 
class EditCodemirror extends UserControl
{	
	
	public function initUserControl()
	{

		$this->tooltip = (isset($this->settings["tooltip"])?$this->settings["tooltip"]:'Press "F11" to move to full screen');
		$this->addJSSetting("tooltip", $this->tooltip); 
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
		$lib[] ='plugins/controles/codemirror/lib/codemirror.js';
		$lib[] ='plugins/controles/codemirror//addon/edit/matchbrackets.js';
		$lib[] ='plugins/controles/codemirror/mode/htmlmixed/htmlmixed.js';
		$lib[] ='plugins/controles/codemirror/mode/xml/xml.js';
		$lib[] ='plugins/controles/codemirror/mode/javascript/javascript.js';
		$lib[] ='plugins/controles/codemirror/mode/css/css.js';
		$lib[] ='plugins/controles/codemirror/mode/clike/clike.js';
		$lib[] ='plugins/controles/codemirror/mode/sql/sql.js';
		$lib[] ='plugins/controles/codemirror/addon/selection/active-line.js';
		$lib[] ='plugins/controles/codemirror/addon/scroll/simplescrollbars.js';
		$lib[] ='plugins/controles/codemirror/addon/display/fullscreen.js';

		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/codemirror.min.js';
		$fileUrl = 'templates_c/codemirror.min.js';
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
		$this->pageObject->AddCSSFile("plugins/controles/codemirror/lib/codemirror.css");
		$this->pageObject->AddCSSFile("plugins/controles/codemirror/addon/scroll/simplescrollbars.css");
		$this->pageObject->AddCSSFile("plugins/controles/codemirror/addon/display/fullscreen.css");
		$this->pageObject->AddCSSFile("plugins/controles/codemirror/plugins.css");

	} 
}
?>