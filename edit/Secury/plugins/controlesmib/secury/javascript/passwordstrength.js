(function($){
    $.fn.passwordstrength = function(options) {
        var settings = $.extend({
            'minlength': 8,
            'number'   : true,
            'capital'  : true,
            'special'  : true,
	    'bgcolor'  : '#F2F5A9',
            'labels'   : {
                'general'   : 'The password must have:',
                'minlength' : 'At least {{minlength}} characters',
                'number'    : 'At least one number',
                'capital'   : 'At least one uppercase letter',
                'special'   : 'At least one special character'
            }
        }, options);
        return this.each(function(){
            var $this = $(this); var $id = $this.attr('id');
            $('<div id="passwordstrength-wrap'+$id+'" />').insertAfter($this);
	    $('#passwordstrength-wrap'+$id).css('top',$this.position().top-5).css('left',$this.position().left+$this.width()+15);
	    $('#passwordstrength-wrap'+$id).css('background-color',settings.bgcolor);
	    $('head').append('<style>#passwordstrength-wrap'+$id+':after{border-right-color:'+settings.bgcolor+' !important;}</style>');
            $('#passwordstrength-wrap'+$id).append('<strong>'+settings.labels.general+'</strong><ul></ul>');
            if(settings.minlength > 0) $('#passwordstrength-wrap'+$id+' ul').append('<li id="length">'+settings.labels.minlength.replace('{{minlength}}', settings.minlength)+'</li>');
            if(settings.number) $('#passwordstrength-wrap'+$id+' ul').append('<li id="pnum">'+settings.labels.number+'</li>');
            if(settings.capital) $('#passwordstrength-wrap'+$id+' ul').append('<li id="capital">'+settings.labels.capital+'</li>');
            if(settings.special) $('#passwordstrength-wrap'+$id+' ul').append('<li id="spchar">'+settings.labels.special+'</li>');
            $this.on('focus keyup', function() {
                var value = $this.val();
		if(value=='') {
			$('#passwordstrength-wrap'+$id+' #length').removeClass('valid');
			$('#passwordstrength-wrap'+$id+' #pnum').removeClass('valid');
			$('#passwordstrength-wrap'+$id+' #capital').removeClass('valid');
			$('#passwordstrength-wrap'+$id+' #spchar').removeClass('valid');
		}
                $('#passwordstrength-wrap'+$id).fadeIn(400);
                if(value.length > 0){ // Password length
                    if (value.length >= settings.minlength) $('#passwordstrength-wrap'+$id+' #length').addClass('valid');
                    else $('#passwordstrength-wrap'+$id+' #length').removeClass('valid');
                }
                if(settings.number) { // At least 1 digit
                    if (value.match(/\d/)) $('#passwordstrength-wrap'+$id+' #pnum').addClass('valid');
                    else $('#passwordstrength-wrap'+$id+' #pnum').removeClass('valid');
		}
                if(settings.capital) { // At least 1 capital
                    if (value.match(/[A-Z]/)) $('#passwordstrength-wrap'+$id+' #capital').addClass('valid');
                    else $('#passwordstrength-wrap'+$id+' #capital').removeClass('valid');
                }
                if(settings.special) { // At least 1 special character
                    if (value.match(/[^\w]/)) $('#passwordstrength-wrap'+$id+' #spchar').addClass('valid');
                    else $('#passwordstrength-wrap'+$id+' #spchar').removeClass('valid');
                }
            });
            $this.blur(function () {
                $('#passwordstrength-wrap'+$id).fadeOut(400);
            });
        });
    }
})(jQuery);