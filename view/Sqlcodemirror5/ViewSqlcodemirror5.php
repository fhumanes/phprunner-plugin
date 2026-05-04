<?php 
class ViewSqlcodemirror5 extends ViewUserControl
{	
	
	public function initUserControl()
	{

		$this->tooltip = (isset($this->settings["tooltip"])?$this->settings["tooltip"]:'Press "F11" to move to full screen');

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $lib = [];
            $lib[] ='plugins/controles/Sqlcodemirror5/js/codemirror.js';
            $lib[] ='plugins/controles/Sqlcodemirror5/js/sql.js';
            $lib[] ='plugins/controles/Sqlcodemirror5/addon/fullscreen.js';
            $lib[] ='plugins/controles/Sqlcodemirror5/addon/matchbrackets.js';
            $lib[] ='plugins/controles/Sqlcodemirror5/addon/show-hint.js';
            $lib[] ='plugins/controles/Sqlcodemirror5/addon/sql-hint.js';

            $dir = __DIR__ ;
            $dir = str_replace('\\', '/', $dir);
            $filename = $dir .'/../../templates_c/Sqlcodemirror5.min.js';
            $fileUrl = 'templates_c/Sqlcodemirror5.min.js';
            $fjs =''; // For concat content file of JS
            if (!file_exists($filename)) {
                for ( $i=0;$i < count($lib); $i++) {
                           $fjs .= file_get_contents($lib[$i]);
                    }            
                    $fp = $filename;			
                    if(!$fp) { die('Could not create / open text file for writing'.$filename);}		
                    $status = file_put_contents($fp, $fjs);
                    if($status === false) { die('Could not write file. '.$filename);}
            }


            $id_field = explode('=',$keylink);
            $content = $data[$this->field];
            // $content = str_replace("\r\n",'\r\n',addslashes($content));
            $field = $this->field.'_'.$id_field[1];
            
            $field_value = ''
            .' <textarea id="'.$field .'" class="form-control textarea-control" '  
            .'name="'.$field .'" ' 
            .' title="' . addslashes($this->tooltip)  .'" >'.$content. '</textarea>'
            . ( $this->tooltip <> '' ? "\n".$this->tooltip .'  ' : '' ) 
            .' ';
$field_value .= <<<EOT
<script src="$fileUrl"></script>

<script>
$(function() {
	var $field = CodeMirror.fromTextArea(document.getElementById('$field'), {
                mode: 'text/x-mariadb',
                indentWithTabs: true,
                smartIndent: true,
                lineNumbers: true,
                matchBrackets : true,
                readOnly: true,   // para View
                autofocus: true,
                viewportMargin: Infinity,
                extraKeys: {
                    "F11": function(cm) {
                        cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                                      },
                    "Esc": function(cm) {
                        if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                    }
                },
                styleActiveLine: true
          });
});
</script>
EOT;  
       
            return $field_value;
        }
	

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 */
	function addJSFiles()
	{	
		

	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object*/
	 
	function addCSSFiles()
	{
		$this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/custom_codemirror.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/codemirror.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/fullscreen.css");
                $this->pageObject->AddCSSFile("plugins/controles/Sqlcodemirror5/css/show-hint.css");
	} 
}
?>