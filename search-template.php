<?php
/**
 * Template Name: Search Template
  
 */
 
 

get_header(); ?>



<div id="widgets" class="grid col-300 rtl-fit">
	 

	 
	<div class="widget-wrapper">

		<div class="widget-title"><h3>Buscador</h3></div>
		<?php
            global $post,  $wp_query;
 
            

             
            $permalink = get_permalink( $post->ID );
        
         ?>		
         <script src="<?php echo get_template_directory_uri(); ?>/js/data.json" ></script>
         <script>
             
            jQuery( document ).ready(function() {
            var html="";
             for(var i=0; i< data.state.length; i++){
                 html=html + '<option value="'+data.state[i].name+'">'+data.state[i].name+'</option>';
             }
              
             jQuery('#region').append(html);
             
             
             jQuery("body").on("change","#region", function(event){
                        //var city_html='';
                        var city_html="<option value=\"\">--- TODAS ---</option>";
                             for(var i=0; i< data.state.length; i++){
                                    if( data.state[i].name==jQuery('#region').val() ){
                                        for (var j=0;j<data.state[i].city.length; j++){
                                            
                                            city_html=city_html + '<option value="'+data.state[i].city[j].name+'">'+data.state[i].city[j].name+'</option>';
                                        }
                                        break;
                                    }
                                 
                             }
                          
                		   jQuery('#city').empty().append(city_html);    
                		});
             
            });
                 
         </script>
        <form action="<?php  echo   home_url(); // add_query_arg( 'foo', 'bar', $permalink ); ?>" method="get" name="forma">
            <input type="hidden" value="0" name="ini">
             
            Hombre/Mujer:<br>
            <select class="agbusca" name="rpr_hombre0mujer">
            <option value="">-AMBOS-</option>
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
            </select><br>
            Edad entre:<br>
            <select style="width:50px" class="agbusca" name="edad_min">
             
            <option value="15">18</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            </select>
            &nbsp;y&nbsp;
            <select   style="width:50px" class="agbusca" name="edad_max"> 
            
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90" selected="selected">90</option>
             
            </select> <br>
            
            <input type="checkbox" align="absmiddle" name="foto" style="margin-top:5px" /> Que tengan FOTO<br>
            <br>
            Estado:<br>
            <select class="agbusca"   name="state" id="region">
                <option value="">--- TODOS ---</option>
               <!-- <option id="rpr_state-alabama" value="Alabama">Alabama</option><option id="rpr_state-alaska" value="Alaska">Alaska</option><option id="rpr_state-arizona" value="Arizona">Arizona</option><option id="rpr_state-arkansas" value="Arkansas">Arkansas</option><option id="rpr_state-california" value="California">California</option><option id="rpr_state-colorado" value="Colorado">Colorado</option><option id="rpr_state-connecticut" value="Connecticut">Connecticut</option><option id="rpr_state-delaware" value="Delaware">Delaware</option><option id="rpr_state-district_of_columbia" value="District Of Columbia">District Of Columbia</option><option id="rpr_state-florida" value="Florida">Florida</option><option id="rpr_state-georgia" value="Georgia">Georgia</option><option id="rpr_state-hawaii" value="Hawaii">Hawaii</option><option id="rpr_state-idaho" value="Idaho">Idaho</option><option id="rpr_state-illinois" value="Illinois">Illinois</option><option id="rpr_state-indiana" value="Indiana">Indiana</option><option id="rpr_state-iowa" value="Iowa">Iowa</option><option id="rpr_state-kansas" value="Kansas">Kansas</option><option id="rpr_state-kentucky" value="Kentucky">Kentucky</option><option id="rpr_state-louisiana" value="Louisiana">Louisiana</option><option id="rpr_state-maine" value="Maine">Maine</option><option id="rpr_state-maryland" value="Maryland">Maryland</option><option id="rpr_state-massachusetts" value="Massachusetts">Massachusetts</option><option id="rpr_state-michigan" value="Michigan">Michigan</option><option id="rpr_state-minnesota" value="Minnesota">Minnesota</option><option id="rpr_state-mississippi" value="Mississippi">Mississippi</option><option id="rpr_state-missouri" value="Missouri">Missouri</option><option id="rpr_state-montana" value="Montana">Montana</option><option id="rpr_state-nebraska" value="Nebraska">Nebraska</option><option id="rpr_state-nevada" value="Nevada">Nevada</option><option id="rpr_state-new_hampshire" value="New Hampshire">New Hampshire</option><option id="rpr_state-new_jersey" value="New Jersey">New Jersey</option><option id="rpr_state-new_mexico" value="New Mexico">New Mexico</option><option id="rpr_state-new_york" value="New York">New York</option><option id="rpr_state-north_carolina" value="North Carolina">North Carolina</option><option id="rpr_state-north_dakota" value="North Dakota">North Dakota</option><option id="rpr_state-ohio" value="Ohio">Ohio</option><option id="rpr_state-oklahoma" value="Oklahoma">Oklahoma</option><option id="rpr_state-oregon" value="Oregon">Oregon</option><option id="rpr_state-pennsylvania" value="Pennsylvania">Pennsylvania</option><option id="rpr_state-rhode_island" value="Rhode Island">Rhode Island</option><option id="rpr_state-south_carolina" value="South Carolina">South Carolina</option><option id="rpr_state-south_dakota" value="South Dakota">South Dakota</option><option id="rpr_state-tennessee" value="Tennessee">Tennessee</option><option id="rpr_state-texas" value="Texas">Texas</option><option id="rpr_state-utah" value="Utah">Utah</option><option id="rpr_state-vermont" value="Vermont">Vermont</option><option id="rpr_state-virginia" value="Virginia">Virginia</option><option id="rpr_state-washington" value="Washington">Washington</option><option id="rpr_state-west_virginia" value="West Virginia">West Virginia</option><option id="rpr_state-wisconsin" value="Wisconsin">Wisconsin</option><option id="rpr_state-wyoming" value="Wyoming">Wyoming</option>
                
                -->
            </select>
            <br>Cuidad:<br>
            <select class="agbusca" name="city" id="city"> 
                <option value="">--- TODAS ---</option>
                <!--
               <option id="rpr_cuidad-birmingham" value="Birmingham">Birmingham</option><option id="rpr_cuidad-montgomery" value="Montgomery">Montgomery</option><option id="rpr_cuidad-mobile" value="Mobile">Mobile</option><option id="rpr_cuidad-huntsville" value="Huntsville">Huntsville</option><option id="rpr_cuidad-tuscaloosa" value="Tuscaloosa">Tuscaloosa</option><option id="rpr_cuidad-hoover" value="Hoover">Hoover</option><option id="rpr_cuidad-dothan" value="Dothan">Dothan</option><option id="rpr_cuidad-decatur" value="Decatur">Decatur</option><option id="rpr_cuidad-auburn" value="Auburn">Auburn</option><option id="rpr_cuidad-madison" value="Madison">Madison</option><option id="rpr_cuidad-florence" value="Florence">Florence</option><option id="rpr_cuidad-gadsden" value="Gadsden">Gadsden</option><option id="rpr_cuidad-vestavia_hills" value="Vestavia Hills">Vestavia Hills</option><option id="rpr_cuidad-prattville" value="Prattville">Prattville</option><option id="rpr_cuidad-phenix_city" value="Phenix City">Phenix City</option><option id="rpr_cuidad-anchorage__mat-su" value="Anchorage / Mat-su">Anchorage / Mat-su</option><option id="rpr_cuidad-fairbanks" value="Fairbanks">Fairbanks</option><option id="rpr_cuidad-kenai_peninsula" value="Kenai Peninsula">Kenai Peninsula</option><option id="rpr_cuidad-southeast_alaska" value="Southeast Alaska">Southeast Alaska</option><option id="rpr_cuidad-flagstaff__sedona" value="Flagstaff / Sedona">Flagstaff / Sedona</option><option id="rpr_cuidad-mohave_county" value="Mohave County">Mohave County</option><option id="rpr_cuidad-phoenix" value="Phoenix">Phoenix</option><option id="rpr_cuidad-prescott" value="Prescott">Prescott</option><option id="rpr_cuidad-show_low" value="Show low">Show low</option><option id="rpr_cuidad-sierra_vista" value="Sierra Vista">Sierra Vista</option><option id="rpr_cuidad-tucson" value="Tucson">Tucson</option><option id="rpr_cuidad-yuma" value="Yuma">Yuma</option><option id="rpr_cuidad-fayetteville" value="Fayetteville">Fayetteville</option><option id="rpr_cuidad-fort_smith" value="Fort Smith">Fort Smith</option><option id="rpr_cuidad-jonesboro" value="Jonesboro">Jonesboro</option><option id="rpr_cuidad-little_rock" value="Little Rock">Little Rock</option><option id="rpr_cuidad-texarkana" value="Texarkana">Texarkana</option><option id="rpr_cuidad-bakersfield" value="Bakersfield">Bakersfield</option><option id="rpr_cuidad-chico" value="Chico">Chico</option><option id="rpr_cuidad-fresno__madera" value="Fresno / Madera">Fresno / Madera</option><option id="rpr_cuidad-gold_country" value="Gold Country">Gold Country</option><option id="rpr_cuidad-hanford-corcoran" value="Hanford-Corcoran">Hanford-Corcoran</option><option id="rpr_cuidad-humboldt_county" value="Humboldt County">Humboldt County</option><option id="rpr_cuidad-imperial_county" value="Imperial County">Imperial County</option><option id="rpr_cuidad-inland_empire" value="Inland Empire">Inland Empire</option><option id="rpr_cuidad-los_angeles" value="Los Angeles">Los Angeles</option><option id="rpr_cuidad-mendocino_county" value="Mendocino County">Mendocino County</option><option id="rpr_cuidad-merced" value="Merced">Merced</option><option id="rpr_cuidad-modesto" value="Modesto">Modesto</option><option id="rpr_cuidad-monterey_bay" value="Monterey Bay">Monterey Bay</option><option id="rpr_cuidad-orange_county" value="Orange County">Orange County</option><option id="rpr_cuidad-alm_springs" value="Alm Springs">Alm Springs</option><option id="rpr_cuidad-redding" value="Redding">Redding</option><option id="rpr_cuidad-sacramento" value="Sacramento">Sacramento</option><option id="rpr_cuidad-san_diego" value="San Diego">San Diego</option><option id="rpr_cuidad-san_francisco_bay_area" value="San Francisco Bay Area">San Francisco Bay Area</option><option id="rpr_cuidad-san_luis_obispo" value="San Luis Obispo">San Luis Obispo</option><option id="rpr_cuidad-santa_barbara" value="Santa Barbara">Santa Barbara</option><option id="rpr_cuidad-santa_maria" value="Santa Maria">Santa Maria</option><option id="rpr_cuidad-siskiyou_county" value="Siskiyou County">Siskiyou County</option><option id="rpr_cuidad-stockton" value="Stockton">Stockton</option><option id="rpr_cuidad-susanville" value="Susanville">Susanville</option><option id="rpr_cuidad-ventura_county" value="Ventura County">Ventura County</option><option id="rpr_cuidad-visalia-tulare" value="Visalia-Tulare">Visalia-Tulare</option><option id="rpr_cuidad-yuba-sutter" value="Yuba-Sutter">Yuba-Sutter</option><option id="rpr_cuidad-boulder" value="Boulder">Boulder</option><option id="rpr_cuidad-colorado_springs" value="Colorado springs">Colorado springs</option><option id="rpr_cuidad-denver" value="Denver">Denver</option><option id="rpr_cuidad-eastern_co" value="Eastern CO">Eastern CO</option><option id="rpr_cuidad-fort_collins__north_co" value="Fort Collins / North CO">Fort Collins / North CO</option><option id="rpr_cuidad-high_rockies" value="High Rockies">High Rockies</option><option id="rpr_cuidad-pueblo" value="Pueblo">Pueblo</option><option id="rpr_cuidad-western_slope" value="Western Slope">Western Slope</option><option id="rpr_cuidad-eastern_ct" value="Eastern CT">Eastern CT</option><option id="rpr_cuidad-hartford" value="Hartford">Hartford</option><option id="rpr_cuidad-new_haven" value="New Haven">New Haven</option><option id="rpr_cuidad-northwest_ct" value="Northwest CT">Northwest CT</option><option id="rpr_cuidad-delaware" value="Delaware">Delaware</option><option id="rpr_cuidad-washington" value="Washington">Washington</option><option id="rpr_cuidad-daytona_beach" value="Daytona Beach">Daytona Beach</option><option id="rpr_cuidad-florida_keys" value="Florida Keys">Florida Keys</option><option id="rpr_cuidad-fort_lauderdale" value="Fort Lauderdale">Fort Lauderdale</option><option id="rpr_cuidad-ft_myers__sw_florida" value="Ft Myers / SW Florida">Ft Myers / SW Florida</option><option id="rpr_cuidad-gainesville" value="Gainesville">Gainesville</option><option id="rpr_cuidad-heartland_florida" value="Heartland Florida">Heartland Florida</option><option id="rpr_cuidad-jacksonville" value="Jacksonville">Jacksonville</option><option id="rpr_cuidad-lakeland" value="Lakeland">Lakeland</option><option id="rpr_cuidad-north_central_fl" value="North Central FL">North Central FL</option><option id="rpr_cuidad-ocala" value="Ocala">Ocala</option><option id="rpr_cuidad-okaloosa__walton_orlando" value="Okaloosa / Walton Orlando">Okaloosa / Walton Orlando</option><option id="rpr_cuidad-panama_city" value="Panama City">Panama City</option><option id="rpr_cuidad-pensacola" value="Pensacola">Pensacola</option><option id="rpr_cuidad-sarasota-bradenton" value="Sarasota-Bradenton">Sarasota-Bradenton</option><option id="rpr_cuidad-south_florida" value="South Florida">South Florida</option><option id="rpr_cuidad-space_coast" value="Space Coast">Space Coast</option><option id="rpr_cuidad-st_augustine" value="St Augustine">St Augustine</option><option id="rpr_cuidad-tallahassee" value="Tallahassee">Tallahassee</option><option id="rpr_cuidad-tampa_bay_area" value="Tampa Bay Area">Tampa Bay Area</option><option id="rpr_cuidad-treasure_coast" value="Treasure Coast">Treasure Coast</option><option id="rpr_cuidad-west_palm_beach" value="West Palm Beach">West Palm Beach</option><option id="rpr_cuidad-albany_athens" value="Albany Athens">Albany Athens</option><option id="rpr_cuidad-atlanta" value="Atlanta">Atlanta</option><option id="rpr_cuidad-augusta" value="Augusta">Augusta</option><option id="rpr_cuidad-brunswick" value="Brunswick">Brunswick</option><option id="rpr_cuidad-columbus" value="Columbus">Columbus</option><option id="rpr_cuidad-macon__warner_robins" value="Macon / Warner Robins">Macon / Warner Robins</option><option id="rpr_cuidad-northwest_ga" value="Northwest GA">Northwest GA</option><option id="rpr_cuidad-savannah__hinesville" value="Savannah / Hinesville">Savannah / Hinesville</option><option id="rpr_cuidad-statesboro" value="Statesboro">Statesboro</option><option id="rpr_cuidad-valdosta" value="Valdosta">Valdosta</option><option id="rpr_cuidad-hawaii" value="Hawaii">Hawaii</option><option id="rpr_cuidad-boise" value="Boise">Boise</option><option id="rpr_cuidad-east_idaho" value="East Idaho">East Idaho</option><option id="rpr_cuidad-lewiston__clarkston" value="Lewiston / Clarkston">Lewiston / Clarkston</option><option id="rpr_cuidad-twin_falls" value="Twin Falls">Twin Falls</option><option id="rpr_cuidad-bloomington-normal" value="Bloomington-Normal">Bloomington-Normal</option><option id="rpr_cuidad-champaign_urbana" value="Champaign Urbana">Champaign Urbana</option><option id="rpr_cuidad-chicago" value="Chicago">Chicago</option><option id="rpr_cuidad-decatur" value="Decatur">Decatur</option><option id="rpr_cuidad-la_salle_co" value="La Salle Co">La Salle Co</option><option id="rpr_cuidad-mattoon-charleston" value="Mattoon-Charleston">Mattoon-Charleston</option><option id="rpr_cuidad-peoria" value="Peoria">Peoria</option><option id="rpr_cuidad-rockford" value="Rockford">Rockford</option><option id="rpr_cuidad-southern_illinois" value="Southern Illinois">Southern Illinois</option><option id="rpr_cuidad-springfield" value="Springfield">Springfield</option><option id="rpr_cuidad-western_il" value="Western IL">Western IL</option><option id="rpr_cuidad-" value="" selected="selected"></option><option id="rpr_cuidad-bloomington" value="Bloomington">Bloomington</option><option id="rpr_cuidad-evansville" value="Evansville">Evansville</option><option id="rpr_cuidad-fort_wayne" value="Fort Wayne">Fort Wayne</option><option id="rpr_cuidad-indianapolis" value="Indianapolis">Indianapolis</option><option id="rpr_cuidad-kokomo" value="Kokomo">Kokomo</option><option id="rpr_cuidad-lafayette__west_lafayette" value="Lafayette / West Lafayette">Lafayette / West Lafayette</option><option id="rpr_cuidad-muncie__anderson" value="Muncie / Anderson">Muncie / Anderson</option><option id="rpr_cuidad-richmond" value="Richmond">Richmond</option><option id="rpr_cuidad-south_bend__michiana" value="South Bend / Michiana">South Bend / Michiana</option><option id="rpr_cuidad-terre_haute" value="Terre Haute">Terre Haute</option><option id="rpr_cuidad-ames" value="Ames">Ames</option><option id="rpr_cuidad-cedar_rapids" value="Cedar Rapids">Cedar Rapids</option><option id="rpr_cuidad-des_moines" value="Des Moines">Des Moines</option><option id="rpr_cuidad-dubuque" value="Dubuque">Dubuque</option><option id="rpr_cuidad-fort_dodge" value="Fort Dodge">Fort Dodge</option><option id="rpr_cuidad-iowa_city" value="Iowa City">Iowa City</option><option id="rpr_cuidad-mason_city" value="Mason City">Mason City</option><option id="rpr_cuidad-quad_cities" value="Quad Cities">Quad Cities</option><option id="rpr_cuidad-sioux_city" value="Sioux City">Sioux City</option><option id="rpr_cuidad-southeast_ia" value="Southeast IA">Southeast IA</option><option id="rpr_cuidad-waterloo__cedar_falls" value="Waterloo / Cedar Falls">Waterloo / Cedar Falls</option><option id="rpr_cuidad-lawrence" value="Lawrence">Lawrence</option><option id="rpr_cuidad-manhattan" value="Manhattan">Manhattan</option><option id="rpr_cuidad-northwest_ks" value="Northwest KS">Northwest KS</option><option id="rpr_cuidad-salina" value="Salina">Salina</option><option id="rpr_cuidad-southeast_ks" value="Southeast KS">Southeast KS</option><option id="rpr_cuidad-southwest_ks" value="Southwest KS">Southwest KS</option><option id="rpr_cuidad-topeka" value="Topeka">Topeka</option><option id="rpr_cuidad-wichita" value="Wichita">Wichita</option><option id="rpr_cuidad-bowling_green" value="Bowling green">Bowling green</option><option id="rpr_cuidad-eastern_kentucky" value="Eastern Kentucky">Eastern Kentucky</option><option id="rpr_cuidad-lexington" value="Lexington">Lexington</option><option id="rpr_cuidad-louisville" value="Louisville">Louisville</option><option id="rpr_cuidad-owensboro" value="Owensboro">Owensboro</option><option id="rpr_cuidad-western_ky" value="Western KY">Western KY</option><option id="rpr_cuidad-baton_rouge" value="Baton Rouge">Baton Rouge</option><option id="rpr_cuidad-central_louisiana" value="Central Louisiana">Central Louisiana</option><option id="rpr_cuidad-houma" value="Houma">Houma</option><option id="rpr_cuidad-lafayette" value="Lafayette">Lafayette</option><option id="rpr_cuidad-lake_charles" value="Lake Charles">Lake Charles</option><option id="rpr_cuidad-monroe" value="Monroe">Monroe</option><option id="rpr_cuidad-new_orleans" value="New Orleans">New Orleans</option><option id="rpr_cuidad-shreveport" value="Shreveport">Shreveport</option><option id="rpr_cuidad-maine" value="Maine">Maine</option><option id="rpr_cuidad-annapolis" value="Annapolis">Annapolis</option><option id="rpr_cuidad-baltimore" value="Baltimore">Baltimore</option><option id="rpr_cuidad-eastern_shore" value="Eastern Shore">Eastern Shore</option><option id="rpr_cuidad-frederick" value="Frederick">Frederick</option><option id="rpr_cuidad-southern_maryland" value="Southern Maryland">Southern Maryland</option><option id="rpr_cuidad-western_maryland" value="Western Maryland">Western Maryland</option><option id="rpr_cuidad-boston" value="Boston">Boston</option><option id="rpr_cuidad-cape_cod__islands" value="Cape Cod / Islands">Cape Cod / Islands</option><option id="rpr_cuidad-south_coast" value="South Coast">South Coast</option><option id="rpr_cuidad-western_massachusetts" value="Western Massachusetts">Western Massachusetts</option><option id="rpr_cuidad-worcester__central_ma" value="Worcester / Central MA">Worcester / Central MA</option><option id="rpr_cuidad-ann_arbor" value="Ann Arbor">Ann Arbor</option><option id="rpr_cuidad-battle_creek" value="Battle Creek">Battle Creek</option><option id="rpr_cuidad-central_michigan" value="Central Michigan">Central Michigan</option><option id="rpr_cuidad-detroit_metro" value="Detroit Metro">Detroit Metro</option><option id="rpr_cuidad-flint" value="Flint">Flint</option><option id="rpr_cuidad-grand_rapids" value="Grand Rapids">Grand Rapids</option><option id="rpr_cuidad-holland_jackson" value="Holland Jackson">Holland Jackson</option><option id="rpr_cuidad-kalamazoo" value="Kalamazoo">Kalamazoo</option><option id="rpr_cuidad-lansing" value="Lansing">Lansing</option><option id="rpr_cuidad-monroe" value="Monroe">Monroe</option><option id="rpr_cuidad-muskegon" value="Muskegon">Muskegon</option><option id="rpr_cuidad-northern_michigan" value="Northern Michigan">Northern Michigan</option><option id="rpr_cuidad-port_huron" value="Port Huron">Port Huron</option><option id="rpr_cuidad-saginaw-midland-baycity" value="Saginaw-Midland-Baycity">Saginaw-Midland-Baycity</option><option id="rpr_cuidad-southwest_michigan" value="Southwest Michigan">Southwest Michigan</option><option id="rpr_cuidad-the_thumb" value="The Thumb">The Thumb</option><option id="rpr_cuidad-upper_peninsula" value="Upper Peninsula">Upper Peninsula</option><option id="rpr_cuidad-bemidji" value="Bemidji">Bemidji</option><option id="rpr_cuidad-brainerd_duluth__superior" value="Brainerd Duluth / Superior">Brainerd Duluth / Superior</option><option id="rpr_cuidad-mankato" value="Mankato">Mankato</option><option id="rpr_cuidad-minneapolis__st_paul" value="Minneapolis / St Paul">Minneapolis / St Paul</option><option id="rpr_cuidad-rochester" value="Rochester">Rochester</option><option id="rpr_cuidad-southwest_mn" value="Southwest MN">Southwest MN</option><option id="rpr_cuidad-st_cloud" value="St Cloud">St Cloud</option><option id="rpr_cuidad-gulfport__biloxi" value="Gulfport / Biloxi">Gulfport / Biloxi</option><option id="rpr_cuidad-hattiesburg" value="Hattiesburg">Hattiesburg</option><option id="rpr_cuidad-jackson" value="Jackson">Jackson</option><option id="rpr_cuidad-meridian" value="Meridian">Meridian</option><option id="rpr_cuidad-north_mississippi" value="North Mississippi">North Mississippi</option><option id="rpr_cuidad-southwest_ms" value="Southwest MS">Southwest MS</option><option id="rpr_cuidad-columbia__jeff_city" value="Columbia / Jeff City">Columbia / Jeff City</option><option id="rpr_cuidad-joplin" value="Joplin">Joplin</option><option id="rpr_cuidad-kansas_city" value="Kansas City">Kansas City</option><option id="rpr_cuidad-kirksville" value="Kirksville">Kirksville</option><option id="rpr_cuidad-lake_of_the_ozarks" value="Lake Of The Ozarks">Lake Of The Ozarks</option><option id="rpr_cuidad-southeast_missouri" value="Southeast Missouri">Southeast Missouri</option><option id="rpr_cuidad-springfield" value="Springfield">Springfield</option><option id="rpr_cuidad-st_joseph" value="St Joseph">St Joseph</option><option id="rpr_cuidad-st_louis" value="St Louis">St Louis</option><option id="rpr_cuidad-billings" value="billings">billings</option><option id="rpr_cuidad-bozeman" value="Bozeman">Bozeman</option><option id="rpr_cuidad-butte" value="Butte">Butte</option><option id="rpr_cuidad-great_falls" value="Great Falls">Great Falls</option><option id="rpr_cuidad-helena" value="Helena">Helena</option><option id="rpr_cuidad-kalispell" value="Kalispell">Kalispell</option><option id="rpr_cuidad-missoula" value="Missoula">Missoula</option><option id="rpr_cuidad-eastern_montana" value="Eastern Montana">Eastern Montana</option><option id="rpr_cuidad-grand_island" value="Grand Island">Grand Island</option><option id="rpr_cuidad-lincoln" value="Lincoln">Lincoln</option><option id="rpr_cuidad-north_platte" value="North Platte">North Platte</option><option id="rpr_cuidad-omaha__council_bluffs" value="Omaha / Council Bluffs">Omaha / Council Bluffs</option><option id="rpr_cuidad-scottsbluff__panhandle" value="Scottsbluff / Panhandle">Scottsbluff / Panhandle</option><option id="rpr_cuidad-elko" value="Elko">Elko</option><option id="rpr_cuidad-las_vegas" value="Las Vegas">Las Vegas</option><option id="rpr_cuidad-reno__tahoe" value="Reno / Tahoe">Reno / Tahoe</option><option id="rpr_cuidad-new_hampshire" value="New Hampshire">New Hampshire</option><option id="rpr_cuidad-central_nj" value="Central NJ">Central NJ</option><option id="rpr_cuidad-jersey_shore" value="Jersey Shore">Jersey Shore</option><option id="rpr_cuidad-north_jersey" value="North Jersey">North Jersey</option><option id="rpr_cuidad-south_jersey" value="South Jersey">South Jersey</option><option id="rpr_cuidad-albuquerque" value="Albuquerque">Albuquerque</option><option id="rpr_cuidad-clovis__portales" value="Clovis / Portales">Clovis / Portales</option><option id="rpr_cuidad-farmington" value="Farmington">Farmington</option><option id="rpr_cuidad-las_cruces" value="Las Cruces">Las Cruces</option><option id="rpr_cuidad-roswell__carlsbad" value="Roswell / Carlsbad">Roswell / Carlsbad</option><option id="rpr_cuidad-santa_fe__taos" value="Santa Fe / Taos">Santa Fe / Taos</option><option id="rpr_cuidad-albany" value="Albany">Albany</option><option id="rpr_cuidad-binghamton" value="Binghamton">Binghamton</option><option id="rpr_cuidad-buffalo" value="Buffalo">Buffalo</option><option id="rpr_cuidad-catskills" value="Catskills">Catskills</option><option id="rpr_cuidad-chautauqua" value="Chautauqua">Chautauqua</option><option id="rpr_cuidad-elmira-corning" value="Elmira-Corning">Elmira-Corning</option><option id="rpr_cuidad-finger_lakes" value="Finger Lakes">Finger Lakes</option><option id="rpr_cuidad-glens_falls" value="Glens Falls">Glens Falls</option><option id="rpr_cuidad-hudson_valley" value="Hudson Valley">Hudson Valley</option><option id="rpr_cuidad-ithaca" value="Ithaca">Ithaca</option><option id="rpr_cuidad-long_island" value="Long Island">Long Island</option><option id="rpr_cuidad-new_york_city" value="New York City">New York City</option><option id="rpr_cuidad-oneonta" value="Oneonta">Oneonta</option><option id="rpr_cuidad-plattsburgh-adirondacks" value="Plattsburgh-Adirondacks">Plattsburgh-Adirondacks</option><option id="rpr_cuidad-potsdam-canton-massena" value="Potsdam-canton-massena">Potsdam-canton-massena</option><option id="rpr_cuidad-rochester" value="Rochester">Rochester</option><option id="rpr_cuidad-syracuse" value="Syracuse">Syracuse</option><option id="rpr_cuidad-twin_tiers_nypa" value="Twin Tiers NY/PA">Twin Tiers NY/PA</option><option id="rpr_cuidad-utica-rome-oneida" value="Utica-Rome-Oneida">Utica-Rome-Oneida</option><option id="rpr_cuidad-watertown" value="Watertown">Watertown</option><option id="rpr_cuidad-asheville" value="Asheville">Asheville</option><option id="rpr_cuidad-boone" value="Boone">Boone</option><option id="rpr_cuidad-charlotte" value="Charlotte">Charlotte</option><option id="rpr_cuidad-eastern_nc" value="Eastern NC">Eastern NC</option><option id="rpr_cuidad-fayetteville" value="Fayetteville">Fayetteville</option><option id="rpr_cuidad-greensboro" value="Greensboro">Greensboro</option><option id="rpr_cuidad-hickory__lenoir" value="Hickory / lenoir">Hickory / lenoir</option><option id="rpr_cuidad-jacksonville" value="Jacksonville">Jacksonville</option><option id="rpr_cuidad-outer_banks" value="Outer Banks">Outer Banks</option><option id="rpr_cuidad-raleigh__durham__ch" value="Raleigh / Durham / CH">Raleigh / Durham / CH</option><option id="rpr_cuidad-wilmington" value="Wilmington">Wilmington</option><option id="rpr_cuidad-winston-salem" value="Winston-Salem">Winston-Salem</option><option id="rpr_cuidad-bismarck" value="Bismarck">Bismarck</option><option id="rpr_cuidad-fargo__moorhead" value="Fargo / Moorhead">Fargo / Moorhead</option><option id="rpr_cuidad-grand_forks" value="Grand Forks">Grand Forks</option><option id="rpr_cuidad-north_dakota" value="North Dakota">North Dakota</option><option id="rpr_cuidad-akron__canton" value="Akron / Canton">Akron / Canton</option><option id="rpr_cuidad-ashtabula" value="Ashtabula">Ashtabula</option><option id="rpr_cuidad-athens" value="Athens">Athens</option><option id="rpr_cuidad-chillicothe" value="Chillicothe">Chillicothe</option><option id="rpr_cuidad-cincinnati" value="Cincinnati">Cincinnati</option><option id="rpr_cuidad-cleveland" value="Cleveland">Cleveland</option><option id="rpr_cuidad-columbus" value="Columbus">Columbus</option><option id="rpr_cuidad-dayton__springfield" value="Dayton / Springfield">Dayton / Springfield</option><option id="rpr_cuidad-lima__findlay" value="Lima / Findlay">Lima / Findlay</option><option id="rpr_cuidad-mansfield" value="Mansfield">Mansfield</option><option id="rpr_cuidad-sandusky" value="Sandusky">Sandusky</option><option id="rpr_cuidad-toledo" value="Toledo">Toledo</option><option id="rpr_cuidad-tuscarawas_co" value="Tuscarawas Co">Tuscarawas Co</option><option id="rpr_cuidad-youngstown" value="Youngstown">Youngstown</option><option id="rpr_cuidad-zanesville__cambridge" value="Zanesville / Cambridge">Zanesville / Cambridge</option><option id="rpr_cuidad-lawton" value="Lawton">Lawton</option><option id="rpr_cuidad-northwest_ok" value="Northwest OK">Northwest OK</option><option id="rpr_cuidad-oklahoma_city" value="Oklahoma City">Oklahoma City</option><option id="rpr_cuidad-stillwater" value="Stillwater">Stillwater</option><option id="rpr_cuidad-tulsa" value="Tulsa">Tulsa</option><option id="rpr_cuidad-bend" value="Bend">Bend</option><option id="rpr_cuidad-corvallisalbany" value="Corvallis/Albany">Corvallis/Albany</option><option id="rpr_cuidad-east_oregon" value="East Oregon">East Oregon</option><option id="rpr_cuidad-eugene" value="Eugene">Eugene</option><option id="rpr_cuidad-klamath_falls" value="Klamath Falls">Klamath Falls</option><option id="rpr_cuidad-medford-ashland" value="Medford-ashland">Medford-ashland</option><option id="rpr_cuidad-oregon_coast" value="Oregon Coast">Oregon Coast</option><option id="rpr_cuidad-portland" value="Portland">Portland</option><option id="rpr_cuidad-roseburg" value="Roseburg">Roseburg</option><option id="rpr_cuidad-salem" value="Salem">Salem</option><option id="rpr_cuidad-altoona-johnstown" value="Altoona-Johnstown">Altoona-Johnstown</option><option id="rpr_cuidad-cumberland_valley" value="Cumberland Valley">Cumberland Valley</option><option id="rpr_cuidad-erie" value="Erie">Erie</option><option id="rpr_cuidad-harrisburg" value="Harrisburg">Harrisburg</option><option id="rpr_cuidad-lancaster" value="Lancaster">Lancaster</option><option id="rpr_cuidad-lehigh_valley" value="Lehigh Valley">Lehigh Valley</option><option id="rpr_cuidad-meadville" value="Meadville">Meadville</option><option id="rpr_cuidad-philadelphia" value="Philadelphia">Philadelphia</option><option id="rpr_cuidad-pittsburgh" value="Pittsburgh">Pittsburgh</option><option id="rpr_cuidad-poconos" value="Poconos">Poconos</option><option id="rpr_cuidad-reading" value="Reading">Reading</option><option id="rpr_cuidad-scranton__wilkes-barre" value="Scranton / Wilkes-Barre">Scranton / Wilkes-Barre</option><option id="rpr_cuidad-state_college" value="State College">State College</option><option id="rpr_cuidad-williamsport" value="Williamsport">Williamsport</option><option id="rpr_cuidad-york" value="York">York</option><option id="rpr_cuidad-rhode_island" value="Rhode Island">Rhode Island</option><option id="rpr_cuidad-charleston" value="Charleston">Charleston</option><option id="rpr_cuidad-columbia" value="Columbia">Columbia</option><option id="rpr_cuidad-florence" value="Florence">Florence</option><option id="rpr_cuidad-greenville__upstate" value="Greenville / Upstate">Greenville / Upstate</option><option id="rpr_cuidad-hilton_head" value="Hilton Head">Hilton Head</option><option id="rpr_cuidad-myrtle_beach" value="Myrtle Beach">Myrtle Beach</option><option id="rpr_cuidad-northeast_sd" value="Northeast SD">Northeast SD</option><option id="rpr_cuidad-pierre__central_sd" value="Pierre / Central SD">Pierre / Central SD</option><option id="rpr_cuidad-rapid_city__west_sd" value="Rapid City / West SD">Rapid City / West SD</option><option id="rpr_cuidad-sioux_falls__se_sd" value="Sioux Falls / SE SD">Sioux Falls / SE SD</option><option id="rpr_cuidad-south_dakota" value="South Dakota">South Dakota</option><option id="rpr_cuidad-chattanooga" value="Chattanooga">Chattanooga</option><option id="rpr_cuidad-clarksville" value="Clarksville">Clarksville</option><option id="rpr_cuidad-cookeville" value="Cookeville">Cookeville</option><option id="rpr_cuidad-jackson" value="Jackson">Jackson</option><option id="rpr_cuidad-knoxville" value="Knoxville">Knoxville</option><option id="rpr_cuidad-memphis" value="Memphis">Memphis</option><option id="rpr_cuidad-nashville" value="Nashville">Nashville</option><option id="rpr_cuidad-tri-cities" value="Tri-Cities">Tri-Cities</option><option id="rpr_cuidad-abilene" value="Abilene">Abilene</option><option id="rpr_cuidad-amarillo" value="Amarillo">Amarillo</option><option id="rpr_cuidad-austin" value="Austin">Austin</option><option id="rpr_cuidad-beaumont__port_arthur" value="Beaumont / Port Arthur">Beaumont / Port Arthur</option><option id="rpr_cuidad-brownsville" value="Brownsville">Brownsville</option><option id="rpr_cuidad-college_station" value="College Station">College Station</option><option id="rpr_cuidad-corpus_christi" value="Corpus Christi">Corpus Christi</option><option id="rpr_cuidad-dallas__fort_worth" value="Dallas / Fort Worth">Dallas / Fort Worth</option><option id="rpr_cuidad-deep_east_texas" value="Deep East Texas">Deep East Texas</option><option id="rpr_cuidad-del_rio__eagle_pass" value="Del Rio / Eagle Pass">Del Rio / Eagle Pass</option><option id="rpr_cuidad-el_paso" value="El Paso">El Paso</option><option id="rpr_cuidad-galveston" value="Galveston">Galveston</option><option id="rpr_cuidad-houston" value="Houston">Houston</option><option id="rpr_cuidad-killeen__temple__ft_hood" value="Killeen / Temple / Ft Hood">Killeen / Temple / Ft Hood</option><option id="rpr_cuidad-laredo" value="Laredo">Laredo</option><option id="rpr_cuidad-lubbock" value="Lubbock">Lubbock</option><option id="rpr_cuidad-mcallen__edinburg" value="Mcallen / Edinburg">Mcallen / Edinburg</option><option id="rpr_cuidad-odessa__midland" value="Odessa / Midland">Odessa / Midland</option><option id="rpr_cuidad-san_angelo" value="San Angelo">San Angelo</option><option id="rpr_cuidad-san_antonio" value="San Antonio">San Antonio</option><option id="rpr_cuidad-san_marcos" value="San marcos">San marcos</option><option id="rpr_cuidad-southwest_tx" value="Southwest TX">Southwest TX</option><option id="rpr_cuidad-texoma" value="Texoma">Texoma</option><option id="rpr_cuidad-tyler__east_tx" value="Tyler / East TX">Tyler / East TX</option><option id="rpr_cuidad-victoria" value="Victoria">Victoria</option><option id="rpr_cuidad-waco" value="Waco">Waco</option><option id="rpr_cuidad-wichita_falls" value="Wichita Falls">Wichita Falls</option><option id="rpr_cuidad-logan" value="Logan">Logan</option><option id="rpr_cuidad-ogden-clearfield" value="Ogden-Clearfield">Ogden-Clearfield</option><option id="rpr_cuidad-provo__orem" value="Provo / Orem">Provo / Orem</option><option id="rpr_cuidad-salt_lake_city" value="Salt Lake City">Salt Lake City</option><option id="rpr_cuidad-st_george" value="St George">St George</option><option id="rpr_cuidad-vermont" value="Vermont">Vermont</option><option id="rpr_cuidad-charlottesville" value="Charlottesville">Charlottesville</option><option id="rpr_cuidad-danville" value="Danville">Danville</option><option id="rpr_cuidad-fredericksburg" value="Fredericksburg">Fredericksburg</option><option id="rpr_cuidad-hampton_roads" value="Hampton Roads">Hampton Roads</option><option id="rpr_cuidad-harrisonburg" value="Harrisonburg">Harrisonburg</option><option id="rpr_cuidad-lynchburg" value="Lynchburg">Lynchburg</option><option id="rpr_cuidad-new_river_valley" value="New River Valley">New River Valley</option><option id="rpr_cuidad-richmond" value="Richmond">Richmond</option><option id="rpr_cuidad-roanoke" value="Roanoke">Roanoke</option><option id="rpr_cuidad-southwest_va" value="Southwest VA">Southwest VA</option><option id="rpr_cuidad-winchester" value="Winchester">Winchester</option><option id="rpr_cuidad-bellingham" value="Bellingham">Bellingham</option><option id="rpr_cuidad-kennewick-pasco-richland" value="Kennewick-Pasco-Richland">Kennewick-Pasco-Richland</option><option id="rpr_cuidad-moses_lake" value="Moses Lake">Moses Lake</option><option id="rpr_cuidad-olympic_peninsula" value="Olympic Peninsula">Olympic Peninsula</option><option id="rpr_cuidad-pullman__moscow" value="Pullman / Moscow">Pullman / Moscow</option><option id="rpr_cuidad-seattle-tacoma" value="Seattle-Tacoma">Seattle-Tacoma</option><option id="rpr_cuidad-skagit__island__sji" value="Skagit / Island / SJI">Skagit / Island / SJI</option><option id="rpr_cuidad-spokane__coeur_dalene" value="Spokane / Coeur D'Alene">Spokane / Coeur D'Alene</option><option id="rpr_cuidad-wenatchee" value="Wenatchee">Wenatchee</option><option id="rpr_cuidad-yakima" value="Yakima">Yakima</option><option id="rpr_cuidad-charleston" value="Charleston">Charleston</option><option id="rpr_cuidad-eastern_panhandle" value="Eastern Panhandle">Eastern Panhandle</option><option id="rpr_cuidad-huntington-ashland" value="Huntington-Ashland">Huntington-Ashland</option><option id="rpr_cuidad-morgantown" value="Morgantown">Morgantown</option><option id="rpr_cuidad-northern_panhandle" value="Northern Panhandle">Northern Panhandle</option><option id="rpr_cuidad-parkersburg-marietta" value="Parkersburg-marietta">Parkersburg-marietta</option><option id="rpr_cuidad-southern_wv" value="Southern WV">Southern WV</option><option id="rpr_cuidad-west_virginia_old" value="West Virginia (old)">West Virginia (old)</option><option id="rpr_cuidad-appleton-oshkosh-fdl" value="Appleton-Oshkosh-FDL">Appleton-Oshkosh-FDL</option><option id="rpr_cuidad-eau_claire" value="Eau Claire">Eau Claire</option><option id="rpr_cuidad-green_bay" value="Green Bay">Green Bay</option><option id="rpr_cuidad-janesville" value="Janesville">Janesville</option><option id="rpr_cuidad-kenosha-racine" value="Kenosha-racine">Kenosha-racine</option><option id="rpr_cuidad-la_crosse" value="La Crosse">La Crosse</option><option id="rpr_cuidad-madison" value="Madison">Madison</option><option id="rpr_cuidad-milwaukee" value="Milwaukee">Milwaukee</option><option id="rpr_cuidad-northern_wi" value="Northern WI">Northern WI</option><option id="rpr_cuidad-sheboygan" value="Sheboygan">Sheboygan</option><option id="rpr_cuidad-wausau" value="Wausau">Wausau</option><option id="rpr_cuidad-wyoming" value="Wyoming">Wyoming</option><option id="rpr_cuidad-guam-micronesia" value="Guam-Micronesia">Guam-Micronesia</option><option id="rpr_cuidad-puerto_rico" value="Puerto Rico">Puerto Rico</option><option id="rpr_cuidad-us_virgin_islands" value="U.S. Virgin Islands">U.S. Virgin Islands</option>
            
            -->
            </select><br><br>
            Que sepa tocar:<br>
            <select class="agbusca" name="instru">
            <option value="">--- TODOS ---</option>
            <option value="Acordeón">Acordeón</option>
            <option value="BajoElect">Bajo Elect</option>
            <option value="BajoSexto">Bajo Sexto</option>
            <option value="Bateria">Bateria</option>
            <option value="Charcheta">Charcheta</option>
            <option value="Clarineta">Clarineta</option>
            <option value="Cantante">Cantante</option>
            <option value="Congas">Congas</option>
            <option value="Guitarra/Requinto">Guitarra/Requinto</option>
            <option value="Tambora Sinaloense">Tambora Sinaloense</option>
            <option value="Tarolas">Tarolas</option>
            <option value="Teclado">Teclado</option>
            <option value="Tolo">Tolo</option>
            <option value="Trombón">Trombón</option>
            <option value="Trompeta">Trompeta</option>
            <option value="Tuba">Tuba</option>
            <option value="Sax">Sax</option>
             
            </select><br>
            Nivel:<br>
            <select class="agbusca" name="rpr_nivel">
            <option value="">--- TODOS ---</option>
            <option value="Principiante">Principiante</option>
            <option value="Mas o menos">Mas o menos</option>
            <option value="Perron">Perron</option>
            </select><br>
            Estilo:<br>
            <select class="agbusca" name="rpr_estilo">
            <option value="">- TODO TIPO -</option>
                <option id="rpr_estilo-norteo" value="Norteño">Norteño</option>
                <option id="rpr_estilo-norteobanda" value="Norteño/Banda">Norteño/Banda</option>
                <option id="rpr_estilo-banda" value="Banda">Banda</option>
                <option id="rpr_estilo-sureo" value="Siérrenos">Siérrenos</option>
            </select><br><br>
            <center><button style="font-size:10pt; width:100px; height:30px; margin:0 0 12px 0" class="btnmain" onclick="forma.submit()" name="search_u" value="s">Buscale YA!</button></center>
            </form>        
                            
                
                
                

	</div><!-- end of .widget-wrapper -->
		 
 
</div>




<div id="content" class="grid-right col-620 fit">

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
    
     
    $query = "SELECT  * FROM {$wpdb->prefix}users ";
    for($i=0;$i<$count_fields;$i++){
        $query.=" INNER JOIN {$wpdb->prefix}usermeta u_m".$i."
      ON ( {$wpdb->prefix}users.ID = u_m".$i.".user_id ) ";
    }
    
     
    
    $query.=$groupby  . $where;
      
 
    
    
   // echo $query;
     $results=$wpdb->get_results( $query);
    
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
        echo    get_avatar( $result->ID, 80); 
        echo '  </div>';
    	echo '  <div class="user-info col-780 fit grid-right">';
        echo    '<h3>'.$result->display_name.' <span class="edad">Edad: '.$rpr_edad.'</span></h3>';
        echo '  <p>'.$rpr_cuidad.', '.$rpr_state.'</p>';
        echo '  <p>Estilo: '.$rpr_estilo.'</p>';
        echo '  <p>Nivel: '.$rpr_nivel.'</p>';
        echo '  </div>';
        echo '</div>';
    }
    ?>


	 
</div><!-- end of #content -->


<?php get_footer(); ?>
