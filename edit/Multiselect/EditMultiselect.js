Runner.controls.EditMultiselect = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditMultiselect.superclass.constructor.call(this, cfg);

		var options = {};
		var $this = this;

		if ($this.getFieldSetting('required'))
			$this.addValidation('IsRequired');
		
		if ($this.getFieldSetting('group_by') && $this.getFieldSetting('selectableOptgroup'))
			options.selectableOptgroup = true;
			
		if($this.getFieldSetting('selectableHeader'))
			options.selectableHeader = $this.getFieldSetting('selectableHeader');
		if($this.getFieldSetting('selectionHeader'))
			options.selectionHeader = $this.getFieldSetting('selectionHeader');
		if($this.getFieldSetting('selectableFooter'))
			options.selectableFooter = $this.getFieldSetting('selectableFooter');
		if($this.getFieldSetting('selectionFooter'))
			options.selectionFooter = $this.getFieldSetting('selectionFooter');

		$('#'+$this.valContId).multiSelect(options);
		
		if($this.getFieldSetting('selectDeselectAll'))
		{ 
			$('#'+$this.valContId+'-select-all').click(function(){
			  $('#'+$this.valContId).multiSelect('select_all');
			  return false;
			});
			$('#'+$this.valContId+'-deselect-all').click(function(){
			  $('#'+$this.valContId).multiSelect('deselect_all');
			  return false;
			});
		}
		
	},
	isEmpty: function(){
		if(this.getValue() === null)
			return [];
	},
	
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}

                // console.log("value MultiSelect2: "+this.getValue() );

                var values_string = this.getValue();
                
                if ( typeof this.getValue() == 'object' ) {
                        var values = this.getValue();           // For transform the array
                        if ( values === null ){ values = []; };
                        values_string = values.join();
                    }
                var realCb = $("." + this.valContId);
                var cbClone = document.createElement('input');
                $(cbClone).attr('type', 'hidden');
                $(cbClone).attr('id', this.valContId);
                $(cbClone).attr('name', this.valContId);
                $(cbClone).val(values_string);
                return [cbClone];
	}
});

Runner.controls.constants["EditMultiselect"] = "EditMultiselect"; 



