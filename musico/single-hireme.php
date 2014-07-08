<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Single Hire-me Template
 *
 *
 * @file           single-hireme.php
 * @package        Responsive
 * @author         Manoj Baruah
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single-hireme.php
 * @since          available since Release 1.0
 */
?>
<?php
    if(isset($_POST['cid'])){
        $status = isset($_POST['cid'])?isset($_POST['pid'])?isset($_POST['userid'])?TRUE:FALSE:FALSE:FALSE;
        if(!$status) {
            echo '<p class="alert alert-danger">Some error occured</p>';
            return;
        }
        $cid = intval($_POST['cid']);
        $pid = intval($_POST['pid']);
        $uid = intval($_POST['userid']);
        $musico = new musicoPosting();
        $status = $musico->musico_Status(get_the_ID());
        if($status->jid == 0){//musician only award when job status is set to open
            if($musico->musico_AddAwardedUser($cid,$pid,$uid)){
                echo 'Success';
            }
        else { 
            echo 'Failed';
            echo '<p class="alert alert-danger">Some error occured</p>';
            echo var_dump($wpdb->last_query);
           }
        }
    }

?>
<?php get_header(); ?>

<div id="content" class="col-960">

	<?php if( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php echo do_shortcode('[author-post-rating]'); ?>
				<div class="post-entry">
<?php
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
if($category_id == '117') echo '<h3>Event description</h3><hr/>';
?>
<div class="row">
<div class="title col-sm-6"><h1><?php the_title(); ?></h1></div>
    <div class="col-sm-6" style="alig: right;"><button type="button" class="btn btn-warning pull-right">Make Offer</button></div>
</div>
    <div class="row well stats">
        <div class="btn-group col-sm-6">
            <button type="button" class="btn btn-default">Offers <span><?php comments_number( $zero, $one, $more ); ?></span></button>
            <button type="button" class="btn btn-default">Avg.Offer</button>
            <button type="button" class="btn btn-default">Param</button>
        </div>
        <div class="col-sm-6">
            <div class="well well-sm pull-right">
                <?php
                    $musico = new musicoPosting();
                    $r = $musico->musico_Status(get_the_ID());
                    switch($r->jid){
                        case 0: echo 'Open';break;
                        case 1: echo 'In Progress';break;
                        case 2: echo 'Completed';break;
                        case 3: echo 'Cancelled';break;
                        case 4: echo 'Frozen';break;
                        case 5: echo 'Awarded';break;
                        default: echo 'Error';
                    }
                ?>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-sm-8">
        <h4>Description:</h4>
        <?php the_content(); ?>
          <div class="skills">
        <h4>Skills:</h4>
        </div>
    </div>
    <div class="col-sm-4 insidebar">
        <h4>About the Musician:</h4>
        <?php
            $rating = new fabRating();
            $rating->displayUserReputation(get_current_user_id());
        ?>
    </div>
</div>

</div><hr/><!-- end of .post-entry -->	
</div><!-- end of #content -->
<button type="button" class="btn btn-warning pull-right">Make Offer</button>
<?php comments_template('/comments-hireme.php'); ?> 
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>