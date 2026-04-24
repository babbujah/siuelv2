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

    private $endereco;
    private $contato;

    /**
     * Constructor method
     **/
    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('nome');
        parent::addAttribute('data_nascimento');
        parent::addAttribute('genero');        
        parent::addAttribute('endereco_id');
        parent::addAttribute('contato_id');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Method get_contato
     * Sample of usage: $pessoa->contato->attribute;
     * @returns Contato instance
     */
    public function get_contato(){
        if( empty($this->contato) ){
            $this->contato = new Contato($this->contato_id);
        }
    
        return $this->contato;
    }

    /**
     * Method set_contato
     * Sample of usage: $pessoa->contato = $contato;
     * @param $c Instance of Contato
     */
    public function set_contato( Contato $c ){
        $this->contato = $c;
        $this->contato_id = $c->contato_id;
    }

    /**
     * Method get_endereco
     * Sample of usage: $pessoa->endereco->attribute;
     * @returns Endereco instance
     */
    public function get_endereco(){
        if( empty($this->endereco) ){
            $this->endereco = new Endereco($this->endereco_id);
        }
    
        return $this->endereco;
    }

    /**
     * Method set_endereco
     * Sample of usage: $pessoa->endereco = $endereco;
     * @param $e Instance of Endereco
     */
    public function set_endereco( Endereco $e ){
        $this->endereco = $e;
        $this->endereco_id = $e->endereco_id;
    }
}
?>