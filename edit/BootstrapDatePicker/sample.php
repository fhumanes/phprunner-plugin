                                                                // The days of the week are: 0 (Sunday) to 6 (Saturday)
$this->settings["required"] = false;                            // Wether is mandatory
$this->settings["tooltip"] = 'Enter the date of ......';        // Tooltip of field
$this->settings["format"] = 'mm/dd/yyyy';                       // Format of presentation of the date
$this->settings["weekStart"] = '0';                             // Day in which the week begins
$this->settings["startDate"] = '';                              // Selectable initil date. The defined date format must be used
$this->settings["endDate"] = '';                                // Selectable end date. The defined date format must be used
$this->settings["todayBtn"] = true;                             // So that "today" button appears
$this->settings["clearBtn"] = true;                             // So that "clean" button appears
$this->settings["daysOfWeekDisabled"] =  "0,6";                 // Days of the week I do not work
$this->settings["daysOfWeekHighlighted"] =  "0,6";              // Days of the week highlighted 
$this->settings["calendarWeeks"] = false ;                      // If in the calendar you show the information number
$this->settings["autoclose"] = true ;                           // If when selecting a date, the calendar window is closed
$this->settings["todayHighlight"] = true ;                      // If the current day is highlighted
$this->settings["language"] = 'en-GB' ;                         // Calendar language. Consult URL: https://github.com/uxsolutions/bootstrap-datepicker/tree/master/dist/locales
$this->settings["datesDisabled"] = '' ;                         // Holidays Array of days is defined according to the format that has been specified.
                                                                // Example: array('03/03/2021', '03/24/2021')
