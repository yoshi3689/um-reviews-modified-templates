<?php
/**
 * Filter to check if the current user and the profile user have exchanged messages.
 *
 * Changes made to this function:
 * - Modified to call get_current_user_id inside the function.
 * - Date: 2024-07-15
 * - Author: [Your Name or Initials]
 */

add_filter('check_users_messages', function($profile_user_id) {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    // Fetch the current user and profile user objects
    $current_user = get_userdata($current_user_id);
    $profile_user = get_userdata($profile_user_id);

    // Check if the current user has sent at least one message to the profile user
    $current_user_to_profile_user_count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*)
             FROM {$wpdb->prefix}um_messages
             WHERE author = %d AND recipient = %d",
            $current_user_id, $profile_user_id
        )
    );

    // Check if the profile user has sent at least one message to the current user
    $profile_user_to_current_user_count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*)
             FROM {$wpdb->prefix}um_messages
             WHERE author = %d AND recipient = %d",
            $profile_user_id, $current_user_id
        )
    );

    return $current_user_to_profile_user_count > 0 && $profile_user_to_current_user_count > 0;
}, 10, 1);
