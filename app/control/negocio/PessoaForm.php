<?php
/**
 * PessoaForm Form
 * @version    1.0
 * @package    control/negocio
 * @author     brunosilva
 */
class PessoaForm extends TPage{
    private $form;

    public function __construct(){
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Pessoa');
        //$this->form->setPessoaValidation(true);

        $id = new TEntry('pessoa_id');        
        $nome = new TEntry('nome');
        $dataNascimento = new TEntry('data_nascimento');
        $genero = new TEntry('genero');
        $id->setEditable(FALSE);

        $this->form->addFields([new TLabel('Id')], [$id]);
        $this->form->addFields([new TLabel('Nome')], [$nome]);
        $this->form->addFields([new TLabel('Data de Nascimento')], [$dataNascimento]);
        $this->form->addFields([new TLabel('Gênero')], [$genero]);

        $nome->addValidation('Nome', new TRequiredValidator);

        $this->form->addAction( 'Salvar', new TAction([$this, 'onSave']), 'fa:save green' );
        $this->form->addActionLink( 'Limpar', new TAction([$this, 'onClear']), 'fa:eraser red' );

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        //$container->add($panel);
        
        parent::add($container);

    }

    public function onClear(){
        $this->form->clear(true);
    }

    public function onSave( $param ){
        try{
            TTransaction::open( 'permission' );
            $this->form->validate();

            $data = $this->form->getData();

            $pessoa = new Pessoa;
            $pessoa->fromArray((array) $data);
            $pessoa->store();

            $this->form->setData( $pessoa );

            new TMessage( 'info', 'Registro salvo com sucesso' );
            TTransaction::close();
        }catch( Exception $e ){
            new TMessage( 'error', $e->getMessage() );
            TTransaction::rollback();

        }
    }

    public function onEdit( $param ){
        try{
            TTransaction::open( 'permission' );

            if(isset($param['key'])){
                $key = $param['key'];
                $pessoa = new Pessoa( $key );
                $this->form->setData( $pessoa );

            }else{
                $this->form->clear(true);

            }

            TTransaction::close();
        }catch( Exception $e ){
            new TMessage( 'error', $e->getMessage() );
            TTransaction::rollback();
        }
    }
}
?>