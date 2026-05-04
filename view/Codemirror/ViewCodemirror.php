<?php 
class ViewCodemirror extends ViewUserControl
{	
	
	public function initUserControl()
	{

		$this->tooltip = (isset($this->settings["tooltip"])?$this->settings["tooltip"]:'Press "F11" to move to full screen');

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{

		$lib = [];
		$lib[] ='plugins/controles/codemirror/lib/codemirror.js';
		$lib[] ='plugins/controles/codemirror//addon/edit/matchbrackets.js';
		$lib[] ='plugins/controles/codemirror/mode/htmlmixed/htmlmixed.js';
		$lib[] ='plugins/controles/codemirror/mode/xml/xml.js';
		$lib[] ='plugins/controles/codemirror/mode/javascript/javascript.js';
		$lib[] ='plugins/controles/codemirror/mode/css/css.js';
		$lib[] ='plugins/controles/codemirror/mode/clike/clike.js';
		$lib[] ='plugins/controles/codemirror/mode/php/php.js';
		$lib[] ='plugins/controles/codemirror/addon/selection/active-line.js';
		$lib[] ='plugins/controles/codemirror/addon/scroll/simplescrollbars.js';
		$lib[] ='plugins/controles/codemirror/addon/display/fullscreen.js';

		$dir = __DIR__ ;
		$dir = str_replace('\\', '/', $dir);
		$filename = $dir .'/../../templates_c/codemirror.min.js';
		$fileUrl = 'templates_c/codemirror.min.js';
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
		lineNumbers: true,
		matchBrackets: true,
		mode: "application/x-httpd-php",
		indentUnit: 4,
		indentWithTabs: true,
		readOnly: true,
		scrollbarStyle: "simple",
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
		$this->AddCSSFile("plugins/controles/codemirror/lib/codemirror.css");
		$this->AddCSSFile("plugins/controles/codemirror/addon/scroll/simplescrollbars.css");
		$this->AddCSSFile("plugins/controles/codemirror/addon/display/fullscreen.css");
		$this->AddCSSFile("plugins/controles/codemirror/plugins.css");

	} 
}
?>