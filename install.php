<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Instalation
* @link https://docs.jabalicms.org/installation/
* @author Mauko Maunde
* @since 0.17.04
* @license MIT - https://opensource.org/licenses/MIT
**/

if ( !file_exists( 'app/config.php' ) ) {
	header( "Location: setup.php" );
}

require 'init.php';
if (isset( $_POST['register'] ) ) {
	$date = date( "Ymd H:i:s" );
    $email = $GLOBALS['JBLDB'] -> clean( $_POST['email'] );
    $site_name = $GLOBALS['JBLDB'] -> clean( $_POST['h_name'] );
    $social = array( "facebook" => "https://www.facebook.com/", "twitter" => "https://twitter.com/", "instagram" => "https://instagram.com/", "github" => "https://github.com/" );

    $hash = str_shuffle(md5($email .$date ) );

    $name = "Admin User";
    $author = 1;
    $avatar = _IMAGES.'avatar.png';
    $company = "Jabali CMS";
    $id = $author;
    $created = date( 'Y-m-d H:i:s' );
    $gender = "other";
    $authkey = $hash;
    $level = "admin";
    $link = "";
    $location = "nairobi";
    $excerpt = "Account created on ".$created;
    $password = md5( $_POST['password'] );
    $social = json_encode( $social );
    $status = "active";
    $style = "zahra";
    $type = "admin";
    $username = strtolower($_POST['username'] );

    $menu_code = substr( md5(date( 'YmdHms' ).rand(10,1000) ), 0, 12);

	$tos = "<p>OVERVIEW</p>

	<p>This website is operated by ". $site_name .". Throughout the site, the terms &ldquo;we&rdquo;, &ldquo;us&rdquo; and &ldquo;our&rdquo; refer to ". $site_name .". ". $site_name ." offers this website, including all information, tools and services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies and notices stated here. By visiting our site and/ or purchasing something from us, you engage in our &ldquo;Service&rdquo; and agree to be bound by the following terms and conditions (&ldquo;Terms of Service&rdquo;, &ldquo;Terms&rdquo;), including those additional terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/ or contributors of content. Please read these Terms of Service carefully before accessing or using our website. By accessing or using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services. If these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of Service. Any new features or tools which are added to the current store shall also be subject to the Terms of Service. You can review the most current version of the Terms of Service at any time on this page. We reserve the right to update, change or replace any part of these Terms of Service by posting updates and/or changes to our website. It is your responsibility to check this page periodically for changes. Your continued use of or access to the website following the posting of any changes constitutes acceptance of those changes. Our store is hosted on Shopify Inc. They provide us with the online e-commerce platform that allows us to sell our products and services to you.</p>

	<p>SECTION 1 - ONLINE STORE TERMS</p>

	<p>By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site. You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws). You must not transmit any worms or viruses or any code of a destructive nature. A breach or violation of any of the Terms will result in an immediate termination of your Services.</p>

	<p>SECTION 2 - GENERAL CONDITIONS</p>

	<p>We reserve the right to refuse service to anyone for any reason at any time. You understand that your content (not including credit card information), may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices. Credit card information is always encrypted during transfer over networks. You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service or any contact on the website through which the service is provided, without express written permission by us. The headings used in this agreement are included for convenience only and will not limit or otherwise affect these Terms.</p>

	<p>SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION We are not responsible if information made available on this site is not accurate, complete or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete or more timely sources of information. Any reliance on the material on this site is at your own risk. This site may contain certain historical information. Historical information, necessarily, is not current and is provided for your reference only. We reserve the right to modify the contents of this site at any time, but we have no obligation to update any information on our site. You agree that it is your responsibility to monitor changes to our site.</p>

	<p>SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES Prices for our products are subject to change without notice. We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time. We shall not be liable to you or to any third-party for any modification, price change, suspension or discontinuance of the Service.</p>

	<p>SECTION 5 - PRODUCTS OR SERVICES (if applicable) Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy. We have made every effort to display as accurately as possible the colors and images of our products that appear at the store. We cannot guarantee that your computer monitor&#39;s display of any color will be accurate. We reserve the right, but are not obligated, to limit the sales of our products or Services to any person, geographic region or jurisdiction. We may exercise this right on a case-by-case basis. We reserve the right to limit the quantities of any products or services that we offer. All descriptions of products or product pricing are subject to change at anytime without notice, at the sole discretion of us. We reserve the right to discontinue any product at any time. Any offer for any product or service made on this site is void where prohibited. We do not warrant that the quality of any products, services, information, or other material purchased or obtained by you will meet your expectations, or that any errors in the Service will be corrected.</p>

	<p>SECTION 6 - ACCURACY OF BILLING AND ACCOUNT INFORMATION</p>

	<p>We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per household or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting the e-mail and/or billing address/phone number provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors. You agree to provide current, complete and accurate purchase and account information for all purchases made at our store. You agree to promptly update your account and other information, including your email address and credit card numbers and expiration dates, so that we can complete your transactions and contact you as needed. For more detail, please review our Returns Policy.</p>

	<p>SECTION 7 - OPTIONAL TOOLS We may provide you with access to third-party tools over which we neither monitor nor have any control nor input. You acknowledge and agree that we provide access to such tools &rdquo;as is&rdquo; and &ldquo;as available&rdquo; without any warranties, representations or conditions of any kind and without any endorsement. We shall have no liability whatsoever arising from or relating to your use of optional third-party tools. Any use by you of optional tools offered through the site is entirely at your own risk and discretion and you should ensure that you are familiar with and approve of the terms on which tools are provided by the relevant third-party provider(s). We may also, in the future, offer new services and/or features through the website (including, the release of new tools and resources). Such new features and/or services shall also be subject to these Terms of Service.</p>

	<p>SECTION 8 - THIRD-PARTY LINKS Certain content, products and services available via our Service may include materials from third-parties. Third-party links on this site may direct you to third-party websites that are not affiliated with us. We are not responsible for examining or evaluating the content or accuracy and we do not warrant and will not have any liability or responsibility for any third-party materials or websites, or for any other materials, products, or services of third-parties. We are not liable for any harm or damages related to the purchase or use of goods, services, resources, content, or any other transactions made in connection with any third-party websites. Please review carefully the third-party&#39;s policies and practices and make sure you understand them before you engage in any transaction. Complaints, claims, concerns, or questions regarding third-party products should be directed to the third-party.</p>

	<p>SECTION 9 - USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS If, at our request, you send certain specific submissions (for example contest entries) or without a request from us you send creative ideas, suggestions, proposals, plans, or other materials, whether online, by email, by postal mail, or otherwise (collectively, &#39;comments&#39;), you agree that we may, at any time, without restriction, edit, copy, publish, distribute, translate and otherwise use in any medium any comments that you forward to us. We are and shall be under no obligation (1) to maintain any comments in confidence; (2) to pay compensation for any comments; or (3) to respond to any comments. We may, but have no obligation to, monitor, edit or remove content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party&rsquo;s intellectual property or these Terms of Service. You agree that your comments will not violate any right of any third-party, including copyright, trademark, privacy, personality or other personal or proprietary right. You further agree that your comments will not contain libelous or otherwise unlawful, abusive or obscene material, or contain any computer virus or other malware that could in any way affect the operation of the Service or any related website. You may not use a false e-mail address, pretend to be someone other than yourself, or otherwise mislead us or third-parties as to the origin of any comments. You are solely responsible for any comments you make and their accuracy. We take no responsibility and assume no liability for any comments posted by you or any third-party.</p>

	<p>SECTION 10 - PERSONAL INFORMATION Your submission of personal information through the store is governed by our Privacy Policy. To view our Privacy Policy.</p>

	<p>SECTION 11 - ERRORS, INACCURACIES AND OMISSIONS Occasionally there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information in the Service or on any related website is inaccurate at any time without prior notice (including after you have submitted your order). We undertake no obligation to update, amend or clarify information in the Service or on any related website, including without limitation, pricing information, except as required by law. No specified update or refresh date applied in the Service or on any related website, should be taken to indicate that all information in the Service or on any related website has been modified or updated.</p>

	<p>SECTION 12 - PROHIBITED USES In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the site or its content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, federal, provincial or state regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Service or of any related website, other websites, or the Internet; (h) to collect or track the personal information of others; (i) to spam, phish, pharm, pretext, spider, crawl, or scrape; (j) for any obscene or immoral purpose; or (k) to interfere with or circumvent the security features of the Service or any related website, other websites, or the Internet. We reserve the right to terminate your use of the Service or any related website for violating any of the prohibited uses.</p>

	<p>SECTION 13 - DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY We do not guarantee, represent or warrant that your use of our service will be uninterrupted, timely, secure or error-free. We do not warrant that the results that may be obtained from the use of the service will be accurate or reliable. You agree that from time to time we may remove the service for indefinite periods of time or cancel the service at any time, without notice to you. You expressly agree that your use of, or inability to use, the service is at your sole risk. The service and all products and services delivered to you through the service are (except as expressly stated by us) provided &#39;as is&#39; and &#39;as available&#39; for your use, without any representation, warranties or conditions of any kind, either express or implied, including all implied warranties or conditions of merchantability, merchantable quality, fitness for a particular purpose, durability, title, and non-infringement. In no case shall ". $site_name .", our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, service providers or licensors be liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind, including, without limitation lost profits, lost revenue, lost savings, loss of data, replacement costs, or any similar damages, whether based in contract, tort (including negligence), strict liability or otherwise, arising from your use of any of the service or any products procured using the service, or for any other claim related in any way to your use of the service or any product, including, but not limited to, any errors or omissions in any content, or any loss or damage of any kind incurred as a result of the use of the service or any content (or product) posted, transmitted, or otherwise made available via the service, even if advised of their possibility. Because some states or jurisdictions do not allow the exclusion or the limitation of liability for consequential or incidental damages, in such states or jurisdictions, our liability shall be limited to the maximum extent permitted by law.</p>

	<p>SECTION 14 - INDEMNIFICATION</p>

	<p>You agree to indemnify, defend and hold harmless ". $site_name ." and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, subcontractors, suppliers, interns and employees, harmless from any claim or demand, including reasonable attorneys&rsquo; fees, made by any third-party due to or arising out of your breach of these Terms of Service or the documents they incorporate by reference, or your violation of any law or the rights of a third-party.</p>

	<p>SECTION 15 - SEVERABILITY</p>

	<p>In the event that any provision of these Terms of Service is determined to be unlawful, void or unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by applicable law, and the unenforceable portion shall be deemed to be severed from these Terms of Service, such determination shall not affect the validity and enforceability of any other remaining provisions.</p>

	<p>SECTION 16 - TERMINATION The obligations and liabilities of the parties incurred prior to the termination date shall survive the termination of this agreement for all purposes. These Terms of Service are effective unless and until terminated by either you or us. You may terminate these Terms of Service at any time by notifying us that you no longer wish to use our Services, or when you cease using our site. If in our sole judgment you fail, or we suspect that you have failed, to comply with any term or provision of these Terms of Service, we also may terminate this agreement at any time without notice and you will remain liable for all amounts due up to and including the date of termination; and/or accordingly may deny you access to our Services (or any part thereof).</p>

	<p>SECTION 17 - ENTIRE AGREEMENT</p>

	<p>The failure of us to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision. These Terms of Service and any policies or operating rules posted by us on this site or in respect to The Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us (including, but not limited to, any prior versions of the Terms of Service). Any ambiguities in the interpretation of these Terms of Service shall not be construed against the drafting party.</p>

	<p>SECTION 18 - GOVERNING LAW</p>

	<p>These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of 12156, MTOPANGA, 300, 80117, Kenya.</p>

	<p>SECTION 19 - CHANGES TO TERMS OF SERVICE</p>

	<p>You can review the most current version of the Terms of Service at any time at this page. We reserve the right, at our sole discretion, to update, change or replace any part of these Terms of Service by posting updates and changes to our website. It is your responsibility to check our website periodically for changes. Your continued use of or access to our website or the Service following the posting of any changes to these Terms of Service constitutes acceptance of those changes.</p>

	<p>SECTION 20 - CONTACT INFORMATION</p>

	<p>Questions about the Terms of Service should be sent to us at  ". $email  ." </p>
	";

	/*
	*Set Initial Settings So They Are Editable
	*/
	$GLOBALS['OPTIONS'] -> install ( 'Site Name', 'name', $site_name, $created );
    $GLOBALS['OPTIONS'] -> install ( 'About', 'about', 'Coming Soon', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Description', 'description', 'Built With Jabali', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Admin Email', 'email', $email , $created );
	$GLOBALS['OPTIONS'] -> install ( 'Admin Phone', 'phone', '+254204404993', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Copyright', 'copyright', '© '. $site_name .' 2017', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Admin Footer', 'adfooter', 'The Jabali Framework', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Attribution', 'attribution', 'Mauko', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Attribution Link', 'attribution_link', 'https://mauko.co.ke', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Header Logo', 'headerlogo', _IMAGES."logo.png", $created );
	$GLOBALS['OPTIONS'] -> install ( 'Home Logo', 'homelogo', _IMAGES."logo-w.png", $created );
	$GLOBALS['OPTIONS'] -> install ( 'Favicon', 'favicon', _IMAGES."marker.png", $created );
	$GLOBALS['OPTIONS'] -> install ( 'Terms Of Service', 'tos', $tos, $created );
	$GLOBALS['OPTIONS'] -> install ( 'Site Social', 'social', $social, $created );
	$GLOBALS['OPTIONS'] -> install ( 'Allow Registration', 'registration', 'checked', $created );
    $GLOBALS['OPTIONS'] -> install ( 'User Types', 'usertypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Post Types', 'posttypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Resource Types', 'resourcetypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Comment Types', 'commenttypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Message Types', 'messagetypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Active Modules', 'modules', '[]', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Active Theme', 'activetheme', 'eventually', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Timezone', 'timezone', 'Africa/Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Country', 'country', 'Kenya', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Region', 'region', 'Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'City/Town', 'city', 'Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Language', 'language', 'en', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Charset', 'charset', 'utf-8', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Home Page', 'homepage', 'home', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Posts Page', 'postspage', 'blog', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Ace Editor Theme', 'acetheme', 'chrome', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Show Ace Editor Gutter', 'acegutter', 'true', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Show Ace Editor Lines', 'acelines', 'true', $created );


	/**
	* Set Initial Menus So They Are Editable
	**/
	//Dashboard Link
	$GLOBALS['MENUS'] -> install ( 'Dashboard', 'jabali', 'dashboard', 'dashboard'
        , '', _ADMIN.'index?page=dashboard', 'drawer', 'checked', 'drop' );

	//Posts Menu
	$GLOBALS['MENUS'] -> install ( 'Posts', 'jabali', 'description', 'posts', '', '#', 'drawer', 'checked', 'drop' );
		//Posts SubMenus
        $GLOBALS['MENUS'] -> install ( 'Drafts', 'jabali', 'insert_drive_file', 'draftarticles', 'posts', _ADMIN.'posts?status=draft', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Scheduled', 'jabali', 'schedule', 'scheduled', 'posts', _ADMIN.'posts?status=scheduled', 'drawer', 'checked', 'null' );
		$GLOBALS['MENUS'] -> install ( 'Articles', 'jabali', 'description', 'allarticles', 'posts', _ADMIN.'posts?type=article', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Pages', 'jabali', 'description', 'allpages', 'posts', _ADMIN.'posts?type=page', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Projects', 'jabali', 'description', 'allprojects', 'posts', _ADMIN.'posts?type=project', 'drawer', 'checked', 'null' );

	//Users Menu
	$GLOBALS['MENUS'] -> install ( 'Users', 'jabali', 'group', 'users', '', '#', 'drawer', 'checked', 'drop' );
		//Users SubMenus
        $GLOBALS['MENUS'] -> install ( 'Pending Users', 'jabali', 'done', 'draftusers', 'users', _ADMIN.'users?status=pending&key=users', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Adminstrators', 'jabali', 'description', 'alladmins', 'users', _ADMIN.'users?type=admin', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Editors', 'jabali', 'group', 'alleditors', 'users', _ADMIN.'users?type=editor', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Authors', 'jabali', 'group', 'allauthors', 'users', _ADMIN.'users?type=author', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Clients', 'jabali', 'group', 'allclients', 'users', _ADMIN.'users?type=client', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Subscribers', 'jabali', 'group', 'allsubscribers', 'users', _ADMIN.'users?type=subscriber', 'drawer', 'checked', 'null' );

    //Resources Menu
    $GLOBALS['MENUS'] -> install ( 'Resources', 'jabali', 'business', 'resources', '', '#', 'drawer', 'inchecked', 'drop' );
        //Resources SubMenus
        $GLOBALS['MENUS'] -> install ( 'Drafts', 'jabali', 'insert_drive_file', 'draftresources', 'resources', _ADMIN.'resources?status=draft', 'drawer', 'checked', 'null' );

    //Comments Menu
	$GLOBALS['MENUS'] -> install ( 'Comments', 'jabali', 'comment', 'comments', '', '#', 'drawer', 'checked', 'drop' );
        //Comments SubMenus
        $GLOBALS['MENUS'] -> install ( 'Pending', 'jabali', 'comment', 'pendingcomments', 'comments', _ADMIN.'comments?status=pending&key=pending comments', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Comments', 'jabali', 'comment', 'allcomments', 'comments', _ADMIN.'comments?type=comment', 'drawer', 'checked', 'null' );

    //Messages Menu
    $GLOBALS['MENUS'] -> install ( 'Messages', 'jabali', 'chat_bubble', 'messages', '', '#', 'drawer', '', 'drop' );
        //Messages SubMenus
        $GLOBALS['MENUS'] -> install ( 'Unread', 'jabali', 'message', 'pendingmessages', 'messages', _ADMIN.'messages?status=unread', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Messages', 'jabali', 'message', 'allmessages', 'messages', _ADMIN.'messages?type=message', 'drawer', 'checked', 'null' );
	/*
	*Create Admin Account
	*/
    if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."users (name, author, avatar, company, id, created, email, gender, authkey, level, link, location, excerpt, password, social, status, style, type, username) 
    VALUES ('".$name."', '".$author."', '".$avatar."', '".$company."', '".$id."', '".$created."', '".$email."', '".$gender."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$password."', '".$social."', '".$status."', '".$style."', '".$type."', '".$username."')" ) ) {

        $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."posts (name, author, author_name, avatar, categories, created, details, gallery, authkey, level, link, excerpt, readings, status, subtitle, slug, tags, template, type, updated) 
    VALUES ('Home', '1', '', '"._IMAGES."404.jpg"."', 'uncategorized', '".$created."', 'This is a sample page. Edit it or delete it alltogether.', '', '".md5( $created )."', 'public', '', '', '', 'published', 'Home', 'home', '', '', 'page', 'page', '".$created."')" );

        $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."posts (name, author, author_name, avatar, categories, created, details, gallery, authkey, level, link, excerpt, readings, status, subtitle, slug, tags, template, type, updated) 
    VALUES ('Hello World!', '1', 'Admin User', '"._IMAGES."placeholder.png"."', 'uncategorized', '".$created."', 'This is a sample article. Edit it or delete it alltogether.', '', '".md5( $created )."', 'public', 'hello-world', '', '', 'published', 'Hello', 'hello-world', 'starter', 'post', 'post', 'article', '".$created."')" );

		header("Location: "._ROOT."/login/jabali/" );

    } else {
        _shout_( "Error: " . $GLOBALS['JBLDB'] -> error(), "error");
    }
} else { 

    installSQLDB( $server["dbtype"] ); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="app/assets/css/materialize.css">
    	<link rel="stylesheet" href="app/assets/css/material-icons.css">
    	<link rel="stylesheet" href="app/assets/css/jabali.css">
    	<script src="app/assets/js/jquery-3.2.1.min.js"></script>
    	<script src="app/assets/js/materialize.min.js"></script>
    	<script src="app/assets/js/material.js"></script>
    	<title>Admin Setup - Jabali CMS</title>
    </head>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    	<body>
    		<main class="mdl-layout__content mdl-grid">
    			<div class="mdl-cell mdl-cell--4-col"></div>
    			<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone light-blue">
    			    <div id="login_div" class="mdl-grid">
    			    <div class="mdl-cell mdl-cell--12-col">
    			    <?php _shout_('Jabali Succesfully Installed<br>Set up your admin account', 'success'); ?>
                    </div>
    		          <form method="POST" action="" class="mdl-grid mdl-cell mdl-cell--12-col">

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">label</i>
    		          <input name="h_name" id="h_name" type="text">
    		          <label for="h_name" class="center-align">Site Name</label>
    		          </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">mail</i>
    		          <input name="email" id="email " type="text">
    		          <label for="email " class="center-align">Email Address</label>
    		          </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">perm_identity</i>
    		          <input name="username" id="username" type="text">
    		          <label for="username" class="center-align">Username</label>
    		          </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">lock</i>
    		          <input name="password" id="password" type="password">
    		          <label for="password">Password</label>
    		          </div>

    		          <button class="mdl mdl-button mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="register"><i class="material-icons">save</i> SUBMIT</button>
    		          </form>
    			    </div>
    		    </div>
    			<div class="mdl-cell mdl-cell--4-col"></div>
    	    </main>
    	</body>
    </div>
        <script type="text/javascript">
            $('#alert_close').click(function(){
            $( "#alert_box" ).fadeOut( "slow", function() {
            });
          }); 
        </script>
        <script src="app/assets/js/d3.js"></script>
        <script src="app/assets/js/getmdl-select.min.js"></script>
        <script src="app/assets/js/material.js"></script>
        <script src="app/assets/js/materialize.js"></script>
        <script src="app/assets/js/nv.d3.js"></script>
        <script src="app/assets/js/widgets/employer-form/employer-form.js"></script>
        <script src="app/assets/js/widgets/line-chart/line-chart-nvd3.js"></script>
        <script src="app/assets/js/list.js"></script>
        <script src="app/assets/js/widgets/pie-chart/pie-chart-nvd3.js"></script>
        <script src="app/assets/js/widgets/table/table.js"></script>
        <script src="app/assets/js/widgets/todo/todo.js"></script>
    </html><?php
}