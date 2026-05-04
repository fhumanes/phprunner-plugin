Runner.viewControls.ViewCountdown = Runner.extend(Runner.viewControls.ViewControl,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	jsParams : new Array(),
	constructor: function(cfg){	
		// call parent
		Runner.viewControls.ViewCountdown.superclass.constructor.call(this, cfg);
	},
	
	init: function(){
	
		var current =  this;
		
		$("span[id^='countdown_']").each(function(){
				
				var options = {
							format: current.format, 
							layout: current.layout,
							compact: current.compact,
							significant: current.significant,
							description: current.description		
				}
				
				if(current.until_or_since == 'until')
				{
					options.until = new Date($(this).attr('y'),
											parseInt($(this).attr('m')) - 1,
											$(this).attr('d'),
											$(this).attr('h'),
											$(this).attr('i'),
											$(this).attr('s'));
				}
				else
				{
					options.since = new Date($(this).attr('y'),
											parseInt($(this).attr('m')) - 1,
											$(this).attr('d'),
											$(this).attr('h'),
											$(this).attr('i'),
											$(this).attr('s'));
				}
				
				if(current.override_labels)
				{
					options.labels = current.labels;
					options.labels1 = current.labels1;
					options.compactLabels = current.compactLabels;
					options.digits = current.digits;
					options.timeSeparator = current.timeSeparator;
					options.isRTL = current.isRTL;
				}

				$(this).countdown('destroy').countdown(options);
		});
	}
});