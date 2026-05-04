
Runner.controls.EditEmoji = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditEmoji.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }

                window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[data-emojiable=true]',
                assetsPath: './plugins/controles/emoji/img/',
                popupButtonClasses: 'fa fa-smile-o'
                });
                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
                // It can be called as many times as necessary; previously converted input fields will not be converted again
                window.emojiPicker.discover();

	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]  
	}
});

Runner.controls.constants["EditEmoji"] = "EditEmoji";
