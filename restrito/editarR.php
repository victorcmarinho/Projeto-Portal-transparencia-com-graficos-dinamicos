<?php
include('../repositorio/Master.php');
$id = (int) $_GET['id'];
if(isset($_POST)){
    if(isset($_POST['valor'])){$dbo->alteraRegistro('valor','valor',$id);}
    if(isset($_POST['data'])){$dbo->alteraRegistro('data','data',$id);}
    if(isset($_POST['ano_exe'])){$dbo->alteraRegistro('ano_exe','ano_exe',$id);}
    if(isset($_POST['mes_exe'])){$dbo->alteraRegistro('mes_exe','mes_exe',$id);}
    if(isset($_POST['categoria'])){if($_POST['categoria'] != null)$dbo->alteraRegistro('categoria','categoria_idcategoria',$id);}
    if(isset($_POST['poder'])){if($_POST['poder'] != null)$dbo->alteraRegistro('poder','poder_idpoder',$id);}
    if(isset($_POST['fonteR'])){if($_POST['fonteR'] != null)$dbo->alteraRegistro('fonteR','fonte_recurso_idfonte_recurso',$id);}
    if(isset($_POST['fonte'])){if($_POST['fonte'] != null)$dbo->alteraRegistro('fonte','fonte_idfonte',$id);}
    if(isset($_POST['aplicacao'])){if($_POST['aplicacao'] != null)$dbo->alteraRegistro('aplicacao','aplicacao_idaplicacao',$id);}
    if(isset($_POST['AplicacaoV'])){if($_POST['AplicacaoV'] != null)$dbo->alteraRegistro('AplicacaoV','aplicacao_variavel_idaplicacao_variavel',$id);}
    if(isset($_POST['rubrica'])){if($_POST['rubrica'] != null)$dbo->alteraRegistro('rubrica','rubrica_idrubrica',$id);}
    if(isset($_POST['alinea'])){if($_POST['alinea'] != null)$dbo->alteraRegistro('alinea','alinea_idalinea',$id);}
}
if($result=$dbo->query("SELECT * FROM `receita` WHERE idreceita='{$id}'")){
    if($result){
        while($row = $result->fetch_assoc()){
            $array[]=$row;
        }
    }
    $result->close();
}
if(isset($_POST['excluir'])){
    $id = $_POST['excluir'];
    $dbo->query("DELETE FROM receita WHERE idreceita='{$id}';");
}
?>
    <!DOCTYPE html>
    <html lang="PT-BR">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="keywords" content="Portal Transparencia">
        <meta name="description" property="og:description" content="Descrição do site." />
        <meta name="author" content="Victor Vinícius de Carvalho Marinho">
        <meta name="robots" content="index,follow">
        <meta property="og:image" content="#">
        <link rel="icon" href="#" sizes="32x32">
        <title>Administração de Receita</title>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.css" rel="stylesheet">
        <link href="../build/css/login.css" rel="stylesheet">
        <link href="../build/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../vendors/DataTable/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="../build/css/load.css">

    </head>

    <body class="nav-md">
        <div id="result" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 animated fadeInLeftBig">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="tab-content">
                            <form action="#" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="valor" class="col-sm-2 control-label">Valor</label>
                                    <div class="col-sm-2">
                                        <input id="valor" type="text" class="form-control" name="valor" value="<?php echo $array[0]['valor']; ?>">
                                    </div>
                                    <label for="categoria" class="col-sm-2 control-label">Categoria</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM categoria","categoria","idcategoria")?>
                                    </div>
                                    <label for="data" class="col-sm-2 control-label">Data</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="date" name="data" value="<?php echo $array[0]['data']; ?>">
                                    </div>
                                    <label for="poder" class="col-sm-2 control-label">Poder</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM poder","poder","idpoder"); ?>
                                    </div>
                                    <label for="fonteR" class="col-sm-2 control-label">Fonte do Recurso</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM fonte_recurso","fonteR","idfonte_recurso")?>
                                    </div>
                                    <label for="fonte" class="col-sm-2 control-label">Fonte</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM fonte","fonte","idfonte")?>
                                    </div>
                                    <label for="aplicacao" class="col-sm-2 control-label">Aplicação</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM aplicacao","aplicacao","idaplicacao") ?>
                                    </div>
                                    <label for="AplicacaoV" class="col-sm-2 control-label">Aplicação variavel</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM aplicacao_variavel","AplicacaoV","idaplicacao_variavel")?>
                                    </div>
                                    <label for="rubrica" class="col-sm-2 control-label">Rubrica</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM rubrica","rubrica","idrubrica") ?>
                                    </div>
                                    <label for="alinea" class="col-sm-2 control-label">Alinea</label>
                                    <div class="col-sm-2">
                                        <?php $dbo->opButton("SELECT * FROM alinea","alinea","idalinea") ?>
                                    </div>
                                    <label   class="col-sm-2 control-label" for="ano_exe">Ano de exercício</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="ano_exe" value="<?php echo $array[0]['ano_exe']; ?>">
                                    </div>
                                    <label  class="col-sm-2 control-label" for="mes_exe">Mês de exercício</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="mes_exe" value="<?php echo $array[0]['mes_exe']; ?>">
                                    </div>
                                </div>
                                <button type="input">Alterar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../vendors/jquery/jquery-3.2.0.min.js"></script>
        <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../build/js/custom.js"></script>
    </body>

    </html>
