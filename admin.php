<?php

/*
Plugin Name: Gold Price Plugin
Plugin URI: http://www.wordpress.org/extend/plugins/gold-price
Description: A really simple plugin that displays the latest prices of Gold, Platinum, Silver and Palladium in various currencies. The prices are auto updated every 15 minutes Monday-Friday
Author: Enigma Digital
Version: 1.3
Author URI: http://www.enigmaweb.com.au
*/
error_reporting(0);

// register styles
wp_enqueue_style('gp-css',plugin_dir_url( __FILE__ )."includes/goldprice_admin.css");
wp_enqueue_style('gp-css1',plugin_dir_url( __FILE__ )."includes/style.css");
add_action('admin_menu','gold_plugin_menu');
// add menu page
function gold_plugin_menu() {
	add_menu_page( 'Gold Price', 'Gold Price', 'manage_options', 'gold_prices', 'gold_prices',plugin_dir_url( __FILE__ )."gold-price.png" );
	add_submenu_page('gold_prices','Gold Price Settings','','manage_options','gold_prices','gold_price_setting');
	add_submenu_page('gold_prices','Gold Price Settings','Settings','manage_options','gold_prices','gold_price_setting');
}

function gold_price_setting(){
	require 'settings.php';
}
// Register Setting
add_action( 'admin_init', 'register_gold_price_setting' );

function register_gold_price_setting() {
	register_setting( 'gp-settings-group', 'gp_metal_silver' );
	register_setting( 'gp-settings-group', 'gp_metal_gold' );
	register_setting( 'gp-settings-group', 'gp_metal_platinum' );
	register_setting( 'gp-settings-group', 'gp_metal_palladium' );
	register_setting( 'gp-settings-group', 'gp_currency' );
	register_setting( 'gp-settings-group', 'measurement' );
	register_setting( 'gp-settings-group', 'disp_measure' );
	register_setting( 'gp-settings-group', 'time_stamp' );
	register_setting( 'gp-settings-group', 'widget_design' );
	register_setting( 'gp-settings-group', 'customcss' );
}

//END Register Setting
//Custom CSS admin hook
 if(get_option('customcss')!=""){
	 
	 add_action('wp_head','customgpcss');
	 function customgpcss(){
		 $customgpcss .=  '<style type="text/css">';
		 $customgpcss .=  get_option('customcss');
		 $customgpcss .=  '</style>';
		 echo $customgpcss;
		 }
	 }
//End of head hook
// Shortcode
function gold_price_shortcode(){
	ob_start();
	
	$gp_metal_gold		=	get_option('gp_metal_gold');
	$gp_metal_silver	=	get_option('gp_metal_silver');
	$gp_metal_platinum	=	get_option('gp_metal_platinum');
	$gp_metal_palladium	=	get_option('gp_metal_palladium');
	$gp_currency		=	get_option('gp_currency');
	$measurement		=	get_option('measurement');
	$disp_measure		=	get_option('disp_measure');
	$time_stamp			=	get_option('time_stamp');
	$widget_design		=	get_option('widget_design');
	
	if($measurement == "grams")
		$fileGold = "https://enigmaplugins.com/get_xml/gold.xml";
	else
		$fileGold = "https://enigmaplugins.com/get_xml/goldounces.xml";
	$contentsGold .= '<?xml version="1.0" encoding="utf-8" ?>
	<gold>';
	$contentsGold .= file_get_contents($fileGold); 
	$contentsGold .= '</gold>'; 
	$stringGold = $contentsGold;
	$xmlGold = simplexml_load_string($stringGold);
	$dateGold = (string)$xmlGold->GoldPrice['date'];
	$priceGold = floatval($xmlGold->GoldPrice->$gp_currency);
	$priceGold = number_format($priceGold, 2);
	
	
	//
	if($measurement == "grams")
		$filesilver = "https://enigmaplugins.com/get_xml/silver.xml";
	else
		$filesilver = "https://enigmaplugins.com/get_xml/silverounces.xml";
	$contentssilver .= '<?xml version="1.0" encoding="utf-8" ?>
	<silver>';
	$contentssilver .= file_get_contents($filesilver); 
	$contentssilver .= '</silver>'; 
	$stringsilver = $contentssilver;

	$xmlsilver = simplexml_load_string($stringsilver);
	
	$datesilver = (string)$xmlsilver->SilverPrice['date'];
	$pricesilver = floatval($xmlsilver->SilverPrice->$gp_currency);
	$pricesilver = number_format($pricesilver, 2);
	
	
	//
	if($measurement == "grams")
		$fileplatinum = "https://enigmaplugins.com/get_xml/platinum.xml";
	else
		$fileplatinum = "https://enigmaplugins.com/get_xml/platinumounces.xml";
	$contentsplatinum .= '<?xml version="1.0" encoding="utf-8" ?>
	<platinum>';
	$contentsplatinum .= file_get_contents($fileplatinum);
	$contentsplatinum .= '</platinum>';  
	$stringplatinum = $contentsplatinum;

	$xmlplatinum = simplexml_load_string($stringplatinum);
	
	$dateplatinum = (string)$xmlplatinum->PlatinumPrice['date'];
	$priceplatinum = floatval($xmlplatinum->PlatinumPrice->$gp_currency);
	$priceplatinum = number_format($priceplatinum, 2);
	
	
	//
	if($measurement == "grams")
		$filepalladium = "https://enigmaplugins.com/get_xml/palladium.xml";
	else
		$filepalladium = "https://enigmaplugins.com/get_xml/palladiumounces.xml";
	$contentspalladium .= '<?xml version="1.0" encoding="utf-8" ?>
	<palladium>';
	$contentspalladium .= file_get_contents($filepalladium); 
	$contentspalladium .= '</palladium>'; 
	$stringpalladium = $contentspalladium;

	$xmlpalladium = simplexml_load_string($stringpalladium);
	$datepalladium = (string)$xmlpalladium->PalladiumPrice['date'];
	$pricepalladium = floatval($xmlpalladium->PalladiumPrice->$gp_currency);
	$pricepalladium = number_format($pricepalladium, 2);
	
	if($disp_measure=="on")
	if(get_option('measurement')=='grams')
	$msr = '</span>&nbsp;<span class="metal-unit"> per gram</span>';
	else if(get_option('measurement')=='ounces')
	$msr = '</span>&nbsp;<span class="metal-unit"> per Ounce</span>';
	else
	$msr="</span>";
	$date = date_create($dateGold);
	$date = date_format($date, 'M d Y H:i').' EST';
	
			
		echo ($widget_design==1)? '<div id="shrink">' :  '<div id="wide">';
					if($gp_metal_gold=="gold") echo '<div class="r1"><span class="metal-name">Gold</span><span class="metal-icon"><img src="'.plugin_dir_url( __FILE__ ).'includes/images/img1_03.jpg"></span><span class="metal-price">'.$gp_currency.' '.$priceGold.' '.$msr.'</div>';
					if($gp_metal_silver=="silver") echo '<div class="r2"><span class="metal-name">Silver</span><span class="metal-icon"><img src="'.plugin_dir_url( __FILE__ ).'includes/images/bg2_03.jpg"></span><span class="metal-price">'.$gp_currency.' '.$pricesilver.' '.$msr.'</div>';
					if($gp_metal_platinum=="platinum") echo '<div class="r3"><span class="metal-name">Platinum</span><span class="metal-icon"><img src="'.plugin_dir_url( __FILE__ ).'includes/images/bg3_03.jpg"></span><span class="metal-price">'.$gp_currency.' '.$priceplatinum.' '.$msr.'</div>';
					if($gp_metal_palladium=="palladium") echo '<div class="r4"><span class="metal-name">Palladium</span><span class="metal-icon"><img src="'.plugin_dir_url( __FILE__ ).'includes/images/bg4_03.jpg"></span><span class="metal-price">'.$gp_currency.' '.$pricepalladium.' '.$msr.'</div>';
				echo '</div>';
				if($time_stamp=="on")
					if($widget_design==1){
						echo '<div class="date" style="width:326px;"><span style="padding-right:10px; ">'.$date.'</span></div>';
					}
					else{
						echo '<div class="date" style="width:624px;"><span style="padding-right:10px;">'.$date.'</span></div>';
					}
return ob_get_clean();

}

add_shortcode('gold-price','gold_price_shortcode');

// function for selective image of widget design
function wdgt_select() { 
wp_enqueue_script('jquery');
?>
<script type="text/javascript">
jQuery(document).ready(function(e) {
  jQuery('.widget-select input[type=radio]').hide();
  jQuery('.widget-select input[type=radio]').click(function(e) {
	 jQuery('.widget-select input[type=radio]').parent().css({'border-color': '#d7d7d7'})
	 jQuery(this).parent().css({'border-color': '#9d9b9b'})
  });
});
</script>
<?php } 
add_action('admin_head', 'wdgt_select');
?>
