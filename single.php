<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php setPostViews(get_the_ID()); ?>  
				<div class="mainbox">
                    <article class="article reveal">
                        <header class="article-header">
                             <h2><b><?php the_title(); ?></b></h2>
                            <p></p>
                            <div class="article-list-footer"> 
                            	<i class="iconfont icon-icon-test1"></i> <span class="article-list-date"><?php the_time('Y-n-j') ?></span>
								<i class="iconfont icon-icon-test"></i> <span class="article-list-minutes"><?php echo getPostViews(get_the_ID()); ?>  </span>
								<i class="iconfont icon-tags"></i> <span class="article-list-categorys">分类目录: 
                                	<?php
    									$category = get_the_category();
    									echo $category[0]->cat_name;
									?> · 
                                </span>
                                <span class="article-list-tags"><?php echo get_the_tag_list('Tags: ',', ',''); ?></span>
                            </div>
                        </header>
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
                    <div class="article-list-ann">
                    <p style="font-size: 12px">
                    	本文采用
                    	<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">CC BY-NC-SA 4.0 协议</a>进行授权，如无注明均为原创，转载请注明转自
                    	<a href="<?php echo get_option('LT_single_url') ;?>" target="_blank"><?php echo get_option('LT_name') ;?></a><br />
                    	本文为:《<?php echo get_the_title(); ?>》，文章链接为：<a href="<?php echo get_permalink(); ?>"><?php echo get_permalink(); ?></a>
                    </p>
                	</div>
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