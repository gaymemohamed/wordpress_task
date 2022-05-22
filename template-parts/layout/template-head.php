<?php if (!defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html dir="<?php echo DIR; ?>" <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="referrer" content="strict-origin" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<title> <?php echo BaseGetTitle(); ?> </title>

	<?php
		echo BaseGetFavicons();
		echo BaseMetaGraph();
		wp_head();
	?>

</head>

<?php
	$red = get_post_meta( get_the_ID(), 'red', true);
	$dark = get_post_meta( get_the_ID(), 'dark', true);

	if( $dark == true ){
		$class = " dark--header ";
	}elseif( $red == true ){
		$class = " danger--header ";
	}else{
		$class = "";
	}
?>

<body <?php body_class($class); ?>>

<?php 
	wp_body_open();
	if(function_exists('baseCustomizeBtn')){
		echo baseCustomizeBtn();
	}
?>