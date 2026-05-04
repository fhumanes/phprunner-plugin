<?php
class EditMultiColumn extends UserControl
{
	protected $sql;
	protected $columns;
	protected $title;
	protected $parentField;
	protected $multiselect;
	protected $required;


	public function initUserControl()
	{
		$this->title = "Select";
		$this->sql = "";
		$this->columns = 3;

		// set internal variables
		if (isset($this->settings["title"]))
			$this->title = $this->settings["title"];
		if (isset($this->settings["columns"]))
			$this->columns = $this->settings["columns"];
		if (isset($this->settings["sql"]))
			$this->sql = $this->settings["sql"];
		

		if (isset($this->settings["multiselect"]))
			$this->multiselect = $this->settings["multiselect"];
		if (isset($this->settings["required"]))
			$this->required = $this->settings["required"];

		$tokens  = DB::scanTokenString($this->sql);
		if($tokens["tokens"] && $tokens["tokens"][0]){
			$this->parentField = $tokens["tokens"][0];
			$this->addJSSetting("parentField", $this->parentField );
		}
		

			
	


		// pass settings to JavaScript
		$this->addJSSetting("title", $this->title);
		$this->addJSSetting("columns", $this->columns);
		$this->addJSSetting("required", $this->settings["required"]);
		$this->addJSSetting("multiselect", $this->settings["multiselect"]);
		
	}

	public function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{

		// create our HTML here

		
		$values_list = explode(",", $value);
		
		$_SESSION["MultiColumnSql"][$this->field] = $this->sql;
	
		$sql = DB::prepareSQL($this->sql);
		if($this->parentField && isset($data[$this->parentField])){
			$args[] = $data[$this->parentField];
			$this->sql = str_replace(":".$this->parentField,":1",$this->sql);
			$sql = DB::prepareSQL($this->sql,$data[$this->parentField]);
		}
		$rs = DB::Query($sql);
		$i = 0;

		

		
		echo '<select name="' . $this->cfield;
		if($this->multiselect)
		echo '[]" multiple="multiple"';
		else
			echo '"';

		echo ' id="' . $this->cfield . '"  class="form-control">';
		echo "<option value=''>&nbsp;</option>";
		while( $items = $rs->fetchNumeric() ) {
			if($items[0] == "" || is_null($items[0]))
				continue;
			echo "<option";
			if ( in_array($items[0],$values_list) )
				echo " selected='selected' ";
			echo " value='".$items[0]."' ";
			echo ">" . $items[0] . "</option>";
			$i++;
		}

		echo '</select>';
		echo '<span id="current_'.$this->cfield.'" style="display: none" >'.$i.'</span>';
		// $this->addJSSetting("dataCount", $i);

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
		$this->pageObject->AddJSFile("gentleSelect/jquery-gentleSelect.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 */
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("gentleSelect/jquery-gentleSelect.css");
	}

}
?>