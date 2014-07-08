<?php
     ob_start();
/*=========================================================================
=============================FIRST TIME SET-UP=============================
===========================================================================

-----------SECTIONS-----------
Profile Manager
    Contact Lists
    Settings
    View Profile
Notification Manager
Feedback Rating Manager
Portfolio Manager

-----------------------------------ONE TIME SETUP -------------------------*/
 //for feedback rating system installation
 add_action("after_switch_theme", "install_rating_sys");
 function install_rating_sys(){//creating tables for rating system implementation
 global $wpdb, $current_user;   if(!defined('MRATE')) define('MRATE','musico_ratings');   //getting the musician/user rating keys
    $k11 = '_fab_musician_performance';
	$k12 = '_fab_musician_contact';
	$k13 = '_fab_musician_hireagain';
    $k14 = '_fab_musician_reputation';
	
	//user/employer reputation keys
	$k21 = '_fab_user_param1';
	$k22 = '_fab_user_param2';
	$k23 = '_fab_user_param3';
    $k24 = '_fab_user_reputation';   //pid = post id -------the hire me post which will be unique   //jid = job status id-------0=>created, 1=>In Progress, 2=>Completed, 3=>Cancelled, 4=>Frozen   //cid = comment id ---------the cid of the offered user only   //mid= music user id
   //uid = general user id
   //creating the ratings table
   $sql = "CREATE TABLE ".MRATE." (    pid bigint(20) NOT NULL,  jid tinyint(9) NOT NULL,  cid bigint(20) NOT NULL,
  mid tinyint(9) NOT NULL,  uid tinyint(9) NOT NULL,  $k11 tinyint(1) NOT NULL, $k12 tinyint(1) NOT NULL,$k13 tinyint(1) NOT NULL, $k14 tinyint(1) NOT NULL,  $k21 tinyint(1) NOT NULL, $k22 tinyint(1) NOT NULL, $k23 tinyint(1) NOT NULL, $k24 tinyint(1) NOT NULL,  UNIQUE KEY pid(pid)
);";   
   $check = $wpdb->get_row("SELECT * FROM {$wpdb->MRATE} where 1;");
   if(!$check) {echo 'Error creating table or table already exists';return;}                                                  //exit if table already exists

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

//registering hireme custom post type 
//dependcy on cptui plugin
add_action('init', 'cptui_register_my_cpt_hireme');
function cptui_register_my_cpt_hireme() {
register_post_type('hireme', array(
'label' => 'Hireme',
'description' => 'Musicians and users post will be assigned to this post type',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'hireme', 'with_front' => true),
'query_var' => true,
'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes','post-formats'),
'labels' => array (
  'name' => 'Hireme',
  'singular_name' => 'hireme',
  'menu_name' => 'Hireme',
  'add_new' => 'Add hireme',
  'add_new_item' => 'Add New hireme',
  'edit' => 'Edit',
  'edit_item' => 'Edit hireme',
  'new_item' => 'New hireme',
  'view' => 'View hireme',
  'view_item' => 'View hireme',
  'search_items' => 'Search Hireme',
  'not_found' => 'No Hireme Found',
  'not_found_in_trash' => 'No Hireme Found in Trash',
  'parent' => 'Parent hireme',
)
) ); }

//registering hireme custom post type 
//dependcy on cptui plugin
add_action('init', 'cptui_register_my_taxes_skills');
function cptui_register_my_taxes_skills() {
register_taxonomy( 'skills',array (
  0 => 'post',
),
array( 'hierarchical' => false,
	'label' => 'skills',
	'show_ui' => true,
	'query_var' => true,
	'show_admin_column' => true,
	'labels' => array (
  'search_items' => 'skill',
  'popular_items' => '',
  'all_items' => '',
  'parent_item' => '',
  'parent_item_colon' => '',
  'edit_item' => '',
  'update_item' => '',
  'add_new_item' => '',
  'new_item_name' => '',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}

/*-----------------------------------Additional functions -------------------------*/
//this function is used as ca callback to modify the users offer lookout/i.e comments lookout
function userOfferComments($comment, $args, $depth){
    require_once 'feedback.php';
    $GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
    $ratings = new fabrating();
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'offer';
	} else {
		$tag = 'li';
		$add_below = 'div-offer';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="offer-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-offer-<?php comment_ID() ?>" class="offer-body">
	<?php endif; ?>
	<div class="offer-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="offer-awaiting-review"><?php _e( 'Your offer is awaiting review.' ); ?></em>
		<br />
	<?php endif; ?>
     <div>
         <div class="displayUserReputation">
             <?php
              $musico = new musicoPosting();
              $r = $musico->musico_Status(get_the_ID());
              if($r->jid == 0) {//show the accept offer button only when hireme is open
             ?>
             <form method="post">
                 <input type="hidden" name="cid" value="<?php echo get_comment_ID(); ?>" />
                 <input type="hidden" name="pid" value="<?php echo get_the_ID(); ?>" />
                 <input type="hidden" name="userid" value="<?php echo $comment->user_id; ?>" />
                 <button type="submit" name="accept-offer" class="btn btn-success pull-right">Accept Offer</button>
                 
             </form>
         <?php
              }
             $ratings->displayUserReputation($userid);
         ?>
         </div>
         
         
     </div>
	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>
	</div>

	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

//adding script and style to header
add_action( 'wp_enqueue_scripts', 'musico_scripts' );
function musico_scripts() {
	wp_enqueue_style( 'musico-style', get_template_directory_uri().'/musico/css/style.css' );
	wp_enqueue_script( 'musico-script', get_template_directory_uri() . '/musico/js/script.js', array('jquery'), '1.0.0', true );
}
$output = ob_get_contents();
ob_end_clean();
?>