<?php

/**
 * Ramo List
 * @version    1.0
 * @package    control/core
 * @author     brunosilva
 * @since      07/08/2026
 */
class RamoList extends TPage{
    private $form;
    private $datagrid;
    private $pageNavigation;

    public function __construct(){
        parent::__construct();

        /*
         * Formulário de pesquisa
         */
        $this->form = new BootstrapFormBuilder('form_search_Ramo');
        $this->form->setFormTitle('Consulta de Ramos');

        $nome  = new TEntry('nome');
        $nome->setSize('100%');

        $sigla = new TEntry('sigla');
        $sigla->setSize('100%');

        $this->form->addFields(
            [new TLabel('Nome')],
            [$nome],
            [new TLabel('Sigla')],
            [$sigla]
        );

        $this->form->addAction(
            'Pesquisar',
            new TAction([$this, 'onSearch']),
            'fa:search blue'
        );

        /*
         * Datagrid
         */        
        $col_id = new TDataGridColumn( 'ramo_id', 'Código', 'center', '10%' );
        $col_nome = new TDataGridColumn( 'nome', 'Nome', 'left', '30%' );
        $col_sigla = new TDataGridColumn( 'sigla', 'Sigla', 'center', '10%' );
        $col_idade_minima = new TDataGridColumn( 'idade_minima', 'Idade Min.', 'center', '10%' );
        $col_idade_maxima = new TDataGridColumn( 'idade_maxima', 'Idade Max.', 'center', '10%' );
        
        $col_cor = new TDataGridColumn( 'cor', 'Cor', 'left', '15%' );
        $col_cor->setTransformer(function($value){

            $map = [
                'E74E0F' => 'Laranja',
                'FAB81B' => 'Amarelo',
                '005321' => 'Verde',
                'A8153D' => 'Grená',
                'E20613' => 'Vermelho'
            ];

                $descricao = $map[$value] ?? $value;

                //https://www.escoteiros.org.br/wp-content/uploads/2025/07/Manual-de-Indentidade-Visual-Ramo-Filhotes.pdf

                return "<span class='badge'
                            style='background-color:#{$value};
                                    color:white;'>
                            {$descricao}
                        </span>";
        });

        $col_status = new TDataGridColumn( 'status', 'Status', 'center', '10%' );
        $col_status->setTransformer(function($value){
            $status = '';
            if( !empty($value) && $value == '1' ){
                $status = 'Ativo';
            }else{
                $status = 'Inativo';

            }

            return $status;
        });
        
        $this->datagrid = new BootstrapDatagridWrapper( new TDataGrid );
        $this->datagrid->style = 'width:100%';

        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_sigla);
        $this->datagrid->addColumn($col_idade_minima);
        $this->datagrid->addColumn($col_idade_maxima);
        $this->datagrid->addColumn($col_cor);
        $this->datagrid->addColumn($col_status);

        /*
         * Ações
         */
        $action_edit = new TDataGridAction(
            ['RamoForm', 'onEdit'],
            ['key' => '{ramo_id}']
        );
        $action_edit->setLabel('Editar');
        $action_edit->setImage('fa:edit blue');

        $this->datagrid->addAction($action_edit);

        $action_delete = new TDataGridAction(
            [$this, 'onDelete'],
            ['key' => '{ramo_id}']
        );
        $action_delete->setLabel('Excluir');
        $action_delete->setImage('fa:trash red');

        $this->datagrid->addAction($action_delete);

        $this->datagrid->createModel();

        /*
         * Paginação
         */
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(
            new TAction([$this, 'onReload'])
        );

        /*
         * Painel da grid
         */
        $panel = new TPanelGroup('Ramos');
        $panel->add($this->datagrid);
        $panel->addFooter( $this->pageNavigation );

        $btnNovo = new TAction(['RamoForm', 'onEdit']);

        $panel->addHeaderActionLink(
            'Novo',
            $btnNovo,
            'fa:plus green'
        );

        /*
         * Container
         */
        $container = new TVBox;
        $container->style = 'width:100%';
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);
    }

    /**
     * Pesquisa
     */
    public function onSearch($param){
        $data = $this->form->getData();

        TSession::setValue( 'RamoList_filter_nome', $data->nome );
        TSession::setValue( 'RamoList_filter_sigla', $data->sigla );

        $this->form->setData( $data );

        $this->onReload();
    }

    /**
     * Recarrega grid
     */
    public function onReload($param = NULL){
        try{
            TTransaction::open( 'siuel_negocio' );

            $criteria = new TCriteria;

            if( $nome = TSession::getValue('RamoList_filter_nome') ){
                $criteria->add( new TFilter( 'nome', 'like', "%{$nome}%" ) );

            }

            if( $sigla = TSession::getValue('RamoList_filter_sigla') ) {
                $criteria->add( new TFilter( 'sigla', 'like', "%{$sigla}%" ) );

            }

            $criteria->setProperty('order', 'nome');

            $repository = new TRepository('Ramo');

            $objects = $repository->load($criteria);

            $this->datagrid->clear();

            if ($objects){
                foreach ($objects as $object){
                    $this->datagrid->addItem($object);

                }
            }

            TTransaction::close();

        }catch(Exception $e){
            new TMessage( 'error', $e->getMessage() );

            TTransaction::rollback();
        }
    }

    /**
     * Exclusão
     */
    public function onDelete($param){
        try{

            TTransaction::open( 'siuel_negocio' );

            $obj = new Ramo($param['key']);

            $obj->delete();

            TTransaction::close();

            $this->onReload();

            new TMessage( 'info', 'Registro excluído com sucesso' );

        }catch(Exception $e){
            new TMessage( 'error', $e->getMessage() );

            TTransaction::rollback();

        }
    }

    /**
     * Método executado ao carregar
     */
    public function show(){
        $this->onReload();

        parent::show();
    }
}