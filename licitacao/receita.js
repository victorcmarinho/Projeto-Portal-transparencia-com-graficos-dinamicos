    function ReceitaGrafico() {
        var url = "dadosreceitagrafico.php?callback=?";
        $.ajax({
            url: url,
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("h2").html("Carregando...");
            },
            error: function () {
                $('h2').html("Erro: Fonte de dados Gráfico");
            },
            success: function (dados) {
                if (dados[0].erro) {
                    $("h2").html(retorno[0].erro);
                } else {
                    var coluna = Highcharts.stockChart('coluna', {
                        rangeSelector: {
                            selected: 1
                        },
                        title: {
                            text: 'Receitas da prefeitura'
                        },
                        series: [{
                            name: 'Receita:',
                            data: dados,
                            type: 'column',
                            tooltip: {
                                valueDecimals: 2
                            },
                    }]
                    });
                }
                $("h2").html("Carregado");
            }
        });
    };

    function ReceitaGraficoP() {
        $.ajax({
            url: "receitagraficopie.php?callback=?",
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("h2").html("Carregando...");
            },
            error: function () {
                $('h2').html("Erro: Fonte de dados Gráfico");
            },
            success: function (dados) {
                if (dados[0].erro) {
                    $("h2").html(retorno[0].erro);
                } else {
                    var coluna = Highcharts.chart('pizza', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Receita por categorias'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Receita',
                            data: dados,
                    }]
                    });
                }
                $("h2").html("Carregado");
            }
        });
    }
function ReceitaGraficoP2() {
        $.ajax({
            url: "receitagraficopie2.php?callback=?",
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("h2").html("Carregando...");
            },
            error: function () {
                $('h2').html("Erro: Fonte de dados Gráfico");
            },
            success: function (dados) {
                if (dados[0].erro) {
                    $("h2").html(retorno[0].erro);
                } else {
                    var coluna = Highcharts.chart('pizza2', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Receita por fonte'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Receita',
                            data: dados,
                    }]
                    });
                }
                $("h2").html("Carregado");
            }
        });
    }
function ReceitaGraficoP3() {
        $.ajax({
            url: "receitagraficopie3.php?callback=?",
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("h2").html("Carregando...");
            },
            error: function () {
                $('h2').html("Erro: Fonte de dados Gráfico");
            },
            success: function (dados) {
                if (dados[0].erro) {
                    $("h2").html(retorno[0].erro);
                } else {
                    var coluna = Highcharts.chart('pizza3', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Receita por rubrica'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Receita',
                            data: dados,
                    }]
                    });
                }
                $("h2").html("Carregado");
            }
        });
    }

    $("document").ready(function () {
        ReceitaGrafico();
        ReceitaGraficoP();
        ReceitaGraficoP2();
        ReceitaGraficoP3();
        $("#TabelaReceita").DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },

        });
        $('#TabelaReceita').removeClass('display').addClass('table table-striped table-bordered');

    });
