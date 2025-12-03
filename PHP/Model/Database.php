<?php
class Database
{

    private $host;
    private $userName;
    private $password;
    private $database;
    public $Connect;
    public function __construct($filename)
    {
        if (is_file($filename)) {
            include $filename;
        } else {
            throw new Exception("Error Processing Request", 1);
        }

        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        $this->ConnectDB();

    }

    private function ConnectDB()
    {

        $this->Connect = new mysqli($this->host, $this->userName, $this->password, $this->database);
        $error = mysqli_connect_error();
        $resultw = $this->Connect->query("SET CHARACTER SET UTF8");
        if ($error != null) {
            throw new Exception("Error Processing Request", 1);
        }

    }

    public function closeDB()
    {
        //  mysqli.close();
        $this->Connect . close();
    }
}