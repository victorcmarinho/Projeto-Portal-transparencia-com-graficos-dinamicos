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
    header("location:receitaAd.php");
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
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;"> <a href="index.html" class="site_title"><span>Portal</span></a></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic"> <img src="../img/perfil1.jpg" alt="Perfil" class="img-circle profile_img"> </div>
                            <div class="profile_info">
                                <span>Bem vindo</span>
                                <h2>Nome</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Menu</h3>
                                <ul class="nav side-menu">
                                    <li><a href="../index.html"><i class="fa fa-home"></i>Home<span class="label label-success pull-right">Beta</span></a>
                                        <!--

                                    -->
                                    </li>
                                    <li><a><i class="fa fa-money"></i>Receita</a>
                                        <ul class="nav child_menu">
                                            <li><a href="receitaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="importacao/cadastroreceita.html">Importação de receita</a></li>
                                            <li><a href="#">Dashboard3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="../despesa/despesa.php"><i class="fa fa-suitcase"></i>Despesas</a></li>
                                    <li><a href="../licitacao/licitacao.php"><i class="fa fa-file-text"></i>Licitações</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"> <img src="../img/perfil1.jpg" alt="Perfil 1">Usuário</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="conteudo" class="right_col" role="main">
                    <div id="result" class="row">
                        <section class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2>Alteração de receita</h2>
                                    </div>

                                    <form action="#" method="post" class="panel-body">
                                        <div class="form-group">
                                            <label for="fonteR" class="col-sm-6 control-label">Fonte do Recurso</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM fonte_recurso","fonteR","idfonte_recurso")?>
                                            </div>
                                            <label for="fonte" class="col-sm-6 control-label">Fonte</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM fonte","fonte","idfonte")?>
                                            </div>
                                            <label for="aplicacao" class="col-sm-6 control-label">Aplicação</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM aplicacao","aplicacao","idaplicacao") ?>
                                            </div>
                                            <label for="AplicacaoV" class="col-sm-6 control-label">Aplicação variavel</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM aplicacao_variavel","AplicacaoV","idaplicacao_variavel")?>
                                            </div>
                                            <label for="rubrica" class="col-sm-6 control-label">Rubrica</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM rubrica","rubrica","idrubrica") ?>
                                            </div>
                                            <label for="alinea" class="col-sm-6 control-label">Alinea</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM alinea","alinea","idalinea") ?>
                                            </div>
                                            <label for="poder" class="col-sm-6 control-label">Poder</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM poder","poder","idpoder"); ?>
                                            </div>
                                            <label for="categoria" class="col-sm-6 control-label">Categoria</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM categoria","categoria","idcategoria")?>
                                            </div>
                                            <label for="valor" class="col-sm-6 control-label">Valor</label>
                                            <div class="col-sm-6">
                                                <input id="valor" type="text" class="form-control" name="valor" value="<?php echo $array[0]['valor']; ?>">
                                            </div>
                                            <label for="data" class="col-sm-2 control-label">Data</label>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="date" name="data" value="<?php echo $array[0]['data']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default" type="input">Alterar</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right"> Modelo Dashboard - Feito e administrado por <a href="#">Carvalho Multiserviços</a> </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
        <!-- jQuery -->
        <script src="../vendors/jquery/jquery-3.2.0.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
        <!-- Custom -->
        <script src="../build/js/custom.js"></script>
    </body>

    </html>
