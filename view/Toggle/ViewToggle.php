<?php
class ViewToggle extends ViewUserControl
{
        var $name_enable, $name_disable, $size, $style;

	public function initUserControl()
	{
            	$this->name_enable = 'On';
		$this->name_disable = 'Off';
		$this->size = 'normal';
		$this->style = 'primary';
		
                if($this->settings["name_enable"]) { $this->name_enable=$this->settings["name_enable"];	}
                if($this->settings["name_disable"]) { $this->name_disable=$this->settings["name_disable"]; }
                if($this->settings["size"]) { $this->size=$this->settings["size"];}
                if($this->settings["style"]) { $this->style=$this->settings["style"];}

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $id_field = explode('=',$keylink);
            $toggle = $data[$this->field];
            
            $field_value = '<span '. 'id="toggle_'.$id_field[1]. '">'
            .' <label> <input type="checkbox" '
            . ($toggle == '1' ? ' checked ' : ' ')
            . 'data-on="'. $this->name_enable .'" '
            . 'data-off="'. $this->name_disable .'" '
            . 'data-toggle="toggle" disabled '
            . 'data-size="'. $this->size. '" '
            . 'data-onstyle="' . $this->style . '" ' 
            .' > </label> ';
            return $field_value;
        }


	public function addJSFiles() { 
                                $this->AddJSFile("plugins/controles/toggle/js/bootstrap-toggle.min.js");
                                // $this->pageObject->AddJSFile("plugins/controles/toggle/js/bootstrap-toggle.min.js.map");
                                }

                                
	public function addCSSFiles() {     
                                        $this->AddCSSFile("plugins/controles/toggle/css/bootstrap-toggle.min.css");                                      
                                }
}
?>