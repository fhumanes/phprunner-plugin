<?php 
class ViewTags extends ViewUserControl
{
	// Optional. Can be deleted
	function initUserControl()
	{
		$this->defaultTagClass = $this->settings["defaultTagClass"];
		if ($this->defaultTagClass == '') $this->defaultTagClass = 'label-default';
	}
	
	// Optional. Can be deleted
	function addJSFiles()
	{
		//$this->AddJSFile("include/runnerJS/controls/".$this->viewFormat.".js");
	}
	
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$values = $data[$this->field];
		$labels = explode(",", $values);
		$result = '';
		foreach ($labels as &$label) {
			$result .="<span class='label $this->defaultTagClass'>$label</span>"."&nbsp;";
		}
		return $result;
	}
}
?>