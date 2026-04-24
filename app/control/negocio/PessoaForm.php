<?php
/**
 * PessoaForm Form
 * @version    1.0
 * @package    control/negocio
 * @author     brunosilva
 * @since      04/04/2026
 */
class PessoaForm extends TPage{
    private $form;

    public function __construct(){
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('form_pessoa');
        $this->form->setFormTitle('Cadastro de Pessoa');
        $this->form->setClientValidation(true);

        $idPessoa = new TEntry('pessoa_id');
        $idPessoa->setSize('100%');
        $idPessoa->setEditable(FALSE);

        $nome = new TEntry('nome');
        $nome->setSize('100%');
        $nome->placeholder = 'Digite seu nome';
        $nome->addValidation('Nome', new TRequiredValidator);

        $dataNascimento = new TDate('dt_nascimento');
        $dataNascimento->setMask('dd/mm/yyyy');
        $dataNascimento->setDatabaseMask('yyyy-mm-dd');
        $dataNascimento->setSize('100%');
        $dataNascimento->setValue(date('Y-m-d'));
        $dataNascimento->addValidation('Data Nascimento', new TRequiredValidator);

        $genero = new TRadioGroup('genero');
        //$opcoes = ['M' => 'Masculino', 'F' => 'Feminino'];
        $genero->addItems(['M' => 'Masculino', 'F' => 'Feminino']);
        $genero->setLayout('horizontal');
        $genero->setUseButton();
        $genero->setValue('M');

        $idContato = new TEntry('contato_id');
        $idContato->setSize('100%');
        $idContato->setEditable(FALSE);

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

        $idEndereco = new THidden('endereco_id');
        $idEndereco->setSize('100%');
        $idEndereco->setEditable(FALSE);

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

        $this->form->addFields([new TLabel('ID'),$idPessoa],[new TLabel('GÊNERO'),NULL], [NULL,$genero]);
        $this->form->addFields([new TLabel('NASCIMENTO'), $dataNascimento],[new TLabel('NOME'), $nome]);
        
        $label = new TLabel('CONTATOS', 'var(--bs-secondary-color)', 12, 'bi');
        $label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->form->addContent( [$label] );
        
        $this->form->addFields([new TLabel('TELEFONE (OBRIGATÓRIO)')], [$telefone1],
                               [new TLabel('TELEFONE SECUNDÁRIO')], [$telefone2],
                               [new TLabel('EMAIL')], [$email]);

        $label = new TLabel('ENDEREÇO', 'var(--bs-secondary-color)', 12, 'bi');
        $label->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $this->form->addContent( [$label] );

        $this->form->addFields([new TLabel('CEP')], [$cep]);
        $this->form->addFields([new TLabel('LOGRADOURO')], [$logradouro],
                               [new TLabel('NÚMERO')], [$numero],
                               [new TLabel('COMPLEMENTO')], [$complemento]);
        $this->form->addFields([new TLabel('BAIRRO')], [$bairro],
                               [new TLabel('CIDADE')], [$cidade]);

        

        if( !empty($idPessoa) ){
            
        
            //$this->formEndereco

        }

        $this->form->addAction( 'Salvar', new TAction([$this, 'onSave']), 'fa:save green' );
        $this->form->addActionLink( 'Limpar', new TAction([$this, 'onClear']), 'fa:eraser red' );

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
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
}
?>