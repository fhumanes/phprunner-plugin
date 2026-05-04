<?php
class ViewStarRating extends ViewUserControl
{
	var $hints, $half, $size, $number, $show_hint;

	function initUserControl(){
		$this->hints = array('bad', 'poor', 'regular', 'good', 'gorgeous');
		$this->half = false;
		$this->size = 12;
		$this->number = 5;
		$this->show_hint = false;
		
		if($this->settings["hints"])
			$this->hints=$this->settings["hints"];
	
		if($this->settings["half"])
			$this->half=$this->settings["half"];

		if($this->settings["size"])
			$this->size=$this->settings["size"];

		if($this->settings["number"])
			$this->number=$this->settings["number"];

		if($this->settings["show_hint"])
			$this->show_hint=$this->settings["show_hint"];
	}
	
	
	public function showDBValue(&$data, $keylink, $html = true)
	{
		$star_half   = ($this->size > 12) ? 'star-half-big.png' : 'star-half.png';
		$star_off    = ($this->size > 12) ? 'star-off-big.png' : 'star-off.png';
		$star_on     = ($this->size > 12) ? 'star-on-big.png' : 'star-on.png';
		
		$id_field = explode('=',$keylink);
		
		$field_value = '<div id="star_'.$id_field[1].'" class="star">';
		for($i=1;$i<=$this->number;$i++)
		{
			if($i <= count($this->hints)) 
				$title = $this->hints[$i - 1];
			else
				$title = $i;
			
			if($data[$this->field] >= $i)
				$img = $star_on;
			else if($data[$this->field] > ($i - 1) && $data[$this->field] < $i)
				$img = $star_half;
			else
				$img = $star_off;

			$field_value .= '<img src="img/'.$img.'" alt="'.$i.'" title="'.$title.'">';
		}
		$field_value .= '</div>';
		
		if($this->show_hint)
		{
			$field_value .= '<span id="rating-hint_'.$id_field[1].'" class="list-rating-hint">'.$data[$this->field].'</span><br style="clear:both" />';
		}
	
		return $field_value;
	}
	
	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		$this->AddCSSFile("include/raty.css");
	}
}