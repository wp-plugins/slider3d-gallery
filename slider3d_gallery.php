<?php
/*
	Plugin Name: Slider, banner, menu and images gallery plugin or widget.
	Plugin URI: http://www.pluginswp.com
	Description: Amazing 3D Flash Images gallery or menus in Actionscript 3.
	Version: 0.1
	Author: Webpsilon
	Author URI: http://www.pluginswp.com/
*/	
$contador=0;

$nombrebox="Webpsilon".rand(99, 99999);
function slider3d_gallery_head() {
	
	$site_url = get_option( 'siteurl' );
			
			
}
function slider3d_gallery($content){
	$content = preg_replace_callback("/\[slider3d_gallery ([^]]*)\/\]/i", "slider3d_gallery_render", $content);
	return $content;
	
}

function slider3d_gallery_render($tag_string){
$contador=rand(9, 9999999);
	$site_url = get_option( 'siteurl' );
global $wpdb; 	
$table_name = $wpdb->prefix . "slider3d_gallery";	


if(isset($tag_string[1])) {
	$auxi1=str_replace(" ", "", $tag_string[1]);
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );
}
if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	$conta=0;
	$id= $myrows[$conta]->id;
	$row= $myrows[$conta]->row;
	$folder = $myrows[$conta]->folder;
	$zoom1 = $myrows[$conta]->zoom1;
	$zoom2 = $myrows[$conta]->zoom2;
	$speed = $myrows[$conta]->speed;
	$onover = $myrows[$conta]->onover;
	$vertical = $myrows[$conta]->vertical;
	$transparency = $myrows[$conta]->transparency;
	$target = $myrows[$conta]->target;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$imageslink = $myrows[$conta]->imageslink;
	$links2 = $myrows[$conta]->links;
	$titles = $myrows[$conta]->titles;
	$imagebg = $myrows[$conta]->imagebg;
	$menu1 = $myrows[$conta]->menu1;
	$menu2 = $myrows[$conta]->menu2;
	$menu3 = $myrows[$conta]->menu3;
	$menu4 = $myrows[$conta]->menu4;
	$menu5 = $myrows[$conta]->menu5;
	$menu6 = $myrows[$conta]->menu6;
	$menu7 = $myrows[$conta]->menu7;
	
	
	$v1 = $myrows[$conta]->v1;
	$v2 = $myrows[$conta]->v2;
	$v3 = $myrows[$conta]->v3;
	$v4 = $myrows[$conta]->v4;
	$v5 = $myrows[$conta]->v5;
	$v6 = $myrows[$conta]->v6;
	
	
	$alpha = $myrows[$conta]->alpha;

	
	
		$type 		= 'png';
		$type1 		= 'jpg';
		$type2 		= 'gif';
		
		$files	= array();
		$images	= array();

		$dir = $folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html' ) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $img)
			{
				if (!is_dir($dir .DS. $img))
				{
					if (eregi($type, $img) || eregi($type1, $img)|| eregi($type2, $img)) {
						$images[$i]->name 	= $img;
						$images[$i]->folder	= $folder;
						++$i;
					}
				}
			}
			$cantidad=$i;
		}
		else $cantidad=0;




	$texto='';
	
	
	
	$texto='cantidad='.$cantidad.'&columns='.$row.'&colorbordes='.'cccccc'.'&colortextos='.'cccccc'.'&speed2='.$vertical.'&timeback='.$zoom1.'&controls='.$zoom2.'&target='.$target.'&onlink='.$imageslink.'&speed='.$onover.'&alpha='.$alpha.'&type='.$menu1.'&border='.$menu2.'&menu3='.$menu3.'&color1='.$menu4.'&menu5='.$menu5.'&menu6='.$menu6.'&color2='.$menu7.'&v1='.$v1.'&v2='.$v2;
	$conta=0;
	
	$links=split("\n", $titles);
$imagesc=split("\n", $links2);
$ligtext="";

	sort($images);
			foreach ($images as $img)
			{
 					$auxi1c="";
 					$auxi2c="";
					if(isset($links[$conta])) $auxi1c=$links[$conta];
					if(isset($imagesc[$conta])) $auxi2c=$imagesc[$conta];
					if ($imageslink==1) $texto.='&imagen'.$conta.'='.$site_url.'/'.$folder.''.$img->name.'&title'.$conta.'='.$auxi1c.'&link'.$conta.'='.$auxi2c;
					else{
					$texto.='&imagen'.$conta.'='.$site_url.'/'.$folder.''.$img->name.'&title'.$conta.'='.$auxi1c.'&link'.$conta.'='.$site_url.'/'.$folder.$img->name;
					$ligtext.= '<a href="'.$site_url.'/'.$folder.''.$img->name.'" rel="shadowbox['.$nombrebox.']"></a>';
					}
				
					$conta++;

			}
	
	
	$table_name = $wpdb->prefix . "slider3d_gallery";
	$saludo= $wpdb->get_var("SELECT id FROM $table_name ORDER BY RAND() LIMIT 0, 1; " );
	$output='
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$width.'" height="'.$height.'" id="slider3d'.$id.'-'.$contador.'" title="'.$imagebg.'">
  <param name="movie" value="'.$site_url.'/wp-content/plugins/slider3d-gallery/slider3d.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  	<param name="flashvars" value="'.$texto.'" />
  <param name="swfversion" value="9.0.45.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/slider3d-gallery/Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="'.$site_url.'/wp-content/plugins/slider3d-gallery/slider3d.swf" width="'.$width.'" height="'.$height.'">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    	<param name="flashvars" value="'.$texto.'" />
    <param name="swfversion" value="9.0.45.0" />
    <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/slider3d-gallery/Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("slider3d'.$id.'-'.$contador.'");
//-->
</script>'.$ligtext;
	return $output;
}
function slider3d_gallery_instala(){
	global $wpdb; 
	$table_name= $wpdb->prefix . "slider3d_gallery";
   $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		row tinytext NOT NULL ,
		folder tinytext NOT NULL ,
		zoom1 tinytext NOT NULL ,
		zoom2 tinytext NOT NULL ,
		speed tinytext NOT NULL ,
		onover tinytext NOT NULL ,
		links tinytext NOT NULL ,
		titles tinytext NOT NULL ,
		vertical tinytext NOT NULL ,
		target tinytext NOT NULL ,
		transparency tinytext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		imageslink tinytext NOT NULL ,
		imagebg tinytext NOT NULL ,
		alpha tinytext NOT NULL ,
		menu1 tinytext NOT NULL ,
		menu2 tinytext NOT NULL ,
		menu3 tinytext NOT NULL ,
		menu4 tinytext NOT NULL ,
		menu5 tinytext NOT NULL ,
		menu6 tinytext NOT NULL ,
		menu7 tinytext NOT NULL ,
		`v1` tinytext NOT NULL,
 		 `v2` tinytext NOT NULL,
 		 `v3` tinytext NOT NULL,
 		 `v4` tinytext NOT NULL,
  		`v5` tinytext NOT NULL,
	  `v6` tinytext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ;";
   
   
   
	$wpdb->query($sql);
	$sql = "INSERT INTO $table_name (row, folder, zoom1, zoom2, speed, onover, links, titles, vertical, target, transparency, width, height, imageslink, imagebg, alpha, menu1, menu2, menu3, menu4, menu5, menu6, menu7, v1, v2, v3, v4, v5, v6) VALUES ('8', 'wp-content/plugins/slider3d-gallery/images/', '5', '0', '0', '0.7', 'http://www.pluginswp.com/slider3d-images/\nhttp://www.pluginswp.com/', 'SLIDER 3D, wordpress plugin and widget\nMore Wordpress plugins', '0', '_blank', '1', '100%', '300px', '0', '', '90', '0', '20', '0', '000000', 'Arial', '16', 'cccccc', '333333', '12', '', '', '', '');";
	$wpdb->query($sql);
}
function slider3d_gallery_desinstala(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "slider3d_gallery";
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}	
function slider3d_gallery_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "slider3d_gallery";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
//autos  no existe
if(empty($re))
{
  $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		row tinytext NOT NULL ,
		folder tinytext NOT NULL ,
		zoom1 tinytext NOT NULL ,
		zoom2 tinytext NOT NULL ,
		speed tinytext NOT NULL ,
		onover tinytext NOT NULL ,
		links tinytext NOT NULL ,
		titles tinytext NOT NULL ,
		vertical tinytext NOT NULL ,
		target tinytext NOT NULL ,
		transparency tinytext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		imageslink tinytext NOT NULL ,
		imagebg tinytext NOT NULL ,
		alpha tinytext NOT NULL ,
		menu1 tinytext NOT NULL ,
		menu2 tinytext NOT NULL ,
		menu3 tinytext NOT NULL ,
		menu4 tinytext NOT NULL ,
		menu5 tinytext NOT NULL ,
		menu6 tinytext NOT NULL ,
		menu7 tinytext NOT NULL ,
				`v1` tinytext NOT NULL,
 		 `v2` tinytext NOT NULL,
 		 `v3` tinytext NOT NULL,
 		 `v4` tinytext NOT NULL,
  		`v5` tinytext NOT NULL,
	  `v6` tinytext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ;";
	$wpdb->query($sql);

}
		
	$sql = "INSERT INTO $table_name (row, folder, zoom1, zoom2, speed, onover, links, titles, vertical, target, transparency, width, height, imageslink, imagebg, alpha, menu1, menu2, menu3, menu4, menu5, menu6, menu7, v1, v2, v3, v4, v5, v6) VALUES ('8', 'wp-content/plugins/slider3d-gallery/images/', '5', '0', '0', '0.7', 'http://www.pluginswp.com/slider3d-images/\nhttp://www.pluginswp.com/', 'SLIDER 3D, wordpress plugin and widget\nMore Wordpress plugins', '0', '_blank', '1', '100%', '300px', '0', '', '90', '0', '20', '0', '000000', 'Arial', '16', 'cccccc', '333333', '12', '', '', '', '');";
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	if($_POST["imageslink".$_POST['id']]=="") $_POST["imageslink".$_POST['id']]=1;

if($_POST["zoom2".$_POST['id']]=="") $_POST["zoom2".$_POST['id']]=1;


$sql= "UPDATE $table_name SET `row` = '".$_POST["row".$_POST['id']]."', `folder` = '".$_POST["folder".$_POST['id']]."', `zoom1` = '".$_POST["zoom1".$_POST['id']]."', `zoom2` = '".$_POST["zoom2".$_POST['id']]."', `speed` = '".$_POST["speed".$_POST['id']]."', `onover` = '".$_POST["onover".$_POST['id']]."', `links` = '".$_POST["links".$_POST['id']]."', `titles` = '".$_POST["titles".$_POST['id']]."', `target` = '".$_POST["target".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `transparency` = '".$_POST["transparency".$_POST['id']]."', `vertical` = '".$_POST["vertical".$_POST['id']]."', `imageslink` = '".$_POST["imageslink".$_POST['id']]."', `alpha` = '".$_POST["alpha".$_POST['id']]."', `menu1` = '".$_POST["menu1".$_POST['id']]."', `menu2` = '".$_POST["menu2".$_POST['id']]."', `menu3` = '".$_POST["menu3".$_POST['id']]."', `menu4` = '".$_POST["menu4".$_POST['id']]."', `menu5` = '".$_POST["menu5".$_POST['id']]."', `menu6` = '".$_POST["menu6".$_POST['id']]."', `menu7` = '".$_POST["menu7".$_POST['id']]."', `v1` = '".$_POST["v1".$_POST['id']]."', `v2` = '".$_POST["v2".$_POST['id']]."', `v3` = '".$_POST["v3".$_POST['id']]."', `v4` = '".$_POST["v4".$_POST['id']]."', `v5` = '".$_POST["v5".$_POST['id']]."', `v6` = '".$_POST["v6".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;

include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$row= $myrows[$conta]->row;
	$folder = $myrows[$conta]->folder;
	$zoom1 = $myrows[$conta]->zoom1;
	$zoom2 = $myrows[$conta]->zoom2;
	$speed = $myrows[$conta]->speed;
	$onover = $myrows[$conta]->onover;
	$vertical = $myrows[$conta]->vertical;
	$transparency = $myrows[$conta]->transparency;
	$target = $myrows[$conta]->target;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$imageslink = $myrows[$conta]->imageslink;
	$links2 = $myrows[$conta]->links;
	$titles = $myrows[$conta]->titles;
	$imagebg = $myrows[$conta]->imagebg;
	$menu1 = $myrows[$conta]->menu1;
	$menu2 = $myrows[$conta]->menu2;
	$menu3 = $myrows[$conta]->menu3;
	$menu4 = $myrows[$conta]->menu4;
	$menu5 = $myrows[$conta]->menu5;
	$menu6 = $myrows[$conta]->menu6;
	$menu7 = $myrows[$conta]->menu7;
	$v1 = $myrows[$conta]->v1;
	$v2 = $myrows[$conta]->v2;
	$v3 = $myrows[$conta]->v3;
	$v4 = $myrows[$conta]->v4;
	$v5 = $myrows[$conta]->v5;
	$v6 = $myrows[$conta]->v6;
	$alpha = $myrows[$conta]->alpha;
	include('template/panel.html');			
	$conta++;
	}

}




function widget_slider3d_gallery($args) {

 
  
    extract($args);
	
	  $options = get_option("widget_slider3d_gallery");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'slider3d Gallery',
	  'id' => '1'
      );
  }

	$aaux=array();
	$aaux[0]="slider3d_gallery";
	
  echo $before_widget;
  echo $before_title;
  echo $options['title'];
  echo $after_title;
  $aaux[1]=$options['id'];
 echo slider3d_gallery_render($aaux);
  echo $after_widget;

}



function slider3d_gallery_control()
{
  $options = get_option("widget_slider3d_gallery");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'slider3d Gallery',
	  'id' => '1'
      );
  }
 
  if ($_POST['slider3d-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['slider3d-WidgetTitle']);
	 $options['id'] = htmlspecialchars($_POST['slider3d-WidgetId']);
    update_option("widget_slider3d_gallery", $options);
  }
  
  
  global $wpdb; 
	$table_name = $wpdb->prefix . "slider3d_gallery";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new gallery of videos, from the administration of slider3d plugin.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="slider3d-WidgetId" id="slider3d-WidgetId">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($options['id']==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';
	
	
 
echo '
  <p>
    <label for="slider3d-WidgetTitle">Widget Title: </label>
    <input type="text" id="slider3d-WidgetTitle" name="slider3d-WidgetTitle" value="'.$options['title'].'" /><br/>
	<label for="slider3d-WidgetTitle">slider3d Video Gallery ID: </label>
   '.$selector.'
    <input type="hidden" id="slider3d-Submit" name="slider3d-Submit" value="1" />
  </p>
';
}


}


function slider3d_gallery_init(){
	register_sidebar_widget(__('slider3d Gallery'), 'widget_slider3d_gallery');
	register_widget_control(   'slider3d Gallery', 'slider3d_gallery_control', 300, 300 );
	
}



function slider3d_gallery_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		//add_options_page('slider3d_gallery', 'slider3d', 8, basename(__FILE__), 'slider3d_gallery_panel');
		
		add_menu_page('slider3d_gallery', 'slider3d', 8, basename(__FILE__), 'slider3d_gallery_panel');
	}
}
if (function_exists('add_action')) {
	add_action('admin_menu', 'slider3d_gallery_add_menu'); 
}
add_action('wp_head', 'slider3d_gallery_head');
add_filter('the_content', 'slider3d_gallery');
add_action('activate_slider3d_gallery/slider3d_gallery.php','slider3d_gallery_instala');
add_action('deactivate_slider3d_gallery/slider3d_gallery.php', 'slider3d_gallery_desinstala');
add_action("plugins_loaded", "slider3d_gallery_init");
?>