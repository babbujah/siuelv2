<?php
/**
 * PessoaPanelForm Class Form
 * @version    1.0
 * @package    control/cadastros
 * @author     brunosilva
 * @since      06/07/2026
 */
class PessoaPanelForm extends PessoaFormBase{

    protected function afterSave( Pessoa $pessoa ){
        TToast::show(
            'success',
            'Registro salvo com sucesso',
            'top right'
        );

        TScript::create("Template.closeRightPanel();");

        TApplication::loadPage('PessoaList', 'onReload');
    }

    protected function createHeaderButtons(){
        $btnClose = new TButton('btn_close');
        $btnClose->setLabel('Fechar');
        $btnClose->setImage('fa:times red');

        $btnClose->setProperty(
                    'onclick',
                    'Template.closeRightPanel(); return false;'
        );

        $this->form->addField( $btnClose );
        $this->form->addHeaderWidget($btnClose);
    }
}
?>