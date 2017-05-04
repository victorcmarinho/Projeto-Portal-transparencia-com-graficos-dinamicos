<?php


#funcao pre (escreve tag pre dentro do print_r)
function pre($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


#transforma data mysql para data "brasileira"
#aaaa-mm-dd
function data($data)
{
    $explode = explode('-',$data);
    return $explode[2].'/'.$explode[1].'/'.$explode[0];

}

#transforma datahora mysql para datahora "brasileira"
#aaaa-mm-dd HH:ii:ss
function dataHora($data)
{
    $explode1 = explode(' ',$data);

    return data($explode1[0]).' '.$explode1[1];
}

?>
