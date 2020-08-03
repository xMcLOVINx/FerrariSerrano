var m_update = false;
var m_id = 0;

// ===========================================
// DEFINE INDICE FIELDs
// ===========================================
var
	billing 		= $('#i-faturamento'),
	taxesR 			= $('#i-impostos-real'),
	taxesP 			= $('#i-impostos-percent'),
	commissionR 	= $('#i-comissao-real'),
	commissionP 	= $('#i-comissao-percent'),
	costsR 			= $('#i-custos-real'),
	costsP 			= $('#i-custos-percent'),
	profitR 		= $('#i-lucro-real'),
	profitP 		= $('#i-lucro-percent');

// ===========================================
// DEFINE SIMULATION FIELDs
// ===========================================
var
	sProduct 		= $('#produto'),
	sPurchasePrice 	= $('#preco-compra'),
	sTiePrice 		= $('#preco-empate'),
	sCommissionR 	= $('#comissao-real'),
	sCommissionP 	= $('#comissao-percent'),
	sSalePrice 		= $('#preco-venda'),
	sProfitR 		= $('#lucro-real'),
	sProfitP 		= $('#lucro-percent'),
	sMarkup 		= $('#markup'),

	sIsTheFirst		= true,
	sTiePriceO 		= 0,
	sSalePriceO 	= 0,
	sProfitPO 		= 0

// ===========================================
// CONTEXT
// ===========================================
jQuery(document).ready(function()
{
	// ===========================================
	// DISABLE ENTER KEYBOARD
	// ===========================================
	$('form').on('keyup keypress', function(e)
	{
		var keyCode = e.keyCode || e.which;

		if (keyCode === 13) { 
			e.preventDefault();

			return false;
		}
	});

	// ===========================================
	// CREATE A NEW RULE
	// ===========================================
	$.validator.addMethod('greaterThanZero', function(value, element) {
		return parseFloat(value.replace(',','')) > 0;
	}, 'Por favor, insira um valor maior que 0.');

	// ===========================================
	// ADD VALIDATION IN INDICES FORM
	// ===========================================
	$('form#indices').validate({
		rules: {
			'i-faturamento': {
				greaterThanZero: true
			},
			'i-custos-real': {
				greaterThanZero: true
			}
		}
	});

	// ===========================================
	// CLEAN FIELDS IF THE BILLING AMOUNT CHANGES
	// ===========================================
	billing.on('keyup', function() {
		taxesR.val('');
		taxesP.val('');
		commissionR.val('');
		commissionP.val('');
		costsR.val('');
		costsP.val('');
	});

	// ===========================================
	// LISTEN SIMILAR INDICES AND VALIDATE THEM
	// ===========================================
	$('.i-taxes, .i-costs, .s-costs').on('keyup', function() {
		var field = $(this).hasClass('i-taxes')
		? '.i-taxes' : $(this).hasClass('i-costs')
		? '.i-costs' : '.s-costs'
		;

		if (billing.val().length <= 0) {
			showError('O campo faturamento deve ser maior que zero!');

			return false;
		}

		if ($(this).val().length <= 3) {
			return false;
		}

		switch ($(this).data('similar')) {
			case 'percents':
				var element = $(field + '[data-similar="money"]');
				var result = (unmask($(this)) * 100 / unmask(billing)).toFixed(2);
				var resultLength = result.replace(/[^\d]+/g,'');

				if (resultLength.length <= 4) {
					element.val(result);

					break;
				} else {
					return false;
				}

			case 'money':
				var element = $(field + '[data-similar="percents"]');

				element.val((unmask(billing) * unmask($(this)) / 100).toFixed(2));

				break;
		}

		element.trigger('input').valid();
	});

	// ===========================================
	// RESET IF AN INPUT IN INDICES IS CHANGED
	// ===========================================
	$('form#indices input').on('keyup', function () {
		resetValues();
	});

	// ===========================================
	// UPDATE THE INDICES IN THE CUSTOMER DATABASE
	// ===========================================
	$(document).on('click', '#atualizar-indices', function()
	{
		if (!$('form#indices').valid()) {
			return false;
		}

		$.ajax({
			url: base_url + '/client/index/store',
			type: 'post',
			dataType:'json',
			data: $('form#indices').serialize(),
			success: function(data) {
				if (data.success) {
					execStep2();

					return showSuccess();
				}

				return showError();
			}
		});
	});

	// ===========================================
	// PREVENT NULL VALUES ON FOCUSOUT
	// ===========================================
	$('#preco-compra, #comissao-real, #comissao-percent, #lucro-real, #lucro-percent').focusout(function()
	{
		if ($(this).val() == "") {
			$(this).val('0.00');

			sTiePrice.val(calcTiePrice());
			sSalePrice.val('');
		}
	});

	// ===========================================
	// LISTEN SIMULATION INDICES AND RE-CALC TIE PRICE
	// ===========================================
	$('#preco-compra, #comissao-real, #comissao-percent, #lucro-real, #lucro-percent')
	.on('keyup', function () {
		sTiePrice.val(calcTiePrice());
		sSalePrice.val('');
	});

	// ===========================================
	// ADD VALIDATION IN SIMULATION FORM
	// ===========================================
	$('form#simulacao').validate({
		rules: {
			'preco-compra': {
				greaterThanZero: true
			},
			'custos-real': {
				greaterThanZero: true
			}
		}
	});

	// ===========================================
	// CREATES PRODUCT PRICE SIMULATION
	// ===========================================
	$('#simular').on('click', function ()
	{
		if (unmask(sProfitP) <= 0 || sProfitP.val() == "") {
			sProfitP.val('0.00').trigger('input');
		}

		if (!$('form#simulacao').valid()) {
			return false;
		}

		$(this).text('RECALCULAR');

		$('#salvar').attr('disabled', false);

		return simulatePrice();
	});

	function simulatePrice()
	{
		$('.step-3').removeClass('hidden');

		//==================

		if (sIsTheFirst == true) {
			sTiePrice.val(calcTiePrice());
			sMarkup.val(calcMarkup());
			sSalePrice.val(calcSalePrice());

			sSalePriceO = unmask(sSalePrice);
			sTiePriceO = unmask(sTiePrice);

			sIsTheFirst = false;
		} else {
			var calculed = false;

			if (
				(sMarkup.val(calcMarkup())) &&
				(unmask(sSalePrice) == calcSalePrice()) ||
				(unmask(sSalePrice) == sSalePriceO) ||
				(sSalePrice.val() == "")
			) {
				if (
					(unmask(sProfitR) > 0) ||
					(unmask(sProfitP) > 0) ||
					(unmask(sTiePrice) !== sTiePriceO)
				) { // CALC 1
					sTiePrice.val(calcTiePrice());
					sMarkup.val(calcMarkup());
					sSalePrice.val(
						excelRound(Number(
							calcSalePrice()) +
							(unmask(sCommissionR) + unmask(sProfitR)
						)).toFixed(2)
					);

					calculed = true;

					sSalePriceO = unmask(sSalePrice);
					sTiePriceO = unmask(sTiePrice);
					sProfitPO = unmask(sProfitP);
				}
			}

			if (!calculed) { // CALC 2
				sMarkup.val(calcMarkup());

				if (unmask(sSalePrice) == 0 || sSalePrice.val() == "") {
					sSalePrice.val(calcSalePrice());
				}

				var _taxesR = calcTaxesR();
				var _costsR = calcCostsR();

				if (unmask(sCommissionR) > 0) {
					var _comissionR = unmask(sCommissionR);
				} else {
					var _comissionR = calcCommissionR();
				}

				var _profitR = excelRound(Number(
					unmask(sSalePrice) - Number(
						(unmask(sPurchasePrice)) + 
						(Number(_taxesR)) + (Number(_costsR)) + 
						(Number(_comissionR))
					)
				));

				sProfitR.val(_profitR.toFixed(2));
				sProfitP.val(calcProfitP(_profitR).toFixed(2));
			}
		}

		//==================

		if (unmask(sProfitR) > 0) {
			var profitPercent = excelRound(Number(
				100 * unmask(sProfitR) / unmask(sPurchasePrice)
			)).toFixed(2);
		} else {
			var profitPercent = unmask(sProfitP);
		}

		var progressBars = ".bit-progress div.progress-bar"
		var barPercent = (profitPercent > 0) ? 100 : 100 - profitPercent * -1;
		var percents = [];

		$(progressBars + ' div').html('0%');
		$(progressBars).css('width', '0%');

		if (profitPercent < -100) {
			$(progressBars + ' div').last().html(profitPercent + '%');

			return;
		}

		for (var i = ($(progressBars).length - 1); i >= 0; i--) {
			var sub = 100 / ($(progressBars).length - 1);
			var element = $(progressBars).eq(i);
			var elementChild = $(progressBars + ' div').eq(i);

			if (barPercent > sub) {
				var percent = (sub * ($(progressBars).length - 1)).toFixed(2) + "%";

				element.css('width', percent);
				elementChild.html(percent);
			} else {
				var percent = (barPercent * ($(progressBars).length - 1)).toFixed(2);

				element.css('width', ((percent >= 0) ? percent : 0) + '%');
				elementChild.html(((percent >= 0) ? percent : 0) + '%');
			}

			barPercent -= sub;
		}

		$(progressBars + ' div').first().html(profitPercent + '%');
		$(progressBars).first().css('width',
			((profitPercent > 100) ? 100 : profitPercent) + '%'
		);
	}

	// ===========================================
	// UPDATE THE INDICES IN THE CUSTOMER DATABASE
	// ===========================================
	$(document).on('click', '#salvar', function()
	{
		if (!$('form#simulacao').valid()) {
			return false;
		}

		if (!m_update) {
			var _url = base_url + "/client/simulation/store";
		} else {
			var _url = base_url + "/client/simulation/update/" + m_id;
		}

		$.ajax({
			url: _url,
			type: 'post',
			dataType:'json',
			data: $('form').serialize(),
			success: function(data) {
				if (data.success) {
					return showSuccess();
				}

				return showError();
			}
		});
	});

	// ===========================================
	// RESET VALUES FROM FORM
	// ===========================================
	$(document).on('click', '#resetar', function()
	{
		$('.step-3').addClass('hidden');
		$('#simular').text('CALCULAR');

		resetValues();
	});
});

// ===========================================
// SUPPLIER FUNCTIONS
// ===========================================
function unmask(item) {
	return Number(item.val().replace(/[^\d|\.\-]+/g,''));
}
function excelRound(number) {
    return Math.floor((Math.pow(10, 2)*number)+0.5)*Math.pow(10, -2);
};
function calcTiePrice() {
	return excelRound(
		(unmask(sPurchasePrice) / (calcMarkup() + (unmask(sProfitP) / 100))) +
		(unmask(sCommissionR) + unmask(sProfitR))
	).toFixed(2);
}
function calcMarkup() {
	return Number(1 - (
		(unmask(taxesP) / 100) + (unmask(costsP) / 100) +
		(unmask(sCommissionR) <= 0 ? (unmask(sCommissionP) / 100) : 0) +
		(unmask(sProfitR) <= 0 ? (unmask(sProfitP) / 100) : 0)
	));
}
function calcSalePrice() {
	return excelRound(unmask(sPurchasePrice) / (unmask(sMarkup))).toFixed(2);
}
function calcCommissionR() {
	return excelRound((unmask(sSalePrice) * unmask(sCommissionP)) / 100);
}
function calcTaxesR() {
	return excelRound((unmask(sSalePrice) * unmask(taxesP)) / 100);
}
function calcCostsR() {
	return excelRound((unmask(sSalePrice) * unmask(costsP)) / 100);
}
function calcProfitP(profitR) {
	return excelRound(profitR / (unmask(sSalePrice)) * 100);
}

// ===========================================
// FUNCTIONS TO EXECUTE THE STEPS
// ===========================================
function execStep2(update = false, id = 0) {
	$('.tab2').removeClass('hidden');
	$('a[href="#tab2"]').trigger('click');
	$('html, body').animate({scrollTop: 0}, 'slow');

	m_update = update;
	m_id = id;

	if (!update) {
		sCommissionP.val(commissionP.val());
		sCommissionR.val(commissionR.val());

		sProfitR.val(unmask(profitR).toFixed(2));
		sProfitP.val(unmask(profitP).toFixed(2));

		sPurchasePrice.val('');
		sTiePrice.val('');

		return;
	}

	return calcTiePrice();
}

function resetValues() {
	sProduct.val('');
	sPurchasePrice.val('');
	sTiePrice.val('');

	sCommissionP.val(commissionP.val());
	sCommissionR.val(commissionR.val());

	sProfitR.val(profitR.val());
	sProfitP.val(profitP.val());
}