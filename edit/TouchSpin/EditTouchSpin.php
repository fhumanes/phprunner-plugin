<?php 
class EditTouchSpin extends UserControl
{
	function initUserControl() {
                $this->required = 		(isset($this->settings["required"])?$this->settings["required"]:false);

                $this->min = 			(isset($this->settings["min"])?$this->settings["min"]:"0");
                $this->max = 			(isset($this->settings["max"])?$this->settings["max"]:"100");
                $this->initval = 		(isset($this->settings["init-val"])?$this->settings["init-val"]:"0");
                $this->step= 			(isset($this->settings["step"])?$this->settings["step"]:"1");
                $this->decimal = 		(isset($this->settings["decimal"])?$this->settings["decimal"]:"0");
                $this->stepinterval = 		(isset($this->settings["step-interval"])?$this->settings["step-interval"]:"100");
                $this->forcestepdivisibility = 	(isset($this->settings["force-step-divisibility"])?$this->settings["force-step-divisibility"]:"round");
                $this->stepintervaldelay = 	(isset($this->settings["step-interval-delay"])?$this->settings["step-interval-delay"]:"500");
                $this->prefix = 		(isset($this->settings["prefix"])?$this->settings["prefix"]:"");
                $this->postfix = 		(isset($this->settings["postfix"])?$this->settings["postfix"]:"");
                $this->prefixextraclass = 	(isset($this->settings["prefix-extra-class"])?$this->settings["prefix-extra-class"]:"");
                $this->postfixextraclass = 	(isset($this->settings["postfix-extra-class"])?$this->settings["postfix-extra-class"]:"");
                $this->booster= 		(isset($this->settings["booster"])?$this->settings["booster"]:"true");
                $this->boostat = 		(isset($this->settings["boostat"])?$this->settings["boostat"]:"10");
                $this->maxboostedstep = 	(isset($this->settings["max-boosted-step"])?$this->settings["max-boosted-step"]:"false");
                $this->mousewheel = 		(isset($this->settings["mousewheel"])?$this->settings["mousewheel"]:"true");
                $this->buttondownclass = 	(isset($this->settings["button-down-class"])?$this->settings["button-down-class"]:"btn btn-primary");
                $this->buttonupclass = 		(isset($this->settings["button-up-class"])?$this->settings["button-up-class"]:"btn btn-primary");
                $this->verticalbuttons = 	(isset($this->settings["verticalbuttons"])?$this->settings["verticalbuttons"]:"false");
                
                $this->addJSSetting("verticalbuttons", $this->verticalbuttons);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
            
	        echo $this->getSetting("label")
                .'<input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" type="text" '
		.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
		.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
		.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
		.' title="' . $this->tooltip . '" value="'.$value.'"'
                .'data-bts-min="'.$this->min.'" '
                .'data-bts-max="'.$this->max.'" '
                .'data-bts-init-val="'.$this->initval.'" '
                .'data-bts-step="'.$this->step.'" ' 
                .'data-bts-decimal="'.$this->decimal.'" '
                .'data-bts-step-interval="'.$this->stepinterval.'" ' 
                .'data-bts-force-step-divisibility="'.$this->forcestepdivisibility.'" ' 
                .'data-bts-step-interval-delay="'.$this->stepintervaldelay.'" ' 
                .'data-bts-prefix="'.$this->prefix.'" '
                .'data-bts-postfix="'.$this->postfix.'" '
                .'data-bts-prefix-extra-class="'.$this->prefixextraclass.'" ' 
                .'data-bts-postfix-extra-class="'.$this->postfixextraclass.'" '
                .'data-bts-booster="'.$this->booster.'" ' 
                .'data-bts-boostat="'.$this->boostat.'" '
                .'data-bts-max-boosted-step="'.$this->maxboostedstep.'" ' 
                .'data-bts-mousewheel="'.$this->mousewheel.'" ' 
                .'data-bts-button-down-class="'.$this->buttondownclass.'" '
                .'data-bts-button-up-class="'.$this->buttonupclass.'" '
                .">"

		. ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() {  $this->pageObject->AddJSFile("plugins/controles/touchspin/js/jquery.bootstrap-touchspin.min.js");}
                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/touchspin/css/jquery.bootstrap-touchspin.min.css"); }
}
?>