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
    private $formgrid;
    private $loaded;
    private $deleteButton;
    
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
        $this->form->addAction(_t('Find'), new TAction([$this, 'onSearch']), 'fa:search blue');
        $this->form->addAction(_t('Clear'), new TAction([$this, 'onClear']), 'fa:eraser red');

        // Melhor UX
        $this->form->setData(TSession::getValue('pessoa_filter_data'));

        /**
         * DATAGRID
         */
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        //$this->datagrid->enablePopover('Hint', 'Tipo de endereço para <b>{}</b>');
        //$this->datagrid->disableDefaultClick();

        // Colunas
        $col_id = new TDataGridColumn('id', 'Código', 'center', '10%');
        $col_nome = new TDataGridColumn('nome', 'Nome', 'left', '30%');
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);

        /**
         * Painel Lateral
         */
        //$this->datagrid->setRowAction(new TDataGridAction([$this, 'onEdit']));
        $action_view = new TDataGridAction([$this, 'onEdit']);
        $action_view->setField('id');
        $this->datagrid->addAction($action_view);

        /**
         * Ações padrão
         */
        $action_delete = new TDataGridAction([$this, 'onDelete']);
        $action_delete->setField('id');
        $action_delete->setImage('fa:trash red');
        $this->datagrid->addAction($action_delete);

        $this->datagrid->createModel();
        
        /**
         * Busca no grid
         */
        $input_busca = new TEntry('input_busca');
        $input_busca->placeholder = 'Busca rápida...';
        $input_busca->setSize('100%');
        
        $this->datagrid->enableSearch($input_busca, 'id, nome');

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
            'key' => $param[$key],
            'target_container' => 'adianti_right_panel'
        ]);
    }

    public static function onDelete($param){
        new TMessage('info', 'Excluir ID: ' . $param['id']);
    }
    
    
    
    
    public function onReload($param = null){
        
    $this->datagrid->clear();

        $data = TSession::getValue('pessoa_filter_data');

        foreach ($this->getMockData() as $item) {

            // filtros simples (mock)
            if (!empty($data->nome) && stripos($item->nome, $data->nome) === false) {
                continue;
            }

            $this->datagrid->addItem($item);
        }
    }

    private function getMockData()
    {
        $items = [];

        $nomes = ['Aretha Franklin', 'Eric Clapton', 'B. B. King', 'Janis Joplin'];

        foreach ($nomes as $i => $nome) {

            $obj = new stdClass;
            $obj->id = $i+1;
            $obj->nome = $nome;
            $obj->cidade = 'Cidade ' . ($i+1);
            $obj->estado = 'Estado ' . ($i+1);

            $items[] = $obj;
        }

        return $items;
    }


    public function show(){
        if( !$this->loaded ){
            $this->onReload();
            $this->loaded = true;
        }

        parent::show();
    }

    
}