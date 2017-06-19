<?php
include "../protect.php";
include_once "../../repositorio/master.php";
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        <link href="../../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../../build/css/custom.min.css" rel="stylesheet">
        <link href="../../build/css/login.css" rel="stylesheet">
        <link href="../../vendors/SmartWizard-master/css/smart_wizard.css" rel="stylesheet" type="text/css" />
        <link href="../../vendors/SmartWizard-master/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css">
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
                        <br />
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
                                            <li><a href="../despesa/despesaAd.php">Administração da tabela principal</a></li>
                                            <li><a href="../importacao/importadespesaAd.php">Importação de despesa</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="licitacaoAd.php"><i class="fa fa-file-text"></i>Licitações</a></li>
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
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="modal" data-target="#myModal"> <img src="../../img/perfil1.jpg" alt="Perfil 1">Usuário</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <?php
                                        if(isset($_SESSION['mensagem'])){
                                            echo $_SESSION['mensagem'];
                                            unset($_SESSION['mensagem']);
                                        }
                                    ?>
                                            <center>
                                                <h1 class="page-header">Lista de licitação </h1>
                                            </center>
                                            <div class="removeMessages"></div>
                                            <button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addLicitacao" id="addMemberModalBtn"><span class="glyphicon glyphicon-plus-sign"></span>	Adicionar nova licitação</button>
                                            <br /> <br /> <br />

                                            <table class="table table-striped table-bordered" id="licitacao">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Contrato</th>
                                                        <th>Número</th>
                                                        <th>Objetivo</th>
                                                        <th>Data de inicio</th>
                                                        <th>Data de termino</th>
                                                        <th>Valor</th>
                                                        <th>Orgão</th>
                                                        <th>Arquivo</th>
                                                        <th>Opções</th>
                                                    </tr>
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

        <!-- add modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addLicitacao">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>Adicionar licitação</h4>
                    </div>

                    <form class="form-horizontal" action="create.php" method="POST" id="createLicitacaoForm" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="messages"></div>

                            <div class="form-group">
                                <label for="contrato" class="col-sm-2 control-label">Nome do contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contrato" name="contrato" placeholder="Digite aqui o nome do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="numero" class="col-sm-2 control-label">Número do contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite aqui o numero do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="objetivo" class="col-sm-2 control-label">Objetivo pelo qual foi feio o contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="objetivo" name="objetivo" placeholder="Digite aqui o objetivo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inicio" class="col-sm-2 control-label">Data de inicio do contrato</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inicio" name="inicio" placeholder="Entre com a data de inicio">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="termino" class="col-sm-2 control-label">Data de termino do contrato</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="termino" name="termino" placeholder="Entre com a data de termino">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="valor" class="col-sm-2 control-label">Valor do contrato</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="valor" name="valor" placeholder="Digite aqui o valor do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="orgao" class="col-sm-2 control-label">Orgão responsável</label>
                                <div class="col-sm-10">
                                    <?php
                                   $result = $dbo->query("SELECT * FROM `orgao`");
                                    echo "<select class='form-control' name='orgao' id='orgao'>";
                                    echo "<option>---Selecione uma opção-----</option>";
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row["id"]."'>".$row["descricao"]."</option>";
                                    }
                                    echo "</select>";?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="arquivo" class="col-sm-2 control-label">Upload do arquivo de contrato</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="arquivo" name="arquivo" placeholder="Selecione o arquivo para upload">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /add modal -->

        <!-- remove modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>Remover licitação</h4>
                    </div>
                    <div class="modal-body">
                        <p>Realmente deseja remover a licitação?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                        <button type="button" class="btn btn-primary" id="removeBtn">Sim</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /remove modal -->

        <!-- edit modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Editar licitação</h4>
                    </div>

                    <form class="form-horizontal" action="update.php" method="POST" id="updateMemberForm">

                        <div class="modal-body">
                            <div class="messages"></div>

                            <div class="form-group">
                                <label for="editcontrato" class="col-sm-2 control-label">Nome do contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editcontrato" name="editcontrato" placeholder="Digite aqui o nome do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editnumero" class="col-sm-2 control-label">Número do contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editnumero" name="editnumero" placeholder="Digite aqui o numero do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editobjetivo" class="col-sm-2 control-label">Objetivo pelo qual foi feio o contrato</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editobjetivo" name="editobjetivo" placeholder="Digite aqui o objetivo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editinicio" class="col-sm-2 control-label">Data de inicio do contrato</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="editinicio" name="editinicio" placeholder="Entre com a data de inicio">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edittermino" class="col-sm-2 control-label">Data de termino do contrato</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="edittermino" name="edittermino" placeholder="Entre com a data de termino">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editvalor" class="col-sm-2 control-label">Valor do contrato</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="editvalor" name="editvalor" placeholder="Digite aqui o valor do contrato">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editorgao" class="col-sm-2 control-label">Orgão responsável</label>
                                <div class="col-sm-10">
                                    <?php
                                   $result = $dbo->query("SELECT * FROM `orgao`");
                                    echo "<select class='form-control' name='editorgao' id='editorgao'>";
                                    echo "<option>---Selecione uma opção-----</option>";
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row["id"]."'>".$row["descricao"]."</option>";
                                    }
                                    echo "</select>";?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editarquivo" class="col-sm-2 control-label">Upload do arquivo de contrato</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="editarquivo" name="editarquivo" placeholder="Selecione o arquivo para upload">
                                </div>
                            </div>

                        </div>
                        <div class="editMemberModal modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /edit modal -->

        <footer>
            <div class="pull-right"> Modelo Dashboard - Feito por <a href="#">.....</a> </div>
            <div class="clearfix"></div>
        </footer>
        <script src="../../vendors/jquery/jquery-3.2.0.min.js"></script>
        <script src="../../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../build/js/custom.min.js"></script>
        <script src="../../vendors/Validator/validator.min.js"></script>
        <script type="text/javascript" src="../../vendors/SmartWizard-master/js/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="../../vendors/DataTable/JS/responsive.bootstrap.min.js"></script>
        <script type="text/javascript" src="licitacao.js"></script>
    </body>

    </html>
