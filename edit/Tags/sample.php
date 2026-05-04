$this->settings["required"] = false;                            // Wether is mandatory
$this->settings["defaultLabel"] = 'Type here';                  // Text that appears in the data input box
$this->settings["defaultTagClass"] = '';                        // For example 'bg-primary', .... Class bottom the Bootstrap
$this->settings["trimValue"] = false;                           // If true, eliminates spaces from the word
$this->settings["dashspaces"] = false;                          // If true, space to separate words is allowed
$this->settings["lowercase"] = false;                           // Set max date on datepicker, prevent user select date after given unix time
$this->settings["tagLimit"] = 0;                               // Maximum number of labels, 0 = There is no maximum
$this->settings["isSuggestions"] = false;                       // If true, there are suggested labels

// Only if "True" has been put to the previous field

$this->settings["noSuggestionMsg"] = 'Enter to generate new tag'; // Message that appears when the label is not within the suggested
$this->settings["sqlTagsSuggestions"] = "SELECT name FROM t1";  // SELECT to obtain the suggested labels set
$this->settings["whiteList"] = false;                           // If true, only suggested labels can be used
$this->settings["showAllSuggestions"] = false;                  // If true, it shows all the suggested labels
