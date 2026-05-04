$this->settings["fielddocname"] = ""; // Field to store document's name
$this->settings["defaultdocname"] = "file.bin"; // Default document's name if it's not set
$this->settings["title"] = 'Preview Document - '; // Header caption
$this->settings["contentswidth"] = 'default'; // 'default' for window's width - 100
$this->settings["contentsheight"] = ''; // '' for window's height - 100
$this->settings["tooltip"] = "Click here to preview the document"; // Button's information
$this->settings["textbutton"] = "{{fielddocname}}"; // Button's caption. "{{fielddocname}}" will show the value stored in $this->settings["fielddocname"] property. Otherwise will show the text entered. Example: "Preview Document"