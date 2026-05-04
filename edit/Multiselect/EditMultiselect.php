<?php 
class EditMultiselect extends UserControl
{
	var $required, $selectableOptgroup, $selectDeselectAll, $selectableHeader, $selectionHeader, $selectableFooter, $selectionFooter, 
		$table, $link_field, $display_field, $order_by, $group_by, $where;
	
	function initUserControl()
	{
		$this->required = false;
		$this->selectableHeader = '';
		$this->selectionHeader = '';
		$this->selectableFooter = '';
		$this->selectionFooter = '';
		//$this->disabledClass = 'disabled';
		$this->selectableOptgroup = false;
		$this->selectDeselectAll = false;
		$this->table = '';
		$this->link_field = '';
		$this->display_field = '';
		$this->order_by = '';
		$this->group_by = '';
		$this->where = '';
		
		if($this->settings["required"])
			$this->required=$this->settings["required"];
		if($this->settings["selectableHeader"])
			$this->selectableHeader=$this->settings["selectableHeader"];
		if($this->settings["selectionHeader"])
			$this->selectionHeader=$this->settings["selectionHeader"];
		if($this->settings["selectableFooter"])
			$this->selectableFooter=$this->settings["selectableFooter"];
		if($this->settings["selectionFooter"])
			$this->selectionFooter=$this->settings["selectionFooter"];
		//if($this->settings["disabledClass"])
		//	$this->disabledClass=$this->settings["disabledClass"];
		if($this->settings["selectableOptgroup"])
			$this->selectableOptgroup=$this->settings["selectableOptgroup"];			
		
		if($this->settings["selectDeselectAll"])
			$this->selectDeselectAll=$this->settings["selectDeselectAll"];
		
		if($this->settings["table"] && $this->settings["table"] != '')
			$this->table=$this->settings["table"];

		if($this->settings["link_field"] && $this->settings["link_field"] != '')
			$this->link_field=$this->settings["link_field"];		

		if($this->settings["display_field"] && $this->settings["display_field"] != '')
			$this->display_field=$this->settings["display_field"];	

		if($this->settings["order_by"] && $this->settings["order_by"] != '')
			$this->order_by=$this->settings["order_by"];	

		if($this->settings["where"] && $this->settings["where"] != '')
			$this->where = $this->settings["where"];
			
		if($this->settings["group_by"] && $this->settings["group_by"] != '')
		{
			$this->group_by = $this->settings["group_by"];
			$this->addJSSetting("group_by", true);
		}
		
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("selectableHeader", $this->selectableHeader);
		$this->addJSSetting("selectionHeader", $this->selectionHeader);
		$this->addJSSetting("selectableFooter", $this->selectableFooter);
		$this->addJSSetting("selectionFooter", $this->selectionFooter);	
		$this->addJSSetting("selectDeselectAll", $this->selectDeselectAll);	
	}
	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{	
		$multiselect = '';
		
		if($this->selectDeselectAll)
		{
			$multiselect .= '<a class="selectDeselectAll" href="#" id="'.$this->cfield.'-select-all">select all</a>&nbsp;|&nbsp;<a class="selectDeselectAll" href="#" id="'.$this->cfield.'-deselect-all">deselect all</a><br/><br/>';
		}

		$multiselect .= '<select multiple="multiple" id="'.$this->cfield.'" name="'.$this->cfield.'[]">';		
		
		$query = "SELECT DISTINCT `".$this->link_field."`,`".$this->display_field."`";
		
		if($this->group_by != '')
			$query .= ",`".$this->group_by."`";

		$query .= " FROM `".$this->table."`";
		
		if($this->where != '')
			$query .= " WHERE ".$this->where;
		
		if($this->order_by != '')
			$query .= " ORDER BY `".$this->order_by."`";		
		
		$rs = CustomQuery($query);
		
		$arr_values = explode(',',$value);
		
		while($record = db_fetch_array($rs))
		{
			if(($mode == MODE_INLINE_EDIT || $mode == MODE_EDIT) && in_array($record[$this->link_field],$arr_values))
				$options[$record[$this->group_by]][] =  '<option SELECTED value="'.$record[$this->link_field].'">'.$record[$this->display_field].'</option>';
			else
				$options[$record[$this->group_by]][] =  '<option value="'.$record[$this->link_field].'">'.$record[$this->display_field].'</option>';
		}

		if($this->group_by != '') 
		{
			foreach($options as $key => $val)
			{
				$multiselect .= '<optgroup label="'.$key.'">';
				
				foreach($val as $k => $v)
				{
					$multiselect .= $v;
				}
				
				$multiselect .= '</optgroup>';
			}
		}
		else
		{
			foreach($options as $key => $val)
			{
				foreach($val as $k => $v)
				{
					$multiselect .= $v;
				}
			}
		}
	
		$multiselect .= '</select>';
	
		echo $multiselect;
	}
	
	function getUserSearchOptions()
	{
		return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS);		
	}

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{
		$this->pageObject->AddJSFile("include/Multiselect_plugin/jquery.multi-select.js");
	}	

	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("include/Multiselect_plugin/css/multi-select.css");
	}		
}

