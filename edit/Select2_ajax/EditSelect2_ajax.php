<?php 
class EditSelect2_ajax extends UserControl
{
    var $db_data, $url_language;
    
	function initUserControl() {
                              
                $this->addJSSetting("required", ($this->settings["required"]?$this->settings["required"]:false) );
                $this->required = $this->settings["required"];
		
                $this->addJSSetting("placeholder", ($this->settings["placeholder"]?$this->settings["placeholder"]:"Select an option") );
                $this->addJSSetting("select", ($this->settings["select"]?$this->settings["select"]:"select 1,'text' from dual") );
                $this->select = $this->settings["select"];
                $this->addJSSetting("language", ($this->settings["language"]?$this->settings["language"]:"en") );
                $this->language = $this->settings["language"];
                $this->addJSSetting("allowClear", ($this->settings["allowClear"]?$this->settings["allowClear"]:true) );
                $this->addJSSetting("multiple", ($this->settings["multiple"]?$this->settings["multiple"]:false) );
                $this->addJSSetting("maximumSelectionLength", ($this->settings["maximumSelectionLength"]?$this->settings["maximumSelectionLength"]:3) );
                $this->addJSSetting("FieldWidth", ($this->settings["FieldWidth"]?$this->settings["FieldWidth"]:"340px") );
                              
                $this->addJSSetting("DefaultValue", ($this->settings["DefaultValue"]?$this->settings["DefaultValue"]:Null) );
                $this->addJSSetting("SessionDependenteValue", ($this->settings["SessionDependenteValue"]?$this->settings["SessionDependenteValue"]:null) );

                $this->addJSSetting("sql_recovers_values", ($this->settings["sql_recovers_values"]?$this->settings["sql_recovers_values"]:"select 1,'text' from dual") );
	}  

	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) { 
            
            if ($this->settings["DefaultValue"] <> null) {
                $value = $this->settings["DefaultValue"];
            }
                        
            // Read values of options
            $_SESSION['SELECT2_AJAX_SQL'][$this->cfield] = $this->select;
            
            $values_arr = explode(',',$value);
            
            $data = array();
            
            foreach($values_arr as $val) { // Restore code, title of lookup
                $sql= $this->settings["sql_recovers_values"];
                $sql = str_replace("{value}", $val, $sql);
                
                $rs = DB::Query($sql);
                while( $data_rs = $rs->fetchNumeric() )
                {
                    $data[] = $data_rs;
                }
            }
            $dataRows = count($data);
            $options = '';
            for ($x = 0; $x < $dataRows; $x++) { // All Record
                $field1 = $data[$x][0]; // Key
                $field2 = htmlspecialchars($data[$x][1]); // Values
                $options .= '<option value="'.$field1.'" selected="selected">'.$field2.'</option>' ;
            }
           
            echo $this->getSetting("label")
                        .'<div id="my_'.$this->cfield.'" >'
                        .'<select  id="'.$this->cfield
                        .'" class="'.$this->cfield.' form-control"'
                        .' name="'.$this->cfield.'" '
                        . ( $this->settings["multiple"] == true ? 'value="multiselect" multiple="multiple" ' : '' )                        
			            .($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			            .(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			            .$this->pageObject->pSetEdit->getEditParams($this->field)
                        . ' >'.$options.'</select>'
                        . ( $this->required == true ? '&nbsp;<font color="red">*</font>' : '' )
                        . '</div>'
                        ;

			
        }

	
	function getUserSearchOptions()	{ return array(EQUALS, STARTS_WITH, NOT_EMPTY, NOT_EQUALS); }


	function addJSFiles() { 

                            $dir = __DIR__ ;
                            $dir = str_replace('\\', '/', $dir);
                            $filename = $dir .'/../../templates_c/select2-'.$this->language.'.min.js';
                            $fileUrl = 'templates_c/select2-'.$this->language.'.min.js';
                            if (!file_exists($filename)) {

                                $fjs = $dir .'/../../plugins/controles/select2/js/select2.min.js';
                                $fjslang = $dir .'/../../plugins/controles/select2/js/i18n/'.$this->language.'.js';
                                $js1 = file_get_contents($fjs);
                                $js2 = file_get_contents($fjslang);
                                $js = $js1 . $js2;

                                $fp = $filename;

                                if(!$fp) { die('Could not create / open text file for writing'.$filename);}

                                $status = file_put_contents($fp, $js);
                                if($status === false) { die('Could not write file. '.$filename);}
                            }
                            $this->pageObject->AddJSFile($fileUrl);

                            
                                }

                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/select2/css/select2.min.css"); }
}
