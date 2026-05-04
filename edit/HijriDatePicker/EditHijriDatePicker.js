
Runner.controls.EditHijriDatePicker = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditHijriDatePicker.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }
                $("input#"+this.valContId).hijriDatePicker({
                    hijri:          this.getFieldSetting("hijri"),
                    showSwitcher:   this.getFieldSetting("showSwitcher"), // show switch Gregorian/Hijri dates button 
                    viewMode:       this.getFieldSetting("viewMode"), //  "years","months", "days"
                    format:         this.getFieldSetting("format"),  // Gregorian "D/M/YYYY" 
                    hijriFormat:    this.getFieldSetting("hijriFormat"), // hijri format
                    locale:         this.getFieldSetting("locale"),  // Default "ar-sa"
                    minDate:        this.getFieldSetting("minDate"), // Default 1950-01-01
                    maxDate:        this.getFieldSetting("maxDate"), // Default 2070-01-01
                    useCurrent:     this.getFieldSetting("useCurrent"),   // User date now
                    viewDate:       this.getFieldSetting("viewDate"), // date situation
                    showClear:      this.getFieldSetting("showClear"),  // show clear dates button 
                    showClose:      this.getFieldSetting("showClose"),   // show close button 
                    showTodayButton:this.getFieldSetting("showTodayButton"), // show today button           
                    icons: {
                        previous:   this.getFieldSetting("iconPrevious"),
                        next:       this.getFieldSetting("iconNext"),
                        today:      this.getFieldSetting("iconToday"),
                        clear:      this.getFieldSetting("iconClear"),
                        close:      this.getFieldSetting("iconClose")
                        }, 
                    showSwitcher:   this.getFieldSetting("showSwitcher"),    
                    hijriText:      this.getFieldSetting("hijriText"),
                    gregorianText:  this.getFieldSetting("gregorianText")
                });               
                
	}, 
        /*
	_onBegin: function(){
               
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	}, */
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())];
	}
});

Runner.controls.constants["EditHijriDatePicker"] = "EditHijriDatePicker";
