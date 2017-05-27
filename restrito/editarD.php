<?php
include('../repositorio/Master.php');
$id = (int) $_GET['id'];
if(isset($_POST)){
    if(isset($_POST['valor'])){$dbo->alteraRegistroD('valor','valor',$id);}
    if(isset($_POST['data'])){$dbo->alteraRegistroD('data','data',$id);}
    if(isset($_POST['historico'])){$dbo->alteraRegistroD('historico','historico',$id);}
    if(isset($_POST['tipo'])){if($_POST['tipo'] != null)$dbo->alteraRegistroD('tipo','tipo_despesa_idtipo_despesa',$id);}
    if(isset($_POST['numero'])){if($_POST['numero'] != null)$dbo->alteraRegistroD('numero','numero_empenho_numero',$id);}
    if(isset($_POST['pessoa'])){if($_POST['pessoa'] != null)$dbo->alteraRegistroD('pessoa','pessoas_cpfcnpj',$id);}
    if(isset($_POST['fonte'])){if($_POST['fonte'] != null)$dbo->alteraRegistroD('fonte','fonte_idfonte',$id);}
    if(isset($_POST['funcao'])){if($_POST['funcao'] != null)$dbo->alteraRegistroD('funcao','funcao_idfuncao',$id);}
    if(isset($_POST['programa'])){if($_POST['programa'] != null)$dbo->alteraRegistroD('programa','programa_idprograma',$id);}
    if(isset($_POST['acao'])){if($_POST['acao'] != null)$dbo->alteraRegistroD('acao','acao_idacao',$id);}
    if(isset($_POST['fonteR'])){if($_POST['fonteR'] != null)$dbo->alteraRegistroD('fonteR','fonte_recurso_idfonte_recurso',$id);}
    if(isset($_POST['aplicacao'])){if($_POST['aplicacao'] != null)$dbo->alteraRegistroD('aplicacao','aplicacao_idaplicacao',$id);}
    if(isset($_POST['modalidade'])){if($_POST['modalidade'] != null)$dbo->alteraRegistroD('modalidade','modalidade_idmodalidade',$id);}
    if(isset($_POST['elemento'])){if($_POST['elemento'] != null)$dbo->alteraRegistroD('elemento','elemento_idelemento',$id);}
}
if($result=$dbo->query("SELECT * FROM `despesa` WHERE iddespesa='{$id}'")){
    if($result){
        while($row = $result->fetch_assoc()){
            $array[]=$row;
        }
    }
    $result->close();
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
                                        <h2>Alteração de despesa</h2>
                                    </div>

                                    <form action="#" method="post" class="panel-body">
                                        <div class="form-group">
                                            <label for="tipo" class="col-sm-6 control-label">Tipo da Despesa</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM tipo_despesa","tipo","idtipo_despesa")?>
                                            </div>
                                            <label for="numero" class="col-sm-6 control-label">Numero de empenho</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM numero_empenho","numero","numero")?>
                                            </div>
                                            <label for="pessoa" class="col-sm-6 control-label">Pessoa</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM pessoas","pessoa","cpfcnpj") ?>
                                            </div>
                                            <label for="funcao" class="col-sm-6 control-label">Função</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM funcao","funcao","idfuncao")?>
                                            </div>
                                            <label for="programa" class="col-sm-6 control-label">Programa</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM programa","programa","idprograma") ?>
                                            </div>
                                            <label for="acao" class="col-sm-6 control-label">Ação</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM acao","acao","idacao") ?>
                                            </div>
                                            <label for="fonteR" class="col-sm-6 control-label">Fonte do recurso</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM fonte_recurso","fonteR","idfonte_recurso"); ?>
                                            </div>
                                            <label for="aplicacao" class="col-sm-6 control-label">Aplicação</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM aplicacao","aplicacao","idaplicacao")?>
                                            </div>
                                            <label for="modalidade" class="col-sm-6 control-label">Modalidade</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM modalidade","modalidade","idmodalidade")?>
                                            </div>
                                            <label for="elemento" class="col-sm-6 control-label">Elemento</label>
                                            <div class="col-sm-6">
                                                <?php $dbo->opButton("SELECT * FROM elemento","elemento","idelemento")?>
                                            </div>
                                            <label for="historico" class="col-sm-6 control-label">Histórico</label>
                                            <div class="col-sm-6">
                                               <textarea id="historico" name="historico" class="form-control" rows="3" placeholder="<?php echo $array[0]['historico'];?>"></textarea>
                                            </div>
                                            <label for="valor" class="col-sm-6 control-label">Valor</label>
                                            <div class="col-sm-6">
                                                <input id="valor" type="text" class="form-control" name="valor" value="<?php echo $array[0]['valor']; ?>">
                                            </div>
                                            <label for="data" class="col-sm-6 control-label">Data</label>
                                            <div class="col-sm-6">
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
