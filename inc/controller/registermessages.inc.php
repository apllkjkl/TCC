<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/view/registersucces.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/view/registerfailed.inc.php');

    class RegisterMessages 
    {
        public function getMessageSucces() 
        {
            $succes =  new RegisterSucces();
            return $succes->getMessage();
        }

        public function getMessageFail()
        {
            $fail = new RegisterFailed();
            echo $fail->getMessage();
        }
    }