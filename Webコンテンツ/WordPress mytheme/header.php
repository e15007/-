<!--ヘッダーを共有-->
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo('name'); ?></title>
	<link rel="stylesheet"  href="<?php echo get_stylesheet_uri(); ?>">
     <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Acme">
	<meta name="viewport" content="width=device-width">


   <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
	<div class="siteinfo">
		<div class = "container">
		
		
			<h1 ><a href=" <?php echo home_url();?>"><?php bloginfo('name'); ?></a></h1>
			<p><?php bloginfo( 'description' ); ?></p>
		</div>
	</div>
	<div class="container">
		
		<nav>
			<?php wp_nav_menu('theme_location=navigation'); ?>
		</nav>
	</div>
</header><!-- /header -->