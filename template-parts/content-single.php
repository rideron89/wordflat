<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wordflat
 */

?>

<article id="post-<?php the_ID(); ?>" class="card main-content">
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ) ?>
    <sup class="entry-meta">by <?php the_author_posts_link() ?> on <?= get_the_date() ?> at <?php the_time() ?></sup>
    <div class="entry-content"><?php the_content() ?></div>
    <div class="entry-categories">
        <?php if (get_the_tags()): ?>
            <?php foreach (get_the_tags() as $tag): ?>
                <a href="" class="badge"><?= $tag->name ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="row spacer"></div>
    
    <?php
    	// If comments are open or we have at least one comment, load up the comment template.
    	if ( comments_open() || get_comments_number() ) :
    		comments_template();
    	endif;
    ?>
</article>
