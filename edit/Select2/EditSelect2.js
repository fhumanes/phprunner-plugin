Runner.controls.EditSelect2 = Runner.extend(Runner.controls.Control,{
  
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditSelect2.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }

                $("."+this.valContId).select2.defaults.set("width", this.getFieldSetting("FieldWidth"));
                
                V_this = this;
                function formatSelect(lookup) {
                  if (!lookup.id) {
                    return lookup.text;
                  }
                  var baseUrl = V_this.getFieldSetting("urlImage");
                  baseUrl = baseUrl.replace('{1}', lookup.image);
                  var lookup= $(
                    '<span><img src="' + baseUrl +'" width="'+V_this.getFieldSetting("widthImage")+'" class="img-select2" /> ' + lookup.text + '</span>'
                  );
                  return lookup;
                };

                var values_string = document.getElementById('current_' + this.valContId).innerHTML;

                // console.log("Nombre del campo: ",this.valContId);
                // console.log("Datos/Opciones. ", this.getFieldSetting("data"));
                // console.log("Valores actuales: ",values_string );

                var value = null;

                if (values_string !== null ) {
                    var values = values_string.split(','); // Create array with valors
                }

                
                if (values_string === null && this.getFieldSetting("DefaultValue") !== null ) { // Para Valores por defecto en Add
                    var values = this.getFieldSetting("DefaultValue").split(','); // Create array with valors
                }
                
                var options = {};
                options.language = this.getFieldSetting("language");
                options.placeholder = this.getFieldSetting("placeholder");
                options.allowClear = this.getFieldSetting("allowClear");
                options.maximumSelectionLength = this.getFieldSetting("maximumSelectionLength");
                options.tag = true;
                options.data = this.getFieldSetting("data");
                if (this.getFieldSetting("renderImage") === true) { // Will you list yourself with images?
                    options.templateResult = formatSelect;
                }
                options.dropdownParent = $('#my_'+this.valContId);
                
                    
                var S2 = $("."+this.valContId).select2( options); 
           
                $("."+this.valContId).val(values); // Select the Value Default
                $("."+this.valContId).trigger('change'); // Notify any JS components that the value changed 

          }           
	, 
    isEmpty: function(){
          if(this.getValue() === null)
            return [];
          }
  ,
    getForSubmit: function(){
      if (!this.appearOnPage()){ return []; }
                  
                  // console.log("value1: "+this.getValue() );

                  var values_string = this.getValue();
                  
                  if ( typeof this.getValue() == 'object' ) {
                          var values = this.getValue();           // For transform the array
                          var values_string = null;
                          if (values !== null ) {                 // Para el caso de no entrada de valor
                              values_string = values.join();
                          }
                      }
                  var realCb = $("." + this.valContId);
                  var cbClone = document.createElement('input');
                  $(cbClone).attr('type', 'hidden');
                  $(cbClone).attr('id', realCb.attr('id'));
                  $(cbClone).attr('name', realCb.attr('name'));
                  $(cbClone).val(values_string);
                  return [cbClone];

    }
        
});

Runner.controls.constants["EditSelect2"] = "EditSelect2";

