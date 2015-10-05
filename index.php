<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wordflat
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-3">
        <div class="row">
            <?php if (is_user_logged_in() == false): ?>
                <div class="col-sm-12">
                    <?php get_template_part( 'template-parts/card', 'login' ) ?>
                </div>
                <div class="col-sm-12 spacer"></div>
            <?php endif; ?>
            <div class="col-sm-12">
                <?php get_template_part( 'template-parts/card', 'categories' ) ?>
            </div>
            <div class="col-sm-12 spacer"></div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="row">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-12">
                        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                    </div>
                    <div class="col-sm-12 spacer"></div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
