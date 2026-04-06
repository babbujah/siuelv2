<?php
/**
 * PessoaForm Form
 * @version    1.0
 * @package    control/negocio
 * @author     brunosilva
 */
class PessoaForm extends TPage{
    private $formPessoal;
    private $formContato;

    public function __construct(){
        parent::__construct();
        
        $this->formPessoal = new BootstrapFormBuilder('form_pessoal');
        $this->formPessoal->setFormTitle('Cadastro de Pessoa');
        $this->formPessoal->setClientValidation(true);

        $idPessoa = new TEntry('pessoa_id');
        $idPessoa->setSize('100%');
        $idPessoa->setEditable(FALSE);

        $nome = new TEntry('nome');
        $nome->setSize('100%');

        $dataNascimento = new TDate('dt_nascimento');
        $dataNascimento->setMask('dd/mm/yyyy');
        $dataNascimento->setDatabaseMask('yyyy-mm-dd');
        $dataNascimento->setSize('100%');
        $dataNascimento->setValue('Y-m-d');

        $genero = new TRadioGroup('genero');
        //$opcoes = ['M' => 'Masculino', 'F' => 'Feminino'];
        $genero->addItems(['M' => 'Masculino', 'F' => 'Feminino']);
        $genero->setLayout('horizontal');
        //$genero->setUseButton();
        $genero->setValue('M');

        $idEndereco = new THidden('endereco');



        $this->formPessoal->addFields([new TLabel('id')], [$idPessoa]);
        $this->formPessoal->addFields([new TLabel('Nome')], [$nome]);
        $this->formPessoal->addFields([new TLabel('Data de Nascimento')], [$dataNascimento]);
        $this->formPessoal->addFields([new TLabel('Gênero')], [$genero]);

        $nome->addValidation('Nome', new TRequiredValidator);

        if( !empty($idPessoa) ){
            
        
            //$this->formEndereco

        }

        $this->formPessoal->addAction( 'Salvar', new TAction([$this, 'onSave']), 'fa:save green' );
        $this->formPessoal->addActionLink( 'Limpar', new TAction([$this, 'onClear']), 'fa:eraser red' );

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->formPessoal);
        
        parent::add($container);

    }

    public function onClear( $param ){
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