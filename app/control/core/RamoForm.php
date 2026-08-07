<?php

/**
 * Ramo Form
 * @version    1.0
 * @package    control/core
 * @author     brunosilva
 * @since      07/08/2026
 */
class RamoForm extends TPage{
    protected $form;

    public function __construct(){
        parent::__construct();

        $this->form = new BootstrapFormBuilder('form_Ramo');
        $this->form->setFormTitle('Cadastro de Ramo');

        // Campos
        $ramo_id = new TEntry('ramo_id');
        $ramo_id->setEditable(FALSE);
        $ramo_id->setSize('30%');

        $nome = new TEntry('nome');
        $nome->setSize('100%');
        $nome->addValidation( 'Nome', new TRequiredValidator );

        $sigla = new TEntry('sigla');
        $sigla->setSize('100%');
        $sigla->addValidation( 'Sigla', new TRequiredValidator );

        $idade_minima = new TEntry('idade_minima');
        $idade_minima->setSize('100%');

        $idade_maxima = new TEntry('idade_maxima');
        $idade_maxima->setSize('100%');

        $cor = new TColor('cor');
        $cor->setSize('100%');

        $status = new TCombo('status');
        $status->setSize('100%');
        $status->setValue('1');
        $status->addItems([
            '1' => 'Ativo',
            '0' => 'Inativo'
        ]);

        // Layout
        $this->form->addFields(
            [new TLabel('Código')],
            [$ramo_id]
        );

        $this->form->addFields(
            [new TLabel('Nome *')],
            [$nome]
        );

        $this->form->addFields(
            [new TLabel('Sigla *')],
            [$sigla]
        );

        $this->form->addFields(
            [new TLabel('Idade Mínima')],
            [$idade_minima],
            [new TLabel('Idade Máxima')],
            [$idade_maxima]
        );

        $this->form->addFields(
            [new TLabel('Cor')],
            [$cor],
            [new TLabel('Status')],
            [$status]
        );

        // Ações
        $btnSalvar = $this->form->addAction(
            'Salvar',
            new TAction([$this, 'onSave']),
            'fa:save green'
        );

        $btnNovo = $this->form->addAction(
            'Novo',
            new TAction([$this, 'onEdit']),
            'fa:eraser blue'
        );

        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add($this->form);

        parent::add($container);
    }

    /**
     * Salvar registro
     */
    public function onSave($param){
        try{
            TTransaction::open( 'siuel_negocio' );

            $this->form->validate();

            $data = $this->form->getData();
            
            $ramo = new Ramo;
            $ramo->fromArray((array) $data);
            $ramo->store();

            $data->ramo_id = $ramo->ramo_id;

            $this->form->setData($data);

            TTransaction::close();

            new TMessage( 'info', 'Registro salvo com sucesso' );

        }catch (Exception $e){
            new TMessage('error', $e->getMessage());

            $this->form->setData( $this->form->getData() );

            TTransaction::rollback();
        }
    }

    /**
     * Carrega registro
     */
    public function onEdit($param){
        try{
            
            if (isset($param['key'])){
                TTransaction::open( 'siuel_negocio' );

                $key = $param['key'];

                $obj = new Ramo($key);

                $this->form->setData($obj);

                TTransaction::close();
            
            }else{
                $this->form->clear(TRUE);
            }
        }catch (Exception $e){
            new TMessage('error', $e->getMessage());

            TTransaction::rollback();
        }
    }
}