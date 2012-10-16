<?php

	class OrdersController
	{
		public function index()
		{
			// Retrieve all sales
			$orders = Sale::all();

			Templates::ActionTemplate(array("orders" => $orders));
		}
	}

?>