Runner.controls.EditStarRating = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	required : false,
	cancel: false,
	cancelPlace: "left",
	cancelHint : "remove my rating!",
	hints : new Array('bad', 'poor', 'regular', 'good', 'gorgeous'),
	half: false,
	size: 12,
	number : 5,
	show_hint: false,
	score_value : 0,
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditStarRating.superclass.constructor.call(this, cfg);
		this.required = this.getFieldSetting("required");
		this.cancel = this.getFieldSetting("cancel");
		this.cancelPlace = this.getFieldSetting("cancelPlace");
		this.cancelHint = this.getFieldSetting("cancelHint");
		this.hints = this.getFieldSetting("hints");
		this.half = this.getFieldSetting("half");
		this.size = parseInt(this.getFieldSetting("size"));
		this.number = parseInt(this.getFieldSetting("number"));
		this.show_hint = this.getFieldSetting("show_hint");
		
		var hidden_id = this.valContId;		
		var hidden_value = parseFloat($('#'+hidden_id).val());

		if(hidden_value >= 0)
		{
			this.score_value = hidden_value;
			$('#rating-hint_'+hidden_id).html(this.score_value);
		}
		
		if (this.required)
			this.addValidation("IsRequired");
		
		if(this.show_hint)
			$('#rating-hint_'+hidden_id).show();		
		
		//we update the phprunner hidden field
		// $('#star_'+hidden_id).live('click',function(e) {
		$('#star_'+hidden_id).on('click',function(e) {
			var hidden_score_value = $(this).find("input[name='score'][type='hidden']").val();
			$('#'+hidden_id).val(hidden_score_value);
		});
		
		$('#star_'+hidden_id).raty({
			  score		 : this.score_value, 
			  target     : '#rating-hint_'+hidden_id,
			  targetKeep : true,
			  targetType : 'number',
			  cancel	 : this.cancel,
			  cancelPlace: this.cancelPlace,
			  cancelHint : this.cancelHint,
			  hints		 : this.hints,
			  half       : this.half,
			  size       : this.size,
			  number	 : this.number,
			  width		 : 'auto',
			  starHalf   : (this.size > 12) ? 'star-half-big.png' : 'star-half.png',
			  starOff    : (this.size > 12) ? 'star-off-big.png' : 'star-off.png',
			  starOn     : (this.size > 12) ? 'star-on-big.png' : 'star-on.png',
			  cancelOff  : (this.size > 12) ? 'cancel-off-big.png' : 'cancel-off.png',
			  cancelOn   : (this.size > 12) ? 'cancel-on-big.png' : 'cancel-on.png',
			  mouseover : function(sc, evt) {
					var target = $('#rating-hint_'+hidden_id);
		
					if (sc === null) {
					  target.html('Cancel!');
					} else if (sc === undefined) {
					  target.empty();
					} else {
					  target.html(sc);
					}
			  }
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

		return [this.valueElem.clone().val(parseFloat(this.getValue()))]
	}
});

Runner.controls.constants["EditStarRating"] = "EditStarRating"; 



