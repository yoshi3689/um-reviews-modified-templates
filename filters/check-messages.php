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
    
    $messages_count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*)
             FROM {$wpdb->prefix}um_messages
             WHERE (author = %d AND recipient = %d)
                AND (author = %d AND recipient = %d)",
            $current_user_id, $profile_user_id, $profile_user_id, $current_user_id
        )
    );

    return $messages_count > 0;
}, 10, 1);
?>
