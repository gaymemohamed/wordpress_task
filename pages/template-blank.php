<?php

/*
	Template Name: Blank | صفحة فارغة
*/

if (!defined('ABSPATH')) exit;
while (have_posts()) {
	the_post();
	the_content();
}
