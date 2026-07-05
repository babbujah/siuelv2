<?php
/**
 * PessoaFormBase Abstract Class Form
 * @version    1.0
 * @package    control/cadastros
 * @author     brunosilva
 * @since      01/07/2026
 */

?>

abstract class PessoaFormBase extends TPage{
    protected $form;
    
    public function __construct(){
        parent::__construct();

    }

    /*protected function buildForm(){
        $this->form = new BootstrapFormBuilder('form_pessoa');

        // Pessoa
        $this->id = new TEntry('id');
        $this->nome = new TEntry('nome');

        // Contato
        $this->telefone = new TEntry('telefone');
        $this->email = new TEntry('email');

        // Endereço
        $this->logradouro = new TEntry('logradouro');
        $this->numero = new TEntry('numero');

        $this->form->addFields(
            [new TLabel('Nome')],
            [$this->nome]
        );

        $this->form->addFields(
            [new TLabel('Telefone')],
            [$this->telefone]
        );

        // save
        $this->form->addAction(
            _t('Save'),
            new TAction([$this, 'onSave']),
            'fa:save green'
        );

        $this->add($this->form);
    }*/

    /*public function onEdit($param){
        $key = $param['key'];

        $pessoa = new Pessoa;
        $pessoa = $pessoa->load($key);

        //$pessoa = new Pessoa($key);

        $this->form->setData(
            $pessoa->toFormData()
        );

    }*/

    /*public function onSave($param){
        try{
            TTransaction::open('siuel_negocio');

            $data = $this->form->getData();

            Pessoa::fromFormData($data)
                        ->saveComplete();

            TTransaction::close();

            $this->afterSave();

        }catch(Exception $e){
            new TMessage('error', $e->getMessage());
        }

    }*/

    //abstract protected function afterSave();
}