<?php
class EditColors extends UserControl
{
	public function initUserControl()
	{
	}

	public function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		echo $this->getSetting("label").'<input id="'.$this->cfield.'" '.$this->inputStyle.' type="text" class="form-control" '
			.($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			.'name="'.$this->cfield.'" '.$this->pageObject->pSetEdit->getEditParams($this->field).' value="'
			.runner_htmlspecialchars($value).'">';
	}

	function getUserSearchOptions()
	{
		return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS);
	}


	function addJSFiles() { $this->pageObject->AddJSFile("plugins/controles/Colors/js/jquery.minicolors.min.js"); }
                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/Colors/css/jquery.minicolors.css"); }
}
?>