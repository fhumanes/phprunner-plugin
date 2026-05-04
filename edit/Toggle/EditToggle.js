Runner.controls.EditToggle = Runner.extend(Runner.controls.Control,{

	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditToggle.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }

                // var input = document.querySelector("input#"+this.valContId);
                $("input#"+this.valContId).bootstrapToggle({
                
                    on:         this.getFieldSetting("name_enable"),
                    off:        this.getFieldSetting("name_disable"),
                    size:       this.getFieldSetting("size"),
                    onstyle:    this.getFieldSetting("style"),
                    offstyle:   "default"
                  });
    
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

Runner.controls.constants["EditToggle"] = "EditToggle";



