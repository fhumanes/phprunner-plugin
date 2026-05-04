<?php
class ViewPDF extends ViewUserControl
{


	public function showDBValue(&$data, $keylink)
	{
		$result="";
		if(strlen($data[$this->field])>3){
			if(substr($data[$this->field],0,3) =="[{\"")
				$fileArray = my_json_decode($data[$this->field]);
			else
				$fileArray[0]["usrName"] = $data[$this->field];
		}
		else
		    $fileArray = my_json_decode($data[$this->field]);
		
		foreach($fileArray as $valFiles){
			$name=$valFiles["usrName"]; 
			$ext=strtoupper(substr($name,strlen($name)-4));   
			$keys = "";
			for($i=1;$i<=count($this->pageObject->pSet->_tableData[".Keys"]);$i++){
				if($keys)
					$keys.="&";
				$keys.="key".$i."=".$data[$this->pageObject->pSet->_tableData[".Keys"][$i-1]];
			}
			if($result)
				$result.= ", ";
			if($ext == ".PDF")
				$result.= "<a target=_blank href='pdf.js/web/viewer.html?file=".rawurlencode($name)."&table=".rawurlencode($this->pageObject->tName)."&field=".rawurlencode($this->field)."&pageType=".$this->pageObject->pageType."&".$keys."'>".$name."</a>";	
			else
				$result.= "<a href='mfhandler.php?file=".rawurlencode($name)."&table=".rawurlencode($this->pageObject->tName)."&field=".rawurlencode($this->field)."&pageType=".$this->pageObject->pageType."&".$keys."'>".$name."</a>";	
		}
		return $result;
	}
}
?>