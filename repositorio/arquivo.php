<?php
function downloadArquivo($arquivo,$nome){
    $src = file_get_contents($arquivo);
    file_put_contents($nome, $src);
}
