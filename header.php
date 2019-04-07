<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">

	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.css" />

	<?php
	// ENQUEUE your css and js in inc/enqueues.php
    wp_head();
	?>
</head>
<body <?php echo body_class(); ?>>
<div class="overlay"><div class="close"></div></div>
<header id="header" role="banner">
    <a href='<?php echo get_home_url()?>'>
        <img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png '?>">
    </a></header>
<section id="content" role="main">
