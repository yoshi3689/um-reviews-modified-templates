<?php
/**
 * Template for the UM User Reviews, The list of rated users
 *
 * Shortcode: [ultimatemember_lowest_rated], [ultimatemember_most_rated], [ultimatemember_top_rated]
 * Caller: Reviews_Shortcode->ultimatemember_lowest_rated( $args ) method
 * Caller: Reviews_Shortcode->ultimatemember_most_rated( $args ) method
 * Caller: Reviews_Shortcode->ultimatemember_top_rated( $args ) method
 * @version 2.2.3
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-reviews/reviews-widget.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'um-reviews-widget--before', $users, $list_class );
?>

<ul class="um-reviews-widget <?php echo esc_attr( $list_class ); ?>">

	<?php
	foreach ( $users->results as $user_id ) {

		um_fetch_user( $user_id );

		$rating = UM()->Reviews()->api()->get_avg_rating( $user_id );
		$count = UM()->Reviews()->api()->get_reviews_count( $user_id );
		?>

		<li>

			<div class="um-reviews-widget-pic">
				<a href="<?php echo um_user_profile_url(); ?>"><?php echo get_avatar( $user_id, 40 ); ?></a>
			</div>

			<div class="um-reviews-widget-user">

				<div class="um-reviews-widget-name"><a href="<?php echo um_user_profile_url(); ?>"><?php echo um_user( 'display_name' ); ?></a></div>

				<div class="um-reviews-widget-rating"><span class="um-reviews-avg" data-number="5" data-score="<?php echo UM()->Reviews()->api()->get_rating( $user_id ); ?>"></span></div>

				<?php if ( $count == 1 ) { ?>
					<?php // translators: %1$s is the reviews rating, %2$s is the reviews count ?>
					<div class="um-reviews-widget-avg"><?php printf( __( '%1$s average based on %2$s review', 'um-reviews' ), $rating, $count ); ?></div>
				<?php } else { ?>
					<?php // translators: %1$s is the reviews rating, %2$s is the reviews count ?>
					<div class="um-reviews-widget-avg"><?php printf( __( '%1$s average based on %2$s reviews', 'um-reviews' ), $rating, $count ); ?></div>
				<?php } ?>

			</div>
			<div class="um-clear"></div>

		</li>

	<?php } ?>

</ul>

<?php
do_action( 'um-reviews-widget-after', $users, $list_class );
