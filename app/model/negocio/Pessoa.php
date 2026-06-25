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
        parent::addAttribute('tipo_pessoa');
        parent::addAttribute('status');     
        //parent::addAttribute('endereco_id');
        //parent::addAttribute('contato_id');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Carrega a pessoa e suas composiçoes; contatos e endereço
     * @param $id Pessoa ID
     */
    public function load($id){

        $this->endereco = parent::loadComposite('Endereco', 'pessoa_id', $id);
        $this->contato = parent::loadComposite('Contato', 'pessoa_id', $id);

        // Carrega o endereço
        return parent::load($id);
    }

    /**
     * Grava a pessoa e suas composições; contato e endereço
     */
    public function store(){
        // grava o objeto
        parent::store();

        if( $this->endereco instanceof Endereco ){
            $this->endereco->pessoa_id = $this->pessoa_id;
            $this->endereco->store();
        }

        if( $this->contato instanceof Contato ){
            $this->contato->pessoa_id = $this->pessoa_id;
            $this->contato->store();
        }

    }

    /**
     * Apaga a pessoa e suas agregações
     * @param $id pessoa ID
     */
    public function delete($id = NULL){
        // apaga a pessoa e seu contato e endereço
        if(!empty($id)){
            Endereco::delete($id);
            Contato::deleto($id);
            
            parent::delete($id);
        }
        
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