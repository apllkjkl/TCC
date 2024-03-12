<?php 
    require_once "../core/connection.inc.php";

    class Query
    {
        private object $pdo;//Propriedade que vai receber o objeto "pdo" que faz a conexão com banco de dados.

        public function __construct(object $pdo)
        {
            $this->pdo = $pdo;
        }

        private function queryFuncionarios () : array //Metodo percorre a tabela funcionarios.
        {
            $stmt = "SELECT nome, email FROM funcionarios"; //Seleciona nome e email da tabela funcionarios
            $stmt = $this->pdo->prepare($stmt); //Prepare stetament para evitar injeções SQL.
            $stmt->execute(); //Executa Query.

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados em um array associativo.
        }

        public function getQueryFuncionarios () : array //Metodo para encapsular "queryFuncionarios()";
        {
            return $this->queryFuncionarios();
        }
    }
