$this->settings["required"] = false;                                         // Wether is mandatory
$this->settings["placeholder"] = "Select an option";                         // Text to appear in dialog box
$this->settings["select"] = "select 1,'text' from dual where 1=1";           // query to database, first field is the key and second, text to display. Optional, third field for the image 
$this->settings["language"] = "en";                                          // interface language, example: es, it, fr, .....
$this->settings["allowClear"] = true;                                        // if it shows an icon to leave the field empty. Values "true" and "false"
$this->settings["FieldWidth"] = "340px";                                     // Field width, can be defined in "px" or "%"
$this->settings["DefaultValue"] = null;                                      // Value for default
$this->settings["multiple"] = false;                                         // Possible selection of multiple values? Possible values "false" or "true"

// Only if it has been indicated that they are Multiple values
$this->settings["maximumSelectionLength"] = 3;                               // Maximum number of values that can be selected

// Only if you want to show an image next to the selection 
// The third field of the "select" is the key of the 
$this->settings["renderImage"] = false;                                      // true or false. true = we want to present image
$this->settings["urlImage"] = './images/{1}.png';                            // URL to download the image. The parameter "{1}" will be replaced by the third field of the "select"
$this->settings["widthImage"] = 30;                                          // image rendering size  


