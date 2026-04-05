<?php
/**
 * PessoaTraitForm Form
 * @version    1.0
 * @package    control/negocio
 * @author     brunosilva
 */
class PessoaTraitForm extends TPage{
    private $form;

    use Adianti\Base\AdiantiStandardFormTrait;

    public function __construct(){
        parent::__construct();
        parent::add( new TLabel('Teste') );

        $this->setDatabase('permission');
        $this->setActiveRecord('Pessoa');
        
        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Pessoa');
        $this->form->setClientValidation(true);

        $id = new TEntry('pessoa_id');
        $id->setEditable(FALSE);

        $nome = new TEntry('nome');
        $dataNascimento = new TEntry('data_nascimento');
        $genero = new TEntry('genero');

        $this->form->addFields([new TLabel('Id')], [$id]);
        $this->form->addFields([new TLabel('Nome')], [$nome]);
        $this->form->addFields([new TLabel('Data de Nascimento')], [$dataNascimento]);
        $this->form->addFields([new TLabel('Gênero')], [$genero]);

        $nome->addValidation('Nome', new TRequiredValidator);

        $this->form->addAction( 'Salvar', new TAction([$this, 'onSave']), 'fa:save green' );
        $this->form->addActionLink( 'Limpar', new TAction([$this, 'onClear']), 'fa:eraser red' );

        parent::add($this->form);

    }
}
?>