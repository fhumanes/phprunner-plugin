/**
 * TextArea control class
 */
Runner.controls.EditSignaturePad = Runner.extend( Runner.controls.Control, {
	required: false,
	bgColor: '#ffffff',
	color: '#145394',
	linew: 2,
	cfield:"",
	
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
		this.addEvent( ["change", "keyup"] );		
		// call parent
		Runner.controls.EditSignaturePad.superclass.constructor.call( this, cfg );
		
		this.required = this.getFieldSetting("required");
		this.bgColor = this.getFieldSetting("bgColor");
		this.linew = this.getFieldSetting("lineWidth");
		this.color = this.getFieldSetting("lineColor");
		this.cfield = this.getFieldSetting("cfield");
		if ( this.required ) {
			this.addValidation("IsRequired");
		}
		$('#sigPad_'+this.cfield).signaturePad({
			drawOnly: true, 
			bgColour: this.bgColor,
			penColour: this.color,
			penWidth: this.linew,
			onDraw: this._onBegin
		});

		//var can = document.getElementsByTagName('canvas')[0];
		//var ctx = can.getContext('2d');
		//ctx.strokeStyle = this.color;
		//ctx.lineWidth   = this.linew;
		//$("#sig_"+this.cfield).css("background-color",this.bgColor);


	},
	_onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	isEmpty: function() {
		return this.getValue().toString() == "";
	},
	
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function() {
		if ( !this.appearOnPage() ) {
			return [];
		}
		if($(".pad_"+this.cfield).attr("del")){
			$.get("signature-to-image.php", { 
				delf: $(".pad_"+this.cfield).attr("del")
			})
			.done(function(){
				$(".pad_"+this.cfield).removeAttr("del");
			});
		}
		return [ this.valueElem.clone().val( this.getValue() ) ];
	}
});

Runner.controls.constants["EditSignaturePad"] = "EditSignaturePad"; 



