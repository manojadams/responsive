<?php
 
 

get_header(); ?>

 

<div id="content" class="  col-940 fit">

	<?php get_template_part( 'loop-header' ); ?>


    <?php
    global $wpdb;
    $count_fields=0;
     $and_array = array();
   // if($_GET['ciudad'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_edad' AND  ".$_GET['edad_min']." < u_m".$count_fields.".meta_value AND u_m".$count_fields.".meta_value < ".$_GET['edad_max']."  ) ";
        array_push($and_array, $and);
        $count_fields++;
   // }
    if($_GET['city'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_cuidad' AND u_m".$count_fields.".meta_value = '".$_GET['city']."' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
    if($_GET['state'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_state' AND u_m".$count_fields.".meta_value = '".$_GET['state']."' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
    
    
    if($_GET['instru'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_'  AND u_m".$count_fields.".meta_value like '%".$_GET['instru']."%' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
     if($_GET['rpr_hombre0mujer'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_hombre0mujer'  AND u_m".$count_fields.".meta_value = '".$_GET['rpr_hombre0mujer']."' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
     if($_GET['rpr_nivel'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_nivel'  AND u_m".$count_fields.".meta_value = '".$_GET['rpr_nivel']."' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
     if($_GET['rpr_estilo'] !=''){
        $and= " ( u_m".$count_fields.".meta_key = 'rpr_estilo'  AND u_m".$count_fields.".meta_value = '".$_GET['rpr_estilo']."' ) ";
        array_push($and_array, $and);
        $count_fields++;
    }
     
    if (count($and_array)>0){
        $where = ' WHERE '.implode(" AND ", $and_array);
        
    }
    else{
        $groupby=" GROUP BY {$wpdb->prefix}users.ID ";
    }
    
    $user_per_page = 10;
    $page = isset( $_GET['page'] ) ? abs( (int) $_GET['page'] ) : 1;
    $offset = 1;
    if( isset($_GET['page']) && !empty($_GET['page']) ){
    $offset =  ($_GET['page']-1) * $user_per_page; // (page 2 - 1)*10 = offset of 10
    }
     
    $query = "SELECT  * FROM {$wpdb->prefix}users ";
    $query_count= "SELECT COUNT(*) FROM {$wpdb->prefix}users ";
    for($i=0;$i<$count_fields;$i++){
        $query.=" INNER JOIN {$wpdb->prefix}usermeta u_m".$i."
      ON ( {$wpdb->prefix}users.ID = u_m".$i.".user_id ) ";
      
      $query_count.=" INNER JOIN {$wpdb->prefix}usermeta u_m".$i."
      ON ( {$wpdb->prefix}users.ID = u_m".$i.".user_id ) ";
    }
    
     
    
    $query.=$groupby  . $where ." LIMIT $user_per_page OFFSET $offset";
    $query_count  .=$groupby  . $where;
 
    $total = $wpdb->get_var($query_count);
    
     
     $results=$wpdb->get_results( $query);
     
    echo '<div class="pagination">';
    echo paginate_links( array(
        'base' => add_query_arg( 'page', '%#%' ),
        'format' => '',
        'prev_text' => __('Previous'),
        'next_text' => __('Next'),
        'total' => ceil($total / $user_per_page),
        'current' => $page
    ));
    echo '</div>';
    
    foreach ( $results as $result ) 
    {   
        
        $meta_query=" SELECT * FROM {$wpdb->prefix}usermeta WHERE user_id = $result->ID";
        
        
        
        $metas=$wpdb->get_results( $meta_query);
        foreach($metas as $meta){
            if($meta->meta_key=='rpr_state') $rpr_state= $meta->meta_value;
            if($meta->meta_key=='rpr_cuidad') $rpr_cuidad= $meta->meta_value;
            if($meta->meta_key=='rpr_estilo') $rpr_estilo= $meta->meta_value;
            if($meta->meta_key=='rpr_nivel')  $rpr_nivel= $meta->meta_value;
            if($meta->meta_key=='rpr_edad')  $rpr_edad= $meta->meta_value;
            
        }
        
        echo '<div class="list_user  clearfix">';
        echo '  <div class="avatar col-140 grid ">';
        echo        '<div class="avatar-photo">'.get_avatar( $result->ID, 80).'</div>'; 
        echo        '<p><a href="'.get_bloginfo( 'wpurl' ).'/wp-admin/profile.php">Subir Foto</a></p>';
        echo '  </div>';
    	echo '  <div class="user-info col-780 fit grid-right">';
        echo    '<h3>'.$result->display_name.' <span class="edad">Edad: '.$rpr_edad.'</span></h3>';
        echo '  <p>'.$rpr_cuidad.', '.$rpr_state.'</p>';
        echo '  <p>Estilo: '.$rpr_estilo.'</p>';
        echo '  <p>Nivel: '.$rpr_nivel.'</p>';
        echo '  <p><a href="mailto:'.$result->user_email.'">Contactar</a></p>';
        echo '  </div>';
        echo '</div>';
        echo '<hr />';
    }
    
    
    
    
    
    ?>


	 
</div><!-- end of #content -->


<?php get_footer(); ?>
