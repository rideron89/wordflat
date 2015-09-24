<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wordflat
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card sidebar">
                    <h2>Sign In</h2>
                    <form>
                        <fieldset>
                            <label for="username">Username</label>
                            <input class="error" type="text" name="username" id="username" />
                        </fieldset>
                        <fieldset>
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" />
                        </fieldset>
                        <p class="form-message error-message">Please fill out all fields.</p>
                        <fieldset>
                            <input class="button-green" type="submit" value="Sign In" />
                        </fieldset>
                        <p>Don't have an account? <a href="">Sign up!</a></p>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 spacer"></div>
            <div class="col-sm-12">
                <div class="card sidebar">
                    <h2>Sidebar</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <ul>
                        <li class="slidecard"><a href="">Something</a></li>
                        <li class="slidecard"><a href="">Something</a></li>
                        <li class="slidecard"><a href="">Something</a></li>
                        <li class="slidecard"><a href="">Something</a></li>
                        <li class="slidecard"><a href="">Something</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 spacer"></div>
        </div>
    </div>
</div>

<div id="content" class="row site-content">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content', 'page' ); ?>

            <?php
                    // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
