<?php
/**
 * PessoaForm Form
 * @version    1.0.1
 * @package    control/cadastros
 * @author     brunosilva
 * @since      04/04/2026
 */
class PessoaForm extends PessoaFormBase{
    //private $form;

    public function __construct(){
        parent::__construct();
        
    }

    protected function afterSave( Pessoa $pessoa ){
        TToast::show(
            'success',
            'Registro salvo com sucesso',
            'top right'
        );

        TApplication::loadPage('PessoaList', 'onReload');
    }

    protected function createHeaderButtons(){
        $btnBack = new TButton('btn_back');
        $btnBack->setLabel('Voltar');
        $btnBack->setImage('fa:arrow-left blue');

        $btnBack->setProperty(
            'onclick',
            "__adianti_load_page('index.php?class=PessoaList'); return false;"
        );

        $this->form->addField($btnBack);
        $this->form->addHeaderWidget($btnBack);
    }
}
?>