<?php
class csv{
    protected $arquivo;
    protected $parse_header;
    protected $header;
    protected $delimitador;
    protected $tamanho;
    public $dado;
    function __construct($file_name ,$delimiter="/t",$parse_header=false, $length=8000) {
        $this->arquivo = fopen($file_name, "r");
        $this->parse_header = $parse_header;
        $this->delimitador = $delimiter;
        $this->tamanho = $length;
        if ($this->parse_header) {
           $this->header = fgetcsv($this->arquivo, $this->tamanho, $this->delimitador);
        }
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
            if ($this->parse_header){
                foreach ($this->header as $i => $heading_i) {
                    $row_new[$heading_i] = $row[$i];
                }
                $data[] = $row_new;
            }
            else {
                $data[] = $row;
            }
            if ($max_lines > 0) {
                $line_count++;
            }
        }
        $this->dado = $data;
        $this->formata($this->dado);
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
}
