/**
 * TextArea control class
 */
Runner.controls.EditMyField = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	myVal: "value of my Field: ", 
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditMyField.superclass.constructor.call(this, cfg);
//		this.inputType = "text";		
		this.myVal = this.getFieldSetting("myVal");
	},
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditMyField"] = "EditMyField"; 



