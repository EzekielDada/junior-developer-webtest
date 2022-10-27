<?php
require './core/Model.php';

class DisplayProduct extends Model
{
	function __construct(){}

	public function displayProduct()
	{

		try {
			$db = $this->getDB();
			$result = $db->query("SELECT * FROM `products` ORDER BY `id` DESC");

			while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
				$weight = !!$data['Weight'] ? "<li>Weight: {$data['Weight']}KG</li>" : '';
				$size = !!$data['Size'] ? "<li>Size:{$data['Size']}MB</li>" : '';
				$dimension = !!$data['Length'] ? "<li>Dimension: {$data['Length']}x{$data['Width']}x{$data['Height']}</li>" : '';
				echo "<div class='product' data-product-id='{$data['id']}'>
			<label class='product-inn'>
				<div class='checkbox-wrap'>
					<input type='checkbox' name='product' class='delete-checkbox' value='{$data['id']}'/>
					<i class='fas fa-check check-icon'></i>
				</div>
				<h2 class='title'>{$data['SKU']}</h2>
				<ul class='product-details'>
					<li>{$data['Name']}</li>
					<li>{$data['Price']}$</li>
					$weight $size $dimension
				</ul>
			</label>
		</div>";
			}
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}
