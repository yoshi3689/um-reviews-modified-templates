<?php
/**
 * Template for the UM User Reviews, The Rating block.
 *
 * Page: "Members"
 * Hook: 'um_members_after_user_name'
 * Caller: um_reviews_add_rating() function
 * @version 2.2.3
 *
 * Changes:
 * - Added check for the current user's roles to determine if the content should be blurred.
 * - Applied the 'blurred-content' class conditionally based on the user's role.
 * - Date: 2024-07-15
 * - Author: [Your Name or Initials]
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-reviews/member-rating.php
 * @var int $user_id
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the current user's roles
um_fetch_user( get_current_user_id() );
$current_user_role = UM()->roles()->get_role_name( UM()->user()->get_role() );

// Check if the user does not have any of the specified roles
$is_not_premium_or_admin = (strpos($current_user_role, 'Premium') === false && $current_user_role !== 'Administrator');

$rating = UM()->Reviews()->api()->get_rating( $user_id );
?>

<div class="um-member-rating <?php echo $is_not_premium_or_admin ? 'blurred-content' : ''; ?>">
	<span class="um-reviews-avg" data-number="5" data-score="<?php echo esc_attr( $rating ); ?>"></span>
</div>
