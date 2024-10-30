<?php
/*
Plugin Name: HF solar widget
Version: 0.1
Plugin URI: http://ns6t.net/word/?page_id=88
Description: Provide a simple widget display to show HF propagation and solar-terrestrial data, based on examples here on <a href="http://www.hamqsl.com/solar.html">www.hamqsl.com</a>.
Author: Tom Epperly
Author URI: http://ns6t.net/
License: GPL2
 */

  /*  Copyright 2010 Tom Epperly  (email : tepperly@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */

function widget_hfsolar_init()
{
  // Check if the widget API is available
  if ( !function_exists('register_sidebar_widget') )
    return;
 
  function widget_hfsolar($args) {
    extract($args);
    $options = get_option('widget_hfsolar');
    echo $before_widget;
    echo $before_title . 'Solar-Terrestrial Data' . $after_title;
?>
      <center>
      <a href="http://www.hamqsl.com/solar.html" title="Click to add Solar-Terrestrial Data to your website!"><img src="<?php
    switch($options['hfsolar-style']) {
    case "vertical-sun":
       echo "http://www.hamqsl.com/solarpic.php";
       break;
    case "vertical-hfvhf":
      echo "http://www.hamqsl.com/solarvhf.php";
      break;
    case "vertical-noband":
      echo "http://www.hamqsl.com/solar.php";
      break;
    case "vertical-bands":
      echo "http://www.hamqsl.com/solar100sc.php";
      break;
    case "vertical-calcs":
      echo "http://www.hamqsl.com/solar2.php";
      break;
    case "horiz-sun1":
      echo "http://www.hamqsl.com/solarpich.php";
      break;
    case "horiz-sun2":
      echo "http://www.hamqsl.com/solar101pic.php";
      break;
    case "horiz-hfvhf":
      echo "http://www.hamqsl.com/solar101vhf.php";
      break;
    case "horiz-calcs":
      echo "http://www.hamqsl.com/solar101sc.php";
      break;
    default:
      echo "http://www.hamqsl.com/solar100sc.php";
      break;
    }
?>"></a>
      </center>
<?php
    echo $after_widget;
  }

  function widget_hfsolar_control() {
    $conlist=array(9);
    $conlist[0] = "vertical-sun";
    $conlist[1] = "vertical-hfvhf";
    $conlist[2] = "vertical-noband";
    $conlist[3] = "vertical-bands";
    $conlist[4] = "vertical-calcs";
    $conlist[5] = "horiz-sun1";
    $conlist[6] = "horiz-sun2";
    $conlist[7] = "horiz-hfvhf";
    $conlist[8] = "horiz-calcs";
    $text["vertical-sun"] =  "155x319 with Sun";
    $text["vertical-hfvhf"] = "155x340 with HF/VHF";
    $text["vertical-noband"] = "155x221 with no bands";
    $text["vertical-bands"] =  "155x233 with bands";
    $text["vertical-calcs"] = "155x311 with band calcs";
    $text["horiz-sun1"] = "290x168 with sun";
    $text["horiz-sun2"] = "410x125 with sun and bands";
    $text["horiz-hfvhf"] = "460x125 with HF/VHF";
    $text["horiz-calcs"] =  "460x125 with band calcs";
    $options = $newoptions = get_option('widget_hfsolar');
    if ( $_POST["hfsolar-style"] ) {
      $newoptions['hfsolar-style'] = $_POST["hfsolar-style"];
    }
    if (!$newoptions['hfsolar-style']) {
      $newoptions['hfsolar-style'] = "vertical-bands";
    }
    if ( $options != $newoptions ) {
      $options = $newoptions;
      update_option('widget_hfsolar', $options);
    }
    ?>
    <select name="hfsolar-style">
<?php
       for ($ind=0;$ind<9;++$ind) { 
?>
      <option <?php
         if ($conlist[$ind] == $options['hfsolar-style']) {
	    ?> selected="true" <?php
	 } 
	 ?> value="<?php
	 echo $conlist[$ind];
	 ?>"><?php
            echo $text[$conlist[$ind]];
	 ?></option>
<?php
    }
?>
    </select>
    <?php
  }


  register_sidebar_widget('HF/Solar-Terrestrial Data', 'widget_hfsolar');
  register_widget_control('HF/Solar-Terrestrial Data', 'widget_hfsolar_control');
}

add_action('plugins_loaded', 'widget_hfsolar_init');
?>