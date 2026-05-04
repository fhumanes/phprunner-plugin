<?php 
class EditSwitch extends UserControl
{
	function initUserControl() {

		// $this->required = ($this->settings["required"]?$this->settings["required"]:false);
                // $this->addJSSetting("required", $this->required);
                $this->disabled = ($this->settings["disabled"]?$this->settings["disabled"]:false);
                $this->button_size = ($this->settings["button_size"]?$this->settings["button_size"]:"normal");
                $this->button_color = ($this->settings["button_color"]?$this->settings["button_color"]:"default");
                $this->button_IOS = ($this->settings["button_IOS"]?$this->settings["button_IOS"]:false);

	}
 
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
            
		echo $this->getSetting("label")
                        // iOS Style
                        . ( $this->button_IOS === true ? '<label class="cl-switch ios' : '<label class="cl-switch ' )
                        // Button Size "normal", "large" and "xlarge"
                        . ( $this->button_size == "large" ? ' cl-switch-large ' : '' )
                        . ( $this->button_size == "xlarge" ? ' cl-switch-xlarge ' : '' )
                        // Button color "default","black","red","green" and "orange"
                        . ( $this->button_color == "black" ? '  cl-switch-black ' : '' )
                        . ( $this->button_color == "red" ? '  cl-switch-red ' : '' )
                        . ( $this->button_color == "green" ? '  cl-switch-green ' : '' )
                        . ( $this->button_color == "orange" ? '  cl-switch-orange ' : '' )
                        .'">'

                        .'<input  type="checkbox"  id="'.$this->cfield.'"   style="text-align:left;" '

                        . ( $this->settings["disabled"] == true ? ' disabled ' : '' )
                        . ( $value == 1 ? ' checked ' : '' )
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
                        . '>'
                        .' <span class="switcher"></span>'
                        .'</label>';

			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { 
                                }

                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/switch/css/clean-switch.css"); }
}
?>