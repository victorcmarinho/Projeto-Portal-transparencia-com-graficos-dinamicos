$(document).ready(function () {
    var btnFinish = $('<button></button>').text('Concluir')
        .addClass('btn btn-finish btn-info disabled')
        .on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var elmForm = $("#cadastro");
                if (elmForm) {
                    elmForm.validator('validate');
                    var elmErr = elmForm.find('.has-error');
                    if (elmErr && elmErr.length > 0) {
                        alert('Oops, temos algum erro no formulário');
                        return false;
                    } else {
                        alert('Concluido com sucesso');
                        elmForm.submit();
                        return false;
                    }
                }
            }
        });
    var btnCancel = $('<button></button>').text('Cancelar')
        .addClass('btn btn-danger')
        .on('click', function () {
            $('#smartwizard').smartWizard("reset");
            $('#cadastro').find("input, textarea").val("");
        });



    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'arrows',
        transitionEffect: 'fade',
        toolbarSettings: {
            toolbarPosition: 'bottom',
            toolbarExtraButtons: [btnFinish, btnCancel]
        },
        showStepURLhash: false,
        lang: { // Language variables
            next: 'Próximo',
            previous: 'Anterior'
        },
        anchorSettings: {
            markDoneStep: true, // add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        }
    });

    $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        if (stepDirection === 'forward' && elmForm) {
            elmForm.validator('validate');
            var elmErr = elmForm.children('.has-error');
            if (elmErr && elmErr.length > 0) {
                return false;
            }
        }
        return true;
    });
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
        if (stepNumber == 3) {
            $('.btn-finish').removeClass('disabled');
        } else {
            $('.btn-finish').addClass('disabled');
        }
    });
});
/*
$(function () {
    $('#cadastro').submit(function (event) {
        event.preventDefault();
        var formDados = new FormData($(this)[0]);
        $.ajax({
            url: "cadastro.php",
            type: 'POST',
            data: formDados,
            cache: false,
            contentType: false,
            processData: false,
            sucess: function (data) {
                $("#resultado").html(data);
                alert('Cadastrado com Sucesso!');
            },
        });
        return false;
    });
});

/*
function ASC(String) {
    return String.charCodeAt(0);
}

function CHAR(Ascii) {
    return String.fromCharCode(Ascii);
}

function Cript(senha) {
    var chave = "sdfsdf09f789sdf78s9dfdfsdfsdfsdffdsfsafssdfsdffsd89fsd89";
    var dados = senha;
    var texto = "";
    var len;
    var p = 0;
    var i;
    for (i = 0; i < dados.length; i++) {
        p++;
        len = (ASC(dados.substr(i, 1)) + (ASC(chave.substr(p%chave.length, 1))));
        if (len > 255) {
            len -= 256;
        }
        texto += (CHAR(len));
    }
    return texto;
}
*/
