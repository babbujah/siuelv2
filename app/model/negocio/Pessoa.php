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
    private $contatos;

    /**
     * Constructor method
     **/
    public function __construct($id = NULL, $callObjectLoad = TRUE){
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('nome');
        parent::addAttribute('data_nascimento');
        parent::addAttribute('genero');
        parent::addAttribute('logradouro');
        parent::addAttribute('numero');
        parent::addAttribute('bairro');
        parent::addAttribute('complemento');
        parent::addAttribute('cidade');
        parent::addAttribute('cep');
        parent::addAttribute('data_criacao');
        parent::addAttribute('data_modificacao');
    }

    /**
     * Method adicionarEndereco
     * Adiciona Endereco a uma Pessoa
     * @param $contato Instance of Contato
     */
    public function adicionarContato( Contato $c ){
        $this->contatos[] = $c;
    }

    /**
     * Method adicionarContato
     * Adiciona um contato a uma Pessoa
     * @param $contato Instance of Contato
     */
    public function adicionarContato( Contato $c ){
        $this->contatos[] = $c;
    }

    /**
     * Method getContatos
     * Retorna os contatos da Pessoa
     * @return Collection de Contatos
     */
    public function getContatos(){
        return $this->contatos;
    }

    /**
     * Reset aggregates
     */
    public function clearParts(){
        $this->contatos = array();
    }

    /**
     * Carrega a pessoa e seus contatos
     * @param $id object ID
     */
    public function load($id){
        // load contacts
        $this->contatos = Contato::where('pessoa_id', '=', $id)->load();
        
        // load the object itself
        return parent::load($id);
    }

    /**
     * Grava a pessoa e seus contatos
     */
    public function store(){
        // store the object itself
        parent::store();
        
        // delete contacts
        Contato::where('pessoa_id', '=', $this->pessoa_id)->delete();

        // save contacts
        if ($this->contatos){ 
            foreach ($this->contatos as $contact){
                unset($contact->id);
                $contact->pessoa_id = $this->pessoa_id;
                $contact->store();
            } 
        }
    }
    
    /**
     * Apaga o objeto e seus contatos
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        
        // delete contacts
        Contato::where('pessoa_id', '=', $id)->delete();
        
        // delete the object itself
        parent::delete($id);
    }





}
?>