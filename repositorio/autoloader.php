<?php
namespace repositorio;
class ClassLoader{
    protected $prefixes = array();
    public function register(){
        spl_autoload_register(array($this,'loadClass'));
    }
    public function addNamespace($prefix,$bas_dir,$prepend =false){
    }
    public function loadClass($class){
    }
}
