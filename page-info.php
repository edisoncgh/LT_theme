<?php 
/*
Template Name: 关于
*/
get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php setPostViews(get_the_ID()); ?>  
					<div class="Guanyu">
                        	<header class="article-header">
                            	<h1 align="center"><b><?php the_title(); ?></b></h1>
                        	</header>
                    </div>
                    <div class="mainbox">
                    	<article class="article reveal">
                         <div class="article-content">
                          <?php the_content(); ?>
                         </div>
                         <script type="text/javascript">
    						$(document).ready(function(){
        						$('pre').each(function(i,block){
            					hljs.highlightBlock(block);
        							});
    							});
						</script>
                    <hr />
                    </article>
                 </div>
<?php endif; ?>
<div class="mainbox">
	<div class="article-comments" id="article-comments">
        	<?php if (comments_open() || get_comments_number()) :
            	comments_template();
        	endif;
    	    ?>
	</div>
</div>
<?php get_footer(); ?>