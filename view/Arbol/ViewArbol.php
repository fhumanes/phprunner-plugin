<?php

class ViewArbol extends ViewUserControl {

	function initUserControl() {
		$this->addJSControlSetting("title", ( $this->settings["title"] ? $this->settings["title"] : 'Dependencies' ));
		$this->addJSControlSetting("filterlabel", ( $this->settings["filterlabel"] ? $this->settings["filterlabel"] : 'Element:' ));
		$this->addJSControlSetting("contentswidth", ( $this->settings["contentswidth"] ? $this->settings["contentswidth"] : 580 ));
		$this->addJSControlSetting("contentsheight", ( $this->settings["contentsheight"] ? $this->settings["contentsheight"] : '' ));
		$this->addJSControlSetting("deeplimit", ( $this->settings["deeplimit"] ? $this->settings["deeplimit"] : 0 ));
		$this->addJSControlSetting("gotoelementtext", ( $this->settings["gotoelementtext"] ? $this->settings["gotoelementtext"] : "Go to selected element" ));
		$this->addJSControlSetting("gotoelementtooltip", ( $this->settings["gotoelementtooltip"] ? $this->settings["gotoelementtooltip"] : "Click here to go to selected element" ));
		$this->addJSControlSetting("ismultiselect", ( $this->settings["ismultiselect"] ? $this->settings["ismultiselect"] : false ));
		$this->addJSControlSetting("separator", ( $this->settings["separator"] ? $this->settings["separator"] : ';' ));
	}

	function addJSFiles() { /* $this->getContainer()->AddJSFile("include/runnerJS/controls/".$this->viewFormat.".js"); */ }
	
	public function showDBValue(&$data, $keylink, $html = true) {
		if (!$data[$this->field]) { return ""; exit(); }
		$cadenaencriptada = base64_encode($this->settings["generalSQL"]);
		global $conn;
		if($this->settings["ismultiselect"]=='yes') $mibcontrolarbolsql = ( strrchr($this->settings["individualSQL"], "'") == "'" ? $this->settings["individualSQL"] . str_replace($this->settings["separator"], "','", $data[$this->field]) . "')" : $this->settings["individualSQL"] . str_replace($this->settings["separator"], ",", $data[$this->field]) . ')');
		else $mibcontrolarbolsql = ( strrchr($this->settings["individualSQL"], "'") == "'" ? $this->settings["individualSQL"] . $data[$this->field] . "'" : $this->settings["individualSQL"] . $data[$this->field]);
		$mibcontrolarbolrs = db_query($mibcontrolarbolsql, $conn);
		if($this->settings["ismultiselect"]=='yes') {
			$mibcontrolarboldato[0] = '';
			while($datos = db_fetch_numarray($mibcontrolarbolrs)) { $mibcontrolarboldato[0] .= $datos[0] . $this->settings["separator"]; $hayregistros = true; } }
		else { 	$mibcontrolarboldato = db_fetch_numarray($mibcontrolarbolrs);
			if(
$mibcontrolarboldato) $hayregistros = true;

		}
		if(
$hayregistros) $resultado = '<span id="' . $data[$this->field] . '" class="mibcontrolarbolspan ' . $cadenaencriptada . '" title="' . $this->settings["tooltip"] . '" ismulti="' . $this->settings["ismultiselect"] . '" limite="' . $this->settings["deeplimit"] . '" separator="' . $this->settings["separator"] . '" data="' . $mibcontrolarboldato[0] . '">' . ($this->settings["ismultiselect"]=='yes' ? '<input type="button" value="'.$this->settings["textbutton"].'" />' : $mibcontrolarboldato[0]) . '</span>';
		else { $resultado = ""; }
		return $resultado;
	}
}

?>