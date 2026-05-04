<?php 

class EditCalculator extends UserControl {

	function initUserControl() {

		$this->required = ($this->settings["required"]?$this->settings["required"]:false);
                $this->addJSSetting("required", $this->required);
                
                $this->language = ($this->settings["language"]?$this->settings["language"]:"en");
                $this->addJSSetting("language",$this->language);
                
                $this->layout = ($this->settings["layout"]?$this->settings["layout"]:"basic");
                $this->addJSSetting("layout",$this->layout);
                
                $this->decimals = ($this->settings["decimals"]?$this->settings["decimals"]:2);
                $this->addJSSetting("decimals", $this->decimals);
                
                $this->tooltip = ($this->settings["tooltip"]?$this->settings["tooltip"]:"You have a calculator to fill in the data");
                $this->addJSSetting("tooltip", $this->tooltip); 
	}

	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {

		echo 	$this->getSetting("label")
			.'<DIV class="input-group calculator"><input id="'.$this->cfield.'" '.$this->inputStyle.' class="calculator form-control"  style="text-align:right;" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'" >'
                        .'<span class="input-group-addon" id="imgCal_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-plus-sign"></span></span>'
                        .'</DIV>'
			. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
                        .' ';
                              
	}
       
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { 

                $dir = __DIR__ ;
                $dir = str_replace('\\', '/', $dir);
                $filename = $dir .'/../../templates_c/calculator-'.$this->language.'.min.js';
                $fileUrl = 'templates_c/calculator-'.$this->language.'.min.js';
                if (!file_exists($filename)) {

                    $fjs1 = $dir .'/../../plugins/controles/calculator/js/jquery.plugin.js';
                    $fjs2 = $dir .'/../../plugins/controles/calculator/js/jquery.calculator.js';
                    $fjslang = $dir .'/../../plugins/controles/calculator/lang/jquery.calculator-'.$this->language.'.js';
                    $js1 = file_get_contents($fjs1);
                    $js2 = file_get_contents($fjs2);
                    $js = $js1 . $js2;
                    if ($this->language <> 'en') {
                        $js3 = file_get_contents($fjslang);
                        $js .= $js3;
                     }
                    $fp = $filename;
                    if(!$fp) { die('Could not create / open text file for writing'.$filename);}
                    $status = file_put_contents($fp, $js);
                    if($status === false) { die('Could not write file. '.$filename);}
                }
                $this->pageObject->AddJSFile($fileUrl);             
	}

	function addCSSFiles() { 
                $this->pageObject->AddCSSFile('plugins/controles/calculator/css/jquery.calculator.css');
        }

}

?>