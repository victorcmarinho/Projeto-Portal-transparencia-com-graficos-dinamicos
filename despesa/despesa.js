/*
$(document).ready(function(){
        $("#TabelaReceita").DataTable({
            "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pagina",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro dísponivel",
            "infoFiltered": "(filtrado de  _MAX_ registros no total)"
            },
            "ajax": "dadosreceitatabela.php?callback",

        });

    });
*/
$("document").ready(function () {
    function receitaTabela() {
        //variáveis
        var itens = "",
            url = "dadosreceitatabela.php?callback";
        //Capturar Dados Usando Método AJAX do jQuery
        $.ajax({
            url: url,
            type:'GET',//
        dataType: 'json',//
        cache: false,
            beforeSend: function () {
                $("h2").html("Carregando..."); //Carregando
            },
            error: function () {
                $("h2").html("Erro fonte de dados: Tabela");
            },
            success: function (retorno) {
                if (retorno[0].erro) {
                    $("h2").html(retorno[0].erro);
                } else {
                    //Laço para criar linhas da tabela
                    for (var i = 0; i < retorno.length; i++) {
                        itens += "<tr>";
                        itens += "<td>" + retorno[i].idreceita + "</td>";
                        itens += "<td>" + retorno[i].aplicacao_idaplicacao + "</td>";
                        itens += "<td>" + retorno[i].data + "</td>";
                        itens += "<td>" + retorno[i].valor + "</td>";
                        itens += "<td>" + retorno[i].fonte_idfonte + "</td>";
                        itens += "</tr>";
                    }
                    //Preencher a Tabela
                    $("#TabelaReceita tbody").html(itens);

                    //Limpar Status de Carregando
                    $("h2").html("Carregado");
                }
            }

        });
    }


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

            }
        });
    };
    $('#search1').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        onSelect: function () {
            $.getJSON("dadosreceitatabela.php?callback", function (data) {
                var search = $('#search1').val();
                var regex = new RegExp(search, 'i');
                var output;
                $.each(data, function (key, val) {
                    if ((val.data.search(regex) != -1)) {
                        output += "<tr>";
                        output += "<td id='" + key + "'>" + val.receita_id + "</td>";
                        output += "<td id='" + key + "'>" + val.descricao + "</td>";
                        output += "<td id='" + key + "'>" + val.data + "</td>";
                        output += "<td id='" + key + "'>" + val.valor + "</td>";
                        output += "<td id='" + key + "'>" + val.documento + "</td>";
                        output += "</tr>";
                    }
                });
                $('#TabelaReceita tbody').html(output);
            });
        }
    });
    $('#search').keydown(function () {
        $.getJSON("dadosreceitatabela.php?callback", function (data) {
            var search = $('#search').val();
            var regex = new RegExp(search, 'i');
            var output;
            $.each(data, function (key, val) {
                if ((val.receita_id.search(regex) != -1) || (val.descricao.search(regex) != -1)) {
                    output += "<tr>";
                    output += "<td id='" + key + "'>" + val.receita_id + "</td>";
                    output += "<td id='" + key + "'>" + val.descricao + "</td>";
                    output += "<td id='" + key + "'>" + val.data + "</td>";
                    output += "<td id='" + key + "'>" + val.valor + "</td>";
                    output += "<td id='" + key + "'>" + val.documento + "</td>";
                    output += "</tr>";
                }
            });
            $('#TabelaReceita tbody').html(output);
        });
    })
    $('#search2').keydown(function () {
        $.getJSON("dadosreceitatabela.php?callback", function (data) {
            var search = $('#search2').val();
            var regex = new RegExp(search, 'i');
            var output;
            $.each(data, function (key, val) {
                if ((val.valor.search(regex) != -1)) {
                    output += "<tr>";
                    output += "<td id='" + key + "'>" + val.receita_id + "</td>";
                    output += "<td id='" + key + "'>" + val.descricao + "</td>";
                    output += "<td id='" + key + "'>" + val.data + "</td>";
                    output += "<td id='" + key + "'>" + val.valor + "</td>";
                    output += "<td id='" + key + "'>" + val.documento + "</td>";
                    output += "</tr>";
                }
            });
            $('#TabelaReceita tbody').html(output);
        });
    })
    receitaTabela();
    ReceitaGrafico();
});
