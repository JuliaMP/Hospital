<?php

class DataAccess
{	
	private $connect;
	
	public function __construct() {
		$this->connect();
	}
	
	public function connect()
	{
            //L -> '187.73.149.26:8080', 'root', 'jogoshcb' DB -> hcb_criancas
            //W ->'localhost', 'root','' DB -> hcb_criancas
            $this->connect = mysqli_connect('187.73.149.26:3306','root','jogoshcb','hcb_criancas');//
            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            //$this->connect = mysqli_connect('localhost','root','kevyn');
           // mysqli_select_db($this->connect,'hcb_criancas') or die(mysqli_connect_error());//

	}
	
	public function getDBConnect()
	{
		return $this->connect;
	}

		
	/**/
	public function execute($sql)
	{
		//echo $sql;
		$query = mysqli_query($this->getDBConnect(),$sql);// or die(mysql_error()."Erro!!");

		/* Executa o SQL */
		if ($query)
			return $query;
			//throw new Exception('Division by zero.');
		else
			return null;
	}

	/**/
	public function executeAndReturnLastID($sql)
	{
		$query = mysqli_query($sql, $this->getDBConnect()) or die(mysql_error()."Erro!!");				
				
		/* Executa o SQL */			
		if ($query)
		{
			return mysql_insert_id($this->getDBConnect());
		}
		else
			return null;	
	}
	
    /**
    * Returns any MySQL errors
    *
    * @return string a MySQL error
    *
    */
    public function isError ()
    {
        return mysqli_error( $this->getDBConnect() );
    }

    
}

?>
