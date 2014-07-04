<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
//gets the rating related to a particular post
function get_the_rating($comment){
        global $wpdb;
        $GLOBALS['comment'] = $comment;
        global $comment_ID;
        $comment_id = get_comment_ID();
        $crating_value = get_comment_meta($comment_id,'crfp-rating',true);
        $author = get_comment_author( $comment_ID );
        $query = "
            SELECT rating 
            FROM $wpdb->comments
            WHERE comment_ID = $comment_id";
        $rcomment = $wpdb->get_results($query,OBJECT);
?>
<table class="crating">
<tbody>
<tr><td></td><td align="right">
<?php
//$crating = intval($rcomment[0]->rating);
$crating = intval($crating_value);
for($i=0;$i<$crating;$i++)
echo '<img src="http://www.musicodisponible.com/wp-content/plugins/author-post-ratings/images/star-active.png">';
for($i=0;$i<5-$crating;$i++)
echo '<img src="http://www.musicodisponible.com/wp-content/plugins/author-post-ratings/images/star-inactive.png">';
echo '<span class="nrating">'.$crating.'.0</span>'; 
?>
</td></tr>
<tr><td class="cavatar">
<div class="comment-author vcard">
<?php echo get_avatar( $comment,60 ); ?>
</div>
</td>
<td>
<div class="crating-content">
<div class="cauthor">
<?php echo $author; ?>
</div>
<div class="ctime">
<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() );?>
</div>
<div class="comment-content-crating">
<?php comment_text(); ?>
</div>
</div><!--end-crating-content-->
</td></tr>
</tbody></table>
<?php
}
/**
 * Comments Template
 *
 *
 * @file           comments.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2010 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/comments.php
 * @link           http://codex.wordpress.org/Theme_Development#Comments_.28comments.php.29
 * @since          available since Release 1.0
 */
?>

<?php
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
if( !empty( $comments_by_type['pings'] ) ) : // let's seperate pings/trackbacks from comments
	$count = count( $comments_by_type['pings'] );
	( $count !== 1 ) ? $txt = __( 'Pings&#47;Trackbacks', 'responsive' ) : $txt = __( 'Pings&#47;Trackbacks', 'responsive' );
	?>

	<h6 id="pings"><?php printf( __( '%1$d %2$s for "%3$s"', 'responsive' ), $count, $txt, get_the_title() ) ?></h6>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=pings&max_depth=<em>' ); ?>
	</ol>


<?php endif; ?>

<?php if( comments_open()&&(get_post_meta(get_the_ID(),'event-complete',true)!=1) ) : ?>

	<?php
	$fields = array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'responsive' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'E-mail', 'responsive' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'responsive' ) . '</label>' .
		'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ) );
	 if ( is_user_logged_in() ) { comment_form( array('label_submit'=> __( 'Anúnciate' ),'comment_field'=>'<p class="comment-form-comment"><label for="comment">' . _x( ' Anuncios.', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',"Anuncios.",'must_log_in'=>"<a href='http://www.musicodisponible.com/wp-login.php?redirect_to=http://www.musicodisponible.com'>Inicia tu sesión</a><span> para anunciarte.</span>",'title_reply'=>'<div>
<div class="master">SALPICADERO FIN DE SEMANA</div>
  </div>
<br>
<div class="comment_spanadd2">EI 90% de nuestra comunidad de musicos usa este tablero para fijar anuncio que esta disponible este fin de semana o futura fecha. O para anunciar que busca musico este fin de semana o futura fecha.</div>
</div>')); 
} else{

	comment_form( array('must_log_in'=>"<a href='http://www.musicodisponible.com/wp-login.php?redirect_to=http://www.musicodisponible.com'>Inicia tu sesión</a><span> para anunciarte.</span>",'title_reply'=>'<div>
<div class="master">SALPICADERO FIN DE SEMANA</div>   <div class="popbox">
    <a class="open" href="#">Anúnciate</a>

    <div class="collapse">
      <div class="box">
<a href="http://www.musicodisponible.com/wp-login.php?action=register">inicia sesion </a> para poner anuncio</div>
    </div>
  </div>
<br>
</div>'));}
?>

<?php endif; ?>


<div style="clear:both"></div>
<?php if( post_password_required() ) { ?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'responsive' ); ?></p>

	<?php return;
} ?>

<?php if( have_comments() ) : ?>
	<h6 id="comments" class="<?php if($category_id == '117') echo 'comment-feedback'; ?>">
		<?php
		printf( _n( 'Feedbacks on &ldquo;%2$s&rdquo;', '%1$s feedbacks on &ldquo;%2$s&rdquo;', get_comments_number('number=3'), 'responsive' ),
				number_format_i18n( get_comments_number('number=3') ), '<span>' . get_the_title() . '</span>' );
		?>
	</h6>

	<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="previous"><?php previous_comments_link( __( '&#8249; Older comments', 'responsive' ) ); ?></div>
			<!-- end of .previous -->
			<div class="next"><?php next_comments_link( __( 'Newer comments &#8250;', 'responsive', 0 ) ); ?></div>
			<!-- end of .next -->
		</div><!-- end of.navigation -->
	<?php endif; ?>

	<ol class="commentlist">
		<?php 
if($category_id==117) wp_list_comments( 'avatar_size=60&type=comment&callback=get_the_rating' );
else wp_list_comments( 'avatar_size=60&type=comment' );
?>

	</ol>

	<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="previous"><?php previous_comments_link( __( '&#8249; Older comments', 'responsive' ) ); ?></div>
			<!-- end of .previous -->
			<div class="next"><?php next_comments_link( __( 'Newer comments &#8250;', 'responsive', 0 ) ); ?></div>
			<!-- end of .next -->
		</div><!-- end of.navigation -->
	<?php endif; ?>

<?php else : ?>

<?php endif; ?>