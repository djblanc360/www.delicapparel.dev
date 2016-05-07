<?php
	include "../../../wp-load.php";
	get_header();
?>
<h1>Checkout</h1>
<?php
	$id = $_SESSION["mfsc_id"];

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$content = $wpdb->get_var($wpdb->prepare( 
		"
			SELECT content 
			FROM $table_name 
			WHERE id = %s
		", 
		$id
	));
	$items = array_count_values((explode(";", $content)));
	$content = "";
	$total = 0;
	foreach($items as $key => $value) {
		if ($key != '') {
			$product = get_post($key);
			?>
				<div class="checkout-item">
				<h2><?php echo $product->post_title; ?></h2>
	        	<?php echo '<a href="' . get_permalink($product) . '" class="product-title">';?>
					<?php
						$picture = get_field('image', $product);
						$price = get_field('price', $product);
						$total = $total + ($price * $value);
						if (!empty($picture))
							echo '<img class="checkout-image" src="' . $picture['url'] . '" alt="' . $picture['alt'] . '" />';
						else
							echo '<img class="checkout-image" src="' . BAVOTASAN_THEME_URL . '/library/images/no-image.jpg" alt="" />';
					?>
				</a>
				<h3>Number: <?php echo $value; ?></h3>
				<h3>Single: <?php echo $price . "$"; ?></h3>
				<h3>Total: <?php echo ($price * $value) . "$"; ?></h3>
				</div>
			<?php
		}
	}
?>
<h3>Total of the checkout: <?php echo $total . "$"; ?></h3>
<?php get_footer(); ?>