<?php
/**
 * Vinculo Active Record
 * @version    1.0
 * @package    model/core
 * @author     brunosilva
 * @since      06/08/2026
 */
class Vinculo extends TRecord{
    const TABLENAME  = 'vinculo';
    const PRIMARYKEY = 'vinculo_id';
    const IDPOLICY   = 'serial';

    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    private $pessoa;
    private $grupo;
    private $ramo;
    private $unidade_escoteira;
    private $equipe;
    private $cargo;

    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('pessoa_id');
        parent::addAttribute('grupo_id');
        parent::addAttribute('ramo_id');
        parent::addAttribute('unidade_escoteira_id');
        parent::addAttribute('equipe_id');
        parent::addAttribute('cargo_id');
        parent::addAttribute('usuario_responsavel_id');
        parent::addAttribute('data_inicio');
        parent::addAttribute('data_fim');
        parent::addAttribute('status');
        parent::addAttribute('motivo_encerramento');
        parent::addAttribute('observacao');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Method get_pessoa
     * Sample of usage: $vinculo->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa(){
        if (empty($this->pessoa)){
            $this->pessoa = new Pessoa($this->pessoa_id);
        }

        return $this->pessoa;
    }

    /**
     * Method set_pessoa
     * Sample of usage: $vinculo->pessoa = $pessoa;
     * @param $pessoa Instance of Pessoa
     */
    public function set_pessoa(Pessoa $pessoa){
        $this->pessoa = $pessoa;
        $this->pessoa_id = $pessoa->pessoa_id;
    }

    /**
     * Method get_grupo
     * Sample of usage: $vinculo->grupo->attribute;
     * @returns GrupoEscoteiro instance
     */
    public function get_grupo(){
        if (empty($this->grupo)){
            $this->grupo = new GrupoEscoteiro($this->grupo_id);
        }

        return $this->grupo;
    }

    /**
     * Method set_grupo
     * Sample of usage: $vinculo->grupo = $grupo;
     * @param $grupo Instance of GrupoEscoteiro
     */
    public function set_grupo(GrupoEscoteiro $grupo){
        $this->grupo = $grupo;
        $this->grupo_id = $grupo->grupo_id;
    }

    /**
     * Method get_ramo
     * Sample of usage: $vinculo->ramo->attribute;
     * @returns Ramo instance
     */
    public function get_ramo(){
        if (empty($this->ramo)){
            $this->ramo = new Ramo($this->ramo_id);
        }

        return $this->ramo;
    }

    /**
     * Method set_ramo
     * Sample of usage: $vinculo->ramo = $ramo;
     * @param $ramo Instance of Ramo
     */
    public function set_ramo(Ramo $ramo){
        $this->ramo = $ramo;
        $this->ramo_id = $ramo->ramo_id;
    }

    /**
     * Method get_unidade_escoteira
     * Sample of usage: $vinculo->unidade_escoteira->attribute;
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
     * Sample of usage: $vinculo->unidade_escoteira = $unidade;
     * @param $unidade Instance of UnidadeEscoteira
     */
    public function set_unidade_escoteira(UnidadeEscoteira $unidade){
        $this->unidade_escoteira = $unidade;
        $this->unidade_escoteira_id = $unidade->unidade_escoteira_id;
    }

    /**
     * Method get_equipe
     * Sample of usage: $vinculo->equipe->attribute;
     * @returns Equipe instance
     */
    public function get_equipe(){
        if (empty($this->equipe)){
            $this->equipe = new Equipe($this->equipe_id);
        }

        return $this->equipe;
    }

    /**
     * Method set_equipe
     * Sample of usage: $vinculo->equipe = $equipe;
     * @param $equipe Instance of Equipe
     */
    public function set_equipe(Equipe $equipe){
        $this->equipe = $equipe;
        $this->equipe_id = $equipe->equipe_id;
    }

    /**
     * Method get_cargo
     * Sample of usage: $vinculo->cargo->attribute;
     * @returns Cargo instance
     */
    public function get_cargo(){
        if (empty($this->cargo)){
            $this->cargo = new Cargo($this->cargo_id);
        }

        return $this->cargo;
    }

    /**
     * Method set_cargo
     * Sample of usage: $vinculo->cargo = $cargo;
     * @param $cargo Instance of Cargo
     */
    public function set_cargo(Cargo $cargo){
        $this->cargo = $cargo;
        $this->cargo_id = $cargo->cargo_id;
    }
}