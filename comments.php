<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wordflat
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}

if ( is_user_logged_in() == false) {
    return;
}

global $current_user;
get_currentuserinfo();
?>

<div class="row spacer"></div>

<div id="comments" class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="comments-form-area">
            <?php
            comment_form( array(
                'comment_field' => '<fieldset><label for="comment">' . __('Enter your comment here.' ) . '</label><textarea id="comment" name="comment" rows="3" aria-required="true" required="required"></textarea></fieldset>',
                'comment_notes_after' => '<p class="form-message error-message">' . __('Please fill out the comment box.') . '</p>',
                'logged_in_as' => '',
                'class_submit' => 'button-green button-small',
                'title_reply' => __( 'Comments' ),
                'label_submit' => __( 'Submit' )
            ) );
            ?>
        </div>

        <div class="row spacer"></div>

        <?php if ( have_comments() == false): ?>
            <p class="no-comments"><?php esc_html_e( 'No comments have been made.', 'wordflat' ); ?></p>
        <?php else: ?>
            <div class="comments-area">
                <?php
                wp_list_comments( array(
                    'avatar_size' => 64,
                    'style' => 'div',
                    'short_ping' => true
                ) );
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
