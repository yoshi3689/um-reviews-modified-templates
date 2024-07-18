<?php
/**
 * Hook to display the default reviews content after the profile menu.
 *
 * This action hook is used to call the function 'um_profile_content_reviews_default'
 * which displays the default reviews content on the profile page. The content will
 * be displayed immediately after the profile menu section.
 *
 * Usage:
 * Place this code in your theme's functions.php file or in a custom plugin to
 * automatically add the reviews content to the user profile page.
 *
 * @hook um_profile_menu_after
 */
add_action( 'um_profile_menu_after', 'um_profile_content_reviews_default' );
