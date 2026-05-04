<?php
class ViewMarkdown extends ViewUserControl
{
        var $fieldValue;

	public function initUserControl()
	{
		$this->fieldValue = '';			
	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $id_field = explode('=',$keylink);
            $content = $data[$this->field];
            $content = str_replace("\r\n",'\r\n',addslashes($content));
            $field = 'view_'.$id_field[1];
            

$field_value = <<<EOT
    <link rel="stylesheet" href="plugins/controles/markdown/css/toastui-editor-viewer.min.css" /> 
    <script src="plugins/controles/markdown/js/toastui-editor-viewer.min.js"></script>  
        
    <div class="code-html tui-doc-contents">
      <div id="$field"></div>
    </div>
        
    <script>
    content = '$content';
    content = content.replace('\\r\\n', "\\r\\n");
    const $field = new toastui.Editor({
        el: document.querySelector('#$field'),
        usageStatistics: 'false',
        initialValue: content
       });     
      // $field.getHtml();
    </script>
        
       
EOT;           
            return $field_value;
        }

	/**
	 * addJSFiles
	 * Add control JS files to page object
	 **/
	function addJSFiles()
	{
		// $this->pageObject->AddJSFile("plugins/controles/markdown/js/toastui-editor-viewer.min.js");
	}

	/**
	 * addCSSFiles
	 * Add control CSS files to page object
	 **/
	function addCSSFiles()
	{
		// $this->pageObject->AddCSSFile("plugins/controles/markdown/css/toastui-editor-viewer.min.css");
	}      
}
?>