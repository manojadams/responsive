<?php
//
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

//User profile rating class
class fabRating {
	//musician reputation keys
	public $k11 = '_fab_musician_performance';
	public $k12 = '_fab_musician_contact';
	public $k13 = '_fab_musician_hireagain';
    public $k14 = '_fab_musician_reputation';

	public $k15 = 'rpr_mperformance'; //overall performance
    public $k16 = 'rpr_mcontact';    //how easy to be contacted
    public $k17 = 'rpr_mhireagain';  //would hire again
	public $k181 = 'rpr_montime'; 	//ontime
	public $k182 = 'rpr_mgenre'; 	//music genre
    public $k18 = 'rpr_moverallrating';	//overall rating
    public $k19 = 'rpr_mtotalprojects';	//total projects
	public $k20 = 'rpr_mtotalreviews';	//total reviews
	
	//user/employer reputation keys
	public $k21 = '_fab_user_param1';
	public $k22 = '_fab_user_param2';
	public $k23 = '_fab_user_param3';
    public $k24 = '_fab_user_reputation';
	
    public $k25 = 'rpr_reputation';    //Band leader was thorough in giving me directions?
    public $k26 = 'rpr_givedirection';    //Band leader was thorough in giving me directions?
    public $k27 = 'rpr_easyplay';    // Band members are easy to play with?
    public $k28 = 'rpr_paidme';    //Band paid me accordingly?
    public $k29 = 'rpr_professional';    //Band was professional?
    public $k30 = 'rpr_wouldhelpagain'; //would help out the band again
	public $k31 = 'rpr_totalprojects';	//total projects
	public $k32 = 'rpr_totalreviews';	//total reviews
	
	//general functions
	function fabRating(){
		
	}
    function displayStars($rating){
           $stars = '';
        if($rating > 5 ) echo 'error';
        $rating = $rating>5?0:$rating;
        for($count = 0;$count < $rating; $count++)
            $stars .= '<img src="'.get_template_directory_uri().'/musico/images/star-active.png'.'" />';
        for($count2=$count;$count2<5;$count2++)
            $stars .= '<img src="'.get_template_directory_uri().'/musico/images/star-inactive.png'.'" />';
        return $stars.' <span class="ratingCount">'.$rating.'</span>';
    }
    
	//user/employer settings
	function getuNumRating($userid){
		$r = get_user_meta($userid,$this->k25,'true');
        $r = $r?$r:0;
		return $r;		
    }
    function getUserRepuationForm(){
?>
<form method="post">
    <h1>User reputation</h1>
    <label>Performance</label></label>	<input type="text" name="<?php echo $k21;?>" placeholder="Performance"/>
    <label>Contact</label>	<input type="text" name="<?php echo $k22;?>" placeholder="Contact" />
	<label>Hire Again</label><input type="text" name="<?php echo $k23;?>" placeholder="Hire Again" />
	<label>Reputation</label><input type="text" name="<?php echo $k24;?>" placeholder="Reputation" />
    <input type="submit" value="Submit" />
</form>
<?php        

    }
	function displayUserReputation($userid){
	
		$givedirection = ceil(get_user_meta($userid,$this->k26,'true'));
		$easyplay = ceil(get_user_meta($userid,$this->k27,'true'));
		$paidme = ceil(get_user_meta($userid,$this->k28,'true'));
        $professional = ceil(get_user_meta($userid,$this->k29,'true'));
		$wouldPlayAgain = ceil(get_user_meta($userid,$this->k30,'true'));
		$totalProjects = ceil(get_user_meta($userid,$this->k31,'true'));
		$totalReviews = ceil(get_user_meta($userid,$this->k32,'true'));
        $overall = get_user_meta($userid,$this->k25,'TRUE');
		
        $result = '<div class="userRating">'.$this->displayStars($overall).'
        <div class="rating-wrapper">
            <div class="row text-right">
                Filter by:<span class="label label-default">Past 3 Months</span>
                <span class="label label-default">12 Months</span>
                <span class="label label-primary">All</span>
            </div><hr/>
            <div class="row">
                <div><p>Average Rating<span>'.$this->displayStars($overall).'</span></p></div>
                <div>
                    <p>Reviews<span>'.$totalProjects.'</span></p>
                    <p>Total Projects<span>'.$totalReviews.'</span></p>
                </div>
            </div><hr/>
            <div class="row">
                <div class="col-sm-6">
                    <p>Giving directions: <span>'.$this->displayStars($givedirection).'</span></p>
                    <p>Easy to be played with<span>'.$this->displayStars($easyplay).'</span></p>
                    <p>Payments<span>'.$this->displayStars($paidme).'</span></p>
                    <p>Professionalism<span>'.$this->displayStars($professional).'</span></p>
					<p>Would work again<span>'.$this->displayStars($wouldPlayAgain).'</span></p>
                </div>
                <div class="col-sm-6">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>Open Projects</li>
                        <li class="list-group-item"><span class="badge">12</span>Closed Projects</li>
                        <li class="list-group-item"><span class="badge">5</span>Active Projects</li>

                    </ul>   
                </div>
            </div>
        </div>
        </div>';
        echo $result;
	}
    function insertUserPost($pid){
        global $wpdb;
        $r = $wpdb->insert(
                        MRATE,
                        array(
                            'pid' => $pid
                        ),
                        array(
                            '%d'
                        )
        );
    }
    function updateUserReputation($pid,$userid){
        global $wpdb;
        $p = isset($_POST[$this->$k21])?(int)$_POST[$this->$k21]:0;//performance
		$c = isset($_POST[$this->$k22])?(int)$_POST[$this->$k22]:0;//contact
		$h = isset($_POST[$this->$k23])?(int)$_POST[$this->$k23]:0;//hireagain
        $r = isset($_POST[$this->$k24])?(int)$_POST[$this->$k24]:0;//overall reputation

        $error = $p<=5?$c<=5?$h<=5?$r<=5?TRUE:FALSE:FALSE:FALSE:FALSE;
        if($error) {echo 'Error occured';return;}
        //else insert data into tables
        
    }
	function getuPerformanceRating($userid){
		return (int)(get_user_meta($userid,$this->k21,'true'));
	}
	function getuContactRating ($userid){
		return (int)(get_user_meta($userid,$this->k22,'true'));
	}
	function getuHireAgainRating ($userid){
		return (int)(get_user_meta($userid,$this->k23,'true'));
	}
    function getuOverallRating($userid){
        return (int)(get_user_meta($userid,$this->k24,'true'));
    }
    function getMusicianReputationForm(){
?>
    <form method="post">
    <h1>Musician reputation</h1>
    <label>Performance</label></label>	<input type="text" name="<?php echo $k11;?>" placeholder="Performance"/>
    <label>Contact</label>	<input type="text" name="<?php echo $k12;?>" placeholder="Contact" />
	<label>Hire Again</label><input type="text" name="<?php echo $k13;?>" placeholder="Hire Again" />
	<label>Reputation</label><input type="text" name="<?php echo $k14;?>" placeholder="Reputation" />

    <input type="submit" value="Submit" />
</form>
<?php
    }
	function displayMusicianReputation($userid){
	
		$performance = ceil(get_user_meta($userid,$this->k15,'true'));
		$contact = ceil(get_user_meta($userid,$this->k16,'true'));
		$hireagain = ceil(get_user_meta($userid,$this->k17,'true'));
        $genre = ceil(get_user_meta($userid,$this->k182,'true'));
		$ontime = ceil(get_user_meta($userid,$this->k181,'true'));
		$totalProjects = ceil(get_user_meta($userid,$this->k19,'true'));
		$totalReviews = ceil(get_user_meta($userid,$this->k20,'true'));
        $overall = get_user_meta($userid,$this->k18,'TRUE');
		
        $result = '<div class="userRating">'.$this->displayStars($overall).'
        <div class="rating-wrapper">
            <div class="row text-right">
                Filter by:<span class="label label-default">Past 3 Months</span>
                <span class="label label-default">12 Months</span>
                <span class="label label-primary">All</span>
            </div><hr/>
            <div class="row">
                <div><p>Average Rating<span>'.$this->displayStars($overall).'</span></p></div>
                <div>
                    <p>Reviews<span>'.$totalProjects.'</span></p>
                    <p>Total Projects<span>'.$totalReviews.'</span></p>
                </div>
            </div><hr/>
            <div class="row">
                <div class="col-sm-6">
                    <p>Performance: <span>'.$this->displayStars($performance).'</span></p>
                    <p>How easy to be contacted: <span>'.$this->displayStars($contact).'</span></p>
                    <p>Woulr hire again: <span>'.$this->displayStars($hireagain).'</span></p>
                    <p>Music Genre<span>'.$this->displayStars($genre).'</span></p>
					<p>On time<span>'.$this->displayStars($ontime).'</span></p>
                </div>
                <div class="col-sm-6">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>Open Projects</li>
                        <li class="list-group-item"><span class="badge">12</span>Closed Projects</li>
                        <li class="list-group-item"><span class="badge">5</span>Active Projects</li>

                    </ul>   
                </div>
            </div>
        </div>
        </div>';
        echo $result;
	}
    //musician average rating count
	function getmNumRating($userid){
		$r = get_user_meta($userid,$this->k18,'true');
		$r = $r?$r:0;
        return $r;
    }
	function getMusicianReputation($userid){
		$performance = get_user_meta($userid,$this->k11,'true');
		$contact = get_user_meta($userid,$k12,'true');
		$hireagain = get_user_meta($userid,$k13,'true');
        $reputation = ceil(get_user_meta($userid,$k24,'true'));
		$overall_rating = ceil(($performance + $contact + $hireagain)/3);
	}
    function updateMusicianReputation($userid){
        $p = isset($_POST[$this->k21])?(int)$_POST[$this->k21]:0;//performance
		$c = isset($_POST[$this->k22])?(int)$_POST[$this->k22]:0;//contact
		$h = isset($_POST[$this->k23])?(int)$_POST[$this->k23]:0;//hireagain
        $r = isset($_POST[$this->k24])?(int)$_POST[$this->k24]:0;//overall reputation

        $error = $p<=5&&$p>=0?$c<=5&&$c>=0?$h<=5&&$h>=0?$r<=5&&$r>=0?FALSE:TRUE:TRUE:TRUE:TRUE;
        if($error) {echo 'Error occured';return;}
        else echo 'success';
    }
	function getmPerformance ($userid){
		return (int)(get_user_meta($userid,$this->k11,true));
	}
	function getmContactRating ($userid){
		return (int)(get_user_meta($userid,$this->k12,'true'));
	}
	function getmHireAgainRating ($userid){
		return (int)(get_user_meta($userid,$this->k13,'true'));
	}
    function getmOverallRating($userid){
        return (int)(get_user_meta($userid,$this->k14,'true'));
    }
}

//class to process "Hire me " ads and 
class musicoPosting {
    public $wpdb;
    function musicoPosting(){
        global $wpdb;
        $this->wpdb = $wpdb;
    }
    function musico_Status($pid){
        $r = $this->wpdb->get_row("select jid from ".MRATE." where pid = $pid");
        return $r;
    }
    //1.8.2
    function musico_AddHireMe($pid,$userid){
        $r = $this->wpdb->insert(
            MRATE,
            array(
                'pid' => $pid,
                'jid' => 0,
                'mid' => $userid
            ),
            array(
                '%d',
                '%d',
                '%d'
            )
        );
        return $r;
    }
    //1.8.6
    function musico_AddAwardedUser($cid,$pid,$userid){
        $r = $this->wpdb->update(
            MRATE,
            array(
                'uid' => $userid,
                'cid' => $cid,
                'jid' => 5
            ),
            array(
                'pid' => $pid
            ),
            array(
                '%d' 
            )
        );
        return $r;
    }
    //1.8.7
    function musico_AcceptOffer($pid){
         $r = $this->wpdb->update(
            MRATE,
            array(
                'jid' => 1
            ),
            array(
                'pid' => $pid
            ),
            array(
                '%d' 
            )
        );
        return $r;
    }
    //1.8.9
    function musico_CompleteJob($pid){
         $r = $this->wpdb->update(
            MRATE,
            array(
                'jid' => 2
            ),
            array(
                'pid' => $pid
            ),
            array(
                '%d' 
            )
        );
        return $r;
    }
    //1.8.9.21
    function musico_CancelJob($pid){
         $r = $this->wpdb->update(
            MRATE,
            array(
                'jid' => 3
            ),
            array(
                'pid' => $pid
            ),
            array(
                '%d' 
            )
        );
        return $r;
    }
    //1.8.9.11
    function musico_FrozeJob($pid){
         $r = $this->wpdb->update(
            MRATE,
            array(
                'jid' => 4
            ),
            array(
                'pid' => $pid
            ),
            array(
                '%d' 
            )
        );
        return $r;
    }
    function musico_UserFeedback($pid,$userid,$param1,$param2,$param3,$overall){
        $r = $this->wpdb->update(
            MRATE,
            array(
                '_fab_user_param1' => $param1,
                '_fab_user_param2' => $param2,
                '_fab_user_param3' => $param3,
                '_fab_user_param3' => $overall
            ),
            array(
                'pid' => $pid,
                'uid' => $userid
            ),
            array(
                '%d', '%d','%d','%d'
            )
        );
        return $r;
    }
    function musico_MusicianFeedback($pid,$userid,$performance,$contact,$hireagain,$overall){
        $r = $this->wpdb->update(
            MRATE,
            array(
                '_fab_musician_performance' => $performance,
                '_fab_musician_contact' => $contact,
                '_fab_musician_hireagain' => $hireagain,
                '_fab_musician_reputation' => $overall
            ),
            array(
                'pid' => $pid,
                'mid' => $userid
            ),
            array(
                '%d', '%d','%d','%d'
            )
        );
        return $r;
    }
}
?>