<?php
/**
 * Template for the UM User Reviews, The "Edit review" block
 *
 * Page: "Profile", tab "Reviews"
 * Caller: um_profile_content_reviews_default() function
 * @version 2.2.3
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-reviews/review-edit.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $post;

if ( ! UM()->Reviews()->api()->already_reviewed( um_profile_id() ) ) {
	return;
}

$post = UM()->Reviews()->api()->get_review_detail( um_profile_id(), get_current_user_id() );

$reviewer_id = get_post_meta( $post->ID, '_reviewer_id', true );
$reviewer = get_userdata( $reviewer_id );

if ( empty( $post->post_content ) ) {
	return;
}

$content = wp_strip_all_tags( $post->post_content );

setup_postdata( $post );
um_fetch_user( get_current_user_id() );
?>

<div class="um-reviews-item" data-review_id="<?php echo esc_attr( $post->ID ); ?>" data-user_id="<?php echo esc_attr( um_profile_id() ); ?>">

	<div class="um-reviews-img">
		<a href="<?php echo esc_url( um_user_profile_url() ); ?>"><?php echo um_user( 'profile_photo', 40 ); ?></a>
	</div>

	<div class="um-reviews-post review-list">

		<span class="um-reviews-avg" data-number="5" data-score="<?php echo esc_attr( get_post_meta( $post->ID, '_rating', true ) ); ?>"></span>

		<span class="um-reviews-title"><span><?php the_title(); ?></span></span>

		<span class="um-reviews-meta"><?php printf( __( 'by <a href="%s">%s</a>, %s', 'um-reviews' ), um_user_profile_url(), um_user( 'display_name' ), get_the_time( UM()->options()->get( 'review_date_format' ) ) ); ?></span>

		<span class="um-reviews-content"><?php echo nl2br( $content ); ?></span>

		<?php if( UM()->Reviews()->api()->is_flagged( $post->ID ) ) { ?>
			<div class="um-reviews-flagged"><?php esc_html_e( 'This is currently being reviewed by an admin', 'um-reviews' ); ?></div>
		<?php } ?>

		<?php if( UM()->Reviews()->api()->is_pending( $post->ID ) ) { ?>
			<div class="um-reviews-pending"><?php esc_html_e( 'This review will be moderated by an admin before it is live.', 'um-reviews' ); ?></div>
		<?php } ?>

		<div class="um-reviews-note"></div>

		<?php if ( ! UM()->Reviews()->api()->is_pending( $post->ID ) ) { ?>
			<div class="um-reviews-tools">
				<?php do_action( 'um_review_front_actions', um_profile_id(), get_current_user_id(), get_current_user_id(), $post->ID ); ?>
			</div>
		<?php } ?>

	</div>

	<div class="um-reviews-post review-form">

		<a href="javascript:void(0);" class="um-reviews-cancel-edit"><i class="um-icon-close"></i></a>

		<form class="um-reviews-form" action="" method="post">

			<span class="um-reviews-rate" data-key="rating" data-number="5" data-score="<?php echo esc_attr( get_post_meta( $post->ID, '_rating', true ) ); ?>"></span>

			<span class="um-reviews-title">
				<input type="text" name="title" placeholder="<?php esc_attr_e( 'Enter subject...', 'um-reviews' ); ?>" value="<?php echo esc_attr( $post->post_title ); ?>" maxlength="60" />
			</span>

			<span class="um-reviews-meta"><?php printf( __( 'by <a href="%s">%s</a>, %s', 'um-reviews' ), um_user_profile_url(), um_user( 'display_name' ), current_time( UM()->options()->get( 'review_date_format' ) ) ); ?></span>

			<span class="um-reviews-content">
				<textarea name="content" placeholder="<?php esc_attr_e( 'Enter your review...', 'um-reviews' ); ?>"><?php echo esc_textarea( $content ); ?></textarea>
			</span>

			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( um_profile_id() ); ?>" />
			<input type="hidden" name="reviewer_id" id="reviewer_id" value="<?php echo esc_attr( get_current_user_id() ); ?>" />
			<input type="hidden" name="action" id="action" value="um_review_edit" />
			<input type="hidden" name="nonce" id="action" value="<?php echo wp_create_nonce( 'um-frontend-nonce' ); ?>" />

			<input type="hidden" name="review_id" id="review_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="rating_old" id="rating_old" value="<?php echo esc_attr( get_post_meta( $post->ID, '_rating', true ) ); ?>" />
			<input type="hidden" name="reviewer_publish" id="reviewer_publish" value="<?php echo esc_attr( UM()->roles()->um_user_can( 'can_publish_review' ) ); ?>" />

			<div class="um-field-error" style="display:none"></div>

			<span class="um-reviews-send"><input type="submit" value="<?php _e( 'Save Review', 'um-reviews' ); ?>" class="um-button" /></span>

		</form>

	</div>
	<div class="um-clear"></div>

	<?php do_action('um_review_after_review_content', $post->ID, $reviewer_id , um_profile_id() ); ?>

	<div class="um-clear"></div>
</div>

<?php
um_fetch_user( um_profile_id() );
wp_reset_postdata();
