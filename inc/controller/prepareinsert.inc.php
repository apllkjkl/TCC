<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/controller/hashpw.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/controller/verifyerrors.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/model/insertuser.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/core/connection.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/view/registersucces.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/tcc/inc/view/registerfailed.inc.php');

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
            $verifyerrors = new VerifyErrors($this->username, $this->email, $this->password, $this->level, $this->pdo); //Chama o metodo VerifyErrros
            return $verifyerrors->getRegisterErrors();
        }

        private function HashPw() 
        {
            if ($this->VerifyErrors()) { //Verifica se verify erros retorna verdadeira, se sim, retorna true e não faz nada, se retorna falso, pega a hash da senha.
                return true;
            } else {
                $pw = new HashPw($this->password);
                $this->password = $pw->getHash();
                return false;
            }
        }

        private function prepareInsert() 
        {
            if (!$this->HashPw()) {//Se o HashPw retornar falso, ele prepaara para inserrir o usuario no banco de dados.
                $_SESSION['REGISTER_STATUS'] = 'succes';//Define a variavel 'REGISTER_STATUS' para succes mais tarde usar em uma verificação.
                $insertUser = new InsertUser($this->username, $this->email, $this->password, $this->level, $this->pdo);//Cria um objeto da classe insertUser
                $insertUser->execInsert();//Executa o metódo de inserção no banco de dados
            } else {
                $_SESSION['REGISTER_STATUS'] = 'fail';
                header("Location: ../../register.php");
            }
        }

        public function prepareExec() 
        {
            $this->prepareInsert();
        }
    }