<?php
header('Content-Type: text/html; charset=utf-8');
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
        if (!$this->mysqli->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $mysqli->error);
            exit();
        }
    }
     public function query($query){
        $res = mysqli_query($this->mysqli, $query);
        if(!$res){
            echo "Errormessage: %s\n".  $this->mysqli->error."<br>";
        }
        return $res;
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
                //$row["data"]= date('d/m/Y',strtotime($row["data"]));
                $myArray[] = $row;
            }
            return $myArray;
        }else{
            echo "0 results";
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
    public function graficoD ($query){
        if ($result = $this->query($query)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // O valor x é o tempo atual do JavaScript, que é o tempo Unix multiplicado por 1000.
                $row['data'] = date("d/m/Y", strtotime($row['data']));
                $row['data'] = strtotime($row['data'])*1000;
                $row["valor"]= floatval($row["valor"]);
                $myArray[] = [$row["data"],$row["valor"]];
            }
            echo $_GET['callback']. '('. json_encode($myArray) . ')';
        }
        return false;
    }
    public function graficoPie($query,$aplica){
        if($result =  $this->query($query)){
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $array[] = [$row[$aplica],floatval($row['SUM(valor)'])];
            }
           echo $_GET['callback']."(".json_encode( $array, JSON_UNESCAPED_UNICODE ).")";
        }
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

    public function alteraRegistro($valor,$set,$id){
        if(isset($_POST[$valor])){
            $valor = $_POST[$valor];
            $result=$this->query("UPDATE receita SET {$set} = '{$valor}' WHERE idreceita='{$id}';");
        }
    }
    public function opButton($sql,$name,$value){
        $result = $this->query($sql);
        echo "<select class='form-control' name='$name'>";
        echo "<option></option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row[$value]."'>$row[$value]</option>";
        }
        echo "</select>";
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

//        for($i = 0; $i < count($dados); $i++){
//            if($dados[$i][16]!=NULL){
//                $sql = "INSERT IGNORE INTO `subalinea` (`idsubalinea`) VALUES ('".$dados[$i][15]."');";
//                $this->query($sql);
//            }
//        }
        $this->query($sql);
        for ($i = 0; $i < count($dados); $i++) {

            $sql = "INSERT IGNORE INTO `alinea` (`idalinea`, `subalinea_idsubalinea`) VALUES ('".$dados[$i][14]."','".$dados[$i][15]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `subalinea` (`idsubalinea`) VALUES ('".$dados[$i][15]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `poder` (`idpoder`) VALUES ('".$dados[$i][6]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `aplicacao` (`idaplicacao`) VALUES ('".$dados[$i][8]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `orgao` (`id`, `descricao`) VALUES ('".$dados[$i][2]."','".$dados[$i][3]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `fonte_recurso` (`idfonte_recurso`) VALUES ('".$dados[$i][7]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `aplicacao_variavel` (`idaplicacao_variavel`) VALUES ('".$dados[$i][9]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `subcategoria` (`idsubcategoria`) VALUES ('".$dados[$i][11]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `categoria` (`idcategoria`, `subcategoria_idsubcategoria`) VALUES ('".$dados[$i][10]."', '".$dados[$i][11]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `fonte` (`idfonte`) VALUES ('".$dados[$i][12]."');";
            $this->query($sql);
            $sql = "INSERT IGNORE INTO `rubrica` (`idrubrica`) VALUES ('".$dados[$i][13]."');";
            $this->query($sql);
//            $sql = "INSERT IGNORE INTO `receita` (`idreceita`, `valor`, `categoria_idcategoria`, `aplicacao_idaplicacao`, `data`, `poder_idpoder`, `fonte_recurso_idfonte_recurso`, `aplicacao_variavel_idaplicacao_variavel`, `fonte_idfonte`, `rubrica_idrubrica`, `alinea_idalinea`, `ano_exe`, `mes_exe`, `orgao_id`) VALUES ('".$dados[$i][0]."', '".$dados[$i][16]."', '".$dados[$i][10]."', '".$dados[$i][8]."', '".$dados[$i][17]."','".$dados[$i][6]."','".$dados[$i][7]."','".$dados[$i][9]."','".$dados[$i][12]."','".$dados[$i][13]."','".$dados[$i][14]."', '".$dados[$i][1]."', '".$dados[$i][4]."', '".$dados[$i][2]."');";
             $sql = "INSERT IGNORE INTO `receita` (`idreceita`, `valor`, `categoria_idcategoria`, `aplicacao_idaplicacao`, `data`, `poder_idpoder`, `fonte_recurso_idfonte_recurso`, `aplicacao_variavel_idaplicacao_variavel`, `fonte_idfonte`, `rubrica_idrubrica`, `alinea_idalinea`, `orgao_id`) VALUES ('".$dados[$i][0]."', '".$dados[$i][16]."', '".$dados[$i][10]."', '".$dados[$i][8]."', '".$dados[$i][17]."','".$dados[$i][6]."','".$dados[$i][7]."','".$dados[$i][9]."','".$dados[$i][12]."','".$dados[$i][13]."','".$dados[$i][14]."','".$dados[$i][2]."');";
            $this->query($sql);

        }

    }
    public function  setDespesa($dados){

        for ($i = 0; $i < count($dados); $i++) {
            $sql = "INSERT IGNORE INTO `acao` (`idacao`, `nome`) VALUES ('".$dados[$i][16]."','".$dados[$i][17]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `programa` (`idprograma`, `nome`) VALUES ('".$dados[$i][14]."','".$dados[$i][15]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `tipo_despesa` (`idtipo_despesa`) VALUES ('".$dados[$i][6]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `modalidade` (`idmodalidade`) VALUES ('".$dados[$i][20]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `numero_empenho` (`numero`) VALUES ('".$dados[$i][7]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `elemento` (`idelemento`) VALUES ('".$dados[$i][21]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `sub_funcao` (`idsub_funcao`) VALUES ('".$dados[$i][13]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `funcao` (`idfuncao`, `sub_funcao_idsub_funcao`) VALUES ('".$dados[$i][12]."','".$dados[$i][13]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `pessoas` (`nome`, `cpfcnpj`) VALUES ('".$dados[$i][9]."', '".$dados[$i][8]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `aplicacao` (`idaplicacao`) VALUES ('".$dados[$i][19]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `fonte_recurso` (`idfonte_recurso`) VALUES ('".$dados[$i][18]."');";
            $this->query($sql);
            $sql= "INSERT IGNORE INTO `orgao` (`id`, `descricao`) VALUES ('".$dados[$i][2]."', '".$dados[$i][3]."');";
            $this->query($sql);
//            $sql= "INSERT IGNORE INTO `despesa` (`iddespesa`, `tipo_despesa_idtipo_despesa`, `numero_empenho_numero`, `pessoas_cpfcnpj`, `data`, `valor`, `funcao_idfuncao`, `programa_idprograma`, `acao_idacao`, `fonte_recurso_idfonte_recurso`, `aplicacao_idaplicacao`, `modalidade_idmodalidade`, `elemento_idelemento`, `historico`, `orgao_id`, `ano_exe`, `mes_exe`) VALUES ('".$dados[$i][0]."', '".$dados[$i][6]."', '".$dados[$i][7]."', '".$dados[$i][8]."', '".$dados[$i][10]."', '".$dados[$i][11]."', '".$dados[$i][12]."', '".$dados[$i][14]."', '".$dados[$i][16]."', '".$dados[$i][18]."', '".$dados[$i][19]."', '".$dados[$i][20]."', '".$dados[$i][21]."', '".$dados[$i][22]."', '".$dados[$i][2]."', '".$dados[$i][1]."', '".$dados[$i][4]."');";
            $sql= "INSERT IGNORE INTO `despesa` (`iddespesa`, `tipo_despesa_idtipo_despesa`, `numero_empenho_numero`, `pessoas_cpfcnpj`, `data`, `valor`, `funcao_idfuncao`, `programa_idprograma`, `acao_idacao`, `fonte_recurso_idfonte_recurso`, `aplicacao_idaplicacao`, `modalidade_idmodalidade`, `elemento_idelemento`, `historico`, `orgao_id`) VALUES ('".$dados[$i][0]."', '".$dados[$i][6]."', '".$dados[$i][7]."', '".$dados[$i][8]."', '".$dados[$i][10]."', '".$dados[$i][11]."', '".$dados[$i][12]."', '".$dados[$i][14]."', '".$dados[$i][16]."', '".$dados[$i][18]."', '".$dados[$i][19]."', '".$dados[$i][20]."', '".$dados[$i][21]."', '".$dados[$i][22]."', '".$dados[$i][2]."');";
            $this->query($sql);
        }
    }

}
?>
