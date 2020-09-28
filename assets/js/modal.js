function showSuccess(message = '')
{
	_showModal('#success-modal', message, 4000);
}

function showError(message = '')
{
	_showModal('#error-modal', message,  7000);
}

function _showModal(id, message = '', speed)
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
	}, speed);
}