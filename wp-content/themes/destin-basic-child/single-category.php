<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */
get_header(); ?>
<div id="category-page" class="container category-apparels-container">
	<?php
	$section = $wp_query->post->post_title;
	$args = array(
		'posts_per_page' => 15,
		'post_type' => 'apparel',
		'meta_query'	=> array(
			array(
				'key'		=> 'sections',
				'compare'	=> 'LIKE',
				'value'		=> ';' . $section . ';',
			)
		)
	);
	query_posts($args);
	while ( have_posts() ) : the_post(); ?>
		<div class="apparel">
	        <div data-product-image-hover="0">
	        	<?php echo '<a href="' . get_permalink($post->ID) . '" class="product-title">';?>
	  				<?php
						$picture = get_field('image');
						if (!empty($picture))
							echo '<img src="' . $picture['url'] . '" alt="' . $picture['alt'] . '" />';
						else
							echo '<img src="' . BAVOTASAN_THEME_URL . '/library/images/no-image.jpg" alt="" />';
					?>
	            </a>
	        </div>
	        <?php echo '<a href="' . get_permalink($post->ID) . '" class="product-title">' . the_title() . '</a>';?>
        	<div class="product-price">$44.99</div>
		</div>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>
