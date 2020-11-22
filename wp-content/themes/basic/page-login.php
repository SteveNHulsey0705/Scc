<?php
/**
 * Template Name: Page login
 *
 *
 */

get_header(); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style-login.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery.validate.min.js"></script>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- layout-container -->
<div id="layout" class="pagewidth page-login clearfix">

	<div id="contentWrapper" class="container">
		<div id="content">
<div class="links-users" style =" max-width: 978px; margin: 0 auto; margin-top: 26px;"><a href="http://creativamotion.com/luis/hub/login/">Login</a>&nbsp; | &nbsp;<a href="http://creativamotion.com/luis/hub/agency-registration/">Register</a></div>
			<div class="wrap-form-login">
				<form method="post" action="https://booking.hubfares.com/admin/login.aspx">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__ViewStateGuid" id="__ViewStateGuid" value="797de903-a2fe-4968-8b66-961460299f27-gj1ktgwmniyu2wi0ytziuvbx-8d3d279a7d7b38f">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="">
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAWvVXD1oYELeveMr0vHCmYPR1LBKX1P1xh290RQyTesRXO/fxMCZ7hhk7c7YJyUUGZSQqTVY25g6K561Y6rMiF10G1uBIYZDopU/6TaQIEm9CUlQnt5R61XuBawlriCFZjEV9ID">
					<h1 class="title">PLEASE LOGIN</h1>
					<div class="wrapinput">
						<i class="fa fa-user" aria-hidden="true"></i>
						<input type="text" name="UserName" placeholder="Name">
					</div>
					<div class="wrapinput">
						<i class="fa fa-key" aria-hidden="true"></i>
						<input type="password" name="UserPassword" placeholder="Password">
					</div>
					<button type="submit">LOGIN</button>
					<a href="https://booking.hubfares.com/admin/login.aspx" class="link">Forgot Password</a>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /layout-container -->

<?php get_footer(); ?>
