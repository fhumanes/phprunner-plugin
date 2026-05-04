
Runner.controls.EditMultiColumn = Runner.extend( Runner.controls.Control, {
    columns: 3,
	title: "Select", 
	
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
	
		this.addEvent( ["change", "keyup"] );		
		// call parent
		Runner.controls.EditMultiColumn.superclass.constructor.call( this, cfg );
		
		this.columns = this.getFieldSetting("columns");
		this.title = this.getFieldSetting("title");
		this.parentField = this.getFieldSetting("parentField");
		var noDataMessage = "No data";
		var datacount = document.getElementById('current_' + this.valContId).innerHTML;
		if(this.parentField)
		noDataMessage+=", select "+this.parentField+" value";
		this.opts = { 
            columns: this.columns,
            itemWidth: 120,
            title: this.title,
			hideOnMouseOut: true,
			pageId:cfg.id,
			fieldName:cfg.fieldName,
			listCount: datacount,
			// listCount:this.getFieldSetting("dataCount"),
			noDataMessage:noDataMessage
        };
		if(this.getFieldSetting("required"))
			this.addValidation('IsRequired');
		$('#'+this.valContId).gentleSelect(this.opts);
		//this.parentField = "field2";
		// this.filterField = "NameProvincia";
		if( this.parentField ){
			var control = this;
			var parentEvent = function(){
				var params = {};
				params[control.parentField+"_field"] = $(this).val();
				params["field"] = cfg.fieldName;
				$('#'+control.spanContId).find(".gentleselect-label").text("Updating...");
				$('#'+control.spanContId).find(".gentleselect-label").attr("disabled","disabled");

				$.get(Runner.pages.getUrl("MultiColumnFilter"),params,function(response){
					var multiColumnData = JSON.parse(response);
					control.valueElem.html("<option value=''>&nbsp;</option>");
					$.each(multiColumnData,function(i,op){
						control.valueElem.append("<option value='"+op+"'>"+op+"</option>");
					});
					var ul = $('#'+control.spanContId).find(".gentleselect-dialog ul");
					$.each(ul.find(".selected"),function(){
						control.valueElem.find("option[value='" + $(this).html() + "']").prop("selected", true);
					});
					control.opts.listCount = multiColumnData.length;
					$('#'+control.valContId).gentleSelect(control.opts);
	
				})
			}
	
			$("body").on("change","#value_"+this.parentField+"_"+cfg.id,parentEvent)
		}
		
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
		var valueElem = this.valueElem.clone();
		$.each($('#'+this.valContId).parent().find("span.gentleselect-label").text().split(","), function(i,val){
			valueElem.find("option[value='" + val.trim() + "']").prop("selected", true);
		});

		return [ valueElem ];
	}
});

Runner.controls.constants["EditMultiColumn"] = "EditMultiColumn"; 



