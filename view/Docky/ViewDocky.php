<?php

class ViewDocky extends ViewUserControl {

	function initUserControl() {
		$this->addJSControlSetting("title", ( $this->settings["title"] ? $this->settings["title"] : 'Preview Document' ));
		$this->addJSControlSetting("contentswidth", ( $this->settings["contentswidth"] ? $this->settings["contentswidth"] : 580 ));
		$this->addJSControlSetting("contentsheight", ( $this->settings["contentsheight"] ? $this->settings["contentsheight"] : '' ));
	}

	function addJSFiles() { /* $this->getContainer()->AddJSFile("include/runnerJS/controls/".$this->viewFormat.".js"); */ }
	
	public function showDBValue(&$data, $keylink, $html = true) {
		if (!$data[$this->field]) { return ""; exit(); }
		$docname = ($data[$this->settings['fielddocname']]==''?($this->settings['defaultdocname']==''?'file.bin':$this->settings['defaultdocname']):$data[$this->settings['fielddocname']]);
		$sep = '%26'; $llavesdocky = str_replace('&', '%26', $keylink);
		$resultado = '<span id="' . str_replace('=','-',str_replace('&key','clave',$keylink)) . '" class="mibcontroldockyspan" title="' . $this->settings["tooltip"] . '" data-name="'. $docname . '" data="table=' . $this->container->pSet->_table . $sep . 'filename=' . $docname . $sep . 'field=' . $this->field . $llavesdocky . '"><input type="button" value="'.($this->settings["textbutton"]=='{{fielddocname}}'?$data[$this->settings['fielddocname']]:($this->settings["textbutton"]==''?'Preview Document':$this->settings["textbutton"])).'" /></span>';
		return $resultado;
	}
}

?>