<?php
class ViewSwitch extends ViewUserControl
{

	public function initUserControl()
	{
                $this->button_size = ($this->settings["button_size"]?$this->settings["button_size"]:"normal");
                $this->button_color = ($this->settings["button_color"]?$this->settings["button_color"]:"default");
                $this->button_IOS = ($this->settings["button_IOS"]?$this->settings["button_IOS"]:false);
		

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $id_field = explode('=',$keylink);
            $switch = $data[$this->field];

            $field_value = ( $this->button_IOS === true ? '<label class="cl-switch ios' : '<label class="cl-switch ' )
            // Button Size "normal", "large" and "xlarge"
            . ( $this->button_size == "large" ? ' cl-switch-large ' : '' )
            . ( $this->button_size == "xlarge" ? ' cl-switch-xlarge ' : '' )
            // Button color "default","black","red","green" and "orange"
            . ( $this->button_color == "black" ? '  cl-switch-black ' : '' )
            . ( $this->button_color == "red" ? '  cl-switch-red ' : '' )
            . ( $this->button_color == "green" ? '  cl-switch-green ' : '' )
            . ( $this->button_color == "orange" ? '  cl-switch-orange ' : '' )
            .'">'

            .'<input  type="checkbox"  id="switch_'.$id_field[1].'"   style="text-align:left;" '
            . ' disabled '
            . ( $switch == 1 ? ' checked ' : '' )

            .($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
            .(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
            .' name="switch_'.$id_field[1].'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
            . '>'
            .' <span class="switcher"></span>'
            .'</label>';
            return $field_value;
        }


	public function addJSFiles() { 

                                }

                                
	public function addCSSFiles() {     
                                        $this->AddCSSFile("plugins/controles/switch/css/clean-switch.css");                                      
                                }
}
?>