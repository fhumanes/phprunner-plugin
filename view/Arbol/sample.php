$this->settings["title"] = 'Dependencies';
$this->settings["filterlabel"] = 'Element:';
$this->settings["contentswidth"] = 580; // 'default' for window's width - 100
$this->settings["contentsheight"] = ''; // '' for window's height - 100
$this->settings["individualSQL"] = ""; // Example: "SELECT CategoriesName FROM Categories WHERE CategoriesId = " . Finish with = ' in case of a string field. If is multiselect, finish with " IN (", or " IN (' " if elements are strings. Contact me for support !!!
$this->settings["generalSQL"] = ""; // Complete SELECT for filling the treeview
$this->settings["deeplimit"] = -1; // -1 Means ilimited. For circular recursivity you need to set a value greater than or equal to 0
$this->settings["tooltip"] = "Click here to see element's depenedencies tree";
$this->settings["gotoelementtext"] = "Go to selected element";
$this->settings["gotoelementtooltip"] = "Click here to go to selected element";

// ------------------ MULTI SELECT SETTINGS ------------------ //
$this->settings["ismultiselect"] = 'no'; // If 'yes', use "plugins/controlesmib/multiarbol/contenido/vistamulti.php"
$this->settings["separator"] = ";"; // Do not use ";;mib;;" to make plugin work properly. Do not use any space neither. Do not ask why!!!!
$this->settings["textbutton"] = "Click here";