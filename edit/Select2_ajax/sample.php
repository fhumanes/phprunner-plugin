$this->settings["required"] = false;                                         // Wether is mandatory
$this->settings["placeholder"] = "Select an option";                         // Text to appear in dialog box

// query to database, first field is the key and second, text to display. The Text {search} is fixed
$this->settings["select"] = "select code,title from dual where title LIKE '%{search}%'";

// Query to show the values of the Row. It has to be 2 fields. The text {values} is fixed
$this->settings["sql_recovers_values"] = "select code,title from dual where title = '{value}' ";

$this->settings["language"] = "en";                                          // interface language, example: es, it, fr, .....
$this->settings["allowClear"] = true;                                        // if it shows an icon to leave the field empty. Values "true" and "false"
$this->settings["FieldWidth"] = "340px";                                     // Field width, can be defined in "px" or "%"
$this->settings["multiple"] = false;                                         // Possible selection of multiple values? Possible values "false" or "true"
$this->settings["DefaultValue"] = null;                                      // Value for default
$this->settings["SessionDependenteValue"] = null;                            // Key Session variable for dependente LOOKUP

// Only if it has been indicated that they are Multiple values
$this->settings["maximumSelectionLength"] = 3;                               // Maximum number of values that can be selected

