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
<div class="container">
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$picture = get_field('image');
		$price = get_field('price');
		if (!empty($picture))
			echo '<img src="' . $picture['url'] . '" alt="' . $picture['alt'] . '" />';
		else
			echo '<img src="' . BAVOTASAN_THEME_URL . '/library/images/no-image.jpg" alt="" />';
	?>
		<?php
		if( has_post_thumbnail() )
			the_post_thumbnail( 'featured-img', array( 'class' => 'image-full aligncenter' ) );
		?>

		<div class="row">
			<div class="col-md-3 entry-meta">
				<p><i class="fa fa-bookmark"></i> <?php _e( 'Posted in ', 'destin' ); the_category( ', ' ); ?></p>

				<?php if ( comments_open() ) { ?>
				<p><i class="fa fa-comments"></i> <?php comments_popup_link( __( '0 Comments', 'destin' ), __( '1 Comment', 'destin' ), __( '% Comments', 'destin' ), '', '' ); ?></p>
				<?php } ?>
			</div>
			<div class="col-md-9">
				<h1 class="entry-title taggedlink">
					<?php if ( is_single() ) : ?>
						<?php the_title(); ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					<?php endif; // is_single() ?>
				</h1>
	        	<div>
	        		<h3><?php echo $price . "$"; ?></h3>
	        		<?php add_to_cart_button(get_the_ID());?>
	        	</div>
				<div class="entry-meta">
					<?php
					printf( __( 'by %s on %s', 'destin' ),
						'<span class="vcard author"><span class="fn"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( sprintf( __( 'Posts by %s', 'destin' ), get_the_author() ) ) . '" rel="author">' . get_the_author() . '</a></span></span>', '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . get_the_date() . '</time></a>'
						);
					?>
				</div>
			    <div class="entry-content description clearfix">
				    <?php
					if ( is_singular() )
					    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'destin') );
					else
						the_excerpt();
					?>
			    </div><!-- .entry-content -->

			    <?php
			    if ( is_singular() )
			    	get_template_part( 'content', 'footer' ); ?>
			</div>
		</div>

	</article> <!-- #post-<?php the_ID(); ?> -->
</div>
<?php get_footer(); ?>