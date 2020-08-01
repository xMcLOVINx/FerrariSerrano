var calculo_element =
    '<div class="row m-t-10">'+
        '<div class="col-md-12">'+
            '<div class="row">'+
                '<div class="col-md-6 m-t-10">'+
                    '<label class="control-label" for="muv">'+
                        'M.U.V'+
                    '</label>'+

                    '<input id="muv" name="muv" type="text" class="form-control percents" disabled />'+
                '</div>'+

                '<div class="col-md-6 m-t-10">'+
                    '<label class="control-label" for="venda">'+
                        'Preço Venda *'+
                    '</label>'+

                    '<input id="venda" name="venda" inputmode="decimal" pattern="[0-9]+([\.][0-9]+)?" type="text" class="form-control money" required />'+
                '</div>'+
            '</div>'+

            '<div class="row m-t-20">'+
                '<div class="col-md-12 bit-progress">'+
                    '<h3 class="progress-title">P.A</h3>'+

                    '<div class="bit progress pink">'+
                        '<div id="bar-pa" class="progress-bar" style="width:0%; background:#ff4b7d;">'+
                            '<div class="progress-value">0%</div>'+
                        '</div>'+
                    '</div>'+

                    '<h3 class="progress-title">Tributos</h3>'+

                    '<div class="bit progress green">'+
                        '<div id="bar-tributos" class="progress-bar" style="width:0%; background:#5fad56;">'+
                            '<div class="progress-value">0%</div>'+
                        '</div>'+
                    '</div>'+

                    '<h3 class="progress-title">Comissões</h3>'+

                    '<div class="bit progress yellow">'+
                        '<div id="bar-comissao" class="progress-bar" style="width:0%; background:#e8d324;">'+
                            '<div class="progress-value">0%</div>'+
                        '</div>'+
                    '</div>'+

                    '<h3 class="progress-title">C.F</h3>'+

                    '<div class="bit progress blue">'+
                        '<div id="bar-cf" class="progress-bar" style="width:0%; background:#3485ef;">'+
                            '<div class="progress-value">0%</div>'+
                        '</div>'+
                    '</div>'+

                    '<h3 class="progress-title">Lucro / Prejuizo</h3>'+

                    '<div class="bit progress red">'+
                        '<div id="bar-lucro" class="progress-bar" style="width:0%; background:#c0392b;">'+
                            '<div class="progress-value">0%</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+

            '<div class="row" style="margin-top: 40px">'+
                '<div class="col-md-4 col-md-offset-8">'+
                    '<button id="recalc" class="btn btn-primary col-xs-12" type="button" style="font-weight: bold">'+
                        'RECALCULAR <i class="fas fa-check-double"></i>'+
                    '</button>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>'
;
