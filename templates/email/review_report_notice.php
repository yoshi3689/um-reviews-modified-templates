<?php
/**
 * Template for the "Reviews - Review is reported".
 * Send a notification to admin when someone report a review and its status is "Flagged".
 *
 * This template can be overridden by copying it to {your-theme}/ultimate-member/email/review_report_notice.php
 *
 * @version 2.2.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:20px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">

	<div style="color: #444444;font-weight: normal;">
		<div style="text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;">{site_name}</div>
		<div style="clear:both"></div>
	</div>

	<div style="padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;">

		<div style="margin: 30px 0px;font-size: 24px;text-align: center;line-height: 30px;">Review was reported.</div>

		<div style="margin: 15px 0px;font-size: 16px;line-height: 30px;">
			To see and check this review please click the following link:<br />
			<a href="{flagged_reviews_admin_link}" style="color: #3ba1da;text-decoration: none;">{flagged_reviews_admin_link}</a><br /><br />
		</div>
	</div>

	<div style="color: #999;padding: 20px 30px">

		<div style="">Thank you!</div>
		<div style="">The <a href="{site_url}" style="color: #3ba1da;text-decoration: none;">{site_name}</a> Team</div>

	</div>

</div>