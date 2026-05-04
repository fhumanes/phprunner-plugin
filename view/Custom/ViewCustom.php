<?php
class ViewCustom extends ViewUserControl
{
        var $field;

	public function initUserControl()
	{

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $array_field = explode('=',$keylink);
            $id_field = $array_field[1];
            $field_value = $data[$this->field];
           
            return $field_value;
        }


	public function addJSFiles() { 
                                }

                                
	public function addCSSFiles() {                                
                                }
}
?>