<?php
/**
 * Cargo Active Record
 * @version    1.0
 * @package    model/core
 * @author     brunosilva
 * @since      06/08/2026
 */
class Cargo extends TRecord{
    const TABLENAME  = 'cargo';
    const PRIMARYKEY = 'cargo_id';
    const IDPOLICY   = 'serial';

    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('nome');
        parent::addAttribute('categoria');
        parent::addAttribute('descricao');
        parent::addAttribute('area');
        parent::addAttribute('nivel_permissao');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }
}