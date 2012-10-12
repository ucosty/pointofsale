<?php

	class SalesController
	{
		// The index page
		public function index()
		{
			$products = Product::all();


			Templates::ActionTemplate(array("products" => $products));
		}

		// Create new sale
		public function create()
		{
			$sale = new Sale();
			$sale->total = $_POST['Total'];
			$sale->change = $_POST['Change'];
			$sale->received = $_POST['CashReceived'];
			$sale->time = date('Y-m-d H:i:s');

			$sale->save();
		}
	}

?>