/**
 * BootstrapTimepicker control class
 */
Runner.controls.EditBootstrapTimepicker = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	minuteStep: 15, 
	secondStep: 15,
	showSeconds: false,
	showMeridian: true,
	required: false,
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditBootstrapTimepicker.superclass.constructor.call(this, cfg);
		this.minuteStep = this.getFieldSetting("minuteStep");
		this.secondStep = this.getFieldSetting("secondStep");
		this.showSeconds = this.getFieldSetting("showSeconds");
		this.showMeridian = this.getFieldSetting("showMeridian");
		this.required = this.getFieldSetting("required");
			
		if (this.required)
			this.addValidation("IsRequired");

		var time = this.getValue().toString()=="" ? "current" : this.getValue().toString();
		
		$("#"+this.valContId).timepicker({
				minuteStep:this.minuteStep, 
				secondStep: this.secondStep, 
				showSeconds: this.showSeconds,
				showMeridian: this.showMeridian,
				defaultTime: time				
				});
		

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
	},
		destructor: function(){
		// call parent
		Runner.controls.EditBootstrapTimepicker.superclass.destructor.call(this);
		$("#"+this.valContId).timepicker('hideWidget');
		
	}

});

Runner.controls.constants["EditBootstrapTimepicker"] = "EditBootstrapTimepicker"; 



