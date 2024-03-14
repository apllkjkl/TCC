<?php

    class RegisterSucces
    {
        private function makeMessage() : string
        {
            return "<h1>Registro feito com sucesso</h1>";
        }

        public function getMessage() : string 
        {
            return $this->makeMessage();
        }
    }

