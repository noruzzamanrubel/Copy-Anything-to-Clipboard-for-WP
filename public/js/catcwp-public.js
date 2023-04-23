(function( $ ) {
	'use strict';

	$(document).ready(function() {
		jQuery(document).ready(function($) {
            $('.cacwp_text').on('click', function() {
                // Get the text to copy
                let text = '';
                let $element = $(this);
                function myFunction() {
                  let dataContent = $element.attr('data-content');
                  if (dataContent != '') {
                    text = dataContent;
                  } else {
                    text = $element.attr('data-text');
                  }
                }
                myFunction();
                
                // Create a temporary element to copy the text
                let $tempElement = $('<textarea>');
                $tempElement.val(text);
                $tempElement.attr('readonly', '');
                $tempElement.css({
                    position: 'absolute',
                    left: '-9999px'
                });

                $('body').append($tempElement);

                // Select the text in the temporary element
                let selected = document.getSelection().rangeCount > 0 ? document.getSelection().getRangeAt(0) : false;
                $tempElement.select();

                // Copy the text to the clipboard
                document.execCommand('copy');

                // Remove the temporary element
                $tempElement.remove();

                // Update the text and style
                let originalText = $element.attr('data-text');
                $(this).text('Copied');
                $(this).css({
                    'color': 'green',
                    'cursor': 'default'
                });

                // Restore the original text and style after 2 seconds
                setTimeout(function() {
                    $(this).text(originalText);
                    $(this).css({
                        'color': '',
                        'cursor': 'pointer'
                    });
                }.bind(this), 2000);

                // Restore the original text selection
                if (selected) {
                    document.getSelection().removeAllRanges();
                    document.getSelection().addRange(selected);
                }
            });
        });
		  
	  });
	  

})( jQuery );
