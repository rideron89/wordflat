<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wordflat
 */

if ( ! function_exists( 'wordflat_comment_posted_on' ) ) :
function wordflat_comment_posted_on( $date ) {
    $newdate = time() - strtotime( $date );
    $output = $newdate;
    $title = date( 'M j, Y g:i A', strtotime( $date ) );

    $secs = floor($newdate);
    $mins = floor($newdate /= 60);
    $hours = floor($newdate /= 60);
    $days = floor($newdate /= 24);

    if ($days == 0) {
        if ($hours == 0) {
            if ($mins == 0) {
                if ($secs < 10) {
                    $output = 'now';
                } else {
                    $output = $secs . ' seconds ago';
                }
            } else if ($mins == 1) {
                $output = '1 minute ago';
            } else {
                $output = $mins . ' minutes ago';
            }
        } else if ($hours == 1) {
            $output = '1 hour ago';
        } else {
            $output = $hours . ' hours ago';
        }
    } else if ($days == 1) {
        $output = '1 day ago';
    } else if ($days == 2) {
        $output = '2 days ago';
    } else {
        $output = $title;
        $title = '';
    }

    echo '<span class="comment-author-date" title="' . $title .'">' . $output . '</span>';
}
endif;

if ( ! function_exists( 'wordflat_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wordflat_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
        );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'wordflat' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'wordflat' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'wordflat_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wordflat_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'wordflat' ) );
        if ( $categories_list && wordflat_categorized_blog() ) {
            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wordflat' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'wordflat' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wordflat' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'wordflat' ), esc_html__( '1 Comment', 'wordflat' ), esc_html__( '% Comments', 'wordflat' ) );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'wordflat' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
        '<span class="edit-link">',
        '</span>'
        );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wordflat_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'wordflat_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
            ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'wordflat_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so wordflat_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so wordflat_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in wordflat_categorized_blog.
 */
function wordflat_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'wordflat_categories' );
}
add_action( 'edit_category', 'wordflat_category_transient_flusher' );
add_action( 'save_post',     'wordflat_category_transient_flusher' );

function _wordflat_comment_body( $args, $comment ) {
    $gravatar = md5( strtolower( trim( $comment->comment_author_email ) ) );

    // replying to replies should actually reply to the original comment (only allows 2-deep)
    if ($comment->comment_parent == 0) {
        $replyLink = '/?replytocom=' . $comment->comment_ID . '#respond';
        $replyScript = 'return addComment.moveForm( &quot;comment-' . $comment->comment_ID . '&quot;, &quot;' . $comment->comment_ID . '&quot;, &quot;respond&quot;, &quot;' . $args['post_id'] . '&quot; )';
    } else {
        $replyLink = '/?replytocom=' . $comment->comment_parent . '#respond';
        $replyScript = 'return addComment.moveForm( &quot;comment-' . $comment->comment_ID . '&quot;, &quot;' . $comment->comment_parent . '&quot;, &quot;respond&quot;, &quot;' . $args['post_id'] . '&quot; )';
    }
    ?>
    <div class="comment-meta">
        <div class="comment-avatar">
            <img src="http://www.gravatar.com/avatar/<?=$gravatar?>?s=<?=$args['avatar_size']?>" width="<?=$args['avatar_size']?>" height="<?=$args['avatar_size']?>" class="avatar" alt="<?=$comment->comment_author?>" />
        </div>
        <div class="comment-author">
            <strong><?=$comment->comment_author?></strong>
            <?php wordflat_comment_posted_on( $comment->comment_date ); ?>
        </div>
    </div>
    <div class="comment-content">
        <?= esc_html( $comment->comment_content ) ?>
        <div class="comment-reply">
            <a rel="nofollow" class="comment-reply-link" href="<?=$replyLink?>" onclick="<?=$replyScript?>" aria-label="Reply to admin">Reply</a>
        </div>
    </div>
    <?php
}

function wordflat_list_comments( $args = array() ) {
    global $post;

    $defaults = array(
        'avatar_size' => 48,
        'post_id' => $post->ID
        );

    $args = wp_parse_args($args, $defaults);
    $comments = get_comments( array(
        'order' => 'ASC',
        'parent' => 0,
        'post_id' => $args['post_id']
        ) );

    // no comments, so end here
    if (count($comments) < 1) {
        echo '';
        return true;
    }
    ?>
    <div class="comments-area">
        <?php
        foreach ($comments as $comment) {
            ?>
            <article id="comment-<?=$comment->comment_ID?>" class="comment <?php if ($comment->comment_parent != 0) echo ' reply'; ?>">
                <?php _wordflat_comment_body( $args, $comment ); ?>
                <div class="comment-children">
                    <?php
                    $interiorComments = get_comments( array(
                        'order' => 'ASC',
                        'parent' => $comment->comment_ID,
                        'post_id' => $args['post_id']
                    ) );

                    foreach ($interiorComments as $c) {
                        ?>
                        <article id="comment-<?=$c->comment_ID?>" class="comment interior">
                        <?php _wordflat_comment_body( $args, $c ); ?>
                        </article>
                        <?php
                    }
                    ?>
                </div>
            </article>
            <div class="row spacer"></div>
            <?php
        }
        ?>
    </div>
    <?php
}