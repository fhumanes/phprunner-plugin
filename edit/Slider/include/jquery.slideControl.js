/*
 * slideControl - jQuery Plugin
 * version: 1.2 October 2012
 * @requires jQuery v1.6 or later
 *
 * Examples at http://nikorablin.com/slideControl
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 */
(function($){
	 $.fn.slideControl = function(options) {
		
		// defaults
		var defaults = {
			speed: 400,
			lowerBound: 1,
			upperBound: 10,
			decimals: 0
		};

		var options = $.extend(defaults, options);
		
		return this.each(function() {
			
			// set vars
			var o = options;
			var controller = false;
			var position = 0;
			var obj = this;
			$(this).addClass('slideControlInput');
			var parent = $(this).parent();
			var label = $(parent).find('label');
			var val = $(obj).val();
			if (!val || val<o.lowerBound)
				val = o.lowerBound;
			if (val>o.upperBound)
				val=o.upperBound;
			$(obj).val(val);
			var input = parent.find('input');
			var span=$("<span class=\"slideControlContainer\"><span class=\"slideControlFill\" ><span class=\"slideControlHandle\"></span></span></span>");
			span.insertBefore(input);
			var container = parent.find('.slideControlContainer');
			var fill = container.find('.slideControlFill');
			var handle = fill.find('.slideControlHandle');
			var containerWidth = container.outerWidth() + 1;
			var handleWidth = $(handle).outerWidth();
			var offset = $(container).offset();
			
			$(fill).width((val-options.lowerBound)*100/(options.upperBound-options.lowerBound) + "%");
			
			$(window).resize(function() {
				offset = $(container).offset();
			})
			
			//adds shadow class to handle for IE <9
			if (getInternetExplorerVersion() < 9 && getInternetExplorerVersion() > -1) {
				handle.addClass('ieShadow');
			}
			
			// when user clicks anywhere on the slider
			$(container).click(function(e) {		
				e.preventDefault();
				position = checkBoundaries(Math.round(((e.pageX - offset.left )/containerWidth)*100));
				
				$(fill).animate({
					width: position + "%"
				}, o.speed);
				$(input).val(getDisplayValue(position));
			});
			
			// when user clicks handle
			$(handle).mousedown(function(e) {
				e.preventDefault();
				controller = true;
				$(document).mousemove(function(e) {
					e.preventDefault();
					position = checkBoundaries(Math.round(((e.pageX - offset.left)/containerWidth)*100));
					if (controller) {	
						$(fill).width(position + "%");
						$(input).val(getDisplayValue(position));
					}
				});
				$(document).mouseup(function() {
					e.preventDefault();
					controller = false;
				});
			});
			
			// when user changes value in input
			$(input).change(function() {
				var value = checkBoundaries(($(this).val()-options.lowerBound)*100/(options.upperBound-options.lowerBound));
				if ($(this).val() > o.upperBound)
					$(input).val(o.upperBound);
				else if ($(this).val() < o.lowerBound)
					$(input).val(o.lowerBound);
				$(fill).width(value + "%");
			});
			
		});
		
		
		function getDisplayValue(position) {
		
			var p=options.lowerBound + position*(options.upperBound-options.lowerBound)/100;
			if (options.decimals==0)
				p=Math.round(p);
			
			return p;
		}
		// checks if value is within boundaries
		function checkBoundaries(value) {
			if (value < 0)
				return 0;
			else if (value > 100 )
				return 100;
			else
				return value;
		}
		
		// checks ie version
		function getInternetExplorerVersion(){
		   var rv = -1;
		   if (navigator.appName == 'Microsoft Internet Explorer') {
			  var ua = navigator.userAgent;
			  var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			  if (re.exec(ua) != null)
				 rv = parseFloat( RegExp.$1 );
		   }
		   return rv;
		}
		return this;
	 }
})(jQuery);