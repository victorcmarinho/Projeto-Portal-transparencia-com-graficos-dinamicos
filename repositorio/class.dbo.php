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
     public function query($SELECT)
    {
        return mysqli_query($this->mysqli, $SELECT);
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
        for ($i = 0; $i < count($dados); $i++) {
           $sql = "INSERT INTO `receita` (`descricao`, `data`, `valor`) VALUES('".$dados[$i][0]."','".$dados[$i][1]."','".$dados[$i][2]."')";
           echo "$sql"."<br>";
           $this->query($sql);
        }
    }
    public function setDespesa() {

    }
}
?>
