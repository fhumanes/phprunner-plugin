<?php 
class EditGeolocation extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"];
                $this->addJSSetting("tooltip", ($this->settings["tooltip"]?$this->settings["tooltip"]:"Click here the latitude and longitude of your situation") );
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {    
            
		echo $this->getSetting("label")
                        .'<DIV class="input-group text"><input id="'.$this->cfield.'" '.$this->inputStyle.' class="form-control"  style="text-align:left;" type="text" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.' name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field)
			.' title="' . $this->settings["tooltip"] . '" value="'.$value.'" >'
                        .'<span class="input-group-addon" id="imgCoord_'.$this->cfield.'" style="cursor:auto"><span class="glyphicon glyphicon-screenshot"></span></span>'
                        .'</DIV>'
                        . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
                $flied=$this->cfield;
                $js = <<< EOT
<script type="text/javascript">
$(document).ready(function() {
   $("#$flied").click(function() {
    if (navigator.geolocation) { // Get the user's current position
        navigator.geolocation.getCurrentPosition(showPosition, showError, {enableHighAccuracy : true, timeout : Infinity, maximumAge : 0});
    } else {
        console.log('Geolocation is not supported in your browser');
    }
    function showPosition(position) {
        console.log('Latitude: '+position.coords.latitude+'  Longitude: '+position.coords.longitude);
        $('#$flied').val(position.coords.latitude+','+position.coords.longitude);
        return(position.coords.latitude+','+position.coords.longitude);
     } 
    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                console.log("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                console.log("An unknown error occurred.");
                break;
    }
}
});
});
</script>                       
EOT;
                echo $js;			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { }
                                
	function addCSSFiles() { }
}
?>