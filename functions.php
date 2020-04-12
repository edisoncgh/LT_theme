<?php
require get_template_directory() . '/inc/setting.php';   //setting
require get_template_directory() . '/inc/views.php';   //views

//开发者信息
function remove_footer_admin () {
echo 'based on <a href="http://www.zhutihome.net/6542.html" target="_blank">King</a>, developed and redesigned by <a href="https://www.edisoncgh.com" target="_blank">edisoncgh</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

//启用链接功能
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//去除评论隐患
function lxtx_comment_body_class($content)
{
    $pattern = "/(.*?)([^>]*)author-([^>]*)(.*?)/i";
    $replacement = '$1$4';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('comment_class', 'lxtx_comment_body_class');
add_filter('body_class', 'lxtx_comment_body_class');

//注销Google字体，加快加载
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_open_sans');
add_action('admin_enqueue_scripts', 'remove_open_sans');

//中英文间自动添加空格
add_filter( 'the_content','fanly_post_content_autospace' );
function fanly_post_content_autospace( $data ) {
	$data = preg_replace('/([\x{4e00}-\x{9fa5}]+)([A-Za-z0-9_]+)/u', '${1} ${2}', $data);
	$data = preg_replace('/([A-Za-z0-9_]+)([\x{4e00}-\x{9fa5}]+)/u', '${1} ${2}', $data);
	return $data;
}

//替换WORDPRESS默认头像网获取地址至国内
if (!function_exists('replace_to_v2ex_avatar')) {
    function replace_to_v2ex_avatar($avatarUrl) {
        return preg_replace(["/[0-9]\.gravatar\.com\/avatar/", "/secure.gravatar\.com\/avatar/"], "cdn.v2ex.com/gravatar", $avatarUrl);
    }
}
add_filter('get_avatar', 'replace_to_v2ex_avatar');

//自动重命名上传文件
add_filter('wp_handle_upload_prefilter', 'custom_upload_filter');
function custom_upload_filter($file)
{
    $info = pathinfo($file['name']);
    $ext = $info['extension'];
    $filedate = date('YmdHis') . rand(10, 99);
    //为了避免时间重复，再加一段2位的随机数
    $file['name'] = $filedate . '.' . $ext;
    return $file;
}

//默认avatar修改
add_filter( 'avatar_defaults', 'newgravatar' );  
 
function newgravatar ($avatar_defaults) {  
    $myavatar = get_bloginfo('template_directory') . '/images/commentator.png';  
    $avatar_defaults[$myavatar] = "LT主题默认头像";  
    return $avatar_defaults;  
}

/* comment_mail_notify v1.0 by willin kan. (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'cgh@edisoncgh.com@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style=" border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 查看回复完整內容</p>
      <p>欢迎再度光临 ' . get_option('blogname') . '</p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

//自定义评论列表模板
function simple_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
   		<div class="media">
   			<div class="media-left">
        		<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
   			</div>
   			<div class="media-body">
   				<?php printf(__('<p class="author_name">%s</p>'), get_comment_author_link()); ?>
   				<?php if($comment->user_id == 1) echo "<div class='author_com'><p style='color:#313131;font-size:10px' title='这是博主本人！'><b>博主</b></p></div>" ?>
		        <?php if ($comment->comment_approved == '0') : ?>
		            <em>评论等待审核...</em><br />
				<?php endif; ?>
				<?php comment_text(); ?>
   			</div>
   		</div>
   		<div class="comment-metadata">
   			<span class="comment-pub-time">
   				<?php echo get_comment_time('Y-m-d H:i'); ?>
   			</span>
   			<span class="comment-btn-reply">
 				<i class="fa fa-reply"></i> <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> 
   			</span>
   		</div>
 
<?php
}
?>