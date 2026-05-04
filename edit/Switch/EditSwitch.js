Runner.controls.EditSwitch = Runner.extend(Runner.controls.Control,{

	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditSwitch.superclass.constructor.call(this, cfg);
		// if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }

                // var input = document.querySelector("input#"+this.valContId);

    
          }           
	, 

	getForSubmit: function(){
                // console.log("function: "+this.appearOnPage() );
		if (!this.appearOnPage()){ return []; }
                var realCb = $("#" + this.valContId);
                var cbClone = document.createElement('input');
                $(cbClone).attr('type', 'hidden');
                $(cbClone).attr('id', realCb.attr('id'));
                $(cbClone).attr('name', realCb.attr('name'));
                $(cbClone).val(realCb.is(":checked") ? 1 : 0);
                return [cbClone];
	}
});

Runner.controls.constants["EditSwitch"] = "EditSwitch";



