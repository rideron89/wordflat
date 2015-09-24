<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wordflat
 */

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card header">
            <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'wordflat' ), 'wordflat', '<a href="//github.com/rideron89/" target="_blank" rel="designer">Ron Rider</a>' ); ?>
        </div>
    </div>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
