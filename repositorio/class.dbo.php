<?php
class DBO{
    protected $server;
    protected $user;
    protected $password;
    protected $bd;
    protected $connection;
    protected $mysqli;
    public function __construct($server, $user, $password, $bd){
        $this->server     = $server;
        $this->user       = $user;
        $this->password   = $password;
        $this->bd         = $bd;
        $this->connect();
    }
    private function connect(){
        #return  mysqli_connect($this->server,$this->user,$this->password,$this->bd);
        $this->mysqli = new mysqli($this->server, $this->user, $this->password, $this->bd);
    }
     public function query($query){
        return mysqli_query($this->mysqli, $query);
    }
    public function fetchRecords($RS)
    {
        return mysqli_fetch_array($RS);
    }
    public function numRows($RS)
    {
        return mysqli_num_rows($RS);
    }
   public function tabela ($query){
        if ($result = $this->query($query)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                //$row["valor"]= number_format($row["valor"],2,',',' ');
                $row["data"]= date('d/m/Y',strtotime($row["data"]));
                $myArray[] = $row;
            }
            return $myArray;
        }
    }
    public function grafico ($query){
        if ($result = $this->query($query)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // O valor x é o tempo atual do JavaScript, que é o tempo Unix multiplicado por 1000.
                $row['data'] = strtotime($row['data'])*1000;
                $row["valor"]= floatval($row["valor"]);
                $myArray[] = [$row["data"],$row["valor"]];
            }
            echo $_GET['callback']. '('. json_encode($myArray) . ')';
        }
        return false;
    }
    #INSERT
    public function incluiRegistro($tabela,$dados){
        #dados['campo'] = 'valor';
        $campos  = array_keys($dados);
        $valores = array_values($dados);
        $camposstrings='';
        $valoresstrings='';
        $INSERT = "INSERT INTO ".$tabela."(";
        foreach($campos as $campo){
            $camposstrings .= $campo.",";
        }
        $camposstrings = substr($camposstrings,0,-1);
        $INSERT .= $camposstrings.') VALUES (';
        foreach($valores as $valor){
            $valoresstrings .= "'".$valor."', ";
        }
        $valoresstrings = substr($valoresstrings,0,-2);
        $INSERT .= $valoresstrings . ')';
        echo $INSERT;
        $this->query($INSERT);
        return mysqli_insert_id($this->mysqli);
    }
    #UPDATE

    public function alteraRegistro($tabela, $id, $dados){
        $UPDATE = "UPDATE ".$tabela." SET ";
        foreach($dados as $campo => $valor){
            $ups .= $campo." = '".$valor."',";
        }
        $ups = substr($ups,0,-1);
        $UPDATE .= $ups." WHERE ".$tabela."_id = ".$id;
        return $this->query($UPDATE);
        //return $id;
    }

    #DELETE
    public function deletaRegistros($tabela,$id){
        $DELETE = "DELETE FROM ".$tabela." WHERE ".$tabela."_id = ".$id;
        $this->query($DELETE);
    }
    #Exclui usuário
    public function  deletaUsuario($id){
        $USUARIO = "UPDATE usuarios SET ativo=0 WHERE usuario_id =".$id.";";
        return $this->query($USUARIO);
    }
    public function recuperaUsuario($id){
        $USUARIO = "UPDATE usuarios SET ativo=1 WHERE usuario_id =".$id.";";
        return $this->query($USUARIO);
    }
    public function cadastraUsuarios($dados){
        $insert = "INSERT INTO usuarios(nome,email,senha,sexo,imagem,nivel,ativo) VALUES ("
                ."'".$dados['nome']."'". ","
                ."'".$dados['email']. "',"
                ."'".$dados['senha']. "',"
                ."'".$dados['sexo']. "',"
                ."'".$dados['imagem']. "',"
                ."'".$dados['nivel']. "',"
                ."'".$dados['ativo']."')";
        echo $insert;
        $this->query($insert);
        return mysqli_insert_id($this->mysqli);
    }
    public function setReceita($dados) {
        for($i = 0; $i < count($dados); $i++){
            if($dados[$i][16]!=NULL){
                $sql = "INSERT IGNORE INTO `subalinea` (`idsubalinea`) VALUES ('".$dados[$i][15]."');";
            }
        }
        $this->query($sql);

        for ($i = 0; $i < count($dados); $i++) {
            $sql = "INSERT IGNORE INTO `alinea` (`idalinea`, `subalinea_idsubalinea`) VALUES ('".$dados[$i][14]."','".$dados[$i][15]."');"
                    . "INSERT IGNORE INTO `poder` (`idpoder`) VALUES ('".$dados[$i][6]."');"
                    . "INSERT IGNORE INTO `aplicacao` (`idaplicacao`) VALUES ('".$dados[$i][8]."');"
                    . "INSERT IGNORE INTO `orgao` (`id`, `descricao`) VALUES ('".$dados[$i][2]."','".$dados[$i][3]."');"
                    . "INSERT IGNORE INTO `fonte_recurso` (`idfonte_recurso`) VALUES ('".$dados[$i][7]."');"
                    . "INSERT IGNORE INTO `aplicacao_variavel` (`idaplicacao_variavel`) VALUES ('".$dados[$i][9]."');"
                    . "INSERT IGNORE INTO `subcategoria` (`idsubcategoria`) VALUES ('".$dados[$i][11]."');"
                    . "INSERT IGNORE INTO `categoria` (`idcategoria`, `subcategoria_idsubcategoria`) VALUES ('".$dados[$i][10]."', '".$dados[$i][11]."');"
                    . "INSERT IGNORE INTO `fonte` (`idfonte`) VALUES ('".$dados[$i][12]."');"
                    . "INSERT IGNORE INTO `rubrica` (`idrubrica`) VALUES ('".$dados[$i][13]."');"
                    . "INSERT IGNORE INTO `receita` (`idreceita`, `valor`, `categoria_idcategoria`, `aplicacao_idaplicacao`, `data`, `poder_idpoder`, `fonte_recurso_idfonte_recurso`, `aplicacao_variavel_idaplicacao_variavel`, `fonte_idfonte`, `rubrica_idrubrica`, `alinea_idalinea`, `ano_exe`, `mes_exe`, `orgao_id`) VALUES ('".$dados[$i][0]."', '".$dados[$i][16]."', '".$dados[$i][10]."', '".$dados[$i][8]."', '".$dados[$i][17]."','".$dados[$i][6]."','".$dados[$i][7]."','".$dados[$i][9]."','".$dados[$i][12]."','".$dados[$i][13]."','".$dados[$i][14]."', '".$dados[$i][1]."', '".$dados[$i][4]."', '".$dados[$i][2]."');";
            echo "$sql"."<br>";
        }

           $this->query($sql);
    }
    public function  setDespesa($dados){
        for ($i = 0; $i < count($dados); $i++) {
            $sql = "INSERT INTO `acao` (`idacao`, `nome`) VALUES (,)"
                    . "INSERT INTO `programa` (`idprograma`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `tipo_despesa` (`idtipo_despesa`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `modalidade` (`idmodalidade`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `numero_empenho` (`numero`) VALUES ('')"
                    . "INSERT INTO `elemento` (`idelemento`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `sub_funcao` (`idsub_funcao`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `funcao` (`idfuncao`, `nome`, `sub_funcao_idsub_funcao`) VALUES ('', NULL, '')"
                    . "INSERT INTO `pessoas` (`nome`, `cpfcnpj`) VALUES (NULL, '')"
                    . "INSERT INTO `aplicacao` (`idaplicacao`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `fonte_recurso` (`idfonte_recurso`, `nome`) VALUES ('', NULL)"
                    . "INSERT INTO `exercicio` (`idexercicio`, `ano`, `mes`) VALUES ('', NULL, NULL)"
                    . "INSERT INTO `orgao` (`id`, `nome`, `descricao`, `exercicio_idexercicio`) VALUES ('', NULL, NULL, '')"
                    . "INSERT INTO `despesa` (`iddespesa`, `data`, `tipo_despesa_idtipo_despesa`, `pessoas_id`, `valor`, `funcao_idfuncao`, `pessoas_cpfcnpj`, `programa_idprograma`, `acao_idacao`, `elemento_idelemento`, `historico`, `fonte_recurso_idfonte_recurso`, `aplicacao_idaplicacao`, `numero_empenho_numero`, `modalidade_idmodalidade`, `orgao_id`) VALUES ('', NULL, '', '', NULL, '', '', '', '', '', NULL, '', '', '', '', '')";
        }
    }

}
?>
