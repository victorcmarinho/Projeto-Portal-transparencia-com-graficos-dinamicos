<?php
include "../protect.php";
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
                                    <li><a href="index.html"><i class="fa fa-home"></i>Home<span class="label label-success pull-right">Beta</span></a>
                                    </li>
                                    <li><a href="Receita/Receita.html"><i class="fa fa-money"></i>Receita</a></li>
                                    <li><a><i class="fa fa-suitcase"></i>Despesas</a></li>
                                    <li><a><i class="fa fa-file-text"></i>Licitações</a></li>
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
                    <div class="row panel panel-default">
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                    <?php
                                        if(isset($_SESSION['mensagem'])){
                                            echo $_SESSION['mensagem'];
                                            unset($_SESSION['mensagem']);
                                        }
                                    ?>
                                        <center>
                                            <h1 class="page-header">Lista de usuários </h1>
                                        </center>
                                        <div class="removeMessages"></div>
                                        <button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#cadastro" id="addMemberModalBtn"><span class="glyphicon glyphicon-plus-sign"></span>	Adicionar um novo usuário</button>
                                        <br /> <br /> <br />

                                        <table class="table table-striped table-bordered" id="usuarioTable">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Ativado</th>
                                                    <th>Nivel</th>
                                                    <th>CPF</th>
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

            <!-- modal de remover -->
            <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>Remover membro</h4>
                        </div>
                        <div class="modal-body">
                            <p>Você realmente deseja remover?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="removeBtn">Sim</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- /modal de remover -->

            <!-- modal de edição -->
            <div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Editar membro</h4>
                        </div>

                        <form class="form-horizontal" action="php_action/update.php" method="POST" id="updateMemberForm">

                            <div class="modal-body">

                                <div class="edit-messages"></div>

                                <div class="form-group">
                                    <!--/here teh addclass has-error will appear -->
                                    <label for="editName" class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="editName" name="editName" placeholder="Edite seu nome aqui">
                                        <!-- here the text will apper  -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editAddress" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="editAddress" name="editEmail" placeholder="Edite seu email aqui">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editActive" class="col-sm-2 control-label">Ativação/Desativação</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="editActive" id="editActive">
			      	                        <option value="">---------</option>
			      	                        <option value="1">Ativar</option>
			      	                        <option value="0">Desativar</option>
			                              </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer editMemberModal">
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
            <!-- /Modal de edição dos dados -->
            <!-- Modal de adição de usuários -->
            <div id="cadastro" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="cadastrar">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cadastrar Usuário</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="panel-heading">Cadastro de Usuário</div>
                                <div class="panel-body">
                                    <div class="container">
                                        <form action="cadastro.php" id="cadastro" role="form" data-toggle="validator" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                            <div id="smartwizard">
                                                <ul>
                                                    <li><a href="#step-1">Etapa 1<br /><small>Dados de acesso</small></a></li>
                                                    <li><a href="#step-2">Etapa 2<br /><small>Perfil</small></a></li>
                                                    <li><a href="#step-3">Etapa 3<br /><small>Permissões</small></a></li>
                                                    <li><a href="#step-4">Etapa 4<br /><small>Termos e Condições</small></a></li>
                                                </ul>
                                                <div>
                                                    <div id="step-1">
                                                        <h2>Seus dados de acesso</h2>
                                                        <div id="form-step-0" role="form" data-toggle="validator">
                                                            <div class="form-group">
                                                                <label for="email">Endereço de Email:</label>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Escreva o seu email aqui" required>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="senha">Senha:</label>
                                                                <div class=" row">
                                                                    <div class="form-group col-sm-6 ">
                                                                        <input type="password" data-minlength="6" class="form-control" name="senha" id="senha" placeholder="Escreva a sua senha" required>
                                                                        <div class="help-block with-errors">Digite no minimo 6 caracteres</div>
                                                                    </div>
                                                                    <div class="form-group  col-sm-6 ">
                                                                        <input type="password" class="form-control" id="csenha" data-match="#senha" data-match-error="Oops, senha de confirmação não corresponde a senha" placeholder="Confirme sua senha" required>
                                                                        <div class="help-block with-errors"></div>
                                                                    </div>
                                                                </div>
                                                                <br><br><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="step-2">
                                                        <h2>Seu perfil</h2>
                                                        <div id="form-step-1" role="form" data-toggle="validator">
                                                            <div class="form-group">
                                                                <label for="name">Nome:</label>
                                                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Escreva seu nome" required>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cpf">CPF:</label>
                                                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Escreva seu CPF" required>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <br><br><br>

                                                        </div>
                                                    </div>
                                                    <div id="step-3">
                                                        <h2>Nivel de Permissão</h2>
                                                        <div id="form-step-2" role="form" data-toggle="validator">
                                                            <div class="form-group">
                                                                <select name="perm" id="perm" class="form-control">
                                                                <option name="perm">----</option>
                                                                <option name='perm' value="1">Administrativo</option>
                                                                <option name='perm' value="0">Funcionário</option>
                                                            </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="step-4">
                                                        <h2>Termos e Condições</h2>
                                                        <p>Termos e Condições: Sorria para a condição :)</p>
                                                        <div id="form-step-3" role="form" data-toggle="validator">
                                                            <div class="form-group">
                                                                <label for="terms">Eu aceito os temos e condições propostas</label>
                                                                <input type="checkbox" id="terms" data-error="Porfavor aceite os termos para prosseguir com o cadastro" required>
                                                                <div class="help-block with-errors"></div>
                                                                <div id="alertaPerm" class="alert alert-warning alert-dismissible collapse" role="alert">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <strong>Atenção!</strong> Selecione a permissão do usuário
                                                                </div>
                                                                <br>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Modal de adição de usuários -->
        </div>
        <footer>
            <div class="pull-right"> Modelo Dashboard - Feito por <a href="#">..........</a> </div>
            <div class="clearfix"></div>
        </footer>
        <div class="container">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center">Deseja realmente sair?</h4>
                            </div>
                            <div class="modal-body">
                                <a href="../logout.php" class="btn btn-primary col-xs-12 col-md-12 col-sm-12 col-lg-12">Sim</a>
                                <button type="submit" value="entar" data-dismiss="modal" class="btn btn-danger col-xs-12 col-md-12 col-sm-12 col-lg-12" aria-label="Close">Não</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../vendors/jquery/jquery-3.2.0.min.js"></script>
        <script src="../../vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../build/js/custom.min.js"></script>
        <script src="../../vendors/Validator/validator.min.js"></script>
        <script type="text/javascript" src="../../vendors/SmartWizard-master/js/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="formularioCadastro.js"></script>
    </body>

    </html>
