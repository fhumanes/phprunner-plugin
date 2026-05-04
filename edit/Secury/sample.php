$this->settings["required"] = false; // Wether is mandatory
$this->settings["width"] = "auto"; // Width of the control
$this->settings["tooltip"] = "Type your password here"; // Information tooltip

$this->settings["minlength"] = 8; // Minimum amount of characters
$this->settings["number"] = true; // If password must contain at least one number
$this->settings["capital"] = true; // If password must contain at least one uppercase letter
$this->settings["special"] = true; // If password must contain at least one special character

$this->settings["specialtooltipbgcolor"] = "#F2F5A9"; // Background color of special tooltip
$this->settings["labelgeneral"] = "The password must have: "; // Title of the special tooltip that describes rules established
$this->settings["labelminlength"] = "At least 8 characters"; // Minimum amount of characters allowed rule
$this->settings["labelnumber"] = "At least one number"; // If password must contain at least one number
$this->settings["labelcapital"] = "At least one uppercase letter"; // If password must contain at least one uppercase letter
$this->settings["labelspecial"] = "At least one special character"; // If password must contain at least one special character