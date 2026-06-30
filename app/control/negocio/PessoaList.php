<?php
/**
 * Classe que representa a listagem de Pessoas
 * PessoaList Listing
 * 
 * @version     1.0
 * @package     control/negocio
 * @author      Bruno Lopes
 * @since       10/05/2026
 */
class PessoaList extends TPage{
    private $form; //form
    private $datagrid; //listing
    private $pageNavigation;
    private $loaded;
    
    /**
     * Class constructor
     * Creates the page, the forme and the listing
     */
    public function __construct(){
        parent::__construct();

        /**
         * Creates form filter
         */
        $this->form = new BootstrapFormBuilder('form_search_pessoalist');
        $this->form->setFormTitle('<i class="fas fa-clipboard fa-fw"></i> Filtro de Pessoas');

        // Campos de filtro
        $nome = new TEntry('nome');
        $cpf = new TEntry('cpf');

        $tipo = new TCombo('tipo_pessoa');
        $tipo->addItems([
            'escotista' => 'Escotista',
            'jovem' => 'Jovem',
            'responsavel' => 'Responsável'
        ]);
        
        $status = new TCombo('status');
        $status->addItems([
            'ativo' => 'Ativo',
            'inativo' => 'Inativo'
        ]);

        // Grid de campos
        $this->form->addFields(
            [new TLabel('Nome')], [$nome],
            [new TLabel('CPF')], [$cpf]
        );

        $this->form->addFields(
            [new TLabel('Tipo')], [$tipo],
            [new TLabel('Status')], [$status]
        );

        // Ações
        $this->form->addAction(_t('New'), new TAction(['PessoaForm', 'onEdit']), 'fa:plus green');
        $this->form->addAction(_t('Find'), new TAction([$this, 'onSearch']), 'fa:search blue');
        $this->form->addAction(_t('Clear'), new TAction([$this, 'onClear']), 'fa:eraser red');

        // Melhor UX        
        $data = TSession::getValue('pessoa_filter_data');
        if ($data) {
            $this->form->setData($data);
        }

        /**
         * DATAGRID
         */
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        //$this->datagrid->enablePopover('Hint', 'Tipo de endereço para <b>{}</b>');
        //$this->datagrid->disableDefaultClick();

        // Colunas
        $col_id = new TDataGridColumn('pessoa_id', 'Código', 'center', '10%');
        $col_nome = new TDataGridColumn('nome', 'Nome', 'left', '30%');
        
        $col_tipo = new TDataGridColumn('tipo_pessoa', 'Tipo', 'center', '20%');
        $col_tipo->setTransformer(function($value){
            $map = [
                'escotista' => 'primary',
                'jovem' => 'success',
                'responsavel' => 'warning'

            ];

            $classe = $map[$value] ?? 'secondary';

            return "<span class='badge bg-{$classe}'>" . ucfirst($value) . "</span>";
        });
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_tipo);

        /**
         * Painel Lateral
         */
        //$this->datagrid->setRowAction(new TDataGridAction([$this, 'onEdit']));
        $action_view = new TDataGridAction([$this, 'onEdit']);
        $action_view->setField('pessoa_id');
        
        // Obrigatório para o TScrip
        $this->datagrid->addAction($action_view);

        /**
         * Ações padrão
         */
        $action_delete = new TDataGridAction([$this, 'onDelete']);
        $action_delete->setField('pessoa_id');
        $action_delete->setImage('fa:trash red');
        $this->datagrid->addAction($action_delete);

        $this->datagrid->createModel();

        TScript::create("
            $(document).on('click', '.tdatagrid tbody tr', function(e){

                // evita interferir com botões
                if ($(e.target).is('a, i, button')) {
                    return;
                }

                var link = $(this).find('a:first').attr('href');

                if(link){
                    __adianti_load_page(link);
                }
            });

            $('.tdatagrid tbody tr').css('cursor', 'pointer');
        ");
        
        /**
         * Busca no grid
         */
        $input_busca = new TEntry('input_busca');
        $input_busca->placeholder = 'Busca rápida...';
        $input_busca->setSize('100%');
        
        $this->datagrid->enableSearch($input_busca, 'pessoa_id, nome');

        /**
         * Painel do grid
         */        
        $panel = new TPanelGroup('Lista de Pessoas');
        $panel->addHeaderWidget($input_busca);
        $panel->add($this->datagrid);

        /**
         * Pilha de container
         */
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add($this->form);
        $vbox->add($panel);
        
        parent::add($vbox);
    }

    public function onSearch(){
        $data = $this->form->getData();
        TSession::setValue('pessoa_filter_data', $data);

        $this->form->setData($data);
        $this->onReload($data);
    }

    public function onClear(){
        TSession::setValue('pessoa_filter_data', null);
        $this->form->clear();
        $this->onReload();
    }

    /**
     * Form Lateral
     */
    public function onEdit($param){
        TApplication::loadPage('PessoaForm', 'onEdit', [
            'key' => $param['key'],
            'target_container' => 'adianti_right_panel'
        ]);
    }

    public static function onDelete($param){
        try{
            TTransaction::open('siuel_negocio');

            $pessoa = new Pessoa( $param['key'] );
            $pessoa->delete($param['key']);

            TTransaction::close();

            new TMessage('info', 'Registro excluído com sucesso');

            TApplication::loadPage('PessoaList', 'onReload');

        }catch( Exception $e ){
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    public function onReload($param = null){
        
        try{
            TTransaction::open('siuel_negocio');

            $this->datagrid->clear();

            $criteria = new TCriteria;

            $data = TSession::getValue('pessoa_filter_data');

            if( !empty($data->nome) ){
                $criteria->add( new TFilter('nome', 'like', "%{$data->nome}%") );
            }

            if( !empty($data->cpf) ){
                $criteria->add( new TFilter('cpf', 'like', "%{$data->cpf}%") );
            }

            if( !empty($data->tipo_pessoa) ){
                $criteria->add( new TFilter('tipo_pessoa', '=', $data->tipo_pessoa) );
            }

            if( !empty($data->status) ){
                $criteria->add( new TFilter('status', '=', $data->status) );
            }

            $repo = new TRepository('Pessoa');
            $pessoas = $repo->load($criteria);

            if( $pessoas ){
                foreach( $pessoas as $pessoa ){
                    $this->datagrid->addItem($pessoa);
                }
            }

            TTransaction::close();

        }catch( Exception $e ){
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();

        }

        
    }

    public function show(){
        if( !$this->loaded ){
            $this->onReload();
            $this->loaded = true;
        }

        parent::show();
    }

    
}