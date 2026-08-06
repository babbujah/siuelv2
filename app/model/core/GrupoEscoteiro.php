<?php
/**
* GrupoEscoteiro Active Record
* @version    1.0
* @package    model/core
* @author     brunosilva
* @since      06/08/2026
**/
class GrupoEscoteiro extends TRecord{
    const TABLENAME  = 'grupo_escoteiro';
    const PRIMARYKEY = 'grupo_id';
    const IDPOLICY   = 'serial';
    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('numero');
        parent::addAttribute('nome');
        parent::addAttribute('registro_ueb');
        parent::addAttribute('distrito');
        parent::addAttribute('data_fundacao');
        parent::addAttribute('cidade');
        parent::addAttribute('uf');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }
}
?>