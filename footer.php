<footer class="footer reveal">
    <p> © <?php the_time('Y') ?> <?php bloginfo('name'); ?> · <a href="http://www.beian.miit.gov.cn/" target="_blank"><?php echo get_option('LT_beian') ;?></a> · Theme LT · Made with <i class="czs-heart" style="color: rgb(228, 16, 0);font-size: 12px;"></i> by   <a href="https://www.edisoncgh.com/introduction" title="Theme author" target="_blank">edisoncgh</a></p>
    <div class="poets">
        <span id="jinrishici-sentence">太白饮酒中......</span>
		<script src="https://sdk.jinrishici.com/v2/browser/jinrishici.js" charset="utf-8"></script><br />
    </div>
</footer>
<script src='<?php echo get_stylesheet_directory_uri(); ?>/js/highlight.pack.js' type='text/javascript'></script>
<div class = back_top>
	<a id="back_to_top" href="#" class="back_to_top"><span>↑</span></a>
</div>
    <script>
        $(document).ready((function(_this) {
            return function() {
                var bt; bt = $('#back_to_top'); if ($(document).width() > 480) {
                    $(window).scroll(function() {
                        var st; st = $(window).scrollTop(); if (st > 30) {
                            return bt.css('display', 'block')} else {
                            return bt.css('display', 'none')}}); return bt.click(function() {
                        $('body,html').animate({
                            scrollTop: 0
                        }, 800); return false
                    })}}})
            (this));
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash); target = target.length?target: $('[name='+this.hash.slice(1)+']'); if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 500); return false
                    }}})});
    </script>
<?php wp_footer(); ?>