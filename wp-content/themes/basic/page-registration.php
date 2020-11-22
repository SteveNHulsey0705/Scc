<?php
/**
 * Template Name: Page registration
 *
 *
 */

get_header(); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style-register.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery.validate.min.js"></script>
<script>
    jQuery().ready(function() {
      	jQuery('[data-toggle="tooltip"]').tooltip()	    

    	var container = jQuery('div.container-error');
		// validate the form when it is submitted
		var validator = jQuery("#form-registration").validate({
			errorContainer: container,
			errorLabelContainer: jQuery("ol", container),
			wrapper: 'li',
			messages: {
				agent_name: {
					required: 'The name agent is invalid.'
				},
				agent_email: {
					required: 'The email agent is invalid.'
				},
				agency_name: {
					required: 'The name agency is invalid.'
				},
				agency_phone: {
					required: 'The phone is invalid.'
				},
				agency_email: {
					required: 'The email agency is invalid.'
				},
				agency_address1: {
					required: 'The address 1 is invalid.'
				},
				agency_city: {
					required: 'The city is invalid.'
				},
				agree: {
					required: 'Accept the terms.'
				}
			}
		});
		jQuery('a.learn-more-banner').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			    var target = jQuery(this.hash);
			    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			    if (target.length) {
			        jQuery('html, body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			    }
			}
		});
    })
</script>
<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">
	<?php themify_content_before(); // hook ?>
	<!-- content -->
	<div id="content" class="clearfix">
    	<?php themify_content_start(); // hook ?>

		<?php
		/////////////////////////////////////////////
		// 404
		/////////////////////////////////////////////
		if(is_404()): ?>
			<h1 class="page-title"><?php _e('404','themify'); ?></h1>
			<p><?php _e( 'Page not found.', 'themify' ); ?></p>
		<?php endif; ?>

		<?php
		/////////////////////////////////////////////
		// PAGE
		/////////////////////////////////////////////
		?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="page-<?php the_ID(); ?>" class="type-page">

			<!-- page-title -->
			<?php if($themify->page_title != "yes"): ?>
				
				<time datetime="<?php the_time( 'o-m-d' ); ?>"></time>
				<h1 class="page-title"><?php the_title(); ?></h1>
			<?php endif; ?>
			<!-- /page-title -->

			<div class="page-content entry-content">

				<?php if ( $themify->hide_page_image != 'yes' && has_post_thumbnail() ) : ?>
					<figure class="post-image"><?php themify_image( "{$themify->auto_featured_image}w={$themify->page_image_width}&h=0&ignore=true" ); ?></figure>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<p class="post-pagination"><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>


				<!-- comments -->
				<?php if(!themify_check('setting-comments_pages') && $themify->query_category == ""): ?>
					<?php comments_template(); ?>
				<?php endif; ?>
				<!-- /comments -->

			</div>
			<!-- /.post-content -->

			</div><!-- /.type-page -->
		<?php endwhile; endif; ?>

		<?php
		/////////////////////////////////////////////
		// Query Category
		/////////////////////////////////////////////
		?>

		<?php

		if($themify->query_category != ""): ?>

			<?php if(themify_get('section_categories') != 'yes'): ?>

				<?php query_posts( apply_filters( 'themify_query_posts_page_args', 'cat='.$themify->query_category.'&posts_per_page='.$themify->posts_per_page.'&paged='.$themify->paged.'&order='.$themify->order.'&orderby='.$themify->orderby ) ); ?>

					<?php if(have_posts()): ?>

						<!-- loops-wrapper -->
						<div id="loops-wrapper" class="loops-wrapper <?php echo $themify->layout . ' ' . $themify->post_layout; ?>">

							<?php while(have_posts()) : the_post(); ?>

								<?php get_template_part('includes/loop', 'query'); ?>

							<?php endwhile; ?>

						</div>
						<!-- /loops-wrapper -->

						<?php if ($themify->page_navigation != "yes"): ?>
							<?php get_template_part( 'includes/pagination'); ?>
						<?php endif; ?>

					<?php else : ?>

					<?php endif; ?>

			<?php else: ?>

				<?php $categories = explode(",",str_replace(" ","",$themify->query_category)); ?>

				<?php foreach($categories as $category): ?>

					<?php $category = get_term_by(is_numeric($category)? 'id': 'slug', $category, 'category');
					$cats = get_categories( array( 'include' => isset( $category ) && isset( $category->term_id )? $category->term_id : 0, 'orderby' => 'id' ) ); ?>

					<?php foreach($cats as $cat): ?>

						<?php query_posts( apply_filters( 'themify_query_posts_page_args', 'cat='.$cat->cat_ID.'&posts_per_page='.$themify->posts_per_page.'&paged='.$themify->paged.'&order='.$themify->order.'&orderby='.$themify->orderby ) ); ?>

						<?php if(have_posts()): ?>

							<!-- category-section -->
							<div class="category-section clearfix <?php echo $cat->slug; ?>-category">

								<h3 class="category-section-title"><a href="<?php echo esc_url( get_category_link($cat->cat_ID) ); ?>" title="<?php _e('View more posts', 'themify'); ?>"><?php echo $cat->cat_name; ?></a></h3>

								<!-- loops-wrapper -->
								<div id="loops-wrapper" class="loops-wrapper <?php echo $themify->layout . ' ' . $themify->post_layout; ?>">
									<?php while(have_posts()) : the_post(); ?>

										<?php get_template_part('includes/loop', 'query'); ?>

									<?php endwhile; ?>
								</div>
								<!-- /loops-wrapper -->

								<?php if ($themify->page_navigation != "yes"): ?>
									<?php get_template_part( 'includes/pagination'); ?>
								<?php endif; ?>

							</div>
							<!-- /category-section -->

						<?php else : ?>

						<?php endif; ?>

					<?php endforeach; ?>

				<?php endforeach; ?>

			<?php endif; ?>

			<?php wp_reset_query(); ?>

		<?php endif; ?>

		<?php themify_content_end(); // hook ?>
	</div>
	<!-- /content -->
    <?php themify_content_after(); // hook ?>

	<div id="content-register" class="container">
		<form id="form-registration" class="form-horizontal row" action="" method="post">
			<div class="container-error">
				<ol>
				</ol>
			</div>
			<h1 class="title">Agency Registration</h1>
			<p>Register for HUB Optimal Airfare Aggregation.</p>
			<h2 class="subtitle">Agent Information</h2>
			<div class="col-md-4">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agent_email" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must be between 1 and 255 characters.&nbsp; Must be a valid email format.">Agent Email</label>
                	<div class="col-sm-8">
                		<input class="form-control" type="email" name="agent_email" id="agent_email" value="" required>
                	</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agent_name" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must be between 1 and 124 characters.">Agent Name</label>
                	<div class="col-sm-8">
                		<input class="form-control" type="text" name="agent_name" id="agent_name" value="" required>
                	</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agent_remail" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must be between 1 and 255 characters.&nbsp; Must be a valid email format.">Re-type Email</label>
                	<div class="col-sm-8">
                		<input class="form-control" type="email" name="agent[remail]" id="agent_remail" value="">
                	</div>
				</div>
			</div>
			
			<h2 class="subtitle">Agency Information</h2>
			<p>This information is required for the agency.</p>

			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agency_name" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must be between 1 and 124 characters.">Agency Name</label>
					<div class="col-sm-8">
						<input maxlength="124" class="form-control" type="text" name="agency_name" id="agency_name" value="" required>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agency_affiliation_type" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must select from dropdown.">Agency Affiliation Type</label>
					<div class="col-sm-8">
                		<select id="junk_agency_affiliation_type" name="agency[affiliation_type]" class="form-control">
                			<option value="IATA">IATA</option>
                			<option value="CLIA">CLIA</option>
                			<option value="TRUE">TRUE</option>
                			<option value="ACTA">ACTA</option>
                			<option value="TICO">TICO</option>
                			<option value="NEXION">NEXION</option>
                			<option value="Travel_Planners">Travel Planners</option>
                			<option value="Travel">Travel</option>
                			<option selected="selected" value="Other">Other</option>
                		</select>
                	</div>
                </div>

                <div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Phone</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency_phone" id="" value="" required>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Website</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency[website]" id="" value="">
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Address 2</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency[address2]" id="" value="">
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Country</label>
					<div class="col-sm-8">
						<select name="agency[country_id]" class="form-control">
							<option value="1">* - Any</option>
							<option value="235">AD - Andorra</option>
							<option value="2">AE - United Arab Emirates</option>
							<option value="3">AF - Afghanistan</option>
							<option value="4">AG - Antigua and Barbuda</option>
							<option value="5">AI - Anguilla</option>
							<option value="6">AL - Albania</option>
							<option value="7">AM - Armenia</option>
							<option value="8">AN - Netherlands Antilles</option>
							<option value="9">AO - Angola</option>
							<option value="246">AQ - Antarctica</option>
							<option value="10">AR - Argentina</option>
							<option value="11">AS - American Samoa</option>
							<option value="12">AT - Austria</option>
							<option value="13">AU - Australia</option>
							<option value="14">AW - Aruba</option>
							<option value="15">AZ - Azerbaijan</option>
							<option value="16">BA - Bosnia and Herzegovina</option>
							<option value="17">BB - Barbados</option>
							<option value="18">BD - Bangladesh</option>
							<option value="19">BE - Belgium</option>
							<option value="20">BF - Burkina Faso</option>
							<option value="21">BG - Bulgaria</option>
							<option value="22">BH - Bahrain</option>
							<option value="23">BI - Burundi</option>
							<option value="24">BJ - Benin</option>
							<option value="25">BL - Saint Barthelemy</option>
							<option value="26">BM - Bermuda</option>
							<option value="27">BN - Brunei</option>
							<option value="28">BO - Bolivia</option>
							<option value="252">BQ - Caribbean Netherlands</option>
							<option value="29">BR - Brazil</option>
							<option value="30">BS - Bahamas</option>
							<option value="31">BT - Bhutan</option>
							<option value="32">BW - Botswana</option>
							<option value="33">BY - Belarus</option>
							<option value="34">BZ - Belize</option>
							<option value="35">CA - Canada</option>
							<option value="36">CC - Cocos (Keeling) Islands</option>
							<option value="37">CD - Congo (Kinshasa)</option>
							<option value="38">CF - Central African Republic</option>
							<option value="39">CG - Congo (Brazzaville)</option>
							<option value="40">CH - Switzerland</option>
							<option value="41">CI - Ivory Coast</option>
							<option value="42">CK - Cook Islands</option>
							<option value="43">CL - Chile</option>
							<option value="44">CM - Cameroon</option>
							<option value="45">CN - China</option>
							<option value="46">CO - Colombia</option>
							<option value="47">CR - Costa Rica</option>
							<option value="48">CU - Cuba</option>
							<option value="49">CV - Cape Verde</option>
							<option value="247">CW - Curacao</option>
							<option value="50">CX - Christmas Island</option>
							<option value="51">CY - Cyprus</option>
							<option value="52">CZ - Czech Republic</option>
							<option value="53">DE - Germany</option>
							<option value="54">DJ - Djibouti</option>
							<option value="55">DK - Denmark</option>
							<option value="56">DM - Dominica</option>
							<option value="57">DO - Dominican Republic</option>
							<option value="58">DZ - Algeria</option>
							<option value="59">EC - Ecuador</option>
							<option value="60">EE - Estonia</option>
							<option value="61">EG - Egypt</option>
							<option value="62">EH - Western Sahara</option>
							<option value="63">ER - Eritrea</option>
							<option value="64">ES - Spain</option>
							<option value="65">ET - Ethiopia</option>
							<option value="66">FI - Finland</option>
							<option value="67">FJ - Fiji</option>
							<option value="68">FK - Falkland Islands</option>
							<option value="69">FM - Micronesia</option>
							<option value="70">FO - Faroe Islands</option>
							<option value="71">FR - France</option>
							<option value="72">GA - Gabon</option>
							<option value="73">GB - United Kingdom</option>
							<option value="74">GD - Grenada</option>
							<option value="75">GE - Georgia</option>
							<option value="76">GF - French Guiana</option>
							<option value="77">GG - Guernsey</option>
							<option value="78">GH - Ghana</option>
							<option value="79">GI - Gibraltar</option>
							<option value="80">GL - Greenland</option>
							<option value="81">GM - Gambia</option>
							<option value="82">GN - Guinea</option>
							<option value="83">GP - Guadeloupe</option>
							<option value="84">GQ - Equatorial Guinea</option>
							<option value="85">GR - Greece</option>
							<option value="240">GS - South Georgia and the South Sandwich Islands</option>
							<option value="86">GT - Guatemala</option>
							<option value="87">GU - Guam</option>
							<option value="88">GW - Guinea-Bissau</option>
							<option value="89">GY - Guyana</option>
							<option value="90">HK - Hong Kong</option>
							<option value="91">HN - Honduras</option>
							<option value="92">HR - Croatia</option>
							<option value="93">HT - Haiti</option>
							<option value="94">HU - Hungary</option>
							<option value="95">ID - Indonesia</option>
							<option value="96">IE - Ireland</option>
							<option value="97">IL - Israel</option>
							<option value="98">IM - Isle of Man</option>
							<option value="99">IN - India</option>
							<option value="245">IO - British Indian Ocean Territory</option>
							<option value="100">IQ - Iraq</option>
							<option value="101">IR - Iran</option>
							<option value="102">IS - Iceland</option>
							<option value="103">IT - Italy</option>
							<option value="104">JE - Jersey</option>
							<option value="105">JM - Jamaica</option>
							<option value="106">JO - Jordan</option>
							<option value="107">JP - Japan</option>
							<option value="108">KE - Kenya</option>
							<option value="109">KG - Kyrgyzstan</option>
							<option value="110">KH - Cambodia</option>
							<option value="111">KI - Kiribati</option>
							<option value="112">KM - Comoros</option>
							<option value="113">KN - Saint Kitts and Nevis</option>
							<option value="114">KP - North Korea</option>
							<option value="115">KR - South Korea</option>
							<option value="116">KS - Kosovo</option>
							<option value="117">KW - Kuwait</option>
							<option value="118">KY - Cayman Islands</option>
							<option value="119">KZ - Kazakhstan</option>
							<option value="120">LA - Laos</option>
							<option value="121">LB - Lebanon</option>
							<option value="122">LC - Saint Lucia</option>
							<option value="236">LI - Liechtenstein</option>
							<option value="123">LK - Sri Lanka</option>
							<option value="124">LR - Liberia</option>
							<option value="125">LS - Lesotho</option>
							<option value="126">LT - Lithuania</option>
							<option value="127">LU - Luxembourg</option>
							<option value="128">LV - Latvia</option>
							<option value="129">LY - Libya</option>
							<option value="130">MA - Morocco</option>
							<option value="237">MC - Monaco</option>
							<option value="131">MD - Moldova</option>
							<option value="132">ME - Montenegro</option>
							<option value="249">MF - Saint Martin</option>
							<option value="133">MG - Madagascar</option>
							<option value="134">MH - Marshall Islands</option>
							<option value="135">MK - Macedonia</option>
							<option value="136">ML - Mali</option>
							<option value="137">MM - Burma</option>
							<option value="138">MN - Mongolia</option>
							<option value="139">MO - Macau</option>
							<option value="140">MP - Northern Mariana Islands</option>
							<option value="141">MQ - Martinique</option>
							<option value="142">MR - Mauritania</option>
							<option value="143">MS - Montserrat</option>
							<option value="144">MT - Malta</option>
							<option value="145">MU - Mauritius</option>
							<option value="146">MV - Maldives</option>
							<option value="147">MW - Malawi</option>
							<option value="148">MX - Mexico</option>
							<option value="149">MY - Malaysia</option>
							<option value="150">MZ - Mozambique</option>
							<option value="232">N- - Outside US/CA</option>
							<option value="151">NA - Namibia</option>
							<option value="152">NC - New Caledonia</option>
							<option value="153">NE - Niger</option>
							<option value="154">NF - Norfolk Island</option>
							<option value="155">NG - Nigeria</option>
							<option value="156">NI - Nicaragua</option>
							<option value="157">NL - Netherlands</option>
							<option value="158">NO - Norway</option>
							<option value="159">NP - Nepal</option>
							<option value="160">NR - Nauru</option>
							<option value="161">NU - Niue</option>
							<option value="162">NZ - New Zealand</option>
							<option value="163">OM - Oman</option>
							<option value="164">PA - Panama</option>
							<option value="165">PE - Peru</option>
							<option value="166">PF - French Polynesia</option>
							<option value="167">PG - Papua New Guinea</option>
							<option value="168">PH - Philippines</option>
							<option value="169">PK - Pakistan</option>
							<option value="170">PL - Poland</option>
							<option value="171">PM - Saint Pierre and Miquelon</option>
							<option value="233">PN - Pitcairn</option>
							<option value="172">PR - Puerto Rico</option>
							<option value="241">PS - State of Palestine</option>
							<option value="173">PT - Portugal</option>
							<option value="174">PW - Palau</option>
							<option value="175">PY - Paraguay</option>
							<option value="176">QA - Qatar</option>
							<option value="177">RE - Reunion</option>
							<option value="178">RO - Romania</option>
							<option value="179">RS - Serbia</option>
							<option value="180">RU - Russia</option>
							<option value="181">RW - Rwanda</option>
							<option value="182">SA - Saudi Arabia</option>
							<option value="183">SB - Solomon Islands</option>
							<option value="184">SC - Seychelles</option>
							<option value="185">SD - Sudan</option>
							<option value="186">SE - Sweden</option>
							<option value="187">SG - Singapore</option>
							<option value="188">SH - Saint Helena</option>
							<option value="189">SI - Slovenia</option>
							<option value="242">SJ - Svalbard and Jan Mayen</option>
							<option value="190">SK - Slovakia</option>
							<option value="191">SL - Sierra Leone</option>
							<option value="238">SM - San Marino</option>
							<option value="192">SN - Senegal</option>
							<option value="193">SO - Somalia</option>
							<option value="194">SR - Suriname</option>
							<option value="195">SS - South Sudan</option>
							<option value="196">ST - Sao Tome and Principe</option>
							<option value="197">SV - El Salvador</option>
							<option value="250">SX - Sint Maarten</option>
							<option value="198">SY - Syria</option>
							<option value="199">SZ - Swaziland</option>
							<option value="200">TC - Turks and Caicos Islands</option>
							<option value="201">TD - Chad</option>
							<option value="243">TF - French Southern Territories</option>
							<option value="202">TG - Togo</option>
							<option value="203">TH - Thailand</option>
							<option value="204">TJ - Tajikistan</option>
							<option value="234">TK - Tokelau</option>
							<option value="205">TL - Timor-Leste</option>
							<option value="206">TM - Turkmenistan</option>
							<option value="207">TN - Tunisia</option>
							<option value="208">TO - Tonga</option>
							<option value="209">TR - Turkey</option>
							<option value="210">TT - Trinidad and Tobago</option>
							<option value="211">TV - Tuvalu</option>
							<option value="212">TW - Taiwan</option>
							<option value="213">TZ - Tanzania</option>
							<option value="214">UA - Ukraine</option>
							<option value="215">UG - Uganda</option>
							<option value="251">UM - United States Minor Outlying Islands</option>
							<option value="216">US - United States</option>
							<option value="217">UY - Uruguay</option>
							<option value="218">UZ - Uzbekistan</option>
							<option value="239">VA - Vatican City</option>
							<option value="219">VC - Saint Vincent and the Grenadines</option>
							<option value="220">VE - Venezuela</option>
							<option value="221">VG - British Virgin Islands</option>
							<option value="222">VI - U.S. Virgin Islands</option>
							<option value="223">VN - Vietnam</option>
							<option value="224">VU - Vanuatu</option>
							<option value="225">WF - Wallis and Futuna</option>
							<option value="226">WS - Samoa</option>
							<option value="248">XK - Kosovo</option>
							<option value="227">YE - Yemen</option>
							<option value="228">YT - Mayotte</option>
							<option value="229">ZA - South Africa</option>
							<option value="230">ZM - Zambia</option>
							<option value="244">ZR - Congo (ZR)</option>
							<option value="231">ZW - Zimbabwe</option>
						</select>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Postal / Zip Code</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency[zip]" id="" value="">
                	</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="agency_email" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp; Must be between 1 and 255 characters.&nbsp; Must be a valid email format.">Agency Email</label>
					<div class="col-sm-8">
						<input maxlength="255" class="form-control" type="text" name="agency_email" id="agency_email" value="" required>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Affiliation Number</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency[affiliation_number]" id="" value="">
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Fax</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency[fax]" id="" value="">
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Address 1</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency_address1" id="" value="" required>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency City</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="agency_city" id="" value="" required>
                	</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label" for="" data-toggle="tooltip" data-placement="bottom" title="Cannot be empty.&nbsp;">Agency Region / State</label>
					<div class="col-sm-8">
						<select name="agency[region_id]" class="form-control">
							<option value="1">* - Any</option>
							<option value="2">AB - Alberta</option>
							<option value="16">AK - Alaska</option>
							<option value="17">AL - Alabama</option>
							<option value="18">AR - Arkansas</option>
							<option value="19">AZ - Arizona</option>
							<option value="3">BC - British Columbia</option>
							<option value="20">CA - California</option>
							<option value="21">CO - Colorado</option>
							<option value="22">CT - Connecticut</option>
							<option value="23">DC - District of Columbia</option>
							<option value="24">DE - Delaware</option>
							<option value="25">FL - Florida</option>
							<option value="26">GA - Georgia</option>
							<option value="27">HI - Hawaii</option>
							<option value="28">IA - Iowa</option>
							<option value="29">ID - Idaho</option>
							<option value="30">IL - Illinois</option>
							<option value="31">IN - Indiana</option>
							<option value="32">KS - Kansas</option>
							<option value="33">KY - Kentucky</option>
							<option value="34">LA - Louisiana</option>
							<option value="35">MA - Massachusetts</option>
							<option value="4">MB - Manitoba</option>
							<option value="36">MD - Maryland</option>
							<option value="37">ME - Maine</option>
							<option value="38">MI - Michigan</option>
							<option value="39">MN - Minnesota</option>
							<option value="40">MO - Missouri</option>
							<option value="41">MS - Mississippi</option>
							<option value="42">MT - Montana</option>
							<option selected="selected" value="68">NA - Outside US/CA</option>
							<option value="5">NB - New Brunswick</option>
							<option value="43">NC - North Carolina</option>
							<option value="44">ND - North Dakota</option>
							<option value="45">NE - Nebraska</option>
							<option value="46">NH - New Hampshire</option>
							<option value="47">NJ - New Jersey</option>
							<option value="6">NL - Newfoundland</option>
							<option value="48">NM - New Mexico</option>
							<option value="7">NS - Nova Scotia</option>
							<option value="8">NT - Northwest Territories</option>
							<option value="9">NU - Nunavut</option>
							<option value="49">NV - Nevada</option>
							<option value="50">NY - New York</option>
							<option value="51">OH - Ohio</option>
							<option value="52">OK - Oklahoma</option>
							<option value="10">ON - Ontario</option>
							<option value="53">OR - Oregon</option>
							<option value="54">PA - Pennsylvania</option>
							<option value="11">PE - Prince Edward Island</option>
							<option value="12">QC - Quebec</option>
							<option value="55">RI - Rhode Island</option>
							<option value="56">SC - South Carolina</option>
							<option value="57">SD - South Dakota</option>
							<option value="13">SK - Saskatchewan</option>
							<option value="58">TN - Tennessee</option>
							<option value="59">TX - Texas</option>
							<option value="60">UC - (unassigned)</option>
							<option value="61">UT - Utah</option>
							<option value="14">UU - (unassigned)</option>
							<option value="62">VA - Virginia</option>
							<option value="69">VI - Virgin Islands</option>
							<option value="63">VT - Vermont</option>
							<option value="64">WA - Washington</option>
							<option value="65">WI - Wisconsin</option>
							<option value="66">WV - West Virginia</option>
							<option value="67">WY - Wyoming</option>
							<option value="15">YT - Yukon Territory</option>
						</select>
                	</div>
				</div>
			</div>
			<div class="col-md-12">
				<div id="block-terms">
					<p><strong>In this agreement, the “Agency Owner” agrees to be personally responsible for all financial transactions between the “Agency” and Access To Travel Inc.,Dba AccessFares.</strong></p>
					<ol>
						<li>Agency fully agrees to pay “AccessFares” payment for all tickets issued under the account set up for your agency.</li>
						<li>Agency fully agrees to pay “AccessFares” any fees/penalties or debit memos issued by the airlines for any booking/pricing violations or alteration of ticketed PNR’s committed by the “Agency” on any record re-released back to the “Agency” after ticketing.</li>
						<li>Agency fully agrees to pay “AccessFares” any and all amounts due as a result of a credit cardholder disclaiming charges for ticket/s purchased from “AccessFares” including fees/penalties or debit memos associated with any credit card charge back or fraud issue committed by the passenger/cardholder.</li>
						<li>Agency fully agrees to pay “AccessFares” any fees/penalties or debit memos issued by the airlines for any “HX” segments not being removed from any reservation re-released back to the “Agency” after ticketing and for any debit memos resulting from a NO SHOW.</li>
						<li>Agency fully agrees to pay “AccessFares” any commission recall generated by the airlines on refunded tickets processed through AccessFares or the airlines directly.</li>
						<li>Agency will be fully responsible for advising passengers of any schedule changes or flight cancellations.</li>
						<li>If Agency fails to pay “AccessFares” any amount when due under this agreement, Agency agrees to pay all costs of collection, including but not limited to all court costs and reasonable attorney fees.</li>
					</ol>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
				      <div class="checkbox">
				        <input type="checkbox" name="agree" id="agree" required/>
						<label for="agree">I agree to the terms of service</label>
				      </div>
				    </div>
				</div>
				<hr>
			</div>
			<div class="col-md-12">
				<button type="submit" name="btnSave" id="btnSave">REGISTER</button>
			</div>
		</form>
	</div>
</div>
<!-- /layout-container -->

<?php get_footer(); ?>
