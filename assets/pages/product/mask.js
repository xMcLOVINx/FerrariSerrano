jQuery(document).ready(function()
{
	$('.money').mask(
		'#,##0.00', {
			reverse: true,
			placeholder: "0.00",
			clearIfNotMatch: true
		}
	);

	$('.percents').mask(
		'#0.00', {
			reverse: true,
			placeholder: "0.00",
			clearIfNotMatch: true
		}
	);

	// ================

	$('input').focus();

	// ================
});