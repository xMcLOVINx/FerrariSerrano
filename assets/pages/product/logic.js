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

	sProfitR 		= $('#resultado'),

	sProfitP 		= $('#lucro'),

	sResult 		= $('#resultado'),

	sMarkup 		= $('#markup'),



	sTiePriceO 			= 0,

	sSalePriceO 	= 0,

	sProfitPO 		= 0;



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

	// LISTEN SIMULATION INDICES AND RE-CALC CMV

	// ===========================================



	$('#preco-compra, #comissao-real, #resultado')

	.on('keyup', function () {

		sTiePrice.val(calcTiePrice());

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

			},

			'preco-venda': {

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

			sProfitP.val('0').trigger('input');

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



		if (unmask(sSalePrice) == 0) {

			console.log('init');

			sTiePrice.val(calcTiePrice());console.log(sTiePrice.val());

			sMarkup.val(calcMarkup());console.log(sTiePrice.val());

			sSalePrice.val(calcSalePrice());console.log(sSalePrice.val());



			sSalePriceO = unmask(sSalePrice);

			sTiePriceO = unmask(sTiePrice);

			sProfitPO = unmask(sProfitP);

		} else {

			var calculed = false;



			if (

				(unmask(sSalePrice) == calcSalePrice()) ||

				(unmask(sSalePrice) == sSalePriceO)

			) {

				if (

					(unmask(sTiePrice) !== sTiePriceO) ||

					(unmask(sProfitR) !== sProfitPO)

				) { // CALC 1

					console.log('calc 1');

					sTiePrice.val(calcTiePrice());console.log(sTiePrice.val());

					sMarkup.val(calcMarkup());console.log(sMarkup.val());

					sSalePrice.val(calcSalePrice());console.log(sSalePrice.val());



					var _taxesR = calcTaxesR();console.log(_taxesR);

					var _costsR = calcCostsR();console.log(_costsR);

					var _comissionR = calcCommissionR();console.log(_comissionR);



					var _profitR = excelRound(unmask(sSalePrice) * (unmask(sProfitP) / 100));



					calculed = true;

					sSalePriceO = unmask(sSalePrice);

					sTiePriceO = unmask(sTiePrice);

					sProfitPO = unmask(sProfitP);

				}

			}



			if (!calculed) { // CALC 2

				console.log('calc 1');

				var _taxesR = calcTaxesR();console.log(_taxesR);

				var _costsR = calcCostsR();console.log(_costsR);



				if (unmask(sCommissionR) > 0) {

					var _comissionR = unmask(sCommissionR);

				} else {

					var _comissionR = calcCommissionR();

				}



				console.log(_comissionR);



				var _profitR = excelRound(Number(

					unmask(sSalePrice) - Number(

						(unmask(sPurchasePrice)) + 

						(Number(_taxesR)) + (Number(_costsR)) + 

						(Number(_comissionR))

					)

				));



				sProfitR.val(_profitR);

				sProfitP.val(calcProfitP(_profitR));

			}

		}



		//==================



		var progressBars = ".bit-progress div.progress-bar"

		var barPercent = (unmask(sProfitP) > 0) ? 100 : 100 - unmask(sProfitP) * -1;

		var percents = [];



		$(progressBars + ' div').html('0%');

		$(progressBars).css('width', '0%');



		if (unmask(sProfitP) < -100) {

			$(progressBars + ' div').last().html(unmask(sProfitP) + '%');



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



		$(progressBars + ' div').first().html(unmask(sProfitP) + '%');

		$(progressBars).first().css('width',

			((unmask(sProfitP) > 100) ? 100 : unmask(sProfitP)) + '%'

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

		unmask(sPurchasePrice) / (calcMarkup() + (unmask(sProfitP) / 100))

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



		sProfitR.val(profitR.val());

		sProfitP.val(profitP.val());



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

	sResult.val('');



	sCommissionP.val(commissionP.val());

	sCommissionR.val(commissionR.val());



	sProfitR.val(profitR.val());

	sProfitP.val(profitP.val());

}