<?php

    class RESTRequestor
    {
        private $connection;
        
        public function __construct()
        {
            $this->connection = curl_init();
            
            curl_setopt($this->connection, CURLOPT_SSLVERSION,3); 
            curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($this->connection, CURLOPT_SSL_VERIFYHOST, 2); 
            curl_setopt($this->connection, CURLOPT_HEADER, false); 
            curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true); 
        }
        
        public function __destruct()
        {
            if($this->connection) {
                curl_close($this->connection);
            }
        }
        
        public function Get($url)
        {
            curl_setopt($this->connection, CURLOPT_URL, $url);
            return curl_exec($this->connection);
        }
    }

?>

