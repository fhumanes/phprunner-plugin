<?php 

class EditEmoji extends UserControl {

	function initUserControl() {

		$this->addJSSetting("required", ($this->settings["required"]?$this->settings["required"]:false) );
                $this->required = $this->settings["required"];
		
                $this->addJSSetting("height", ($this->settings["height"]?$this->settings["height"]:"100px") );
	}
        
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		echo 	$this->getSetting("label")
                        .'<p class="lead emoji-picker-container">'
			.'<textarea id="'.$this->cfield .'" class="form-control textarea-control"'.'" style="height: '.$this->settings["height"] .';" '  

			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" ' 
			.' data-emojiable="true">' . htmlspecialchars($value) . '</textarea>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
                        .' ';
	}
       
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { 
		$this->pageObject->AddJSFile('plugins/controles/emoji/js/config.js');
		$this->pageObject->AddJSFile('plugins/controles/emoji/js/util.js');
                $this->pageObject->AddJSFile('plugins/controles/emoji/js/jquery.emojiarea.js');
                $this->pageObject->AddJSFile('plugins/controles/emoji/js/emoji-picker.js');
	}

	function addCSSFiles() { 
                $this->pageObject->AddCSSFile('plugins/controles/emoji/css/emoji.css');
                $this->pageObject->AddCSSFile('plugins/controles/emoji/font-awesome-4.5.0/css/font-awesome.min.css'); 
        
        }

}

?>