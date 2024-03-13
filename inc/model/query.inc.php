<?php 
    require_once "../core/connection.inc.php";

    class Query
    {
        private function queryFuncionarios($pdo) : array //Metodo percorre a tabela funcionarios.
        {
            $query = "SELECT nome, email FROM funcionarios"; //Seleciona nome e email da tabela funcionarios
            $stmt = $pdo->prepare($query); //Prepare stetament para evitar injeções SQL.
            $stmt->execute(); //Executa Query.

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados em um array associativo.
        }

        public function getQueryFuncionarios ($pdo) : array //Metodo para encapsular "queryFuncionarios();
        {
            return $this->queryFuncionarios($pdo);
        }
    }
