<?php 
class EditStarRating extends UserControl
{
	var $required, $cancel, $cancelPlace, $cancelHint, $hints, $half, $size, $number, $show_hint;
	
	function initUserControl()
	{
		$this->required = false;
		$this->cancel = false;
		$this->cancelPlace = 'left';
		$this->cancelHint = 'remove my rating!';
		$this->hints = array('bad', 'poor', 'regular', 'good', 'gorgeous');
		$this->half = false;
		$this->size = 12;
		$this->number = 5;
		$this->show_hint = false;
		
		if($this->settings["required"])
			$this->required=$this->settings["required"];		
		if($this->settings["cancel"])
			$this->cancel=$this->settings["cancel"];
		if($this->settings["cancelPlace"])
			$this->cancelPlace=$this->settings["cancelPlace"];
		if($this->settings["cancelHint"])
			$this->cancelHint=$this->settings["cancelHint"];
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
			
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("cancel", $this->cancel);
		$this->addJSSetting("cancelPlace", $this->cancelPlace);
		$this->addJSSetting("cancelHint", $this->cancelHint);
		$this->addJSSetting("hints", $this->hints);
		$this->addJSSetting("half", $this->half);	
		$this->addJSSetting("size", $this->size);	
		$this->addJSSetting("number", $this->number);	
		$this->addJSSetting("show_hint", $this->show_hint);
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{		
		echo '<div id="star_'.$this->cfield.'" class="star">-</div>
				<span id="rating-hint_'.$this->cfield.'" class="rating-hint">--</span>
				<br style="clear:both" />
				<input id="'.$this->cfield.'" type="hidden" name="'.$this->cfield.'" value="'.str_replace(',','.',$value).'" />';
	}
	
	function getUserSearchOptions()
	{
		return array(EQUALS, STARTS_WITH, BETWEEN, NOT_EMPTY, NOT_EQUALS, NOT_BETWEEN);		
	}

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{
		$this->pageObject->AddJSFile("include/jquery.raty.min.js");
	}
	
	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */ 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/raty.css");
	}
	
}

