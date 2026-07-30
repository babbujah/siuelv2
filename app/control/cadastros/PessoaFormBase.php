<?php
/**
 * PessoaFormBase Abstract Class Form
 * @version    1.0
 * @package    control/cadastros
 * @author     brunosilva
 * @since      01/07/2026
 */

abstract class PessoaFormBase extends TPage{
    protected $form;
    
    public function __construct(){
        parent::__construct();

        $this->createForm();

        $this->createPessoaFields();

        $this->createContatoSection();

        $this->createEnderecoSection();

        $this->createActions();

        $this->createContainer();

    }

    protected function createForm(){
        $this->form = new BootstrapFormBuilder('form_pessoa');
        $this->form->setFormTitle('Cadastro de Pessoa');
        $this->form->setClientValidation(true);
    }

    protected function createPessoaFields(){
        $idPessoa = new TEntry('pessoa_id');
        $idPessoa->setSize('100%');
        $idPessoa->setEditable(FALSE);

        $nome = new TEntry('nome');
        $nome->setSize('100%');
        $nome->placeholder = 'Digite seu nome';
        $nome->addValidation('Nome', new TRequiredValidator);

        $cpf = new TEntry('cpf');
        $cpf->setSize('100%');
        $cpf->placeholder = 'Digite o CPF';
        $cpf->setMask('999.999.999-99', true);

        $dataNascimento = new TDate('data_nascimento');
        $dataNascimento->setMask('dd/mm/yyyy');
        $dataNascimento->setDatabaseMask('yyyy-mm-dd');
        $dataNascimento->setSize('100%');
        $dataNascimento->setValue(date('Y-m-d'));
        $dataNascimento->addValidation('Data Nascimento', new TRequiredValidator);

        $genero = new TRadioGroup('genero');
        $genero->addItems(['M' => 'Masculino', 'F' => 'Feminino']);
        $genero->setLayout('horizontal');
        $genero->setUseButton();
        $genero->setValue('M');

        $tipoPessoa = new TCombo('tipo_pessoa');
        $tipoPessoa->setSize('100%');
        $tipoPessoa->addItems([
            'escotista' => 'Escotista',
            'jovem' => 'Jovem',
            'responsavel' => 'Responsável',
            'outro' => 'Outro'
        ]);

        $status = new TCombo('status');
        $status->setSize('100%');
        $status->addItems([
            1 => 'Ativo',
            2 => 'Inativo'
        ]);
        $status->setValue('1');

        $this->form->addFields(
            [new TLabel('ID')], [$idPessoa],
            [new TLabel('CPF')], [$cpf]
        );

        $this->form->addFields(
            [new TLabel('NOME')], [$nome],
            [new TLabel('NASCIMENTO')], [$dataNascimento]
        );

        $this->form->addFields(
            [new TLabel('GÊNERO')], [$genero],
            [new TLabel('TIPO')], [$tipoPessoa],
            [new TLabel('STATUS')], [$status]
        );
    }

    protected function createContatoSection(){
        $label = new TLabel('CONTATOS', 'var(--bs-secondary-color)', 12, 'bi');
        $label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->form->addContent( [$label] );
        $this->createContatoFields();
    }

    protected function createContatoFields(){
        $idContato = new THidden('contato_id');
        
        $telefone1 = new TEntry('telefone1');
        $telefone1->setSize('100%');
        $telefone1->placeholder = '(00) 00000-0000';
        $telefone1->setTip('Entre com o telefone principal');
        $telefone1->setMask('(99) 99999-9999', true);
        $telefone1->addValidation('Telefone 1', new TRequiredValidator);

        $telefone2 = new TEntry('telefone2');
        $telefone2->placeholder = '(00) 00000-0000';
        $telefone2->setTip('Entre com o telefone secundário');
        $telefone2->setSize('100%');
        $telefone2->setMask('(99) 99999-9999', true);

        $email = new TEntry('email');
        $email->setSize('100%');
        $email->placeholder = 'Entre com seu email';
        $email->addValidation('Email', new TEmailValidator);

        $this->form->addFields([$idContato]);
        $this->form->addFields([new TLabel('TELEFONE (OBRIGATÓRIO)')], [$telefone1]);
        $this->form->addFields([new TLabel('TELEFONE SECUNDÁRIO')], [$telefone2],
                               [new TLabel('EMAIL')], [$email]);
    }

    protected function createEnderecoSection(){
        $label = new TLabel('ENDEREÇO', 'var(--bs-secondary-color)', 12, 'bi');
        $label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->form->addContent( [$label] );
        $this->createEnderecoFields();
    }

    protected function createEnderecoFields(){
        $idEndereco = new THidden('endereco_id');
        
        $logradouro = new TEntry('logradouro');
        $logradouro->setSize('100%');
        $logradouro->placeholder = 'Entre com seu logradouro';

        $numero = new TEntry('numero');
        $numero->setSize('100%');
        $numero->placeholder = 'Entre com o número de sua residência';

        $bairro = new TEntry('bairro');
        $bairro->setSize('100%');
        $bairro->placeholder = 'Entre com seu bairro';

        $complemento = new TEntry('complemento');
        $complemento->setSize('100%');
        $complemento->placeholder = 'Entre com o complemento';

        $cidade = new TEntry('cidade');
        $cidade->setSize('100%');
        $cidade->placeholder = 'Entre com sua cidade';

        $cep = new TEntry('cep');
        $cep->setSize('100%');
        $cep->placeholder = 'Entre com seu CEP';
        $cep->setMask('99999-999');
        $cep->setExitAction(new TAction([$this, 'buscarCep']));

        $this->form->addFields([$idEndereco]);
        $this->form->addFields([new TLabel('CEP')], [$cep]);
        $this->form->addFields([new TLabel('LOGRADOURO')], [$logradouro],
                               [new TLabel('NÚMERO')], [$numero],
                               [new TLabel('COMPLEMENTO')], [$complemento]);
        $this->form->addFields([new TLabel('BAIRRO')], [$bairro],
                               [new TLabel('CIDADE')], [$cidade]);
    }

    protected function createActions(){
        $this->form->addAction(
                        _t('Save'),
                        new TAction([$this, 'onSave']),
                        'fa:save green'
        );

        $this->form->addActionLink(
                        _t('Clear'),
                        new TAction([$this, 'onClear']),
                        'fa:eraser red'
        );
        
        $this->createHeaderButtons();
    }

    protected function createContainer(){
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        //$container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add(new TXMLBreadCrumb('menu.xml', $this->getBreadCrumbClass()));
        $container->add($this->form);
        
        parent::add($container);
    }

    public static function buscarCep($param = null){
        /**
         * Arquivo usado: app/service/CepService.php
         */

        try{
            $logradouro = CepService::getCep($param['cep'], 'json');

            if(isset($logradouro->erro)){
                throw new Exception($logradouro->mensagem);
            }else{
                $dados = new stdClass();

                $dados->logradouro = $logradouro->logradouro;
                $dados->numero = $logradouro->complemento;
                $dados->bairro = $logradouro->bairro;
                $dados->cidade = $logradouro->localidade;
                $dados->estado = $logradouro->uf;

                TForm::sendData('form_pessoa', $dados);
                TScript::create('setTimeout(function() {$("input[name=\'numero\']").focus()}, 500);');
            }
        }catch(Exception $e){
            new TMessage('error', $e->getMessage());
        }
    }

    public function onSave( $param ){
        try{
            TTransaction::open( 'siuel_negocio' );

            $this->form->validate();
            $data = $this->form->getData();

            $pessoa = Pessoa::fromFormData( $data );
            $pessoa->saveComplete();

            // atualiza o formulário
            $this->updateFormData( $data, $pessoa );

            TTransaction::close();

            $this->afterSave( $pessoa );

        }catch( Exception $e ){
            TTransaction::rollback();

            $this->form->setData( $this->form->getData() );

            new TMessage( 'error', $e->getMessage() );

        }
    }

    public function onEdit( $param ){
        try{
            TTransaction::open( 'siuel_negocio' );

            // Identifica se deve abri lateral ou não
            if( !empty($param['target_container']) ){
                parent::setTargetContainer($param['target_container']);
            }

            if(isset($param['key'])){
                $key = $param['key'];

                $pessoa = new Pessoa( $key );

                $data = $pessoa->toFormData();

                $this->form->setData( $data );

            }else{
                $this->form->clear(true);

            }

            TTransaction::close();
        }catch( Exception $e ){
            TTransaction::rollback();
            $this->form->setData( $this->form->getData() );
            new TMessage( 'error', $e->getMessage() );
        }
    }

    public function onClear( $param ){
        $this->form->clear(true);
    }

    protected function updateFormData( $data, Pessoa $pessoa ){
        $data->pessoa_id = $pessoa->pessoa_id;

        if( $pessoa->contato instanceof Contato ){
            $data->contato_id = $pessoa->contato->contato_id;
        }

        if( $pessoa->endereco instanceof Endereco ){
            $data->endereco_id = $pessoa->endereco->endereco_id;
        }

        $this->form->setData( $data );
    }

    protected function getBreadCrumbClass(){
        return 'PessoaForm';
    }
    
    abstract protected function afterSave( Pessoa $pessoa );

    abstract protected function createHeaderButtons();
}