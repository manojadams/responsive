<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

//for rating related purpose
//updates rating fields on each posting of event
if(isset($_POST['event-complete'])&&is_user_logged_in()){
         global $current_user;

         $reqd_posts = get_posts( 'author='.$current_user->ID.'&posts_per_page=-1&category=event&meta_key=event-complete&meta_value=1' );
         $user_rating=0;$counter=0;
         foreach($reqd_posts as $reqd_post){
            
             $user_rating = $user_rating + intval(get_post_meta($reqd_post->ID,'crfp-average-rating',true));
             $counter++;
         }
try {
         $user_rating = $user_rating/($counter);  
} catch(Exception $e){echo 'Division by zero exception occured';return;}
$repu_key = 'rpr_reputation';
$review_key = 'rpr_reviews';
$reputation = update_user_meta($current_user->ID, $repu_key,$user_rating);
$reviews = update_user_meta($current_user->ID, $review_key,$counter+1);

update_post_meta(get_the_ID(),'event-complete',$_POST['event-complete']);  //dependency on custom-category
$rating_value = get_post_meta(get_the_ID(),'crfp-average-rating',true);
update_post_meta(get_the_ID(),'_pn_apr_rating',$rating_value);     //dependency on author-post-rating plugin
}
/**
 * Post Meta-Data Template-Part File
 *
 * @file           post-meta.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/post-meta.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
?>

<?php if( is_single() ): ?>
	<h1 class="entry-title post-title"><?php the_title(); ?></h1>
        <div class="event-status">Status:<span><?php if(get_post_meta(get_the_ID(),'event-complete','true')==1) 
echo 'Completed</div>';
else {
echo 'Under Progress</span></div>';
echo '<a href="#" id="mark-complete">Mark it Complete</a>';
}
?>
<form id="event-form" method="post">
<input type="hidden" name="event-complete" id="event-complete" value="0" />
</form>
<script type="text/javascript">
$("#mark-complete").click(function(){
$("#event-complete").val('1');
$("#event-form").submit();
});
</script>
<?php else: ?>
	<h2 class="entry-title post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php endif; ?>

<div class="post-meta">
	<?php responsive_post_meta_data(); ?>

	<?php if( comments_open() ) : ?>
		<span class="comments-link">
		<span class="mdash">&mdash;</span>
			<?php comments_popup_link( __( 'No Comments &darr;', 'responsive' ), __( '1 Comment &darr;', 'responsive' ), __( '% Comments &darr;', 'responsive' ) ); ?>
		</span>
	<?php endif; ?>
</div><!-- end of .post-meta -->
