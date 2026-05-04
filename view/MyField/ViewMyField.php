<?php
class ViewMyField extends ViewUserControl
{
	// Optional. Can be deleted
	function initUserControl()
	{
		$myOption = $this->settings["MyOption"];
		$this->addJSControlSetting("myOpt", "myOpt:".$myOption);
	}
	
	// Optional. Can be deleted
	function addJSFiles()
	{
		//$this->AddJSFile("include/runnerJS/controls/".$this->viewFormat.".js");
	}
	
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$result = "MyField: ".$data[$this->field];
		return $result;
	}
}
?>