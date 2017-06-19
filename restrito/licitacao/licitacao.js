var manageMemberTable;
$(document).ready(function () {
    manageMemberTable = $("#licitacao").DataTable({
        "ajax": "populacao.php",
        "order": [],
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
            },
        },
    });
    $("#addMemberModalBtn").on('click', function () {
        // reset the form
        $("#createLicitacaoForm")[0].reset();
        // remove the error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".messages").html("");

        // submit form
        $("#createLicitacaoForm").unbind('submit').bind('submit', function () {

            $(".text-danger").remove();

            var form = $(this);

            // validation
            var contrato = $("#contrato").val();
            var numero = $("#numero").val();
            var objetivo = $("#objetivo").val();
            var inicio = $("#inicio").val();
            var termino = $("#termino").val();
            var valor = $("#valor").val();
            var orgao = $("#orgao").val();

            if (contrato == "") {
                $("#contrato").closest('.form-group').addClass('has-error');
                $("#contrato").after('<p class="text-danger">É necessário dizer o nome do contrato</p>');
            } else {
                $("#contrato").closest('.form-group').removeClass('has-error');
                $("#contrato").closest('.form-group').addClass('has-success');
            }

            if (numero == "") {
                $("#numero").closest('.form-group').addClass('has-error');
                $("#numero").after('<p class="text-danger">É necessário entrar com o numero do contrato</p>');
            } else {
                $("#numero").closest('.form-group').removeClass('has-error');
                $("#numero").closest('.form-group').addClass('has-success');
            }

            if (objetivo == "") {
                $("#objetivo").closest('.form-group').addClass('has-error');
                $("#objetivo").after('<p class="text-danger">É necessário dizer qual o objetivo</p>');
            } else {
                $("#objetivo").closest('.form-group').removeClass('has-error');
                $("#objetivo").closest('.form-group').addClass('has-success');
            }

            if (inicio == "") {
                $("#inicio").closest('.form-group').addClass('has-error');
                $("#inicio").after('<p class="text-danger">É necessário entrar com uma data</p>');
            } else {
                $("#inicio").closest('.form-group').removeClass('has-error');
                $("#inicio").closest('.form-group').addClass('has-success');
            }
            if (termino == "") {
                $("#termino").closest('.form-group').addClass('has-error');
                $("#termino").after('<p class="text-danger">É necessário entrar com uma data</p>');
            } else {
                $("#termino").closest('.form-group').removeClass('has-error');
                $("#termino").closest('.form-group').addClass('has-success');
            }
            if (valor == "") {
                $("#valor").closest('.form-group').addClass('has-error');
                $("#valor").after('<p class="text-danger">É necessário entrar com um valor </p>');
            } else {
                $("#valor").closest('.form-group').removeClass('has-error');
                $("#valor").closest('.form-group').addClass('has-success');
            }
            if (orgao == "") {
                $("#orgao").closest('.form-group').addClass('has-error');
                $("#orgao").after('<p class="text-danger">É necessário dizer qual orgão responsável</p>');
            } else {
                $("#orgao").closest('.form-group').removeClass('has-error');
                $("#orgao").closest('.form-group').addClass('has-success');
            }

            if (contrato && numero && objetivo && inicio && termino && valor && orgao) {
                //submi the form to server
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    async: false,
                    //					data : form.serialize(),
                    dataType: 'json',
                    success: function (response) {

                        // remove the error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                        if (response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // reset the form
                            $("#createLicitacaoForm")[0].reset();

                            // reload the datatables
                            manageMemberTable.ajax.reload(null, false);
                            // this function is built in function of datatables;

                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        } // /else
                    } // success
                }); // ajax subit
            } /// if
            return false;
        }); // /submit form for create member
    }); // /add modal
});

function removeLicitacao(id = null) {
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'remove.php',
                type: 'post',
                data: {
                    member_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');

                        // refresh the table
                        manageMemberTable.ajax.reload(null, false);

                        // close the modal
                        $("#removeMemberModal").modal('hide');

                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
    }
}

function editLicitacao(id = null) {
    if (id) {

        // remove the error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

        // remove the id
        $("#member_id").remove();

        // fetch the member data
        $.ajax({
            url: 'getSelect.php',
            type: 'post',
            data: {
                member_id: id
            },
            dataType: 'json',
            success: function (response) {

                $("#editcontrato").val(response.contrato);

                $("#editnumero").val(response.numero);

                $("#editobjetivo").val(response.objetivo);

                $("#editinicio").val(response.inicio);

                $("#edittermino").val(response.termino);

                $("#editvalor").val(response.valor);

                $("#editorgao").val(response.orgao_id);

                $("#editarquivo").val(response.arquivo);

                // mmeber id
                $(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="' + response.idlicitacao + '"/>');
                // here update the member data
                $("#updateMemberForm").unbind('submit').bind('submit', function () {
                    // remove error messages
                    $(".text-danger").remove();

                    var form = $(this);

                    // validation
                    var editcontrato = $("#editcontrato").val();

                    var editnumero = $("#editnumero").val();

                    var editobjetivo = $("#editobjetivo").val();

                    var editinicio = $("#editinicio").val();

                    var edittermino = $("#edittermino").val();

                    var editvalor = $("#editvalor").val();

                    var editorgao = $("#editorgao").val();

                    var editarquivo = $("#editarquivo").val();

                    if (editcontrato == "") {
                        $("#editcontrato").closest('.form-group').addClass('has-error');
                        $("#editcontrato").after('<p class="text-danger">É necessário dizer o nome do contrato</p>');
                    } else {
                        $("#editcontrato").closest('.form-group').removeClass('has-error');
                        $("#editcontrato").closest('.form-group').addClass('has-success');
                    }

                    if (numero == "") {
                        $("#editnumero").closest('.form-group').addClass('has-error');
                        $("#editnumero").after('<p class="text-danger">É necessário entrar com o numero do contrato</p>');
                    } else {
                        $("#editnumero").closest('.form-group').removeClass('has-error');
                        $("#editnumero").closest('.form-group').addClass('has-success');
                    }

                    if (editobjetivo == "") {
                        $("#editobjetivo").closest('.form-group').addClass('has-error');
                        $("#editobjetivo").after('<p class="text-danger">É necessário dizer qual o objetivo</p>');
                    } else {
                        $("#editobjetivo").closest('.form-group').removeClass('has-error');
                        $("#editobjetivo").closest('.form-group').addClass('has-success');
                    }

                    if (editinicio == "") {
                        $("#editinicio").closest('.form-group').addClass('has-error');
                        $("#editinicio").after('<p class="text-danger">É necessário entrar com uma data</p>');
                    } else {
                        $("#editinicio").closest('.form-group').removeClass('has-error');
                        $("#editinicio").closest('.form-group').addClass('has-success');
                    }
                    if (edittermino == "") {
                        $("#edittermino").closest('.form-group').addClass('has-error');
                        $("#edittermino").after('<p class="text-danger">É necessário entrar com uma data</p>');
                    } else {
                        $("#edittermino").closest('.form-group').removeClass('has-error');
                        $("#edittermino").closest('.form-group').addClass('has-success');
                    }
                    if (editvalor == "") {
                        $("#editvalor").closest('.form-group').addClass('has-error');
                        $("#editvalor").after('<p class="text-danger">É necessário entrar com um valor </p>');
                    } else {
                        $("#editvalor").closest('.form-group').removeClass('has-error');
                        $("#editvalor").closest('.form-group').addClass('has-success');
                    }
                    if (editorgao == "") {
                        $("#editorgao").closest('.form-group').addClass('has-error');
                        $("#editorgao").after('<p class="text-danger">É necessário dizer qual orgão responsável</p>');
                    } else {
                        $("#editorgao").closest('.form-group').removeClass('has-error');
                        $("#editorgao").closest('.form-group').addClass('has-success');
                    }

                    if (editcontrato && editnumero && editobjetivo && editinicio && edittermino && editvalor && editorgao) {
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
//                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                        '</div>');

                                    // reload the datatables
                                    manageMemberTable.ajax.reload(null, false);
                                    // this function is built in function of datatables;

                                    // remove the error
                                    $(".form-group").removeClass('has-success').removeClass('has-error');
                                    $(".text-danger").remove();
                                } else {
                                    $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                        '</div>')
                                }
                            } // /success
                        }); // /ajax
                    } // /if

                    return false;
                });

            } // /success
        }); // /fetch selected member info

    } else {
        alert("Error : Refresh the page again");
    }
}
