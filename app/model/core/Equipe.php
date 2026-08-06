<?php
/**
 * Equipe Active Record
 * @version    1.0
 * @package    model/core
 * @author     brunosilva
 * @since      06/08/2026
 */
class Equipe extends TRecord{
    const TABLENAME  = 'equipe';
    const PRIMARYKEY = 'equipe_id';
    const IDPOLICY   = 'serial';

    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    private $unidade_escoteira;

    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('unidade_escoteira_id');
        parent::addAttribute('nome');
        parent::addAttribute('descricao');
        parent::addAttribute('tipo');
        parent::addAttribute('cor');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Method get_unidade_escoteira
     * Sample of usage: $Equipe->unidade_escoteira->attribute;
     * @returns UnidadeEscoteira instance
     */
    public function get_unidade_escoteira(){
        if (empty($this->unidade_escoteira)){
            $this->unidade_escoteira = new UnidadeEscoteira($this->unidade_escoteira_id);
        }

        return $this->unidade_escoteira;
    }

    /**
     * Method set_unidade_escoteira
     * Sample of usage: $equipe->unidade_escoteira = $unidadeEscoteira;
     * @param $unidade Instance of UnidadeEscoteira
     */
    public function set_unidade_escoteira(UnidadeEscoteira $unidade){
        $this->unidade_escoteira = $unidade;
        $this->unidade_escoteira_id = $unidade->unidade_escoteira_id;
    }
}