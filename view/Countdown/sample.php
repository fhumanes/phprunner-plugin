/*
 *
 *
Choose your language. The availbales languages are:
ar    =>    arabic
bg    =>    bulgarian
bn    =>    bengali
bs    =>    bosnian
ca    =>  	canadian
cs    =>  	czech
cy    =>  	welsh
da    =>  	danish
de    =>  	deutsch
el    =>  	greek
en    =>  	english
es    =>  	spanish
et    =>  	estonian
fa    =>  	farsi
fi    =>  	finnish
fr    =>  	french
gl    =>  	galician
gu    =>  	gujarati
he    =>  	hebrew
hr    =>  	croatian
hu    =>  	hungarian
hy    =>  	armenian
id    =>  	indonesian
it    =>  	italian
ja    =>  	japanese
kn    =>  	kannada
ko    =>  	korean
lt    =>  	lithuanian
lv    =>  	latvian
ml    =>  	malayalam
ms    =>  	malay
my    =>  	burmese
nb    =>  	norwegian
nl    =>  	dutch
pl    =>  	polish
pt-BR    =>  	brazilian
ro    =>  	romanian
ru    =>  	russian
sk    =>  	slovak
sl    =>  	slovenian
sq    =>  	albanian
sr    =>  	serbian
sr-SR    =>  	serbian latin
sv    =>  	swedish
th    =>  	thai
tr    =>  	turkish
uk    =>  	ukrainian
uz    =>  	uzbek
vi    =>  	vietnamese
zh-CN    =>  	chinese (S)
zh-TW    =>  	chinese (T)


English is choosen as default language.
 *
 *
 */
$this->settings['localization'] = 'en';

// True to display in a compact format, false for an expanded one
$this->settings['compact'] = false;

// If set to 'until' it counts down.  If set to 'since' it counts up
$this->settings['until_or_since'] = 'until';

// Format for display parts of the countdown- upper case for always, lower case only if non-zero, 
// 'Y' years, 'O' months, 'W' weeks, 'D' days, 'H' hours, 'M' minutes, 'S' seconds 
// By default it shows days, hours, minutes and seconds
$this->settings['format'] = 'dHMS';

/* Build your own layout for the countdown.
Create your own customised layout for more control over the countdown appearance.
Indicate substitution points with '{desc}' for the description, 
'{sep}' for the time separator, 
'{pv}' where p is 'y' for years, 'o' for months, 'w' for weeks, 
'd' for days, 'h' for hours, 'm' for minutes, or 's' for seconds 
and v is 'n' for the period value, 'nn' for the period value with 
a minimum of two digits, 'nnn' for the period value with a minimum 
of three digits, or 'l' for the period label (long or short form depending on the compact setting), 
or '{pd}' where p is as above and d is '1' for the units digit, '10' for the tens digit, '100' 
for the hundreds digit, or '1000' for the thousands digit.
If you need to exclude entire sections when the period value is zero and 
you have specified the period as optional, surround these sections 
with '{p<}' and '{p>}', where p is the same as above.

Your layout can just be simple text, or can contain HTML markup as well. 
You can even embed your HTML within the countdown division/span and reference it from there.
*/
$this->settings['layout'] = '';

// The number of periods with values to show, zero for all
$this->settings['significant'] = 0;

// The description displayed for the countdown. You can even embed your HTML within the description 
$this->settings['description'] = '';

/*
 *
 *
 THIS IS AN OPTIONAL PART. If you want to override
 the default labels, set the override_labels setting to true. 
 *
 *
 */

//If set to true it overrides the default labels
$this->settings['override_labels'] = false;

// The expanded texts for the counters. There is no control over this setting. Ma ke only sure you are keeping
// the same order: 'Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'
$this->settings['labels'] = array('Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'); 

// The display texts for the counters if only one. There is no control over this setting. Ma ke only sure you are keeping
// the same order: 'Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'
$this->settings['labels1'] =  array('Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second');

// The compact texts for the counters. There is no control over this setting. Ma ke only sure you are keeping
// the same order: 'y', 'm', 'w', 'd'
$this->settings['compactLabels'] =  array('y', 'm', 'w', 'd'); 

// The digits to display. There is no control over this setting. Ma ke only sure you are keeping
// the same order: '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
$this->settings['digits'] =  array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

// Separator for time periods
$this->settings['timeSeparator'] =  ':';  

// True for right-to-left languages, false for left-to-right 
$this->settings['isRTL'] =  false;


/*
 *
 *
 THIS IS AN OPTIONAL PART. If you want to override
 the default timezone, set the override_timezone setting to true
 and choose an alternative timezone 
 *
 *
 */
 
//If set to true it overrides the default timezone
$this->settings['override_timezone'] = false;

//Set your timezone. You can check the available timezones here: http://www.php.net/manual/en/timezones.php
$this->settings['timezone'] = 'Europe/London';