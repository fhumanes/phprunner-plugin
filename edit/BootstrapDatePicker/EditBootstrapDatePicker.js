function stringToDate(_date,_format,_delimiter) // Transform date structure
{
            var formatLowerCase=_format.toLowerCase();
            var formatItems=formatLowerCase.split(_delimiter);
            var dateItems=_date.split(_delimiter);
            var monthIndex=formatItems.indexOf("mm");
            var dayIndex=formatItems.indexOf("dd");
            var yearIndex=formatItems.indexOf("yyyy");
            var month=parseInt(dateItems[monthIndex]);
            month-=1;
			var day=parseInt(dateItems[dayIndex]);
			// day +=1;
			// console.log('function_1_: '+dateItems[yearIndex]+'-'+month+'-'+day);
            var formatedDate = new Date(dateItems[yearIndex],month,day,12);
			// console.log('function_2_: '+formatedDate);
            return formatedDate.toISOString().split('T')[0];
}
function countSpecial(str, find) 			// count number the times is a character in string
{
    return (str.split(find)).length - 1;
}

Runner.controls.EditBootstrapDatePicker = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditBootstrapDatePicker.superclass.constructor.call(this, cfg);
		var options = {};
		var $this = this;
		// console.log('Se inicia Boostrap Data Picker');

		if ($this.getFieldSetting('required')) $this.addValidation('IsRequired');

		options.format = $this.getFieldSetting('format');
		options.weekStart = $this.getFieldSetting('weekStart');
		if($this.getFieldSetting('startDate') != '' ) options.startDate = $this.getFieldSetting('startDate');
		if($this.getFieldSetting('endDate') != '' ) options.endDate = $this.getFieldSetting('endDate');
		options.todayBtn = $this.getFieldSetting('todayBtn');
		options.clearBtn = $this.getFieldSetting('clearBtn');
		options.daysOfWeekDisabled = $this.getFieldSetting('daysOfWeekDisabled');
		options.daysOfWeekHighlighted = $this.getFieldSetting('daysOfWeekHighlighted');
		options.calendarWeeks = $this.getFieldSetting('calendarWeeks');
		options.autoclose = $this.getFieldSetting('autoclose');
		options.todayHighlight = $this.getFieldSetting('todayHighlight');
		options.language = $this.getFieldSetting('language');
		options.maxViewMode = 2;
		if($this.getFieldSetting('datesDisabled') != '' ) options.datesDisabled = $this.getFieldSetting('datesDisabled');
		// console.log('Boostrap Data Picker, option: '+options);

		$('#'+$this.valContId).datepicker(options);
		
	},      
	_onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		var cloneDate = this.getValue();
		
		if (cloneDate == '') { 				// No Value?
			var dateClone = null;
		} else {
			var format = this.getFieldSetting('format');
			var delimiter = '/';
			if (countSpecial(format, '-')) delimiter = '-';
			var dateClone = stringToDate(cloneDate,format,delimiter);
			// console.log('Valor traducido: '+ dateClone);
		}

		return [this.valueElem.clone().val(dateClone)];

		// return [this.valueElem.clone().val(this.getValue())];
	}
});

Runner.controls.constants["EditBootstrapDatePicker"] = "EditBootstrapDatePicker";
