<?php

class ViewMapy extends ViewUserControl {

	function initUserControl() {
		$this->addJSControlSetting("title", ( $this->settings["title"] ? $this->settings["title"] : 'Point selected' ));
		$this->addJSControlSetting("contentswidth", ( $this->settings["contentswidth"] ? $this->settings["contentswidth"] : 580 ));
		$this->addJSControlSetting("contentsheight", ( $this->settings["contentsheight"] ? $this->settings["contentsheight"] : '' ));
	}

	function addJSFiles() { /* $this->getContainer()->AddJSFile("include/runnerJS/controls/".$this->viewFormat.".js"); */ }
	
	public function showDBValue(&$data, $keylink, $html = true) {
		if (!$data[$this->field]) { return ""; exit(); }
		$resultado = '<span id="' . $data[$this->field] . '" class="mibcontrolarbolspan" title="' . $this->settings["tooltip"] . '" mapType="' . $this->settings["mapType"] . '" apikey="' . $this->settings["apikey"] . '" zoom="' . $this->settings["zoom"] . '" radius="' . $this->settings["radius"] . '" data="' . $data[$this->field] . '"><input type="button" value="'.$this->settings["textbutton"].'" /></span>';
		return $resultado;
	}
}

?>