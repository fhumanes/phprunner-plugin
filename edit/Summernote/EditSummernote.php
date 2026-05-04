<?php 

class EditSummernote extends UserControl {

	function initUserControl() {
$option_menu = array(
    array('style', array('style')),
    array('font', array('bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear')),
    array('paragraph', array('ul', 'ol', 'paragraph')),
    array('color', array('color')),
    array('table', array('table')),
    array('insert', array('picture', 'link', 'video')),
    array('emoji',array('emoji')),
    array('view', array('fullscreen', 'codeview', 'undo', 'redo')),
    array('help')
)
;
$plugins_default = array('emoji','specialchars'); 

		$this->required = ($this->settings["required"]?$this->settings["required"]:false);
                $this->addJSSetting("required", $this->required);

		$this->height = ($this->settings["height"]?$this->settings["height"]:"300");
                $this->addJSSetting("height",$this->height);
                
                $this->minHeight = ($this->settings["minHeight"]?$this->settings["minHeight"]:null);
                $this->addJSSetting("minHeight",$this->minHeight);
                
                $this->maxHeight = ($this->settings["maxHeight"]?$this->settings["maxHeight"]:null);
                $this->addJSSetting("maxHeight",$this->maxHeight);
                
                $this->language = ($this->settings["language"]?$this->settings["language"]:"en-US");
                $this->addJSSetting("language",$this->language);
                
                $this->spellCheck = ($this->settings["spellCheck"]?$this->settings["spellCheck"]:true);
                $this->addJSSetting("spellCheck",$this->spellCheck);
                
                $this->disableGrammar = ($this->settings["disableGrammar"]?$this->settings["disableGrammar"]:false);
                $this->addJSSetting("disableGrammar", $this->disableGrammar);

                $this->plugins = ($this->settings["plugins"]?$this->settings["plugins"]:$plugins_default);
                $this->addJSSetting("plugins", $this->plugins);

                $this->toolbar_menu = ($this->settings["toolbar_menu"]?$this->settings["toolbar_menu"]:$option_menu);
                $this->addJSSetting("toolbar_menu", $this->toolbar_menu);
        
	}

	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {

		echo 	$this->getSetting("label")
			.'<textarea id="'.$this->cfield .'" class="form-control textarea-control" '  
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' 
			.' >' . $value . '</textarea>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
                        .' ';
	}
       
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { 

        $lib = [];
		$lib[] ='plugins/controles/summernote/summernote.min.js';
        if (in_array("emoji",$this->plugins)) {
            $lib[] ='plugins/controles/summernote/plugin/emoji/js/config.js';
            $lib[] ='plugins/controles/summernote/plugin/emoji/js/FontAwesome.js';
            $lib[] ='plugins/controles/summernote/plugin/emoji/js/tam-emoji.min.js';
        }
        if (in_array('specialchars',$this->plugins)) {
            $lib[] ='plugins/controles/summernote/plugin/specialchars/summernote-ext-specialchars.js';
        }

		if ($this->language != 'en-US') {
			$lib[] ='plugins/controles/summernote/lang/summernote-'.$this->language.'.min.js';
			}
		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/summernote-'.$this->language.'.min.js';
		$fileUrl = 'templates_c/summernote-'.$this->language.'.min.js';
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

	function addCSSFiles() { 
                $this->pageObject->AddCSSFile('plugins/controles/summernote/summernote.min.css');
                if (in_array("emoji",$this->plugins)) {
                    $this->pageObject->AddCSSFile('plugins/controles/summernote/plugin/emoji/css/emoji.css');
                }
               
        }

}

?>