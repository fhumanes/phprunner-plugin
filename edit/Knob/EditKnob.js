Runner.controls.EditKnob = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){	
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditKnob.superclass.constructor.call(this, cfg);
		
		if (this.getFieldSetting('required'))
			this.addValidation("IsRequired");
			
		$('#'+this.valContId).knob({
			 'min':parseFloat(this.getFieldSetting('min')),
			 'max':parseFloat(this.getFieldSetting('max')),
			 'angleOffset':this.getFieldSetting('angleOffset'),
			 'angleArc':this.getFieldSetting('angleArc'),
			 'stopper':this.getFieldSetting('stopper'),
			 'readOnly':this.getFieldSetting('readOnly'),
			 'cursor':this.getFieldSetting('cursor'),
			 'thickness':this.getFieldSetting('thickness'),
			 'width':this.getFieldSetting('width'),
			 'height':this.getFieldSetting('height'),
		     'displayInput':this.getFieldSetting('displayInput'),
		     'displayPrevious':this.getFieldSetting('displayPrevious'),
		     'fgColor':this.getFieldSetting('fgColor'),
		     'inputColor':this.getFieldSetting('inputColor'),
		     'bgColor':this.getFieldSetting('bgColor')
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
	}
});

Runner.controls.constants["EditKnob"] = "EditKnob"; 



