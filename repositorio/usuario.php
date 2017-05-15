<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
  private $CI; // Receberá a instância do Codeigniter
  private $permissaoView = 'sem-permissao'; // Recebe o nome da view correspondente à página informativa de usuário sem permissão de acesso
  private $loginView = 'login'; // Recebe o nome da view correspondente à tela de login
  public function __construct(){
    /*
     * Criamos uma instância do CodeIgniter na variável $CI
     */
    $this->CI = &get_instance();
  }
  function CheckAuth($classe,$metodo)
  {
    /*
     * Pesquisa a classe e o método passados como parâmetro em CheckAuth
     */
    $array = array('classe' => $classe, 'metodo' => $metodo);
    $qryMetodos = $this->CI->db->where($array)->get('metodos');
    $resultMetodos = $qryMetodos->result();
    /*
     * Caso o método passado ainda não conste na tabela "metodos"
     * ele é inserido através de $this->CI->db->insert('metodos', $data);
     */
    if(count($resultMetodos)==0){
      $data = array(
        'classe' => $classe ,
        'metodo' => $metodo ,
        'identificacao' => $classe .  '/' . $metodo,
        'privado' => 1
      );
      $this->CI->db->insert('metodos', $data);
      redirect(base_url($classe . '/' . $metodo), 'refresh');
    }
    else{
      /*
       * Se o método ja existir na tabela, então recupera se ele é público ou privado
       * O método sendo público (0), então não verifica o login e libera o acesso
       * Mas se for privado (1) então é verificado o login e a permissão do usuário
       */
      if($resultMetodos[0]->privado==0){
        return false;
      }
      else{
        $nome = $this->CI->session->userdata('nome');
        $logged_in = $this->CI->session->userdata('logged');
        $data = $this->CI->session->userdata('data');
        $email = $this->CI->session->userdata('email');
        $id_usuario =  $this->CI->session->userdata('id_usuario');
        $id_metodo = $resultMetodos[0]->id;
        /*
         * Se o usuário estiver logado faz a verificação da permissão
         * caso contrário redireciona para uma tela de login
         */
        if($nome && $logged && $id_usuario){
          $array = array('id_metodo' => $id_metodo, 'id_usuario' => $id_usuario);
          $qryPermissoes = $this->CI->db->$this->CI->db->where($array)->get('permissoes');
          $resultPermissoes = $qryPermissoes->result();
          /*
           * Se o usuário não tiver a permissão para acessar o método,
           * ou seja, não estiver relacionado na tabela "permissoes",
           * ele deve ser redirecionado para uma tela informando que
           * não tem permissão de acesso;
           * caso contrário o acesso é liberado
           */
          if(count($resultPermissoes)==0){
            redirect($this->permissaoView, 'refresh');
          }
          else{
            return true;
          }
        }
        else{
          redirect($this->loginView, 'refresh');
        }
      }
    }
  }
}
/*
# Tabela que armazenará os métodos
CREATE TABLE `metodos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classe` varchar(50) DEFAULT NULL,
  `metodo` varchar(50) DEFAULT NULL,
  `identificacao` varchar(100) DEFAULT NULL,
  `privado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Tabela que armazenará as permissões dos cada usuário
CREATE TABLE `permissoes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_metodo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Tabela que armazenará os usuários
CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
