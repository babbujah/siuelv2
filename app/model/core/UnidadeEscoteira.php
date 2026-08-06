<?php
/**
 * UnidadeEscoteira Active Record
 * @version    1.0
 * @package    model/core
 * @author     brunosilva
 * @since      06/08/2026
 */

class UnidadeEscoteira extends TRecord{
    const TABLENAME  = 'unidade_escoteira';
    const PRIMARYKEY = 'unidade_escoteira_id';
    const IDPOLICY   = 'serial';
    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    private $grupo;
    private $ramo;

    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('grupo_id');
        parent::addAttribute('ramo_id');
        parent::addAttribute('nome');
        parent::addAttribute('descricao');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    

    /**
     * Method get_grupo
     * Sample of usage: $unidadeEscoteira->grupo->attribute;
     * @returns Grupo instance
     */
    public function get_grupo(){
        if( empty($this->grupo) ){
            $this->grupo = new Grupo($this->grupo_id);
        }
    
        return $this->grupo;
    }

    /**
     * Method get_ramo
     * Sample of usage: $unidadeEscoteira->ramo->attribute;
     * @returns Ramo instance
     */
    public function get_ramo(){
        if( empty($this->ramo) ){
            $this->ramo = new Ramo($this->ramo_id);
        }

        return $this->ramo;
    }

    /**
     * Method set_grupo
     * Sample of usage: $unidadeEscoteira->grupo = $grupo;
     * @param $grupo Instance of Grupo
     */
    public function set_grupo(Grupo $grupo){
        $this->grupo = $grupo;
        $this->grupo_id = $grupo->grupo_id;
    }

    /**
     * Method set_ramo
     * Sample of usage: $unidadeEscoteira->ramo = $ramo;
     * @param $ramo Instance of Ramo
     */
    public function set_ramo(Ramo $ramo){
        $this->ramo = $ramo;
        $this->ramo_id = $ramo->ramo_id;
    }
}
?>