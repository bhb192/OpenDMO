<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="theme-color" content="#686868">

<title><?php wp_title(''); ?></title>
        

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  
<link href="<?php if(!is_home()){the_permalink();} else{echo(home_url());} ?>" rel="canonical">

<?php wp_head(); ?>        

</head>

<body <?php body_class(); ?>><!-- the Body  -->
   
	<?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>
