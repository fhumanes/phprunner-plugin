Runner.viewControls.ViewColors = Runner.extend(Runner.viewControls.ViewControl,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
			
		// call parent
		Runner.viewControls.ViewColors.superclass.constructor.call(this, cfg);
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
	init: function(){

			
	}
});



