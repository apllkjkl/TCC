<?php
    require_once "./hashpw.inc.php";
    require_once "./verifyerrors.inc.php";

    class PrepareInsert
    {
        private string $username;
        private string $email;
        private string $password;
        private string $level;
        private object $pdo;

        public function __construct(string $username, string $email, string $password, string $level, string $pdo) 
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->level = $level;
            $this->pdo = $pdo;
        }

        private function VerifyErrors() : bool
        {
            $verifyerrors = new VerifyErrors($this->username, $this->email, $this->password, $this->level);
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
                $insertUser->execInsert();
            }
        }
    }