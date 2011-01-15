;
(function($) {

    $.extend($.fn, {
        multiNumberEntry: function( options ) {
            var delimiterString=" or ";
			if(options['delimiter'])
			 	delimiterString=options['delimiter']

            $(this).each(function() {
                $(this).keypress(function (e) {
                    v=$(this).val();
                    if(e.which == 9 || e.which == 13)  return true; // Tab or Enter

                    if( e.which == 8)  // Backspace
                    {
                        if(v.length == 0) return true;
                        lastLetter=v.charCodeAt(v.length-1)
                        if( ! (lastLetter >= 48 && lastLetter <= 57) )
                        {
                            var i;
                            for(i=v.length-1; i > 0; i--)
                                if(v.charCodeAt(i) >= 48 && v.charCodeAt(i) <= 57) break;

                            $(this).val(v.substring(0,i+1));
                            e.preventDefault();
                            return true;
                        }
                    }
                    else {
                        if (! (e.which >= 32 && e.which <= 127)) // Extended keypress - leave it to the browser.
                            return true;

                        // User pressed something other than a number. Interpret it as the next 'or''
                        if( ! (e.which >= 48 && e.which <= 57) ) {

                            // See if the last stretch of the text is already our delimiter. If it is, do nothing.
                            lastLetters=v.substr(v.length-delimiterString.length, delimiterString.length)
                            if(lastLetters != delimiterString) $(this).val(jQuery.trim(v)+delimiterString);

                            e.preventDefault();
                            return false;
                        }
                    }
                });

                // Validate and correct the text to obey our delimiter stuff.
                $(this).blur(function() {
                    var v=$(this).val().split(delimiterString);
                    var validated=[];
                    var i=0;
                    for(i=0; i < v.length; i++) {
                        num=v[i];
                        num=parseInt(num.trim(),10)
                        if(!isNaN(num)) validated.push(num+ '');
                    }
                    $(this).val(validated.join(delimiterString))
                });
            })
        }
    })
})(jQuery);