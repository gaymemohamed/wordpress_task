<?php if (!defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="referrer" content="strict-origin" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
        
        <title><?php echo BaseGetTitle(); ?></title>
		<link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
        <?php
		echo BaseGetFavicons();
		echo BaseMetaGraph();
		wp_head();
		?>
        
    </head>
	<body>