// sql query that populates the dropdown box
$this->settings["sql"] = "select ContactName from Customers order by ContactName";
// to make this list of values is dependent on another control
// Example: make this dropdown box dependent on stateId field. This example assumes that State is a text field
// $this->settings["sql"] = "select ContactName from Customers where State=':stateId' order by ContactName";
// title
$this->settings["title"] = "Select customer";
// number of columns in dropdown list
$this->settings["columns"] = "3";
// required. Set to true to make this field required
$this->settings["required"] = false;
// multiselect. False means single-select, true means multi-select.
$this->settings["multiselect"] = false; 