<?php 
class EditTrumbowyg extends UserControl
{	
	protected $lang;
	protected $semantic;
	protected $btns;
	protected $templates;
	
	public function initUserControl()
	{
		
		$this->lang = 'en';
		$this->lang = $this->settings["lang"];
		$this->addJSSetting("lang", $this->lang);

		$this->semantic = true;
		$this->semantic = $this->settings["semantic"];
		$this->addJSSetting("semantic", $this->semantic);

		
        $this->btns = ($this->settings["btns"]?$this->settings["btns"]:$option_menu);
        $this->addJSSetting("btns", $this->btns);

		$this->templates = $this->settings["templates"];
		$this->addJSSetting("templates", $this->templates);
	}
	
	public function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{	
		// Load Icons manual
		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$fileIcons = $dir .'/../../plugins/controles/trumbowyg/ui/icons.svg';
		$ficons = file_get_contents($fileIcons);
		$icons ='<div id="'.$this->cfield .'-icons">'.$ficons.'</div>';

		echo $this->getSetting("label")
			.'<textarea id="'.$this->cfield .'" class="trumbowyg-box trumbowyg-editor-visible trumbowyg-de trumbowyg form-control" ' 
			// .'<textarea id="'.$this->cfield .'" class="form-control textarea-control" '  
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' 
			.' >' . $value . '</textarea>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
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
		$lib[] ='plugins/controles/trumbowyg/trumbowyg.min.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/fontsize/trumbowyg.fontsize.min.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/colors/trumbowyg.colors.min.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/table/trumbowyg.table.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/indent/trumbowyg.indent.min.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/allowtagsfrompaste/trumbowyg.allowtagsfrompaste.min.js';
		$lib[] ='plugins/controles/trumbowyg/plugins/template/trumbowyg.template.js';
		if ($this->lang != 'en') {
			$lib[] ='plugins/controles/trumbowyg/langs/'.$this->lang.'.min.js';
			}
		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/trumbowyg-'.$this->lang.'.min.js';
		$fileUrl = 'templates_c/trumbowyg-'.$this->lang.'.min.js';
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
		
		/*
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/trumbowyg.min.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/fontsize/trumbowyg.fontsize.min.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/colors/trumbowyg.colors.min.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/table/trumbowyg.table.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/indent/trumbowyg.indent.min.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/allowtagsfrompaste/trumbowyg.allowtagsfrompaste.min.js");
		$this->pageObject->AddJSFile("plugins/controles/trumbowyg/plugins/template/trumbowyg.template.js"); 
		if ($this->lang != 'en') {
				$this->pageObject->AddJSFile("plugins/controles/trumbowyg/langs/".$this->lang.".min.js");
		}
		*/	
		

	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object*/
	 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("plugins/controles/trumbowyg/ui/trumbowyg.min.css");
		$this->pageObject->AddCSSFile("plugins/controles/trumbowyg/plugins/colors/ui/trumbowyg.colors.min.css");
		$this->pageObject->AddCSSFile("plugins/controles/trumbowyg/plugins/table/ui/trumbowyg.table.min.css"); 
		$this->pageObject->AddCSSFile("plugins/controles/trumbowyg/ui/trumbowyg-fontawesome-icons.css"); 
		// $this->pageObject->AddCSSFile("https://use.fontawesome.com/releases/v5.15.2/css/all.css"); 
	} 
}
?>