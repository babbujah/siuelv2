<?php
/**
 * PessoaResponsavel Active Record
 * @version    1.0
 * @package    model/core
 * @author     brunosilva
 * @since      06/08/2026
 */
class PessoaResponsavel extends TRecord{
    const TABLENAME  = 'pessoa_responsavel';
    const PRIMARYKEY = 'pessoa_responsavel_id';
    const IDPOLICY   = 'serial';

    const CREATEDAT  = 'data_criacao';
    const UPDATEDAT  = 'data_modificacao';

    private $membro_juvenil;
    private $responsavel;

    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('membro_juvenil_id');
        parent::addAttribute('responsavel_id');
        parent::addAttribute('parentesco');
        parent::addAttribute('responsavel_principal');
        parent::addAttribute('recebe_comunicado');
        parent::addAttribute('permite_saida');
        parent::addAttribute('status');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Method get_membro_juvenil
     * Sample of usage: $PessoaResponsavel->membro_juvenil->attribute;
     * @returns Pessoa instance
     */
    public function get_membro_juvenil(){
        if (empty($this->membro_juvenil)){
            $this->membro_juvenil = new Pessoa($this->membro_juvenil_id);
        }

        return $this->membro_juvenil;
    }

    /**
     * Method set_membro_juvenil
     * Sample of usage: $pessoaResponsavel->membro_juvenil = $membroJuvenil;
     * @param $pessoa Instance of Pessoa
     */
    public function set_membro_juvenil(Pessoa $pessoa){
        $this->membro_juvenil = $pessoa;
        $this->membro_juvenil_id = $pessoa->pessoa_id;
    }

    /**
     * Method get_responsavel
     * Sample of usage: $PessoaResponsavel->responsavel->attribute;
     * @returns Pessoa instance
     */
    public function get_responsavel(){
        if (empty($this->responsavel))
        {
            $this->responsavel = new Pessoa($this->responsavel_id);
        }

        return $this->responsavel;
    }

    /**
     * Method set_responsavel
     * Sample of usage: $pessoaResponsavel->responsavel = $pessoaResponsavel;
     * @param $pessoa Instance of Pessoa
     */
    public function set_responsavel(Pessoa $pessoa){
        $this->responsavel = $pessoa;
        $this->responsavel_id = $pessoa->pessoa_id;
    }
}