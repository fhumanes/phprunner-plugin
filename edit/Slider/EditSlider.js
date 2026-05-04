/**
 * Slider control class
 */
Runner.controls.EditSlider = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	lowerBound: 1, 
	upperBound: 10,
	decimals:   0,
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditSlider.superclass.constructor.call(this, cfg);
		this.lowerBound = this.getFieldSetting("lowerBound");
		this.upperBound = this.getFieldSetting("upperBound");
		this.decimals = this.getFieldSetting("decimals");
		$("#"+this.valContId).slideControl({lowerBound:this.lowerBound, upperBound: this.upperBound, decimals: this.decimals});
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

Runner.controls.constants["EditSlider"] = "EditSlider"; 



