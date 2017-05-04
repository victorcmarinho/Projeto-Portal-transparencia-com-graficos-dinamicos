<?php
class Form extends Element{
    protected   $fields;
    protected   $actions;
    protected   $table;
    private     $has_action;
    private     $actions_container;
    public function _construct($name='my_form'){
        parent::_construct('form');
        $this->enctype = "multipart/form-data";
        $this->method = 'post';
        $this->setName($name);
        $this->table = new Table;
        $this->table->width = '100%';
        parent::add($this->table);
    }
    public function setName($name){
        $this->name= $name;
    }
    public function getName(){
        return $this->name;
    }
}
