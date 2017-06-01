
<html>

<head>
    <link href="../vendors/bootstrap/css/bootstrap.min.css">
    <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
    <link href="../vendors/DataTable/CSS/dataTables.bootstrap.min.css">
    <link href="../vendors/DataTable/CSS/responsive.bootstrap.min.css">
    <script src="../vendors/DataTable/JS/jquery.dataTables.min.js"></script>
    <script src="../vendors/DataTable/JS/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/DataTable/JS/responsive.bootstrap.min.js"></script>
</head>

<body>
    <table id="table_cust">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</body>
<script>
    $(document).ready(function() {
        $('#table_cust').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10,
            "ajax": {
                "url": "teste.php",
                "type": "POST"
            },
            "columns": [{
                    "data": "urutan"
                },
                {
                    "data": "name"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "country"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "button"
                },
            ]
        });
    });
    $(document).on("click", "#btnadd", function() {
        $("#modalcust").modal("show");
        $("#txtname").focus();
        $("#txtname").val("");
        $("#txtcountry").val("");
        $("#txtphone").val("");
        $("#crudmethod").val("N");
        $("#txtid").val("0");
    });
    $(document).on("click", ".btnhapus", function() {
        var id_cust = $(this).attr("id_cust");
        var name = $(this).attr("name_cust");
        swal({
                title: "Delete Cust?",
                text: "Delete Cust : " + name + " ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete",
                closeOnConfirm: true
            },
            function() {
                var value = {
                    id_cust: id_cust
                };
                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: value,
                    success: function(data, textStatus, jqXHR) {
                        var data = jQuery.parseJSON(data);
                        if (data.result == 1) {
                            $.notify('Successfull delete customer');
                            var table = $('#table_cust').DataTable();
                            table.ajax.reload(null, false);
                        } else {
                            swal("Error", "Can't delete customer data, error : " + data.error, "error");
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Error!", textStatus, "error");
                    }
                });
            });
    });
    $(document).on("click", "#btnsave", function() {
        var id_cust = $("#txtid").val();
        var name = $("#txtname").val();
        var gender = $("#cbogender").val();
        var country = $("#txtcountry").val();
        var phone = $("#txtphone").val();
        var crud = $("#crudmethod").val();
        if (name == '' || name == null) {
            swal("Warning", "Please fill customer name", "warning");
            $("#txtname").focus();
            return;
        }
        var value = {
            id_cust: id_cust,
            name: name,
            gender: gender,
            country: country,
            phone: phone,
            crud: crud
        };
        $.ajax({
            url: "save.php",
            type: "POST",
            data: value,
            success: function(data, textStatus, jqXHR) {
                var data = jQuery.parseJSON(data);
                if (data.crud == 'N') {
                    if (data.result == 1) {
                        $.notify('Successfull save data');
                        var table = $('#table_cust').DataTable();
                        table.ajax.reload(null, false);
                        $("#txtname").focus();
                        $("#txtname").val("");
                        $("#txtcountry").val("");
                        $("#txtphone").val("");
                        $("#crudmethod").val("N");
                        $("#txtid").val("0");
                        $("#txtnama").focus();
                    } else {
                        swal("Error", "Can't save customer data, error : " + data.error, "error");
                    }
                } else if (data.crud == 'E') {
                    if (data.result == 1) {
                        $.notify('Successfull update data');
                        var table = $('#table_cust').DataTable();
                        table.ajax.reload(null, false);
                        $("#txtname").focus();
                    } else {
                        swal("Error", "Can't update customer data, error : " + data.error, "error");
                    }
                } else {
                    swal("Error", "invalid order", "error");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", textStatus, "error");
            }
        });
    });
    $(document).on("click", ".btnedit", function() {
        var id_cust = $(this).attr("id_cust");
        var value = {
            id_cust: id_cust
        };
        $.ajax({
            url: "get_cust.php",
            type: "POST",
            data: value,
            success: function(data, textStatus, jqXHR) {
                var data = jQuery.parseJSON(data);
                $("#crudmethod").val("E");
                $("#txtid").val(data.id_cust);
                $("#txtname").val(data.name);
                $("#cbogender").val(data.gender);
                $("#txtcountry").val(data.country);
                $("#txtphone").val(data.phone);

                $("#modalcust").modal('show');
                $("#txtname").focus();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", textStatus, "error");
            }
        });
    });
    $.notifyDefaults({
        type: 'success',
        delay: 500
    });

</script>

</html>
