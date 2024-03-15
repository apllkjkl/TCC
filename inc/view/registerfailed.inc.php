<?php

    class RegisterFailed
    {
        private function makeMessage()
        {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $message = ' ';

            foreach ($errors as $errorArray) {
                foreach($errorArray as $error) {
                    $message .= "<h1>" . $error . "</h1>";
                }
            }

            return $message;
        }

        public function getMessage()
        {
            return $this->makeMessage();
        }
    }