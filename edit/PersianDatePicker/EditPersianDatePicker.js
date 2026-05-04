
Runner.controls.EditPersianDatePicker = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditPersianDatePicker.superclass.constructor.call(this, cfg);
		var options = {};
		var $this = this;

		if ($this.getFieldSetting('required')) $this.addValidation('IsRequired');
/*
$this->settings["required"] = false;                            // Wether is mandatory
$this->settings["onlySelectOnDate"] = true;                     // if true date select just by click on day in month grid, and when user select month or year selected date doesnt change
$this->settings["onlyTimePicker"] = false;                      // if true all pickers hide and just show timepicker
$this->settings["format"] = 'YYYY-MM-DD HH:mm:ss';              // Format of presentation of the date Read: http://babakhani.github.io/PersianWebToolkit/doc/persian-date/#format
$this->settings["minDate"] = 0;                                 // Set min date on datepicker, prevent user select date before given unix time
$this->settings["maxDate"] = 9999999999999;                     // Set max date on datepicker, prevent user select date after given unix time
$this->settings["autoClose"] = true;                            // If true datepicker close When select a date
$this->settings["btnNextText"] = "< +";                         // text of next button
$this->settings["btnPrevText"] = "- >";                         // text of prev button
$this->settings["timePicker_enabled"] = false;                  // make timePicker enable or disable
*/
        $('#'+$this.valContId+"_alter").attr('readonly', true);  // input ReadOnly
        $('#imgCal_'+$this.valContId).on( "click", function() {  // clear date
            $('#'+$this.valContId+"_alter").val('');
            $('#'+$this.valContId).val('');
        });
		$('#'+$this.valContId+"_alter").pDatepicker(
			{
                "inline": false,
                "format": this.getFieldSetting("format"),
                "viewMode": "day",
                "initialValue": true,
                "initialValueType": 'gregorian',
                "autoClose": true,
                "minDate": this.getFieldSetting("minDate"),
                "maxDate": this.getFieldSetting("maxDate"),
                "autoClose": this.getFieldSetting("autoClose"),
                "position": "auto",
                "altFieldFormatter": function(unix){
                    var date = new Date(unix);
                    var date2 =  date.getFullYear()+
                            "-"+(date.getMonth()+1)+
                            "-"+date.getDate()+
                            " "+date.getHours()+
                            ":"+date.getMinutes()+
                            ":"+date.getSeconds();
                    var unix2 = Math.trunc(unix/1000);

                    return unix2;
                },
                "altField": '#'+$this.valContId,
                "onlyTimePicker": this.getFieldSetting("onlyTimePicker"),
                "onlySelectOnDate": this.getFieldSetting("onlySelectOnDate"),
                "calendarType": "persian",
                "inputDelay": 800,
                "observer": true,
                "calendar": {
                    "persian": {
                        "locale": "fa",
                        "showHint": true,
                        "leapYearMode": "algorithmic"
                    },
                    "gregorian": {
                        "locale": "en",
                        "showHint": true
                    }
                },
                "navigator": {
                    "enabled": true,
                    "scroll": {
                        "enabled": true
                    },
                    "text": {
                        "btnNextText": this.getFieldSetting("btnNextText"),
                        "btnPrevText": this.getFieldSetting("btnPrevText")
                    }
                },
                "toolbox": {
                    "enabled": true,
                    "calendarSwitch": {
                        "enabled": true,
                        "format": "MMMM"
                    },
                    "todayButton": {
                        "enabled": true,
                        "text": {
                            "fa": "امروز",
                            "en": "Today"
                        }
                    },
                    "submitButton": {
                        "enabled": true,
                        "text": {
                            "fa": "تایید",
                            "en": "Ok"
                        }
                    },
                    "text": {
                        "btnToday": "امروز"
                    }
                },
                "timePicker": {
                    "enabled": this.getFieldSetting("timePicker_enabled"),
                    "step": 1,
                    "hour": {
                        "enabled": true,
                        "step": null
                    },
                    "minute": {
                        "enabled": true,
                        "step": null
                    },
                    "second": {
                        "enabled": true,
                        "step": null
                    },
                    "meridian": {
                        "enabled": false
                    }
                },
                "dayPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY MMMM"
                },
                "monthPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY"
                },
                "yearPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY"
                }

            }
		);
		
	},      
	_onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())];
	}
});

Runner.controls.constants["EditPersianDatePicker"] = "EditPersianDatePicker";
