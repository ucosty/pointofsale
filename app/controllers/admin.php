<?php

	class AdminController
	{
		public function index()
		{

		}


		public function sales()
		{
			// Retrieve all sales
			$sales = Sale::all();
		}

		public function products()
		{
			
		}
	}

?>