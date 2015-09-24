<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wordflat
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ) ?>
            <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ) ?>
        </div>
    </div>
</div>

<div class="row spacer"></div>

<div class="row">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-sm-12">
                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
            </div>
            <div class="col-sm-12 spacer"></div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-sm-12">
            <p>This user has not published any posts yet!</p>
        </div>
        <div class="col-sm-12 spacer"></div>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
