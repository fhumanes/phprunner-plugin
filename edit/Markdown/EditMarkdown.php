<?php 

class EditMarkdown extends UserControl { 

	function initUserControl() {

		$this->required = ($this->settings["required"]?$this->settings["required"]:false);
                $this->addJSSetting("required", $this->required);

		$this->height = ($this->settings["height"]?$this->settings["height"]:"300px");
                $this->addJSSetting("height",$this->height);
                $this->editType = ($this->settings["editType"]?$this->settings["editType"]:"wysiwyg");
                $this->addJSSetting("editType", $this->editType);
                $this->language = ($this->settings["language"]?$this->settings["language"]:"en");
                $this->addJSSetting("language",$this->language);
                $this->fileLanguage = ($this->settings["fileLanguage"]?$this->settings["fileLanguage"]:"en-us.js");
                $this->addJSSetting("fileLanguage",$this->fileLanguage);
	}


	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
                if ($value == null) $value = '';
                        echo '<span id="current_'.$this->cfield.'" style="display: none" >'.base64_encode($value).'</span>';
                // htmlspecialchars($value, ENT_HTML5); || addslashes($value)
		echo 	$this->getSetting("label")
                        .'<div class="code-html tui-doc-contents"> '."\n"
			.'<div id="'.$this->cfield.'" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' 
                        .'> '."\n"
                        .'</div>'."\n" 
                        // ."<script src='plugins/controles/markdown/js/toastui-editor-all.min.js'></script>"
                        // ."<script src='plugins/controles/markdown/i18n/".$this->fileLanguage."'></script>"             
                        .' '; 
                
	}
       
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { 
		$this->pageObject->AddJSFile('plugins/controles/markdown/js/toastui-editor-all.min.js');
		// $this->pageObject->AddJSFile('plugins/controles/markdown/i18n/'.$this->fileLanguage);

	}

	function addCSSFiles() { 
                $this->pageObject->AddCSSFile('plugins/controles/markdown/css/toastui-editor.min.css');
                $this->pageObject->AddCSSFile('plugins/controles/markdown/codemirror/codemirror.css');
        
        }

}

?>