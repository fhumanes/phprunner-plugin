<?php
class ViewTagEditor extends ViewUserControl
{
	var $theme;

	// Optional. Can be deleted
	function initUserControl()
	{
		$this->theme="flick";
		
		if (isset($this->settings["theme"]))
			$this->theme=$this->settings["theme"];

	}
	
	// Optional. Can be deleted
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/css/jquery.tagit.css");
		$url = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/".$this->theme."/jquery-ui.css";
		$this->pageObject->AddCSSFile($url);
	}
	
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$result='';
		if ($data[$this->field]) {
			$arr = explode(",", $data[$this->field]);
			$result = '<ul id="tagit-readonly" class="tagit">';
			foreach($arr as $val) {	
				$result.='<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-read-only">
							<span class="tagit-label">'.$val.'</span>
						</li>';
			}
			$result .= '</ul>';
		}
		return $result;
	}
}
?>