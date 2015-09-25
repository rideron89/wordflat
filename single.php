<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wordflat
 */

get_header(); ?>

<div class="row">
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ): the_post(); ?>
			<div class="col-sm-12">
				<?php get_template_part( 'template-parts/content', 'single' ); ?>
			</div>
			<div class="col-sm-12 spacer"></div>
		<?php endwhile ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
