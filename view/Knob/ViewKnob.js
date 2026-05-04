Runner.viewControls.ViewKnob = Runner.extend(Runner.viewControls.ViewControl,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	jsParams : new Array(),
	constructor: function(cfg){	
		// call parent
		Runner.viewControls.ViewKnob.superclass.constructor.call(this, cfg);
	},
	
	init: function(){
		var current = this;
		$("input[id^='knob_']").each(function(){
			if($(this).attr('name') == current.fieldName)
			{
				$(this).knob({
					'readOnly':true,
					'min':parseFloat(current.min),
					'max':parseFloat(current.max),
					'cursor':current.cursor,
					'thickness':current.thickness,
					'width':current.width,
					'height':current.height,
					'displayInput':current.displayInput,
					'displayPrevious':current.displayPrevious,
					'fgColor':current.fgColor,
					'inputColor':current.fgColor,
					'bgColor':current.bgColor
				});
			}
		});
	}
});