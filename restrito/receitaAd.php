<?php
include_once "../repositorio/Master.php";
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
        <link href="../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../build/css/custom.css" rel="stylesheet">
        <link href="../build/css/login.css" rel="stylesheet">
        <link href="../build/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../build/css/load.css">

        <link rel="stylesheet" type="text/css" href="../vendors/DataTable/datatables.min.css">

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
                        <br/>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Menu</h3>
                                <ul class="nav side-menu">
                                    <li><a href="../index.html"><i class="fa fa-home"></i>Home<span class="label label-success pull-right">Beta</span></a>
                                    </li>
                                    <li><a><i class="fa fa-money"></i>Receita</a>
                                        <ul class="nav child_menu">
                                            <li><a href="receitaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="importacao/cadastroreceita.html">Importação de receita</a></li>
                                            <li><a href="#">Dashboard3</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-suitcase"></i>Despesas</a>
                                        <ul class="nav child_menu">
                                            <li><a href="despesaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="importacao/cadastrodespesa.html">Importação de despesa</a></li>
                                            <li><a href="#">Dashboard3</a></li>
                                        </ul>
                                    </li>
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
                    <img style="height:200px;" id="load" src="../img/ring-alt.svg" class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div id="result" class="row load ">
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
                                                <h1>
                                                    <caption>Receitas</caption>
                                                </h1>
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Aplicação</th>
                                                    <th>aplicação variável</th>
                                                    <th>Categoria</th>
                                                    <th>Poder</th>
                                                    <th>Fonte</th>
                                                    <th>Fonte do recurso</th>
                                                    <th>Rubrica</th>
                                                    <th>Alinea</th>
                                                    <th>Data</th>
                                                    <th>Valor</th>
                                                    <th>Opções de controle</th>
                                                </thead>
                                                <tbody>
                                                    <?php if($result=$dbo->query("SELECT * FROM `receita`")){ ?>
                                                    <?php if($result){ ?>
                                                    <?php while($row = $result->fetch_assoc()){ ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['idreceita']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['aplicacao_idaplicacao']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['aplicacao_variavel_idaplicacao_variavel']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['categoria_idcategoria']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['poder_idpoder']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['fonte_idfonte']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['fonte_recurso_idfonte_recurso']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['rubrica_idrubrica']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['alinea_idalinea']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date("d/m/Y", strtotime($row['data'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['valor']; ?>
                                                        </td>
                                                        <td>
                                                            <a href="editarR.php?id=<?php echo $row['idreceita']; ?>">
                                                                <button type="button" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                                                            </a>
                                                            <form action="#" method="post">
                                                                <button type="submit" class="btn btn-danger glyphicon glyphicon-remove">Excluir</button>
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
        </div>
        <script src="../vendors/jquery/jquery-3.2.0.min.js"></script>
        <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../build/js/custom.js"></script>
        <script type="text/javascript" src="../vendors/DataTable/datatables.min.js"></script>
        <script src="tabela.js" type="text/javascript"></script>
    </body>

    </html>
