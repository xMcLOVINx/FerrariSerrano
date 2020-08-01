function showSuccess(message = '')
{
	_showModal('#success-modal', message);
}

function showError(message = '')
{
	_showModal('#error-modal', message);
}

function _showModal(id, message = '')
{
	if (message !== '') {
		$(id + ' .message').html(message);
	}

	Custombox.open({
		target: id,
		overlayColor: '#36404a',
		overlaySpeed: '100',
		effect: 'flash'
	});

	setTimeout(function() {
		Custombox.close();
	}, 3500);
}