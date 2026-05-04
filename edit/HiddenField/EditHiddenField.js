// Copyright (c) 2016 - 2017 Tony Silva
// 
// This code can be purchased by any developer and there after 
// included in any software packages he/they distribute

Runner.controls.EditHiddenField = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	required: false,
	myVal: "value of my Field: ", 
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditHiddenField.superclass.constructor.call(this, cfg);
		this.required = this.getFieldSetting("required");
		this.myVal = this.getFieldSetting("myVal");
	
                if (this.required)
			this.addValidation("IsRequired");

	        $( "input[class^='PLEASE_HIDE_ME']" ).hide();
	        $( "input[class^='PLEASE_HIDE_ME']" ).parent().hide();
	        $( "input[class^='PLEASE_HIDE_ME']" ).parent().parent().hide();
	        $( "input[class^='PLEASE_HIDE_ME']" ).parent().parent().parent().hide();
	},
	isEmpty: function(){
		return this.getValue().toString()=="";
	},
        getForSubmit: function(){            
		if (!this.appearOnPage()){
                        //return [];
			return [this.valueElem.clone().val(this.getValue())];
		}
                
                //[input#value_AttachedFile_1, prevObject: n.fn.init[1], context: document]
                return [this.valueElem.clone().val(this.getValue())];
	},
	setFocus: function(){
                //tony123
		//if (!this.appearOnPage()){
		//	return [];
		//}
		return false;
	}

});

Runner.controls.constants["EditHiddenField"] = "EditHiddenField"; 



