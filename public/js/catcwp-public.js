(function( $ ) {
	'use strict';

	$(document).ready(function() {
		$('#cacwp_btn').on('click', function() {
		  // Get the text to copy
		  let text = $('#cacwp_text').text();
	  
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
	  
		  // Update the button text and style
		  $('#cacwp_btn').text('Copied');
		  $('#cacwp_btn').css('background-color', 'green');
	  
		  // Remove the "Copied" text and style after 2 seconds
		  setTimeout(function() {
			$('#cacwp_btn').text('Copy');
			$('#cacwp_btn').css('background-color', '');
		  }, 2000);
	  
		  // Restore the original text selection
		  if (selected) {
			document.getSelection().removeAllRanges();
			document.getSelection().addRange(selected);
		  }
		});
	  });
	  

})( jQuery );
