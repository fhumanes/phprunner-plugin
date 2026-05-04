<?php
class ViewPersianDatePicker extends ViewUserControl
{
        var $format;

	public function initUserControl()
	{
            	$this->format = 'lll';
		
                if($this->settings["format"]) { $this->format=$this->settings["format"];}

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $id_field = explode('=',$keylink);
            $PersianDate = $data[$this->field];
            $this->PersianDate = 'null';
            if ($PersianDate <> '' ) {
                $d = new DateTime($PersianDate);
                $this->PersianDate = $d->format('[Y,m,d,H,i,s]'); // Fromat de PersianDate
            }
            $field_value = '<span '. 'id="PersianDate_'.$id_field[1]. '">'
            .'<script src="plugins/controles/persiandatepicker/js/persian-date.min.js" type="text/javascript"></script>'           
            .'<script type="text/javascript">'
            // .'  $(document).ready(function(){'
            .'          var date1 = "'.$this->PersianDate.'";'
            .'          if (date1 != "null") {'
            .'                  document.write(new persianDate('.$this->PersianDate.').format("'.$this->format.'")); '
            .'          }'
            // .'  });'
            .'</script>'
            .'';
            return $field_value;
        }


	public function addJSFiles() { 
                                // $this->AddJSFile("plugins/controles/persiandatepicker/js/persian-date.min.js");
   
                                }

                                
	public function addCSSFiles() {     
                                // $this->AddCSSFile("plugins/controles/persiandatepicker/css/persian-datepicker.min.css");                                      
                                }
}
?>