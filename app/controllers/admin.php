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

			Templates::ActionTemplate(array("sales" => $sales));
		}

		public function products()
		{
			// Retrieve all products
			$products = Product::all();

			Templates::ActionTemplate(array("products" => $products));
		}
	}

?>