<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterCtrl
 *
 * @author lio
 */

class MasterCtrl extends IControleur {
    private $textToEncrypt = null;
    private $encryptedText = null;
    private $blockSize = null;

    public function insert () {
        if(Utils::isValid($this->encryptedText)) {
           return json_encode($this->encryptedText);
        } else {
            /* @var $vue MasterVue */
            $vue = $this->getVue();

            return $vue;

        }
    }

    public function encryption () {
        /* @var $post Conversation */
        $post = Conversation::getDefaultConversation('POST');
        if (Utils::isValid($post) && Utils::isValid($post->getValue('textToEncrypt')) && Utils::isValid($post->getValue('blockSize'))){
            $this->textToEncrypt= $post->getValue('textToEncrypt');
            $this->blockSize= $post->getValue('blockSize');

            /* @var $mdl MasterMdl */
            $mdl = $this->getMdl();
            $this->encryptedText = $mdl->encryption($this->textToEncrypt, $this->blockSize);
        }
    }

    public function  __construct() {
        $this->fixeBase('prod', 'Master');

        $this->addMdl('MasterMdl');
        $this->addVue('MasterVue');
    }
}
?>
