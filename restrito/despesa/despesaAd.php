<?php
include "../protect.php";
include_once "../../repositorio/Master.php";
if(isset($_POST['excluir'])){
    $id = $_POST['excluir'];
    $dbo->query("DELETE FROM despesa WHERE iddespesa='{$id}';");
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
        <link href="../../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../../build/css/custom.css" rel="stylesheet">
        <link href="../../build/css/login.css" rel="stylesheet">
        <link href="../../build/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../build/css/load.css">
        <link rel="stylesheet" type="text/css" href="../../vendors/DataTable/CSS/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendors/DataTable/CSS/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../vendors/DataTable/CSS/responsive.bootstrap.min.css">

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;"> <a href="index.html" class="site_title"><span>Portal</span></a></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic"> <img src="../../img/perfil1.jpg" alt="Perfil" class="img-circle profile_img"> </div>
                            <div class="profile_info">
                                <span>Bem vindo</span>
                                <h2>Nome</h2>
                            </div>
                        </div>
                        <br/>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Menu</h3>
                                <ul class="nav side-menu">
                                    <li><a href="../home.php"><i class="fa fa-home"></i>Home<span class="label label-success pull-right">Beta</span></a>
                                    </li>
                                    <li><a><i class="fa fa-money"></i>Receita</a>
                                        <ul class="nav child_menu">
                                            <li><a href="../receita/receitaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="../importacao/importareceitaAd.php">Importação de receita</a></li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-suitcase"></i>Despesas</a>
                                        <ul class="nav child_menu">
                                            <li><a href="despesaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="../importacao/importadespesaAd.php">Importação de despesa</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="../licitacao/licitacaoAd.php"><i class="fa fa-file-text"></i>Licitações</a></li>
                                    <li><a href="../cadastro/usuario.php"><i class="fa fa-group"></i>Lista de usuários</a></li>
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
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"> <img src="../../img/perfil1.jpg" alt="Perfil 1">Usuário</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="conteudo" class="right_col" role="main">
                    <!--<img style="height:200px;" id="load" src="../../img/ring-alt.svg" class="col-md-12 col-sm-12 col-xs-12 col-lg-12">-->
                    <div id="result" class="row ">
                        <?php if(isset($_POST['excluir'])) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Excluido com sucesso!
                        </div>
                        <?php } ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 animated fadeInLeftBig">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="table">
                                            <table id="TabelaAD" class="table table-striped table-bordered">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Tipo</th>
                                                    <th>Numero do empenho</th>
                                                    <th>Pessoa</th>
                                                    <th>Data</th>
                                                    <th>Valor</th>
                                                    <th>Função</th>
                                                    <th>Programa</th>
                                                    <th>Ação</th>
                                                    <th>Fonte de recurso</th>
                                                    <th>Aplicação</th>
                                                    <th>Modalidade</th>
                                                    <th>Elemento</th>
                                                    <th>Histórico</th>
                                                    <th>Opções de controle</th>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="pull-right"> Modelo Dashboard - Feito e administrado por <a href="#">Carvalho Multiserviços</a> </div>
                <div class="clearfix"></div>
            </footer>
            <div class="modal fade" id="mEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edição dos dados</h4>
                        </div>
                        <div class="modal-body">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="mExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edição dos dados</h4>
                        </div>
                        <div class="modal-body">
                            Deseja realmente excluir?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../vendors/jquery/jquery-1.12.4.js"></script>
        <script src="../../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../build/js/custom.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/responsive.bootstrap.min.js"></script>
        <script src="tabela.js" type="text/javascript"></script>
    </body>

    </html>
