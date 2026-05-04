<?php
class ViewAnyChart extends ViewUserControl
{
        var $include, $libraries, $language;

	public function initUserControl()
	{
    $this->include = "MyCode/anychart.php";
		$this->libraries = ["anychart-base.min.js"];
    $this->theme = "";
    $this->language = "en-us.js";
    $this->decimalsCount = 2;
    $this->zeroFillDecimals = false;
    $this->decimalPoint = ".";
    $this->groupsSeparator = ",";
    $this->height = "";
    $this->id_container = "";
    

    if($this->settings["php_include"]) { $this->include=$this->settings["php_include"]; }
    if($this->settings["js_anychart"]) { $this->libraries=$this->settings["js_anychart"]; }
    if($this->settings["theme"]) { $this->theme=$this->settings["theme"]; }
    if($this->settings["language"]) { $this->language=$this->settings["language"]; }
    if($this->settings["decimalsCount"]) { $this->decimalsCount=$this->settings["decimalsCount"]; }
    if($this->settings["zeroFillDecimals"]) { $this->zeroFillDecimals=$this->settings["zeroFillDecimals"]; }
    if($this->settings["decimalPoint"]) { $this->decimalPoint=$this->settings["decimalPoint"]; }
    if($this->settings["groupsSeparator"]) { $this->groupsSeparator=$this->settings["groupsSeparator"]; }
    if($this->settings["height"]) { $this->height=$this->settings["height"]; }
    if($this->settings["id_container"]) { $this->id_container=$this->settings["id_container"]; }
                
	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $array_field = explode('=',$keylink);
            $id_field = $array_field[1];
            $DataValue = $data[$this->field];
            
            $javascript = '';

            foreach ($this->libraries as &$file) {
          
            $javascript .= <<<EOT
            
 <script src="plugins/controles/anychart/js/$file" charset="utf-8"></script>
 
EOT;
            
          
            }
            
            if ($this->theme <>'') {
                $theme = "<script src=\"plugins/controles/anychart/themes/".$this->theme ."\"></script>";
            } else {
                $theme = '';
            }
            
            if ($this->language <>'') {
                $language = "<script src=\"plugins/controles/anychart/locales/".$this->language ."\"></script>";
            } else {
                $language = '';
            }

            $decimalsCount = $this->decimalsCount;
            $zeroFillDecimals = $this->zeroFillDecimals;
            $decimalPoint = $this->decimalPoint;
            $groupsSeparator = $this->groupsSeparator;  
 
            if ($this->id_container <>'') {
                $id_field = $this->id_container;
            } 
            
            if ($this->height == '') {
                $style = <<<EOT
 <style> 
@media screen and (max-width:320px) {
  html, body, #container_$id_field {width: 100%; height: 200px; margin: 0; padding: 0; } 
}
@media screen and (max-width:480px) and (min-width:320px) {
  html, body, #container_$id_field {width: 100%; height: 250px; margin: 0; padding: 0; }
}
@media screen and (max-width:768px) and (min-width:480px) {
  html, body, #container_$id_field {width: 100%; height: 300px; margin: 0; padding: 0; }
}
@media screen and (max-width:1024px) and (min-width:768px) {
  html, body, #container_$id_field {width: 100%; height: 400px; margin: 0; padding: 0; }
}
@media screen and (min-width:1024px) {
  html, body, #container_$id_field {width: 100%; height: 500px; margin: 0; padding: 0; } 
}
</style>
EOT;
            } else {
                $p_heigth = $this->height;
                $style = <<<EOT
  <style> 
@media screen and (min-width:320px) {
  html, body, #container_$id_field {width: 100%; height: $p_heigth; margin: 0; padding: 0; } 
}
</style>
EOT;
            }
            
            $license = <<<EOT

// Set your licence key before you create chart.
anychart.licenseKey('xlinesoft-9faa5dd-332123fd'); 
// Set logo source.
// You can't customize credits without a license key. See https://www.anychart.com/buy/ to learn more.
var credits = chart.credits();
credits.enabled(false);
credits.logoSrc('');
    
EOT;
            $field_value = <<<EOT

<link REL="stylesheet" href="plugins/controles/anychart/css/anychart-ui.min.css" type="text/css">
$javascript
$language
$theme

$style

<div id="container_$id_field"></div>
	
<script type="text/javascript">
// window.onload = function() {
anychart.onDocumentReady(function() {
                    
  // Format Number
anychart.format.locales.default.numberLocale.zeroFillDecimals = $zeroFillDecimals;
anychart.format.locales.default.numberLocale.decimalsCount = $decimalsCount;
anychart.format.locales.default.numberLocale.groupsSeparator = "$groupsSeparator";
anychart.format.locales.default.numberLocale.decimalPoint = "$decimalPoint";


EOT;
            include $this->include;
            
            return $field_value;
        }


	public function addJSFiles() { 
                                // $this->AddJSFile("plugins/controles/anychart/js/anychart-base.min.js");
                                // $this->AddJSFile("plugins/controles/anychart/locales/es-es.js");
                                }

                                
	public function addCSSFiles() {     
                                // $this->AddCSSFile("plugins/controles/anychart/css/anychart-ui.min.css");                                      
                                }
}
?>