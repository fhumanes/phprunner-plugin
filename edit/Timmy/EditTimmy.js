
Runner.controls.EditTimmy = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditTimmy.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		$('input#'+this.valContId).bootstrapMaterialDatePicker({
			format		: this.getFieldSetting('format'),
			shortTime	: this.getFieldSetting('shortTime'),
			date		: this.getFieldSetting('date'),
			time		: this.getFieldSetting('time'),
			clearButton	: this.getFieldSetting('clearButton'),
			nowButton	: this.getFieldSetting('nowButton'),
			switchOnClick	: this.getFieldSetting('switchOnClick'),
			cancelText	: this.getFieldSetting('cancelText'),
			nowText		: this.getFieldSetting('nowText'),
			okText		: this.getFieldSetting('okText'),
			clearText	: this.getFieldSetting('clearText'),
			lang		: this.getFieldSetting('lang'),
			weekStart	: this.getFieldSetting('weekStart')
		});
		if(!!this.getFieldSetting('currentDate')) $('input#'+this.valContId).bootstrapMaterialDatePicker('setDate',this.getFieldSetting('currentDate'));
		else if($('input#'+this.valContId).val()!='') $('input#'+this.valContId).bootstrapMaterialDatePicker('setDate',$('input#'+this.valContId).val());
		$('input#'+this.valContId).bootstrapMaterialDatePicker('setMinDate', this.getFieldSetting('minDate'));
		$('input#'+this.valContId).bootstrapMaterialDatePicker('setMaxDate', this.getFieldSetting('maxDate'));
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditTimmy"] = "EditTimmy";
