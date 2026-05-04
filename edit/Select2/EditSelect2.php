<?php 
class EditSelect2 extends UserControl
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
                
                $this->addJSSetting("renderImage", ($this->settings["renderImage"]?$this->settings["renderImage"]:false) );
                $this->addJSSetting("urlImage", ($this->settings["urlImage"]?$this->settings["urlImage"]:"./images/{1}.png") );
                $this->addJSSetting("widthImage", ($this->settings["widthImage"]?$this->settings["widthImage"]:"30") );
                
                $this->addJSSetting("DefaultValue", ($this->settings["DefaultValue"]?$this->settings["DefaultValue"]:null) );
                // Read values of options
                
                $sql= $this->select;
                $data = array();
                $rs = DB::Query($sql);
                while( $data_rs = $rs->fetchNumeric() )
                {
                    $data[] = $data_rs;
                }
                $dataRows = count($data);
                $options = [];
                for ($x = 0; $x < $dataRows; $x++) { // All Record
                    $field1 = $data[$x][0]; // Key
                    $field2 = htmlspecialchars($data[$x][1]); // Values
                    if (isset($data[$x][2])) {
                        $field3 = $data[$x][2];
                    } else {
                        $field3 = '';
                    }
                    $options[] = array('id'=> $field1, 'text' => $field2, 'image' => $field3) ;
                }

                $this->addJSSetting("data",$options); // Pararm for javasript

	}  

	
	function buildUserControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data) { 
            
            if ($value == null) $value = '';
            echo '<span id="current_'.$this->cfield.'" style="display: none" >'.$value.'</span>';
                        
            echo $this->getSetting("label")
                        .'<div id="my_'.$this->cfield.'" >'
                        .'<select  id="'.$this->cfield
                        .'" class="'.$this->cfield.' form-control"'
                        .' name="'.$this->cfield.'" '
                        . ( $this->settings["multiple"] == true ? 'value="multiselect" multiple="multiple" ' : '' )                        
			            .($mode == MODE_SEARCH ? 'autocomplete="off" ' : '')
			            .(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'.$this->strLabel.'" ' : '')
			            .$this->pageObject->pSetEdit->getEditParams($this->field)
                        . ' >  </select>'
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
            
            
            
                         /*     $this->pageObject->AddJSFile("plugins/controles/select2/js/select2.min.js");
                                $this->pageObject->AddJSFile("plugins/controles/select2/js/i18n/es.js"); */
                            
                                }

                                
	function addCSSFiles() { $this->pageObject->AddCSSFile("plugins/controles/select2/css/select2.min.css"); }
}
?>