<?php

	class Product extends ActiveRecord\Model
	{
		public function price()
		{
			return number_format($this->cost / 100, 2);
		}
	}

?>