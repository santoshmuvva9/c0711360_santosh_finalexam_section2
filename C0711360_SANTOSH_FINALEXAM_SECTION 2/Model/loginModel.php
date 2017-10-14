<?php
	
	class loginmodel
	{
		function __construct($host,$uname,$pass,$db)
		{
			$this->localhost = $host;
			$this->username = $uname;
			$this->password =  $pass;
			$this->database = $db;
            					
		}
		
		public function openDb()
		{
			$this->conn=new mysqli($this->localhost,$this->username,$this->password,$this->database);
			if ($this->conn->connect_error) 
			{
    			die("Connection failed: " . $this->conn->connect_error);
			}
		}
		
		public function closeDb()
		{
			$this->conn->close();
		}
		
		public function login($name,$password)
		{
			$this->openDb();
			$stmt=$this->conn->prepare("SELECT * FROM usertbl where name=? and password=?");
			$stmt->bind_param("ss",$name,$password);
			$stmt->execute();
			$res=$stmt->get_result();
			$stmt->close();
			$this->closeDb();
			return $res->fetch_object();
		}
		
		public function signup($name,$password,$address)
		{
			try
			{	
				$this->openDb();
				$stmt=$this->conn->prepare("INSERT INTO USERTBL (name,password,address) VALUES (?, ?, ?)");
				$stmt->bind_param("sss", $name,$password,$address);
				$stmt->execute();
				$res= $stmt->get_result();
				$last_id=$this->conn->insert_id;
				$stmt->close();
				$this->closeDb();
				return $last_id;
			}
			catch (Exception $e) 
			{
            	$this->closeDb();
            	throw $e;
        	}
		}
		
		public function selectUserById($userid)
		{
			try
			{
				$this->openDb();
				$stmt=$this->conn->prepare("SELECT * FROM USERTBL WHERE id=?");
				$stmt->bind_param("i",$userid);
				$stmt->execute();
				$res=$stmt->get_result();
				$stmt->close();
				$this->closeDb();
				return $res->fetch_object();	
			}
			catch(Exception $e)
			{
				$this->closeDb();
				throw $e; 	
			}
			
		}
	}

?>