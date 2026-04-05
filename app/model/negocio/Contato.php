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

    const CREATEDAT = 'data_criacao';
    const UPDATEDAT = 'data_modificacao';

    private $pessoa;

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
     * Get Pessoa method
     * 
     * @return pessoa
     */
    public function get_pessoa(){
        if( empty($this->pessoa) ){
            $this->pessoa = new Pessoa($this->pessoa_id);

        }

        return $this->pessoa;
    }

    /**
     * Set Pessoa method
     * 
     * @param $pessoa Pessoa
     */
    public function set_pessoa( $pessoa ){
        $this->pessoa = $pessoa;
    }


}
?>