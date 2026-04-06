<?php
/**
* Contato Active Record
* @version    1.0
* @package    model/negocio
* @author     brunosilva
* @since      04/04/2026
**/
class Contato extends TRecord{
    const TABLENAME = 'contato';
    const PRIMARYKEY = 'contato_id';
    const IDPOLICY = 'serial';

    private $pessoa;
    private $contatos;

    /**
     * Constructor method
     **/
    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('tipo');
        parent::addAttribute('valor');
        parent::addAttribute('pessoa_id');
    }

    /**
     * Method get_pessoa
     * Sample of usage: $contato->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa(){
        if( empty($this->pessoa) ){
            $this->pessoa = new Pessoa($this->pessoa_id);

        }

        return $this->pessoa;
    }

    /**
     * Method set_pessoa
     * Sample of usage: $contato->pessoa = $p;
     * @param $p Instance of Pessoa
     */
    public function set_pessoa( Pessoa $p ){
        $this->pessoa = $p;
    }




}
?>