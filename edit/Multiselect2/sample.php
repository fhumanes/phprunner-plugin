//If true, set the field as required
$this->settings["required"] = false;

//Text or HTML to display in the selectable header. Example: '<div class="custom-header">Selectable items</div>'
$this->settings["selectableHeader"] = '<div class="custom-header">Selectable items</div>';

//Text or HTML to display in the selection header. Example: '<div class="custom-header">Selection items</div>'
$this->settings["selectionHeader"] = '<div class="custom-header">Selection items</div>';

//Text or HTML to display in the selectable footer. Example: '<div class="custom-header">Selectable footer</div>'
$this->settings["selectableFooter"] = '<div class="custom-header">Selectable footer</div>';

//Text or HTML to display in the selection footer. Example: '<div class="custom-header">Selection footer</div>'
$this->settings["selectionFooter"]  = '<div class="custom-header">Selection footer</div>';

// Height of "Select"
$this->settings["height"]  = '200px';

// Width of the set of "Select"
$this->settings["width"]  = '300px';

//Click on optgroup will select all nested options when set to true
$this->settings["selectableOptgroup"] = false;

//Show select/deselect all links
$this->settings["selectDeselectAll"] = false;

$this->settings["table"] = 't_inspection_date';
$this->settings["link_field"] = 'id';
$this->settings["display_field"] = 'title';
$this->settings["order_by"] = 'inspid';
$this->settings["group_by"] = 'inspid';

//If set, it filters the query result
/*
Examples:
" City like 'M%' " 
" user = " . $_SESSION["OwnerID"] 
" Salary > 3000 " 
*/ 
$this->settings["where"] = '';