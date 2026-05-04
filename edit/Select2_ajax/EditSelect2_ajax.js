Runner.controls.EditSelect2_ajax = Runner.extend(Runner.controls.Control,{
  
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditSelect2_ajax.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }

                $("."+this.valContId).select2.defaults.set("width", this.getFieldSetting("FieldWidth"));
                
                var V_this = this;
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
                    
                var S2 = $("."+this.valContId).select2({
                      ajax: {
                        url: "./Select2_ajax_filter.php",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                          return {
                            q: params.term, // search term
                            f: V_this.valContId,
                            session: V_this.getFieldSetting("SessionDependenteValue")
                          };
                        },
                        processResults: function (data, params) {
                              return {
                                results: data
                              };
                        },
                        cache: false
                      },
                      language: this.getFieldSetting("language"),
                      placeholder: this.getFieldSetting("placeholder"),
                      allowClear: this.getFieldSetting("allowClear"),
                      maximumSelectionLength: this.getFieldSetting("maximumSelectionLength"),
                      tag: true,
                      dropdownParent:$('#my_'+this.valContId)
                }); 

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
                        if ( values ){                          // is NULL
                            values_string = values.join();
                        } else {
                            values_string = '';
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

Runner.controls.constants["EditSelect2_ajax"] = "EditSelect2_ajax";

