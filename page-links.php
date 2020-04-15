<?php 
/*
Template Name: 友情链接
*/
get_header(); ?>	
	<div id="primary" class="site-content">
	    <?php while ( have_posts() ) : the_post(); ?>
	    	<div class="primary-site">
				<?php $bookmarks = get_bookmarks();
            	if ( !empty($bookmarks) ){
                foreach ($bookmarks as $bookmark) {
        echo '<article>
	    		<div class="fribox"> 
        		<section class="content">
        			<div class="entry-content">
        				<figure class="thumbnail"> 
        					<a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank"> 
        					<div class="fri_img" align="center">
        						<img src="' . $bookmark->link_image . '" class="attachment-thumbnail size-thumbnail wp-post-image" alt="'. $bookmark->link_name .'"/>
        					</div>
        					</a>
        				</figure>
        				<div class="fri_des">
    						<header class="entry-header">
    							<h3 class="entry-title">
    								<a href="' . $bookmark->link_url . '" title="'. $bookmark->link_name .'" target="_blank">'. $bookmark->link_name .'</a>
    							</h3>
    						</header> 
    						<div class="entry-site"><p>“' . $bookmark->link_description . '”</p></div>
    					</div>
    				</div>
    			</section>	
				</div>
    		</article>';
                }
            }
        ?>     
        	</div>    
		<?php endwhile; ?> 
	</div>
<?php get_footer(); ?>