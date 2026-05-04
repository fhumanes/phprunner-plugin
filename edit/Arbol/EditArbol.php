<?php 

class EditArbol extends UserControl {

	function initUserControl() {
		$this->required = false;
		if ($this->settings["required"]) $this->required = $this->settings["required"]; 
		$this->addJSSetting("required", $this->required);
		$this->width = ( $this->settings["width"] ? $this->settings["width"] : 'auto' );
		$this->addJSSetting("title", ( $this->settings["title"] ? $this->settings["title"] : 'Busque y seleccione un elemento de la lista' ) );
		$this->addJSSetting("contentswidth", ( $this->settings["contentswidth"] ? $this->settings["contentswidth"] : 400 ) );
		$this->addJSSetting("contentsheight", $this->settings["contentsheight"]);
		$this->addJSSetting("customcontent", ( $this->settings["customcontent"] ? $this->settings["customcontent"] : 'plugins/controlesmib/arbol/contenido/contenido.php' ) );
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) {
		$clavemib = ( $this->settings["deeplimit"] ? $this->settings["deeplimit"] : 0 );
		$clavemib .= ";;mib;;" . ( $this->settings["allowanyselection"] ? $this->settings["allowanyselection"] : 'yes' );
		$clavemib .= ";;mib;;" . ( $this->settings["allownewelement"] ? $this->settings["allownewelement"] : 'yes' );
		$clavemib .= ";;mib;;" . ( $this->settings["newelementurl"] ? $this->settings["newelementurl"] : '' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytext"] ? $this->settings["buttonemptytext"] : 'Empty' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonemptytooltip"] ? $this->settings["buttonemptytooltip"] : 'Null selection' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonnewtext"] ? $this->settings["buttonnewtext"] : 'New' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonnewtooltip"] ? $this->settings["buttonnewtooltip"] : 'New element' );
		$clavemib .= ";;mib;;" . ( $this->settings["labelsearch"] ? $this->settings["labelsearch"] : 'Search:&nbsp;' );
		$clavemib .= ";;mib;;" . ( $this->settings["placeholdersearch"] ? $this->settings["placeholdersearch"] : 'Type here your search criteria' );
		$clavemib .= ";;mib;;" . ( $this->settings["messagenotallowedanyselection"] ? $this->settings["messagenotallowedanyselection"] : 'It is not possible to select this element beacuse it has dependencies' );
		$clavemib .= ";;mib;;" . $this->cfield;
		$clavencrip = '$a<A&>+@ioK*UY673#-.,;';
		$cadenaencrip = $this->settings["SQL"];
		$cadencriptada = base64_encode($cadenaencrip);
		$clavemib .= ";;mib;;" . ( $this->settings["SQL"] ? $cadencriptada : '' );
		$clavemib .= ";;mib;;" . ( $this->settings["ismultiselect"]=='yes' ? 'yes' : 'no' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttontogglealltext"] ? $this->settings["buttontogglealltext"] : 'Toggle all' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttontogglealltooltip"] ? $this->settings["buttontogglealltooltip"] : 'Select / deselect all elements in list' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonacceptext"] ? $this->settings["buttonacceptext"] : 'Accept' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttonaccepttooltip"] ? $this->settings["buttonaccepttooltip"] : 'Accept selection' );
		$clavemib .= ";;mib;;" . ( $this->settings["buttontoggledependenciestooltip"] ? $this->settings["buttontoggledependenciestooltip"] : 'Select / deselect all dependencies' );
		$clavemib .= ";;mib;;" . ( $this->settings["separator"] ? $this->settings["separator"] : '; ' );
		$clavemib .= ";;mib;;" . $value;
		$clavemib .= ";;mib;;";
		if($this->settings["ismultiselect"]=='yes') $mibvalores = explode($this->settings["separator"], $value);
		global $conn;
		$mibcontrolarbolrs = db_query($this->settings["SQL"], $conn);
		while( 
                    $mibcontrolarboldato = db_fetch_numarray($mibcontrolarbolrs) ) {			
                    if($this->settings["ismultiselect"]=='yes') {
			if(in_array($mibcontrolarboldato[0], $mibvalores))
                            $mibcontrolarbolcampodescripcion .= $mibcontrolarboldato[1] . $this->settings["separator"];
			}
			else if($mibcontrolarboldato[0] == $value)
                                { $mibcontrolarbolcampodescripcion = $mibcontrolarboldato[1]; break; }
                        }
                    if($this->settings["ismultiselect"]=='yes') 
                        $mibcontrolarbolcampodescripcion = rtrim($mibcontrolarbolcampodescripcion, $this->settings["separator"]);
                    echo $this->getSetting("label").'<input id="display_'.$this->cfield.'" '.$this->inputStyle.' type="text" size=' . $this->width . ' '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="display_'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' readonly value="'
			.htmlspecialchars($mibcontrolarbolcampodescripcion).'" title="' . $this->settings["tooltip"] . '" class="' . $clavemib . '" data="' . 
                        ( $this->settings["customcontent"] ? $this->settings["customcontent"] : 'plugins/controlesmib/arbol/contenido/contenido.php' ) . 
                        '"> <input class="mibarboloculto" type="hidden" id="' . $this->cfield . '" name="' . $this->cfield . '" value="' . 
                        htmlspecialchars($value) . '"> ' . 
                        ' <a id="mibarbolseleccionar' . $this->cfield . '" hhhref="#"'.' title="' . 
                        $this->settings["tooltip"] . '" class="' . $clavemib . '">' . $this->settings["selectbuttontext"] . '</a>' . 
                        ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' );
                    unset($clavemib);
	}
	
	function getUserSearchOptions() { return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }

	function addJSFiles() { /* Los js se incluyen en contenido.php */ }
	function addCSSFiles() { /* Los css se incluyen en contenido.php */ }

}

?>