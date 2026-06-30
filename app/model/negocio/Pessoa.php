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
        parent::addAttribute('cpf');
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
     * Carrega os dados do relacionamento
     * @param $id Pessoa ID
     */
    public function load($id){
        
        // carrega a pessoa
        $object = parent::load($id);

        if( $object ){
            // carregar relacionamentos
            $this->endereco = Endereco::where('pessoa_id', '=', $id)->first();
            $this->contato = Contato::where('pessoa_id', '=', $id)->first();

        }

        // Carrega o endereço
        return $object;
    }

    /**
     * Grava a pessoa e suas composições; contato e endereço
     */
    public function store(){
        // grava o objeto
        parent::store();

        // Endereço
        if( $this->endereco instanceof Endereco ){
            $this->endereco->pessoa_id = $this->pessoa_id;
            $this->endereco->store();
        }

        // Contato
        if( $this->contato instanceof Contato ){
            $this->contato->pessoa_id = $this->pessoa_id;
            $this->contato->store();
        }
    }

    /**
     * Method saveComplete
     * Faz validações e grava objeto Pessoa
     * 
     * returns object
     */
    public function saveComplete(){
        $this->store();

        return $this;

    }

    /**
     * Apaga a pessoa e suas agregações
     * @param $id pessoa ID
     */
    public function delete($pessoa_id = NULL){
        // apaga a pessoa e seu contato e endereço
        if(!empty($pessoa_id)){

            // remove depencias
            Endereco::where('pessoa_id', '=', $pessoa_id )->delete();
            Contato::where('pessoa_id', '=', $pessoa_id)->delete();
            
            //remove pessoa
            parent::delete($pessoa_id);
        }
        
    }

    /**
     * Method get_contato
     * Sample of usage: $pessoa->contato->attribute;
     * @returns Contato instance
     */
    public function get_contato(){
        if( empty($this->contato) ){
            $this->contato = Contato::where('pessoa_id', '=', $this->pessoa_id)->first();
        }
    
        return $this->contato;
    }

    /**
     * Method get_endereco
     * Sample of usage: $pessoa->endereco->attribute;
     * @return Endereco instance
     */
    public function get_endereco(){
        if( empty($this->endereco) ){
            $this->endereco = Endereco::where('pessoa_id', '=', $this->pessoa_id)->first();
        }
    
        return $this->endereco;
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
     * Method set_endereco
     * Sample of usage: $pessoa->endereco = $endereco;
     * @param $e Instance of Endereco
     */
    public function set_endereco( Endereco $e ){
        $this->endereco = $e;
        $this->endereco_id = $e->endereco_id;
    }

    /**
     * Method helper toFormData
     * Get date for load object Pessoa
     * Adapt date to form format
     * @return stdClass $data contenting Pessoa
     */
    public function toFormData(){
        $data = new stdClass;

        // dados de pessoa
        $data->pessoa_id = $this->pessoa_id;
        $data->nome = $this->nome;
        $data->cpf = $this->cpf;
        $data->data_nascimento = $this->data_nascimento;
        $data->genero = $this->genero;
        $data->tipo_pessoa = $this->tipo_pessoa;
        $data->status = $this->status;

        // contato
        if( !empty($this->contato) ){
            $data->contato_id = $this->contato->contato_id ?? null;
            $data->telefone1 = $this->contato->telefone1 ?? null;
            $data->telefone2 = $this->contato->telefone2 ?? null;
            $data->email = $this->contato->email ?? null;

        }

        // endereço
        if( !empty($this->endereco) ){
            $data->endereco_id = $this->endereco->endereco_id ?? null;
            $data->logradouro = $this->endereco->logradouro ?? null;
            $data->numero = $this->endereco->numero ?? null;
            $data->complemento = $this->endereco->complemento ?? null;
            $data->cidade = $this->endereco->cidade ?? null;
            $data->cep = $this->endereco->cep ?? null;
        }

        return $data;
    }

    /**
     * Method helper applySmartUpdate
     * Atualiza apenas os campos alterados
     * Se o novo valor for vazio, limpa o campo.
     * 
     * @param object $object
     * @param object $data
     * @param array $fields
     * 
     * @return $object
     */    
    private static function applySmartUpdate( $object, $data, array $fields ){
        foreach( $fields as $field ){
            $valorNovo = $data->$field ?? null;
            $valorAtual = $object->$field ?? null;

            // Com alteração
            if( $valorNovo !== $valorAtual ){
                // valor vazio | remove
                if( $valorNovo === '' || $valorNovo === null ){
                    $object->$field = null;

                }else{
                    $object->$field = $valorNovo;

                }
            }
        }

        return $object;
    }

    /**
     * Method helper fromFormData
     * Captura dados do formulário
     * 
     * @param object $data
     * 
     * @return $object
     */  
    public static function fromFormData($data){
        // Pessoa
        if( !empty($data->pessoa_id) ){
            $pessoa = new Pessoa($data->pessoa_id);

        }else{
            $pessoa = new Pessoa;

        }

        self::applySmartUpdate( $pessoa, $data, [
            'nome',
            'cpf',
            'data_nascimento',
            'genero',
            'tipo_pessoa',
            'status'
        ] );

        // Contato
        if( !empty($data->contato_id) ){
            $contato = new Contato( $data->contato_id );

        }else if(!empty($data->pessoa_id)){
            // reaproveita contato existente
            $contato = Contato::where('pessoa_id', '=', $data->pessoa_id)->first();

            if( !$contato ){
                $contato = new Contato;

            }

        }else{
            $contato = new Contato;

        }

        self::applySmartUpdate( $contato, $data, [
            'telefone1',
            'telefone2',
            'email'
        ] );

        // Endereco
        if( !empty($data->endereco_id) ){
            $endereco = new Endereco( $data->endereco_id );
        
        }else if( !empty($data->pessoa_id) ){
            // reaproveita endereço existente
            $endereco = Endereco::where( 'pessoa_id', '=', $data->pessoa_id )->first();

            if( !$endereco ){
                $endereco = new Endereco;

            }

        }else{
            $endereco = new Endereco;

        }

        self::applySmartUpdate( $endereco, $data, [
            'logradouro',
            'numero',
            'bairro',
            'complemento',
            'cidade',
            'cep'
        ] );
        
        // Relacionamento
        $pessoa->contato = $contato;
        $pessoa->endereco = $endereco;

        return $pessoa;
    }
    
    
}
?>