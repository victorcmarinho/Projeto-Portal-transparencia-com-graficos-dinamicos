// global the manage memeber table
var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		"ajax": "php_action/retrieve.php",
		"order": []
	});


function removeMember(id = null) {
	if(id) {
		// Click em remover
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/remove.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						$(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

						// recerrega a tabela
						manageMemberTable.ajax.reload(null, false);

						// fecha modal
						$("#removeMemberModal").modal('hide');

					} else {
						$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
					}
				}
			});
		}); // Click em cancelar
	} else {
		alert('Error: Recarregue a pagina (F5)');
	}
}

function editMember(id = null) {
	if(id) {

		// remove o erro
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// Mensagem
		$(".edit-messages").html("");

		// remove id
		$("#member_id").remove();

		// associa os membros
		$.ajax({
			url: 'php_action/getSelectedMember.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
				$("#editName").val(response.name);

				$("#editAddress").val(response.address);

				$("#editContact").val(response.contact);

				$("#editActive").val(response.active);

				// id do usuário
				$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// formulario de alteração do usuário
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// menssagem de erro
					$(".text-danger").remove();

					var form = $(this);

					// validação
					var editName = $("#editName").val();
					var editAddress = $("#editAddress").val();
					var editContact = $("#editContact").val();
					var editActive = $("#editActive").val();

					if(editName == "") {
						$("#editName").closest('.form-group').addClass('has-error');
						$("#editName").after('<p class="text-danger">Esqueceu de preencher o campo</p>');
					} else {
						$("#editName").closest('.form-group').removeClass('has-error');
						$("#editName").closest('.form-group').addClass('has-success');
					}

					if(editAddress == "") {
						$("#editAddress").closest('.form-group').addClass('has-error');
						$("#editAddress").after('<p class="text-danger">Esqueceu de preencher o campo</p>');
					} else {
						$("#editAddress").closest('.form-group').removeClass('has-error');
						$("#editAddress").closest('.form-group').addClass('has-success');
					}

					if(editContact == "") {
						$("#editContact").closest('.form-group').addClass('has-error');
						$("#editContact").after('<p class="text-danger">Esqueceu de preencher o campo</p>');
					} else {
						$("#editContact").closest('.form-group').removeClass('has-error');
						$("#editContact").closest('.form-group').addClass('has-success');
					}

					if(editActive == "") {
						$("#editActive").closest('.form-group').addClass('has-error');
						$("#editActive").after('<p class="text-danger">Esqueceu de preencher o campo</p>');
					} else {
						$("#editActive").closest('.form-group').removeClass('has-error');
						$("#editActive").closest('.form-group').addClass('has-success');
					}

					if(editName && editAddress && editContact && editActive) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									$(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');

									// reload the datatables
									manageMemberTable.ajax.reload(null, false);
									// this function is built in function of datatables;

									// remove the error
									$(".form-group").removeClass('has-success').removeClass('has-error');
									$(".text-danger").remove();
								} else {
									$(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>')
								}
							} // /sucesso
						}); // /ajax
					} // /if

					return false;
				});

			} // /sucesso
		});

	} else {
		alert("Error : Recarregue a pagina (F5)");
	}
}
