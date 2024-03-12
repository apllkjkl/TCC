<?php
    require_once "../core/connection.inc.php";

    class InsertUser
    {
        private string $username;
        private string $email;
        private string $password;
        private string $level;
        private object $pdo;

        public function __construct ( string $username, string $email, string $password, string $level, object $pdo)
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->level = $level;
        }

        private function insertUser() //Metodo para inserseção de dados no banco
        {
            $query = "INSERT INTO funcionarios ('nome', 'email', 'senha', 'nivel') VALUES (':username', ':email', ':senha', ':level');";//Prepare stetaments para não acontecer injeção SQL.
            $stmt = $this->pdo->preapre($query);
            $stmt->bindParam(":username", $this->username);//Usa parametros da função para evitar SQL injection.
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":senha", $this->password);
            $stmt->bindParam(":level", $this->level);

            $stmt->execute();
        }

        public function execInsert()
        {
            $this->insertUser();
        }
    }