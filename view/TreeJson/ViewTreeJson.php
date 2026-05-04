<?php
class ViewTreeJson extends ViewUserControl
{
        var $field;

	public function initUserControl()
	{

	}

	public function showDBValue(&$data, $keylink, $html = true)
	{
            $array_field = explode('=',$keylink);
            $id_field = $array_field[1];
            $json = $data[$this->field];
            $json_escape = addslashes(str_replace("\r","",str_replace("\n","",$json)));
            
            $field_value = <<<EOT
 
<script src="plugins/controles/treejson/js/d3.v3.min.js" charset="utf-8"></script>
<script src="plugins/controles/treejson/js/vtree.js"></script>
 <div id="msg_$id_field" style="color: red;"></div>
 <div id="container_$id_field"></div>
 <script type="text/javascript">
var vt;

window.onload = function () {
  var container = document.getElementById("container_$id_field");
  var msg = document.getElementById("msg_$id_field");
  vt = new VTree(container);
  var reader = new VTree.reader.Object();

  function updateTree() {
    var s = "$json_escape";
    msg.innerHTML = '';
    try {
      var jsonData = JSON.parse(s);
    } catch (e) {
      msg.innerHTML = 'JSON parse error: ' + e.message;
    }
    var data = reader.read(jsonData);
    vt.data(data).update();
 }   
  updateTree();
};

</script>
                                       
EOT;
            return $field_value;
        }


	public function addJSFiles() { 
                                // $this->AddJSFile("plugins/controles/treejson/js/d3.v3.min.js");
                                // $this->AddJSFile("plugins/controles/treejson/js/vtree.js");
                                }

                                
	public function addCSSFiles() {     
                                $this->AddCSSFile("plugins/controles/treejson/css/vtree.css");                                      
                                }
}
?>