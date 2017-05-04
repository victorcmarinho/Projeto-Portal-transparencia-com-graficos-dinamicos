<?php


function soma($numero1,$numero2='1')
{
    return $numero1 + $numero2;
}


function diferencaEntreDatas($datainicio,$datafim)
{
    $dtinicio  = strtotime($datainicio);
    $dtfim     = strtotime($datafim);
    if($dtfim > $dtinicio)
    {
        $diferenca = $dtfim - $dtinicio;
    }
    else
    {
        $diferenca = $dtinicio - $dtfim;
    }

    return ($diferenca / (60*60*24));
}
?>
