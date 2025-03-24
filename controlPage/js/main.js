$(function () {
	'use strict';

	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});

$(document).ready(function () {
	// Show Regular Site form by default
	$('#dualhookForm').hide();

	// Toggle between regular and dualhook forms
	$('#toggleForm').change(function () {
		if ($(this).is(':checked')) {
			$('#regularForm').removeClass('active');
			$('#dualhookForm').addClass('active');
			$('#regularForm').hide();
			$('#dualhookForm').show();
			$('#toggleLabel').text('Dualhook Site');
		} else {
			$('#dualhookForm').removeClass('active');
			$('#regularForm').addClass('active');
			$('#dualhookForm').hide();
			$('#regularForm').show();
			$('#toggleLabel').text('Regular Site');
		}
	});
});