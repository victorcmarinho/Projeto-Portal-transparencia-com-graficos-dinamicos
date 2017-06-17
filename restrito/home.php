<?php
include "protect.php";
?>
    <!DOCTYPE html>
    <html lang="PT-BR">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="keywords" content="Portal Transparencia" />
        <meta name="description" property="og:description" content="Descrição" />
        <meta name="author" content="Victor Vinícius de Carvalho Marinho" />
        <meta name="robots" content="index,follow" />
        <meta property="og:image" content="#" />
        <link rel="icon" href="#" sizes="32x32">
        <title>Modelo</title>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../build/css/custom.css" rel="stylesheet">
        <link href="../build/css/login.css" rel="stylesheet">
        <link href="../build/css/animate.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;"> <a href="index.html" class="site_title"><span>Portal</span></a></div>
                        <div class="profile clearfix">
                            <div class="profile_pic"> <img src="../img/perfil1.jpg" alt="Perfil" class="img-circle profile_img"> </div>
                            <div class="profile_info">
                                <span>Bem vindo</span>
                                <h2>
                                    <?php echo $_SESSION['usuarioNome']?>
                                </h2>
                            </div>
                        </div>
                        <br/>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Menu</h3>
                                <ul class="nav side-menu">
                                    <li><a href="home.php"><i class="fa fa-home"></i>Home<span class="label label-success pull-right">Beta</span></a>
                                    </li>
                                    <li><a><i class="fa fa-money"></i>Receita</a>
                                        <ul class="nav child_menu">
                                            <li><a href="receita/receitaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="importacao/cadastroreceita.php">Importação de receita</a></li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-suitcase"></i>Despesas</a>
                                        <ul class="nav child_menu">
                                            <li><a href="despesaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="../importacao/cadastrodespesa.html">Importação de despesa</a></li>

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
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    <!-- Banner
                <div class="row tile_count">
                    <img class="img-responsive" src="images/banner-todos-por-s%C3%A3o-luis.jpg" alt="Banner">
                </div>
                <!-- /top tiles -->
                    <section class="row ">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="carousel slide" data-ride='carousel' id="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel" data-slide-to="1"></li>
                                    <li data-target="#carousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img width="1200" height="320" src="img/teclado.jpg" alt="...">
                                        <div class="carousel-caption">
                                            ...
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="img/teclado.jpg" alt="...">
                                        <div class="carousel-caption">
                                            ...
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="img/teclado.jpg" alt="...">
                                        <div class="carousel-caption">
                                            ...
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Proxímo</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="img/table.jpg" alt="...">
                                <div class="caption">
                                    <h3>Thumbnail</h3>
                                    <p>...</p>
                                    <p>...</p>
                                    <p>...</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Botão</a> <a href="#" class="btn btn-default" role="button">Botão</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="img/table.jpg" alt="...">
                                <div class="caption">
                                    <h3>Exemplo</h3>
                                    <p>...</p>
                                    <p>...</p>
                                    <p>...</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Botão</a> <a href="#" class="btn btn-default" role="button">Botão</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="img/table.jpg" alt="...">
                                <div class="caption">
                                    <h3>Exemplo</h3>
                                    <p>...</p>
                                    <p>...</p>
                                    <p>...</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Botão</a> <a href="#" class="btn btn-default" role="button">Botão</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <footer>
                <div class="pull-right"> Modelo Dashboard - Feito e administrado por <a href="#">Carvalho Multiserviços</a> </div>
                <div class="clearfix"></div>
            </footer>
        </div>
        <div class="container">
            <!-- todas as Modais aqui --->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form name="loginform" method="post" action="logar.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Deseja realmente sair?
                                    <p class="text-center">
                                        <?php echo $_SESSION['usuarioNome']?>
                                    </p>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <button type="submit" value="entar" class="btn btn-primary">Sim</button>
                                <button type="submit" value="entar" data-dismiss="modal" class="btn btn-danger" aria-label="Close">Não</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
        <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../build/js/custom.js"></script>
    </body>

    </html>