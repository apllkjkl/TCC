<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/tcc/inc/core/connection.inc.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/tcc/inc/model/query.inc.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/tcc/inc/controller/hashpw.inc.php");
    session_start();

    class VerifyErrors extends Query
    {
        private string $username;//Propriedades que guardam dados enviados pelo usuario.
        private string $email;
        private string $password;
        private string $level;
        private object $pdo;
        private array $errors = []; //Array para armezar erros
        
        public function __construct(string $username, string $email, string $password, string $level, object $pdo) 
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->level = $level;
            $this->pdo = $pdo;
        }

        private function getHash(string $password) : string
        {
            $hashpw = new HashPw($password);
            $this->passowrd = $hashpw->getHash();
            return $this->password;
        }

        private function isEmptyRegister() : bool //Função para verificar inputs vazios.
        {
            if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->level)) { //Filtro empty() verifica se algum input está vazio.
                return true;
            }

            return false;
        }

        private function isEmailValid() : bool //Verificação de formato do email.
        {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //Este filtro verifica se o email está em um formato correto e retorna verdadeiro caso não esteja.
                return true;
            }

            return false;
        }

        private function isDataTaken() : bool //Faz uma query no banco através de outra classe para verificar se os dados do usuario ja existem no banco.
        {
            $dbdata = $this->getQueryFuncionarios($this->pdo); //Chama metodo de quuery da tabela funcionarios.
            for($i = 0; $i < count($dbdata); $i++) { //Loping feito a quantidade de linhas na tabela.
                if($dbdata[$i]["nome"] == $this->username || $dbdata[$i]["email"] == $this->email) { //Verifica se o email ou nome já estão cadastrados.
                    return true;
                }
            }
            return false;
        }

        private function isDataCorrect() : bool 
        {
            $dbdata = $this->getQueryFuncionarios($this->pdo);
            for($i = 0; $i < count($dbdata); $i++) {
                if($dbdata[$i]["email"] == $this->email && $dbdata[$i]['password'] == $this->getHash($this->password)) {
                    return false;
                }
            }
            return true;
        }

        private function function isEmptyLogin() : bool
        {

            if ($this->email()) {
        }

        private function registerErrors() : bool //Metodo que verifica se alguma das verificações de erros reotrna verdadeiro.
        {
            $haserror = false;
            if ($this->isEmpty()) {
                $haserror = true;
                $this->errors["empty"] = ["Preencha todos os campos"]; //Array errors vai receber o erro de acordo com o erro recebido.
            }
            if($this->isEmailValid()) {
                $haserror = true;
                $this->errors["invalid_format"] = ["Formato de email inválido"];
            }
            if ($this->isDataTaken()) {
                $haserror = true;
                $this->errors["taken"] = ["Dados já cadastrados"];
            }

            $_SESSION['errors'] = $this->errors;
            return $haserror;
        }

        public function getRegisterErrors() : bool //Chama metodo "haveErrors", proposito desta função é apenas encapsulamento.
        {
            return $this->registerErrors();    
        }
        private function loginErrors() : bool 
        {
            $haserrors = false;  
            if ($this->isEmpty()) {
                $haserrors = true;
                $this->errors['empty'] = ['Preencha todos o campos'];
            }
            if($this->isEmailValid()) {
                $haserrors = true;
                $this->errors['inalid_format'] = ['Formato de email inválido'];
            }
            if ($this->isDataTaken()) {
                $haserrors = true;
                $this->errors['invalid _data'] = ['Dados incorretos'];
            }
            return $haserrors;
        }
    }
