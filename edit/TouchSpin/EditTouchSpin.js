
Runner.controls.EditTouchSpin = Runner.extend(Runner.controls.Control,{
    constructor: function(cfg){
        this.addEvent(["change", "keyup"]);		
        Runner.controls.EditTouchSpin.superclass.constructor.call(this, cfg);
        var options = {};
        var $this = this;

        if ($this.getFieldSetting('required')) $this.addValidation('IsRequired');

        options.verticalbuttons = $this.getFieldSetting('verticalbuttons');
        if (options.verticalbuttons == 'false') {
            options.verticalbuttons = false;
        } else {
            options.verticalbuttons = true;
        }

        $("input[name='"+$this.valContId+"']").TouchSpin(options);
            
        },      
        _onBegin: function(){
            Runner.pages.RunnerPage.prototype.setPageModified(true);
        },
        getForSubmit: function(){
            if (!this.appearOnPage()){ return []; }
            return [this.valueElem.clone().val(this.getValue())];
        }
    });
    
    Runner.controls.constants["EditTouchSpin"] = "EditTouchSpin";