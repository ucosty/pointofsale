<?php

	class SalesController
	{
		public function __before_filter()
		{
			if(!User::find_session()) {
				header("Location: " . Templates::BaseURL() . "/login");
			}
		}

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
			$sale->order = $_POST['Order'];
			$sale->time = date('Y-m-d H:i:s');

			$sale->save();
		}
	}

?>