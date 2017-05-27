<?php include('../data/server.php'); ?>
<?php

if(isset($_POST['excluir'])){
    $id = $_POST['excluir'];
    $conn->query("DELETE FROM receita WHERE idreceita='{$id}';");
}

?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title>DataTables Bootstrap 3 example</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="datatables.min.css" />

        <script type="text/javascript" src="datatables.min.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#example').DataTable();
            });

        </script>
    </head>

    <body>
        <?php if(isset($_POST['excluir'])) { ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Excluido com sucesso!
        </div>
        <?php } ?>
        <div class="container">

            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Aplicação</th>
                        <th>Fonte do Recurso</th>
                        <th>Fonte</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result=$conn->query("SELECT idreceita, aplicacao_idaplicacao,fonte_recurso_idfonte_recurso,fonte_idfonte,data,valor FROM `receita` LIMIT 20")){ ?>
                    <?php if($result){ ?>
                    <?php while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td>
                            <?php echo $row['aplicacao_idaplicacao']; ?>
                        </td>
                        <td>
                            <?php echo $row['fonte_recurso_idfonte_recurso']; ?>
                        </td>
                        <td>
                            <?php echo $row['fonte_idfonte']; ?>
                        </td>
                        <td>
                            <?php echo date("d/m/Y", strtotime($row['data'])); ?>
                        </td>
                        <td>
                            <?php echo $row['valor']; ?>
                        </td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['idreceita']; ?>">
                                <button type="button" class="btn btn-warning">Editar</button>
                            </a>
                            <form action="#" method="post">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                                <input type="hidden" name="excluir" value="<?php echo $row['idreceita']; ?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <?php $result->close(); ?>
                    <?php } ?>
                </tbody>
            </table>

        </div>

        <script type="text/javascript">
            // For demo to fit into DataTables site builder...
            $('#example')
                .removeClass('display')
                .addClass('table table-striped table-bordered');

        </script>
    </body>

    </html>
