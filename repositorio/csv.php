<?php
class csv{
    protected $arquivo;
    protected $header;
    protected $delimitador;
    protected $tamanho;
    public $dado;
    function __construct($file_name ,$delimiter="/t", $length=8000) {
        $this->arquivo = fopen($file_name, "r");
        $this->delimitador = $delimiter;
        $this->tamanho = $length;
    }
    function __destruct() {
        if ($this->arquivo) {
            fclose($this->arquivo);
        }
    }
    function getObject($max_lines=0) {
        $data = array();
        if ($max_lines > 0){
            $line_count = 0;
        }else{
            $line_count = -1;
        }
        while ($line_count < $max_lines && ($row = fgetcsv($this->arquivo, $this->tamanho, $this->delimitador)) !== FALSE) {
            $i=0;
            foreach($row as $row1){
                //echo utf8_decode($row1);
              $row[$i] = utf8_encode($row1);
                $i++;
            }
            $data[] = $row;
            if ($max_lines > 0) {
                $line_count++;
            }
        }
        $this->dado = $data;
        $this->formata();
        return $this->dado;
    }
    function mostra(){
        echo "<pre>";
        print_r($this->dado);
        echo "</pre>";
    }
    function formata(){
        array_shift($this->dado);
    }
    public function getDados(){
        return $this->dado;
    }
}
