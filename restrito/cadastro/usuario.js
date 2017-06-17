
var manageMemberTable;

$(document).ready(function () {
    manageMemberTable = $("#usuarioTable").DataTable({
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
        "ajax": "php_action/retrieve.php",
        "order": []
    });

});

function removeMember(id = null) {
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'php_action/remove.php',
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

                        manageMemberTable.ajax.reload(null, false);

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
        alert('Error: Recarregue a página e tente novamente!');
    }
}

function editMember(id = null) {
    if (id) {

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        $(".edit-messages").html("");
        $("#member_id").remove();
        $.ajax({
            url: 'php_action/getSelectedMember.php',
            type: 'post',
            data: {
                member_id: id
            },
            dataType: 'json',
            success: function (response) {
                $("#editName").val(response.name);

                $("#editEmail").val(response.email);

                $("#editNivel").val(response.nivel);

                $("#editActive").val(response.active);

                $(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="' + response.id + '"/>');

                $("#updateMemberForm").unbind('submit').bind('submit', function () {

                    $(".text-danger").remove();

                    var form = $(this);


                    var editName = $("#editName").val();
                    var editEmail = $("#editEmail").val();
                    var editNivel = $("#editNivel").val();
                    var editActive = $("#editActive").val();

                    if (editName == "") {
                        $("#editName").closest('.form-group').addClass('has-error');
                        $("#editName").after('<p class="text-danger">Digite o seu nome aqui</p>');
                    } else {
                        $("#editName").closest('.form-group').removeClass('has-error');
                        $("#editName").closest('.form-group').addClass('has-success');
                    }

                    if (editEmail == "") {
                        $("#editEmail").closest('.form-group').addClass('has-error');
                        $("#editEmail").after('<p class="text-danger">Digite o novo email</p>');
                    } else {
                        $("#editEmail").closest('.form-group').removeClass('has-error');
                        $("#editEmail").closest('.form-group').addClass('has-success');
                    }

                    if (editNivel == "") {
                        $("#editNivel").closest('.form-group').addClass('has-error');
                        $("#editNivel").after('<p class="text-danger">Selecione o novo nivel de acesso</p>');
                    } else {
                        $("#editNivel").closest('.form-group').removeClass('has-error');
                        $("#editNivel").closest('.form-group').addClass('has-success');
                    }

                    if (editActive == "") {
                        $("#editActive").closest('.form-group').addClass('has-error');
                        $("#editActive").after('<p class="text-danger">Ative ou desative o acesso</p>');
                    } else {
                        $("#editActive").closest('.form-group').removeClass('has-error');
                        $("#editActive").closest('.form-group').addClass('has-success');
                    }

                    if (editName && editEmail && editNivel && editActive) {
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                        '</div>');


                                    manageMemberTable.ajax.reload(null, false);


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
        alert("Error : Recarregue a página (F5)");
    }
}
