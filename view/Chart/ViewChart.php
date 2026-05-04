<?php
class ViewChart extends ViewUserControl
{
	
	// Optional. Can be deleted
	function initUserControl()
	{
		
	}
	
	function addJSFiles()
	{

	}
	
	public function showDBValue(&$data, $keylink)
	{
		$xAxis = $this->settings["xAxis"];
		$yAxis = $this->settings["yAxis"];
		$type = $this->settings["type"];
		$title = $this->settings["title"];
		
		// execute sql query and prepare an array with data
		$sql = $this->settings["sql"];
		$chartData = array();
		$rs = DB::Query( DB::PrepareSQL($sql) );
		while($chData = $rs->fetchAssoc() ){
				$chartData[] = array($chData[$xAxis],$chData[$yAxis]);
		}	
		
		$id = "chart_container_".generatePassword(20);
		$result = "<div id='".$id."' data-fieldname='".GoodFieldName($this->field)."' data-data='".my_json_encode($chartData)."' data-title='".$title."' data-type='".$type."'></div>";		
			
		return $result;
	}
}
?>