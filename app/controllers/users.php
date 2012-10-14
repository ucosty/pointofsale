<?php

	class UsersController
	{
		public function login()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$user = User::find_by_username($_POST['username']);

				if(Hash::verify($_POST['password'], $user->password))
				{
					$_SESSION['userid'] = $user->id;
					$_SESSION['username'] = $user->username;

					header("Location: " . Templates::BaseURL());
				}
			}

		}

		public function logout()
		{
			
		}
	}

?>