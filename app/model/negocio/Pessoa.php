<?php
/**
* Pessoa Active Record
* @version    1.0
* @package    model/negocio
* @author     brunosilva
* @since      31/03/2026
**/
class Pessoa extends TRecord{
    const TABLENAME = 'pessoa';
    const PRIMARYKEY = 'pessoa_id';
    const IDPOLICY = 'serial';

    const CREATEDAT = 'data_criacao';
    const UPDATEDAT = 'data_modificacao';

    /**
     * Constructor method
     **/
    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('nome');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }


}
?>