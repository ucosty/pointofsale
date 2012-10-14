<?php

	class UsersController
	{
		public function login()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$user = User::find_by_username($_POST['username']);

				if(isset($user) && Hash::verify($_POST['password'], $user->password))
				{
					$_SESSION['userid'] = $user->id;
					$_SESSION['username'] = $user->username;

					if($user->is_admin) {
						$_SESSION['admin'] = true;
					}

					session_write_close();
					
					header("Location: " . Templates::BaseURL());
				}

				Templates::ActionTemplate(array("error" => "Invalid username or password."));
			}

		}

		public function logout()
		{
			session_unset();
			header("Location: " . Templates::BaseURL());
		}
	}

?>