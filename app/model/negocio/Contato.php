<?php
/**
* Contato Active Record
* @version    1.0
* @package    model/negocio
* @author     brunosilva
* @since      04/04/2026
**/
class Contato extends TRecord{
    const TABLENAME = 'contato';
    const PRIMARYKEY = 'contato_id';
    const IDPOLICY = 'serial';

    /**
     * Constructor method
     **/
    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('telefone1');
        parent::addAttribute('telefone2');
        parent::addAttribute('email');
    }
}
?>