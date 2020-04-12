<?php get_header(); ?>
                    <ul class="article-list">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="mainbox">
                        <li class="article-list-item reveal">
                            <a href="<?php the_permalink(); ?>">
                                 <h3><b><?php if( is_sticky() ) echo '<span style="color:grey;"><b>【↑置顶↑】</b></span>'; the_title(); ?></b></h3>
                            </a>
                            <p>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 90); ?></p>
                            </p>
                            <div class="article-list-footer">
                                <span class="article-list-date"><i class="iconfont icon-icon-test1"></i> <?php the_time('Y-n-j') ?></span>
                                <span class="article-list-minutes"><i class="iconfont icon-icon-test"></i> <?php echo getPostViews(get_the_ID()); ?></span>
                                <span class="article-list-categorys"> <i class="iconfont icon-tags"></i> 
                                	<?php
    									$category = get_the_category();
    									echo $category[0]->cat_name;
									?> -
                                </span>
                                <span class="article-list-tags"><?php echo get_the_tag_list('<p>Tags: ',', ','</p>'); ?></span>
                        	</div>
                        </li>
                		</div>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <h3 class="title"><a href="#" rel="bookmark">无文章</a></h3>
                        <p>博主暂时没有留下痕迹</p>
                        <?php endif; ?>
                    </ul>
<?php get_footer(); ?>