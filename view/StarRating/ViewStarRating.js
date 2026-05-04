Runner.viewControls.ViewStarRating = Runner.extend(Runner.viewControls.ViewControl,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
			
		// call parent
		Runner.viewControls.ViewStarRating.superclass.constructor.call(this, cfg);
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





