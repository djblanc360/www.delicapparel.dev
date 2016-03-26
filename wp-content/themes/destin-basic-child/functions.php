<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

        
if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css' );

// END ENQUEUE PARENT ACTION

function delicaparel_front_page_render() {
	global $wp_query, $paged;
	$args = array(
		'posts_per_page' => 100,
		'post_type' => 'category'
	);
	query_posts($args);
	?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( is_front_page() ) { ?>
		<div class="item">
			<figure class="effect-julia">
				<?php
					$picture = get_field('category_picture');
				if (!empty($picture))
					echo '<img src="' . $picture['url'] . '" alt="' . $picture['alt'] . '" />';
				else
					echo '<img src="' . BAVOTASAN_THEME_URL . '/library/images/no-image.jpg" alt="" />';
				?>
				<figcaption>
					<h2><?php the_title(); ?></h2>
					<div>
						<p><?php echo wp_trim_words( strip_shortcodes( get_the_excerpt() ) , 10 ); ?></p>
						<p class="more-link-p"><?php _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'destin' ); ?></p>
					</div>
					<a href="<?php the_permalink(); ?>"><?php _e( 'View more', 'destin' ); ?></a>
				</figcaption>
			</figure>
		</div>
		<?php } else { ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php } ?>
	<?php endwhile; ?>
	<?php
}

add_theme_support( 'infinite-scroll', array(
	    'type' => 'scroll',
		'wrapper' => false,
		'footer' => false,
		'footer_widgets' => 'extended-footer',
        'render'=> 'delicaparel_front_page_render',
	) );
add_theme_support( 'post-thumbnails', array( 'category' ) );