<?php 
class EditToggle extends UserControl
{
	function initUserControl() {

		$this->addJSSetting("required", ($this->settings["required"]?$this->settings["required"]:false) );
                $this->required = $this->settings["required"];
		
                $this->addJSSetting("disabled", ($this->settings["disabled"]?$this->settings["disabled"]:false) );
                $this->addJSSetting("name_enable", ($this->settings["name_enable"]?$this->settings["name_enable"]:"On") );               
                $this->addJSSetting("name_disable", ($this->settings["name_disable"]?$this->settings["name_disable"]:"Off") );
                $this->addJSSetting("size", ($this->settings["size"]?$this->settings["size"]:"normal") );
                $this->addJSSetting("style", ($this->settings["style"]?$this->settings["style"]:"primary") );

	}
        
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
            
		echo $this->getSetting("label")
                        // .'<DIV class="toggle">'
                        .'<input  type="checkbox" data-toggle="toggle" id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" '
                        . 'data-on="'. $this->settings["name_enable"] .'" data-off="'. $this->settings["name_disable"].'" '
                        .' data-size="'. $this->settings["size"] .'" data-onstyle="'. $this->settings["style"] .'" '
                        . ( $this->settings["disabled"] == true ? ' disabled ' : '' )
                        . ( $value == 1 ? ' checked ' : '' )
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			// .' title="' . $this->settings["tooltip"]
                        . '" value="1" >'
                        //.'</DIV>'
                        // . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' ) 
                        ;
			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controles/toggle/js/bootstrap-toggle.min.js");
                                // $this->pageObject->AddJSFile("plugins/controles/toggle/js/bootstrap-toggle.min.js.map");
                                }

                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/toggle/css/bootstrap-toggle.min.css"); }
}
?>