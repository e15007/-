<!--サイトについての個別ページ-->
<?php get_header(); ?>

<div class="container">
	
<?php if(have_posts()): while(have_posts()):
the_post(); ?>
<article <?php post_class();?>>

<h1 class="sitetitle"><?php the_title(); ?></h1> <!-- オリジナルクラス -->

<div class ="conten">    <!--オリジナルクラス-->
		
<?php the_content(); ?>
	</div>	


</article>
<?php endwhile; endif;?>



<!--ウィジェットメニュー追加-->






</div> <!-- container -->

<?php get_footer(); ?>