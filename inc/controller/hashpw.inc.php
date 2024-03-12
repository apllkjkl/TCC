<?php
    require_once "./verifyerrors.inc.php";

    class HashPw extends VerifyErrors 
    {
        private string $password;

        public function __construct(string $password)
        {
            $this->password = $password;
        }

        private function hashPw()//Metodo para fazer hash da senha.
        {
            return hash('sha512', $this->password);//Hash da senha.
        }

        public function getHash() : string //Encapsulamento de hashpw
        {
            return $this->hashPw();
        }
    }
