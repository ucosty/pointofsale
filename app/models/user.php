<?php

	class User extends ActiveRecord\Model
	{
		public static function find_session()
		{
			return(isset($_SESSION['userid']));
		}

		public static function is_admin()
		{
			return(isset($_SESSION['admin']));
		}
	}

?>