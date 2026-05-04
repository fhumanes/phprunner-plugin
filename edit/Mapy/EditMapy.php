<?php 
class EditMapy extends UserControl
{
	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->width = ( $this->settings["width"] ? $this->settings["width"] : 'auto' );
		$this->addJSSetting("title", ( $this->settings["title"] ? $this->settings["title"] : 'Pick a point on the map' ) );
		$this->addJSSetting("contentswidth", ( $this->settings["contentswidth"] ? $this->settings["contentswidth"] : 400 ) );
		$this->addJSSetting("contentsheight", $this->settings["contentsheight"]);
		$this->addJSSetting("customcontent", ( $this->settings["customcontent"] ? $this->settings["customcontent"] : 'plugins/controlesmib/mapy/content/content.php' ) );
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		$clavemib = ( $this->settings["initiallatitude"] ? $this->settings["initiallatitude"] : '-32.934612' );
		$clavemib .= ";;mib;;" . ( $this->settings["initiallongitude"] ? $this->settings["initiallongitude"] : '-60.650093' );
		$clavemib .= ";;mib;;" . ( $this->settings["radius"] ? $this->settings["radius"] : 20 );
		$clavemib .= ";;mib;;" . ( $this->settings["zoom"] ? $this->settings["zoom"] : 15 );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytext"] ? $this->settings["buttonemptytext"] : 'Empty' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytooltip"] ? $this->settings["buttonemptytooltip"] : 'Null selection' );
		$clavemib .= ";;mib;;" . ( $this->settings["mapType"] ? $this->settings["mapType"] : 'TERRAIN' );
		$clavemib .= ";;mib;;" . ( $this->settings["scrollwheel"] ? $this->settings["scrollwheel"] : 'true' );
		$clavemib .= ";;mib;;" . ( $this->settings["labelsearch"] ? $this->settings["labelsearch"] : 'Search:&nbsp;' );
		$clavemib .= ";;mib;;" . ( $this->settings["placeholdersearch"] ? $this->settings["placeholdersearch"] : 'Type here your search criteria' );
		$clavemib .= ";;mib;;" . ( $this->settings["draggable"] ? $this->settings["draggable"] : 'true' );
		$clavemib .= ";;mib;;" . $this->cfield;
		$clavemib .= ";;mib;;" . $this->settings["apikey"];
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytext"] ? $this->settings["buttonemptytext"] : 'Empty' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytooltip"] ? $this->settings["buttonemptytooltip"] : 'Null selection' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonselecttext"] ? $this->settings["buttonselecttext"] : 'Select' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonselecttooltip"] ? $this->settings["buttonselecttooltip"] : 'Select actual coordinates' );
		$clavemib .= ";;mib;;" . $value;
		echo $this->getSetting("label").'<input id="display_'.$this->cfield.'" '.$this->inputStyle.' type="text" size=' . $this->width . ' '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="display_'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' readonly value="'
			.htmlspecialchars($value).'" title="' . $this->settings["tooltip"] . '" class="' . $clavemib . '" data="' . ( $this->settings["customcontent"] ? $this->settings["customcontent"] : 'plugins/controlesmib/mapy/content/content.php' ) . '"> <input class="mibmapyoculto" type="hidden" id="' . $this->cfield . '" name="' . $this->cfield . '" value="' . htmlspecialchars($value) . '"> ' . ' <a id="mibmapyseleccionar' . $this->cfield . '" href="#" title="' . $this->settings["tooltip"] . '" class="' . $clavemib . '">' . $this->settings["selectbuttontext"] . '</a>' . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
		unset($clavemib);
	}
	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { /*$this->pageObject->AddJSFile("plugins/controlesmib/mapy/javascript/locationpicker.js");*/ }
	function addCSSFiles() {  }
}
?>