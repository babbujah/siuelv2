<?php
/**
* Ramo Active Record
* @version    1.0
* @package    model/core
* @author     brunosilva
* @since      06/08/2026
**/
class Ramo extends TRecord{
    const TABLENAME  = 'ramo';
    const PRIMARYKEY = 'ramo_id';
    const IDPOLICY   = 'serial';
    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    public function __construct( $id = NULL, $callObjectLoad = TRUE ){
        parent::__construct( $id, $callObjectLoad );

        parent::addAttribute('nome');
        parent::addAttribute('sigla');
        parent::addAttribute('idade_minima');
        parent::addAttribute('idade_maxima');
        parent::addAttribute('cor');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');

    }
}
?>