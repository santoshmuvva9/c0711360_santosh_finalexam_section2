<?php
session_start();
	require 'Model/loginModel.php';
	require_once 'config.php';

	class userController 
	{
		function __construct() 
		{
			$this->conset = new Config();
			$this->userobj =  new loginmodel($this->conset->localhost,$this->conset->username,$this->conset->password,$this->conset->database);
		}

		public function handleRequest() 
		{
			$op = isset($_GET['op']) ? $_GET['op'] : NULL;
			switch ($op) 
			{
				case 'logout' :
					$this->signout();
					break;
						
				case 'login':
					$this->login();
					break;
				
				case 'signup' :
					//To get user Details through it's id
					$this -> signUp();
					break;
								
				case NULL :
					if (isset($_SESSION['userid'])) 
					{
						$user = $this -> userobj -> selectUserById($_SESSION['userid']);
						include 'View/user_profile.php';
					}
					else
					{
						include 'View/homepage.php' ;
					}
					break;
				
				default:
					// other operation
			}
		}
		
		
		public function signout() 
		{
			session_destroy();
			$this->redirect("index.php");
		}
		
		public function redirect($location)
		{
			header('Location:'.$location);
		}
		
		public function login()
		{
			if (isset($_SESSION['userid'])) 
			{
				$user = $this -> userobj -> selectUserById($_SESSION['userid']);
				include 'View/user_profile.php';
			}
			elseif (isset($_POST['loginbtn'])) 
			{
				$name = $_POST['name'];
				$password  = $_POST['password'];
				$user = $this->userobj->login($name, $password);
				if ($user) 
				{
					$_SESSION['userid'] =  $user->id;
					include 'View/user_profile.php';
				}
			}
			else 
			{
				echo "Wrong Admin name/Password";
			}
		}
		
		public function signUp()
		{
			if (isset($_SESSION['userid'])) 
			{
				$user = $this -> userobj -> selectUserById($_SESSION['userid']);
				include 'View/user_profile.php';
			} 
			elseif (isset($_POST['signupbtn'])) 
			{
				$name = $_POST['name'];
				$password = $_POST['password'];
				$address = $_POST['address'];
				$user = $this -> userobj ->signup($name,$password,$address);
				$_SESSION['userid'] = $user;
				$user = $this -> userobj -> selectUserById($_SESSION['userid']);
				include 'View/user_profile.php';
			} 
			else 
			{
				echo "blank";
			}
		}
		
	}
?>