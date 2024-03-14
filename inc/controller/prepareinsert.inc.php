<?php
    require_once __DIR__ . "/hashpw.inc.php";
    require_once __DIR__ . "/verifyerrors.inc.php";
    require_once "../model/insertuser.inc.php";
    require_once "../core/connection.inc.php";
    require_once "../view/registersucces.inc.php";
    require_once "../view/registerfailed.inc.php";

    class PrepareInsert
    {
        private string $username;
        private string $email;
        private string $password;
        private string $level;
        private object $pdo;

        public function __construct(string $username, string $email, string $password, string $level, object $pdo) 
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->level = $level;
            $this->pdo = $pdo;
        }

        private function VerifyErrors() : bool
        {
            $verifyerrors = new VerifyErrors($this->username, $this->email, $this->password, $this->level, $this->pdo);
            return $verifyerrors->getErrors();
        }

        private function HashPw() 
        {
            if ($this->VerifyErrors()) {
                return true;
            } else {
                $pw = new HashPw($this->password);
                $this->password = $pw->getHash();
                return false;
            }
        }

        private function prepareInsert() 
        {
            if (!$this->HashPw()) {
                $insertUser = new InsertUser($this->username, $this->email, $this->password, $this->level, $this->pdo);
                $insertUser->execInsert($this->pdo);
                return $this->getMessageSucces();
            } else {
                return $this->getMessagefail();
            }
        }

        private function getMessageSucces() 
        {
            $succes =  new RegisterSucces();
            echo $succes->getMessage();
        }

        private function getMessagefail()
        {
            $fail = new RegisterFailed();
            echo $fail->getMessage();
        }

        public function prepareExec() 
        {
            $this->prepareInsert();
        }
    }