<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterVue
 *
 * @author lio
 */
class MasterVue extends IVue {
    public function __toString() {
        $d = $this->getMdonnees();

        $text = '
            <div class="enter-msg-to-encrypt">
                <label> Enter message to encrypt: </label>
                    <input class="message" type="text">

                    <div class="options">
                        Choose encryption method

                        <div class="options">
                            <input class="select" type="radio" name="static" > Static Vignere Encryption
                            <input class="select" type="radio" name="dynamic" checked> Dynamic Vignere Encryption
                                <div class="key-size">
                                    <label> Key size (optimal value will be used) </label>
                                        <input class="size" type="text">
                                </div>

                        </div>
                    </div>

                    <button> Encrypt </button>
            </div>

            <div class="encrypted-msg">

            </div>
        ';

        $js = '
            var master = new Master();
            master.init();
        ';
        $text .= Utils::insertJavaScriptCode($js);

        return $text;
    }

}

?>
