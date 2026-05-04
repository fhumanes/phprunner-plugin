<?php
class ViewBarcode extends ViewUserControl
{
	protected $color;
	protected $bgcolor;
	protected $scale;
	protected $height;
	
	// Optional. Can be deleted
	public function initUserControl()
	{
		$this->color = "#333366";
		$this->encode = "UPC-A";
		$this->bgcolor = "#FFFFEC";
		$this->height = 50;
		$this->scale = 2;
		
		if( isset($this->settings["color"]) )
			$this->color = $this->settings["color"];
			
		if( isset($this->settings["encode"]) )
			$this->encode = $this->settings["encode"];
			
		if( isset($this->settings["bgcolor"]) )
			$this->bgcolor = $this->settings["bgcolor"];
			
		if( isset($this->settings["scale"]) )
			$this->scale = $this->settings["scale"];
			
		if( isset($this->settings["height"]) )
			$this->height = $this->settings["height"];
	}

	public function addJSFiles()
	{
	}
	
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$result = '<img src="include/barcode.php?encode='.$this->encode.'&bdata='.$data[$this->field].'&height='.$this->height
			.'&scale='.$this->scale.'&bgcolor='.urlencode($this->bgcolor).'&color='.urlencode($this->color).'">';
	
		return $result;
	}
}
?>