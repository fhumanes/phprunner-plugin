
Runner.controls.EditCalculator = Runner.extend(Runner.controls.Control,{

	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditCalculator.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
                
                var options = {};
                // options.showOn = 'both';
                options.showOn = 'focus';
                // options.buttonImageOnly = true;
                options.buttonImageOnly = false;
                // options.buttonImage = 'plugins/controles/calculator/image/calculator.png';
                options.precision = this.getFieldSetting("decimals");
                
                if (this.getFieldSetting("layout") != 'basic' ) {   
                    options.layout = $.calculator.scientificLayout;
                }
         
                //$.calculator.setDefaults({showOn: 'both', buttonImageOnly: true, buttonImage: 'plugin/controles/calculator/image/calculator.png'});
                $("#"+this.valContId).calculator( options); 
                

               
	},
        setFocus: function() {
                return false;
        },
        _onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]; 
	}
});

Runner.controls.constants["EditCalculator"] = "EditCalculator";
