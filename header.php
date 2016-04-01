<!doctype html>
<html>
	<head>
		<title><?php wp_title('|'); ?></title>
		<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

	<?php wp_nav_menu(); ?>