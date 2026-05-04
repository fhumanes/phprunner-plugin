<?php
class ViewCodeView extends ViewUserControl
{
	protected $codetype;
	protected $width;
	protected $height;

	public function initUserControl()
	{
		$this->codetype = 'javascript';		
		$this->width = 600;		
		$this->height = 400;		
		
		if( $this->settings["codetype"] )
			$this->codetype = $this->settings["codetype"];
		if( $this->settings["width"] )
			$this->width = $this->settings["width"];
		if( $this->settings["height"] )
			$this->height = $this->settings["height"];
	}
	
	// Optional. Can be deleted
	public function addJSFiles()
	{
		$this->AddJSFile("include/CodeViewJS/ace.js");
	}
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$result = "<pre id='ace-c9-editor_".$this->pageObject->recId."' style='width:".$this->width."px;height:".$this->height."px'>".runner_htmlspecialchars($data[$this->field])."</pre>";
		return $result;
	}
}
?>