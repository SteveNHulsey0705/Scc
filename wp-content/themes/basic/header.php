<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<?php

/** Themify Default Variables

 *  @var object */

global $themify; ?>

<meta charset="<?php bloginfo( 'charset' ); ?>">



<!-- wp_header -->

<?php wp_head(); ?>

<script type="text/javascript">

 jQuery(document).ready(function (){

 

jQuery("a.lear-more").click(function() {

	jQuery('#wpcf7-f2509-o1').fadeIn();

        jQuery('a.lear-more').fadeOut();

	return false;

});

jQuery("a.learn-more").click(function() {
	jQuery('#wpcf7-f2509-o1').fadeIn();
        jQuery('a.lear-more').fadeOut();
        jQuery.fancybox.close();
        jQuery('html, body').animate({
          scrollTop: jQuery('#wpcf7-f2509-o1').offset().top-120
         }, 700);
  return false;

});

jQuery("a.learn-more-banner").click(function() {
        jQuery('html, body').animate({
          scrollTop: jQuery('.first-content').offset().top
         }, 700);
  return false;

});



});

</script>

</head>



<body <?php body_class(); ?>>

<?php themify_body_start(); // hook ?>

<div id="pagewrap" class="hfeed site">



	<div id="headerwrap">



		<?php themify_header_before(); // hook ?>

		<header id="header" class="pagewidth" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

        <?php themify_header_start(); // hook ?>

			<hgroup>

				<?php echo themify_logo_image('site_logo'); ?>



				<?php if ( $site_desc = get_bloginfo( 'description' ) ) : ?>

					<?php global $themify_customizer; ?>

					<div id="site-description" class="site-description"><?php echo class_exists( 'Themify_Customizer' ) ? $themify_customizer->site_description( $site_desc ) : $site_desc; ?></div>

				<?php endif; ?>

			</hgroup>



			<nav itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">

				<div id="menu-icon" class="mobile-button"></div>

				<?php

				if ( function_exists( 'themify_custom_menu_nav' ) ) {

					themify_custom_menu_nav();

				} else {

					wp_nav_menu( array(

						'theme_location' => 'main-nav',

						'fallback_cb'    => 'themify_default_main_nav',

						'container'      => '',

						'menu_id'        => 'main-nav',

						'menu_class'     => 'main-nav'

					));

				}

				?>

				<!-- /#main-nav -->

			</nav>



			<?php if(!themify_check('setting-exclude_search_form')): ?>

				<?php get_search_form(); ?>

			<?php endif ?>



			<div class="social-widget">

				<?php dynamic_sidebar('social-widget'); ?>



				<?php if(!themify_check('setting-exclude_rss')): ?>

					<div class="rss"><a href="<?php if(themify_get('setting-custom_feed_url') != ""){ echo themify_get('setting-custom_feed_url'); } else { echo bloginfo('rss2_url'); } ?>">RSS</a></div>

				<?php endif ?>

			</div>

			<!-- /.social-widget -->

		<?php themify_header_end(); // hook ?>

		</header>

		<!-- /#header -->

        <?php themify_header_after(); // hook ?>



	</div>

	<!-- /#headerwrap -->



	<div id="body" class="clearfix">

    <?php themify_layout_before(); //hook ?>

<div style="display: none;">
<div id="box1" class="boxes-home" style="width: 750px;">
<?php echo ot_get_option( 'popup_left' ); ?>

</div>
</div>
<div style="display: none;">
<div id="box2" class="boxes-home" style="width: 750px;">
<?php echo ot_get_option( 'popup_center' ); ?>

</div>
</div>

<div style="display: none;">
<div id="box3" class="boxes-home" style="width: 750px;">
<?php echo ot_get_option( 'popup_right' ); ?>

</div>
</div>