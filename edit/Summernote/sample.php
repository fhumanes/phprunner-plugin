$this->settings["required"] = false;        // Wether is mandatory
$this->settings["height"] = "300";          // Height of textarea
$this->settings["minHeight"] = null;        // Minimum height of textarea
$this->settings["maxHeight"] = null;        // Maximum height of textarea
$this->settings["language"] = 'en-US';      // Interface language. View https://github.com/summernote/summernote/tree/develop/lang
$this->settings["spellCheck"] = true;       // Spelling checker. It is browser dependent
$this->settings["disableGrammar"] = false;  // Grammar checker. It is browser dependent
$this->settings["plugins"] = array('emoji','specialchars'); // Library of plugin in use

$this->settings["toolbar_menu"] = array(
    array('style', array('style')),
    array('font', array('bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear')),
    array('paragraph', array('ul', 'ol', 'paragraph')),
    array('color', array('color')),
    array('table', array('table')),
    array('insert', array('picture', 'link', 'video')),
    array('emoji',array('emoji')),
    array('view', array('fullscreen', 'codeview', 'undo', 'redo')),
    array('help')
)
;

// Editor menu options. View https://summernote.org/deep-dive/#custom-toolbar-popover
