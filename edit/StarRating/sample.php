// set it to true to make star rating field required
$this->settings["required"] = true;

//If true will be showed a button to cancel the rating
$this->settings["cancel"] = true;

//Position of the cancel button (left or right)
$this->settings["cancelPlace"] = 'left';

//The hint information of the cancel button
$this->settings["cancelHint"]  = 'remove my rating!';

//List of names that will be used as a hint on each star
$this->settings["hints"] = array('bad', 'poor', 'regular', 'good', 'gorgeous');

//Enables half star selection
$this->settings["half"] = true;

//The icons size (12 or 24)
$this->settings["size"] = 12;

//Number of stars that will be presented (1-20)
$this->settings["number"] = 10;

//If true will be showed an hint area for the actual selected score
$this->settings["show_hint"] = true;