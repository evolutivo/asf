<?php
if ( !defined('ABSPATH')) exit;
/**
 * Nusantara Dinamic CSS
 *
 * Defines the dynamic styles and
 * scripts that are output in the front and back end 
 * Make sure activated your logical element first, for opening the tags
 * 
 * @package 	Nusantara 
 * @copyright	Copyright (c) 2012, Hendro Prayitno
 * @license	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 	Nusantara 0.0.2
 */
function nusantara_custom_logical_element() { 
$nusantara_options = get_option('nusantara_options');
$border_bbpm = $nusantara_options['nusantara_border_primary_menu'];
 { ?>
<?php if ($nusantara_options) { ?>         
<style type="text/css">
<?php 
/**
 * Dinamic CSS body copy
 * 
 * @since  Nusantara 0.0.2
 */     
if (!empty($nusantara_options['nusantara_remove_generalside']) == '1'): ?>
body{<?php $nusantara_typo_body = $nusantara_options['nusantara_typo_body'];
            if ($nusantara_typo_body) {                          
  echo 'font-family: ' . $nusantara_typo_body['face']. '; 
        font-size:'.$nusantara_typo_body['size'] .'; 
        font-style:'.$nusantara_typo_body['style'] .';
        line-height:'.$nusantara_typo_body['height'] .';  
        color:'.$nusantara_typo_body['color'].'; ';
            }  ?>
<?php $border_b = $nusantara_options['nusantara_border_bottombody'];
if ($border_b) {echo 'border-bottom:'.$border_b['width'] .' '.$border_b['style'] .' '.$border_b['color'] .';';}  ?>
<?php $border_t = $nusantara_options['nusantara_border_topbody'];
if ($border_t) {echo 'border-top:'.$border_t['width'] .' '.$border_t['style'] .' '.$border_t['color'] .';';}  ?>
<?php $border_lb = $nusantara_options['nusantara_border_leftbody'];
if ($border_lb) {echo 'border-left:'.$border_lb['width'] .' '.$border_lb['style'] .' '.$border_lb['color'] .';';}  ?>
<?php $border_rb = $nusantara_options['nusantara_border_rightbody'];
if ($border_rb) {echo 'border-right:'.$border_rb['width'] .' '.$border_rb['style'] .' '.$border_rb['color'] .';';}  ?>
}
a{color:<?php echo $nusantara_options['nusantara_link_color']; ?>;}
a:hover{color:<?php echo $nusantara_options['nusantara_link_hover']; ?>;}
a:visited{color:<?php echo $nusantara_options['nusantara_link_visited']; ?>;}
.flex1 #main-content, 
.flex2 #main-content,
.flex3 #main-content,
.flex4 #main-content,
.flex5 #main-content,
body #main-content{
background-color:<?php echo $nusantara_options['nusantara_mainconb']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_mainconi']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_mainconr']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_mainconp']; ?>;
<?php $nusantara_main_content = $nusantara_options['nusantara_main_content'];
            if ($nusantara_main_content) {                          
  echo 'font-family: ' . $nusantara_main_content['face']. '; 
        font-size:'.$nusantara_main_content['size'] .'; 
        font-style:'.$nusantara_main_content['style'] .';
        line-height:'.$nusantara_main_content['height'] .';  
        color:'.$nusantara_main_content['color'].'; ';
            }  ?>}
.below h3{<?php $nusantara_side_h3 = $nusantara_options['nusantara_side_h3'];
            if ($nusantara_side_h3) {                          
  echo 'font-family: ' . $nusantara_side_h3['face']. '; 
        font-size:'.$nusantara_side_h3['size'] .'; 
        font-style:'.$nusantara_side_h3['style'] .';
        line-height:'.$nusantara_side_h3['height'] .';  
        color:'.$nusantara_side_h3['color'].'; ';
            }  ?>}
.below{background:<?php echo $nusantara_options['nusantara_footer_color']; ?>;}
.credit{background:<?php echo $nusantara_options['nusantara_footer_credit']; ?>;}
.credit, .credit a{<?php $nusantara_credit_typo = $nusantara_options['nusantara_credit_typo'];
            if ($nusantara_credit_typo) {                          
  echo 'font-family: ' . $nusantara_credit_typo['face']. '; 
        font-size:'.$nusantara_credit_typo['size'] .'; 
        font-style:'.$nusantara_credit_typo['style'] .';
        line-height:'.$nusantara_credit_typo['height'] .';  
        color:'.$nusantara_credit_typo['color'].'; ';
            }  ?>}
<?php endif; // end dinamik CSS settings body copy ?>
<?php 
/**
 * Dinamic CSS Header
 * 
 * @since  Nusantara 0.0.2
 */     
if (!empty($nusantara_options['nusantara_remove_headerside']) == '1'): ?>
#header{background-color:<?php echo $nusantara_options['nusantara_color_header']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_image_header']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_header_repeat']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_header_position']; ?>;}
.site-title a{<?php $typography = $nusantara_options['nusantara_typo'];
            if ($typography) {                
  echo 'font-family: ' . $typography['face']. '; 
        font-size:'.$typography['size'] .'; 
        font-style:'.$typography['style'] .';
        line-height:'.$typography['height'] .';  
        color:'.$typography['color'].'; ';
            }  ?>}
.site-description{
<?php $nusantara_description = $nusantara_options['nusantara_description'];
            if ($nusantara_description) {                          
  echo 'font-family: ' . $nusantara_description['face']. '; 
        font-size:'.$nusantara_description['size'] .'; 
        font-style:'.$nusantara_description['style'] .';
        line-height:'.$nusantara_description['height'] .';  
        color:'.$nusantara_description['color'].'; ';
            }  ?>
     }
.site-title a:hover{color:<?php echo $nusantara_options['nusantara_header_hover']; ?>;}
<?php endif; ?>
<?php 
/**
 * Dinamic CSS Primary menu and secondary menu
 * 
 * @since  Nusantara 0.0.2
 */           
if (!empty($nusantara_options['nusantara_remove_menuside']) == '1'): ?>
.second{
<?php $border_s = $nusantara_options['nusantara_border_bottomsecondary'];
if ($border_s) {echo 'border-bottom:'.$border_s['width'] .' '.$border_s['style'] .' '.$border_s['color'] .';';}  ?>
<?php $border_n = $nusantara_options['nusantara_border_topsecondary'];
if ($border_n) {echo 'border-top:'.$border_n['width'] .' '.$border_n['style'] .' '.$border_n['color'] .';';}  ?>
<?php $border_l = $nusantara_options['nusantara_border_leftsecondary'];
if ($border_l) {echo 'border-left:'.$border_l['width'] .' '.$border_l['style'] .' '.$border_l['color'] .';';}  ?>
<?php $border_r = $nusantara_options['nusantara_border_rightsecondary'];
if ($border_r) {echo 'border-right:'.$border_r['width'] .' '.$border_r['style'] .' '.$border_r['color'] .';';}  ?>
}
#navmenu a{background:<?php echo $nusantara_options['nusantara_secondary_color']; ?>;
<?php $nusantara_secondary_font = $nusantara_options['nusantara_secondary_font'];
            if ($nusantara_secondary_font) {                          
echo 'font-family: ' . $nusantara_secondary_font['face']. '; 
font-size:'.$nusantara_secondary_font['size'] .'; 
font-style:'.$nusantara_secondary_font['style'] .';';}  ?>}
#navmenu li a{color:<?php echo $nusantara_options['nusantara_secondary_colormenu']; ?>;}
#navmenu li a:hover{color:<?php echo $nusantara_options['nusantara_secondary_hover']; ?>;}
#secondary {background:<?php echo $nusantara_options['nusantara_primary_color']; ?>;
<?php 
if ($border_bbpm) {echo 'border:'.$border_bbpm['width'] .' '.$border_bbpm['style'] .' '.$border_bbpm['color'] .';';}  ?>}
#secondary a {<?php $nusantara_primary_a = $nusantara_options['nusantara_primary_a'];
            if ($nusantara_primary_a) {                          
  echo 'font-family: ' . $nusantara_primary_a['face']. '; 
        font-size:'.$nusantara_primary_a['size'] .'; 
        font-style:'.$nusantara_primary_a['style'] .';
        line-height:'.$nusantara_primary_a['height'] .';  
        color:'.$nusantara_primary_a['color'].'; ';
            }  ?>
<?php $border_blc = $nusantara_options['nusantara_blc'];
if ($border_blc) {echo 'border-left:'.$border_blc['width'] .' '.$border_blc['style'] .' '.$border_blc['color'] .';';}  ?>
}
<?php endif; ?>
<?php 
/**
 * Dinamic CSS Java homepage
 * 
 * @since  Nusantara 0.0.2
 */          
if (!empty($nusantara_options['nusantara_remove_javaside']) == '1'): ?>
#javaside .line{margin-top:10px;
        background:<?php echo $nusantara_options['nusantara_widgetone_side']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_widgetone_bgimg']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_widgetone_bgrpt']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_widgetone_bgpst']; ?>;
        <?php $nusantara_1c_padding = $nusantara_options['nusantara_1c_padding'];
            if ($nusantara_1c_padding) {                          
  echo 'padding-top:' . $nusantara_1c_padding['top']. ';         
        padding-bottom:'.$nusantara_1c_padding['bottom'] .';
        padding-left:' . $nusantara_1c_padding['left']. ';         
        padding-right:'.$nusantara_1c_padding['right'] .';';
            }  ?>
<?php $border_1c_border = $nusantara_options['nusantara_1c_border'];
if ($border_1c_border) {echo 'border:'.$border_1c_border['width'] .' '.$border_1c_border['style'] .' '.$border_1c_border['color'] .';';}  ?>}
#javaside .line a{
<?php $nusantara_javasidelink_a = $nusantara_options['nusantara_javasidelink_a'];
            if ($nusantara_javasidelink_a) {                          
  echo 'font-family: ' . $nusantara_javasidelink_a['face']. '; 
        font-size:'.$nusantara_javasidelink_a['size'] .'; 
        font-style:'.$nusantara_javasidelink_a['style'] .';
        line-height:'.$nusantara_javasidelink_a['height'] .';  
        color:'.$nusantara_javasidelink_a['color'].'; ';
            }  ?>}
#javaside .line a:hover{color:<?php echo $nusantara_options['nusantara_javahover_a']; ?>;}
#javaside .line li{
<?php $border_javali_bb = $nusantara_options['border_javali_bb'];
if ($border_javali_bb) {echo 'border-bottom:'.$border_javali_bb['width'] .' '.$border_javali_bb['style'] .' '.$border_javali_bb['color'] .';';}  ?>
<?php $border_javali_bt = $nusantara_options['border_javali_bt'];
if ($border_javali_bt) {echo 'border-top:'.$border_javali_bt['width'] .' '.$border_javali_bt['style'] .' '.$border_javali_bt['color'] .';';}  ?>
<?php $border_javali_bl = $nusantara_options['border_javali_bl'];
if ($border_javali_bl) {echo 'border-left:'.$border_javali_bl['width'] .' '.$border_javali_bl['style'] .' '.$border_javali_bl['color'] .';';}  ?>
<?php $border_javali_br = $nusantara_options['border_javali_br'];
if ($border_javali_br) {echo 'border-right:'.$border_javali_br['width'] .' '.$border_javali_br['style'] .' '.$border_javali_br['color'] .';';}  ?>
<?php $nusantara_javali_padding = $nusantara_options['nusantara_javali_padding'];
            if ($nusantara_javali_padding) {                          
  echo 'padding-top:' . $nusantara_javali_padding['top']. ';         
        padding-bottom:'.$nusantara_javali_padding['bottom'] .';
        padding-left:' . $nusantara_javali_padding['left']. ';         
        padding-right:'.$nusantara_javali_padding['right'] .';';
            }  ?>
}
.side-right h3,.line h3{background:<?php echo $nusantara_options['nusantara_widgetone_h3title']; ?>;
<?php $nusantara_1c_textshadow = $nusantara_options['nusantara_1c_textshadow'];
if ($nusantara_1c_textshadow) {echo 'text-shadow:'.$nusantara_1c_textshadow['Xshadow'] .' '.$nusantara_1c_textshadow['Yshadow'] .' '.$nusantara_1c_textshadow['blur'] .' '.$nusantara_1c_textshadow['scolor'] .';';}  ?>
<?php $nusantara_widgetone_h3color = $nusantara_options['nusantara_widgetone_h3color'];
            if ($nusantara_widgetone_h3color) {                          
  echo 'font-family: ' . $nusantara_widgetone_h3color['face']. '; 
        font-size:'.$nusantara_widgetone_h3color['size'] .'; 
        font-style:'.$nusantara_widgetone_h3color['style'] .';
        line-height:'.$nusantara_widgetone_h3color['height'] .';  
        color:'.$nusantara_widgetone_h3color['color'].'; ';
            }  ?>}
.thumbnail  {
<?php $nusantara_javathumb_padding = $nusantara_options['nusantara_javathumb_padding'];
            if ($nusantara_javathumb_padding) {                          
  echo 'padding-top:' . $nusantara_javathumb_padding['top']. ';         
        padding-bottom:'.$nusantara_javathumb_padding['bottom'] .';
        padding-left:' . $nusantara_javathumb_padding['left']. ';         
        padding-right:'.$nusantara_javathumb_padding['right'] .';';
            }  ?>
<?php $border_javathumb_border = $nusantara_options['nusantara_javathumb_border'];
if ($border_javathumb_border) {echo 'border:'.$border_javathumb_border['width'] .' '.$border_javathumb_border['style'] .' '.$border_javathumb_border['color'] .';';}  ?>	
       width:<?php echo $nusantara_options['nusantara_javathumb_width']; ?>;
       height:<?php echo $nusantara_options['nusantara_javathumb_height']; ?>;
}
<?php endif; ?>
<?php 
/**
 * Dinamic CSS Batavia Homepage
 * 
 * @since  Nusantara 0.0.2
 */     
if (!empty($nusantara_options['nusantara_remove_bataviaside']) == '1'): ?>
.intro-home h2{<?php $nusantara_side_h2 = $nusantara_options['nusantara_side_h2'];
            if ($nusantara_side_h2) {                          
  echo 'font-family: ' . $nusantara_side_h2['face']. '; 
        font-size:'.$nusantara_side_h2['size'] .'; 
        font-style:'.$nusantara_side_h2['style'] .';
        line-height:'.$nusantara_side_h2['height'] .';  
        color:'.$nusantara_side_h2['color'].'; ';
            }  ?>}
.side-home{padding:10px;margin-top:15px;
        background-color:<?php echo $nusantara_options['nusantara_sidehome_color']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_sidehome_image']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_sidehome_repeat']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_sidehome_position']; ?>;
<?php $border_shb = $nusantara_options['nusantara_border_shb'];
if ($border_shb) {echo 'border-bottom:'.$border_shb['width'] .' '.$border_shb['style'] .' '.$border_shb['color'] .';';}  ?>
<?php $border_sht = $nusantara_options['nusantara_border_sht'];
if ($border_sht) {echo 'border-top:'.$border_sht['width'] .' '.$border_sht['style'] .' '.$border_sht['color'] .';';}  ?>
<?php $border_shl = $nusantara_options['nusantara_border_shl'];
if ($border_shl) {echo 'border-left:'.$border_shl['width'] .' '.$border_shl['style'] .' '.$border_shl['color'] .';';}  ?>
<?php $border_shr = $nusantara_options['nusantara_border_shr'];
if ($border_shr) {echo 'border-right:'.$border_shr['width'] .' '.$border_shr['style'] .' '.$border_shr['color'] .';';}  ?>
<?php $nusantara_batavia_radius2 = $nusantara_options['nusantara_batavia_radius2'];
            if ($nusantara_batavia_radius2) {echo 'border-radius:' . $nusantara_batavia_radius2['top'].' '.$nusantara_batavia_radius2['bottom'].' '.$nusantara_batavia_radius2['left'].' '.$nusantara_batavia_radius2['right'].';';}  ?>
<?php $nusantara_batavia_boxshadow2 = $nusantara_options['nusantara_batavia_boxshadow2'];
            if ($nusantara_batavia_boxshadow2) {echo 'box-shadow:'.$nusantara_batavia_boxshadow2['Xshadow'] .' '.$nusantara_batavia_boxshadow2['Yshadow'] .' '.$nusantara_batavia_boxshadow2['blur'] .' '.$nusantara_batavia_boxshadow2['scolor'] .';';}  ?>
}
.side-home h3{<?php $nusantara_sidehome_h3 = $nusantara_options['nusantara_sidehome_h3'];
            if ($nusantara_sidehome_h3) {                          
  echo 'font-family: ' . $nusantara_sidehome_h3['face']. '; 
        font-size:'.$nusantara_sidehome_h3['size'] .'; 
        font-style:'.$nusantara_sidehome_h3['style'] .';
        line-height:'.$nusantara_sidehome_h3['height'] .';  
        color:'.$nusantara_sidehome_h3['color'].'; ';
            }  ?>
}
.intro-home2{
        background-color:<?php echo $nusantara_options['nusantara_sidehome2_color']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_sidehome2_image']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_sidehome2_repeat']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_sidehome2_position']; ?>;
<?php $nusantara_ih2padding = $nusantara_options['nusantara_ih2padding'];
            if ($nusantara_ih2padding) {                          
  echo 'padding-top:' . $nusantara_ih2padding['top']. ';         
        padding-bottom:'.$nusantara_ih2padding['bottom'] .';
        padding-left:' . $nusantara_ih2padding['left']. ';         
        padding-right:'.$nusantara_ih2padding['right'] .';';
            }  ?>}
.testimonial{
        background-color:<?php echo $nusantara_options['nusantara_tmbc']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_tmbi']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_tmbr']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_tmbp']; ?>;
        <?php $nusantara_padt = $nusantara_options['nusantara_padt'];
            if ($nusantara_padt) {                          
  echo 'padding-top:' . $nusantara_padt['top']. ';         
        padding-bottom:'.$nusantara_padt['bottom'] .';
        padding-left:' . $nusantara_padt['left']. ';         
        padding-right:'.$nusantara_padt['right'] .';';
            }  ?>
<?php $border_tmobb = $nusantara_options['nusantara_tmobb'];
if ($border_tmobb) {echo 'border:'.$border_tmobb['width'] .' '.$border_tmobb['style'] .' '.$border_tmobb['color'] .';';}  ?>
<?php $nusantara_batavia_radius = $nusantara_options['nusantara_batavia_radius'];
            if ($nusantara_batavia_radius) {echo 'border-radius:' . $nusantara_batavia_radius['top'].' '.$nusantara_batavia_radius['bottom'].' '.$nusantara_batavia_radius['left'].' '.$nusantara_batavia_radius['right'].';';}  ?>
<?php $nusantara_batavia_boxshadow = $nusantara_options['nusantara_batavia_boxshadow'];
            if ($nusantara_batavia_boxshadow) {echo 'box-shadow:'.$nusantara_batavia_boxshadow['Xshadow'] .' '.$nusantara_batavia_boxshadow['Yshadow'] .' '.$nusantara_batavia_boxshadow['blur'] .' '.$nusantara_batavia_boxshadow['scolor'] .';';}  ?>
}
<?php endif; ?>
<?php 
/**
 * Dinamic CSS Andalas Homepage
 * 
 * @since  Nusantara 0.0.2
 */         
if (!empty($nusantara_options['nusantara_remove_andalasside']) == '1'): ?>
#andalas .grid3{        
         <?php $nusantara_anpt = $nusantara_options['nusantara_anpt'];
            if ($nusantara_anpt) {                          
  echo 'padding-top:' . $nusantara_anpt['top']. ';         
        padding-bottom:'.$nusantara_anpt['bottom'] .';
        padding-left:' . $nusantara_anpt['left']. ';         
        padding-right:'.$nusantara_anpt['right'] .';';
            }  ?>
<?php $border_andbor = $nusantara_options['nusantara_andbor'];
if ($border_andbor) {echo 'border:'.$border_andbor['width'] .' '.$border_andbor['style'] .' '.$border_andbor['color'] .';';}  ?>             
        <?php $nusantara_anmar = $nusantara_options['nusantara_anmar'];
            if ($nusantara_anpt) {                          
  echo 'margin-top:' . $nusantara_anmar['top']. ';         
        margin-bottom:'.$nusantara_anmar['bottom'] .';
        margin-left:' . $nusantara_anmar['left']. ';         
        margin-right:'.$nusantara_anmar['right'] .';';
            }  ?>
        background-color:<?php echo $nusantara_options['nusantara_andlc']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_andli']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_andlr']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_andlp']; ?>;
        }
.andalas-title {<?php $nusantara_andalas_h2 = $nusantara_options['nusantara_andalas_h2'];
            if ($nusantara_andalas_h2) {                          
  echo 'font-family: ' . $nusantara_andalas_h2['face']. '; 
        font-size:'.$nusantara_andalas_h2['size'] .'; 
        font-style:'.$nusantara_andalas_h2['style'] .';
        line-height:'.$nusantara_andalas_h2['height'] .';  
        color:'.$nusantara_andalas_h2['color'].'; ';
            }  ?>}
<?php endif; ?>
<?php 
/**
 * Dinamic Borneo homepage
 * 
 * @since  Nusantara 0.0.2
 */             
if (!empty($nusantara_options['nusantara_remove_borneoside']) == '1'): ?>
.six .grid3{
        background-color:<?php echo $nusantara_options['nusantara_widgetone_borneosidec']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_widgetone_borneosidei']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_widgetone_borneosider']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_widgetone_borneosidep']; ?>;
<?php $border_bhb = $nusantara_options['nusantara_border_bhb'];
if ($border_bhb) {echo 'border-bottom:'.$border_bhb['width'] .' '.$border_bhb['style'] .' '.$border_bhb['color'] .';';}  ?>
<?php $border_bht = $nusantara_options['nusantara_border_bht'];
if ($border_bht) {echo 'border-top:'.$border_bht['width'] .' '.$border_bht['style'] .' '.$border_bht['color'] .';';}  ?>
<?php $border_bhl = $nusantara_options['nusantara_border_bhl'];
if ($border_bhl) {echo 'border-left:'.$border_bhl['width'] .' '.$border_bhl['style'] .' '.$border_bhl['color'] .';';}  ?>
<?php $border_bhr = $nusantara_options['nusantara_border_bhr'];
if ($border_bhr) {echo 'border-right:'.$border_bhr['width'] .' '.$border_bhr['style'] .' '.$border_bhr['color'] .';';}  ?>
<?php $nusantara_borneo_boxshadow = $nusantara_options['nusantara_borneo_boxshadow'];
if ($nusantara_borneo_boxshadow) {echo 'box-shadow:'.$nusantara_borneo_boxshadow['Xshadow'] .' '.$nusantara_borneo_boxshadow['Yshadow'] .' '.$nusantara_borneo_boxshadow['blur'] .' '.$nusantara_borneo_boxshadow['scolor'] .';';}  ?>
<?php $nusantara_borneo_radius2 = $nusantara_options['nusantara_borneo_radius2'];
            if ($nusantara_borneo_radius2) {echo 'border-radius:' . $nusantara_borneo_radius2['top'].' '.$nusantara_borneo_radius2['bottom'].' '.$nusantara_borneo_radius2['left'].' '.$nusantara_borneo_radius2['right'].';';}  ?>}
.six .grid3 h2 a{
<?php $nusantara_borneo_h2 = $nusantara_options['nusantara_borneo_h2'];
            if ($nusantara_borneo_h2) {                          
  echo 'font-family: ' . $nusantara_borneo_h2['face']. '; 
        font-size:'.$nusantara_borneo_h2['size'] .'; 
        font-style:'.$nusantara_borneo_h2['style'] .';
        line-height:'.$nusantara_borneo_h2['height'] .';  
        color:'.$nusantara_borneo_h2['color'].'; ';
            }  ?>}
.six .grid3 h2 a:hover{
<?php $nusantara_borneo_h2hover = $nusantara_options['nusantara_borneo_h2hover'];
            if ($nusantara_borneo_h2hover) {                          
  echo 'font-family: ' . $nusantara_borneo_h2hover['face']. '; 
        font-size:'.$nusantara_borneo_h2hover['size'] .'; 
        font-style:'.$nusantara_borneo_h2hover['style'] .';
        line-height:'.$nusantara_borneo_h2hover['height'] .';  
        color:'.$nusantara_borneo_h2hover['color'].'; ';
            }  ?>}
.six .grid3 .postmeta{margin:0;
<?php $nusantara_borneo_postmeta = $nusantara_options['nusantara_borneo_postmeta'];
            if ($nusantara_borneo_postmeta) {                          
  echo 'font-family: ' . $nusantara_borneo_postmeta['face']. '; 
        font-size:'.$nusantara_borneo_postmeta['size'] .'; 
        font-style:'.$nusantara_borneo_postmeta['style'] .';
        line-height:'.$nusantara_borneo_postmeta['height'] .';  
        color:'.$nusantara_borneo_postmeta['color'].'; ';
            }  ?>}
.six .grid3 .postmeta a{margin:0;
<?php $nusantara_borneo_postmetaa = $nusantara_options['nusantara_borneo_postmetaa'];
            if ($nusantara_borneo_postmetaa) {                          
  echo 'font-family: ' . $nusantara_borneo_postmetaa['face']. '; 
        font-size:'.$nusantara_borneo_postmetaa['size'] .'; 
        font-style:'.$nusantara_borneo_postmetaa['style'] .';
        line-height:'.$nusantara_borneo_postmetaa['height'] .';  
        color:'.$nusantara_borneo_postmetaa['color'].'; ';
            }  ?>}
.six .grid3 .postmeta a:hover{margin:0;
<?php $nusantara_borneo_postmetaahover = $nusantara_options['nusantara_borneo_postmetaahover'];
            if ($nusantara_borneo_postmetaahover) {                          
  echo 'font-family: ' . $nusantara_borneo_postmetaahover['face']. '; 
        font-size:'.$nusantara_borneo_postmetaahover['size'] .'; 
        font-style:'.$nusantara_borneo_postmetaahover['style'] .';
        line-height:'.$nusantara_borneo_postmetaahover['height'] .';  
        color:'.$nusantara_borneo_postmetaahover['color'].'; ';
            }  ?>}
#borneoside .line{margin-top:18px;
        background-color:<?php echo $nusantara_options['nusantara_widgetone_sidec']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_widgetone_sidei']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_widgetone_sider']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_widgetone_sidep']; ?>;
<?php $border_wbhb = $nusantara_options['nusantara_border_wbhb'];
if ($border_wbhb) {echo 'border-bottom:'.$border_wbhb['width'] .' '.$border_wbhb['style'] .' '.$border_wbhb['color'] .';';}  ?>
<?php $border_wbht = $nusantara_options['nusantara_border_wbht'];
if ($border_wbht) {echo 'border-top:'.$border_wbht['width'] .' '.$border_wbht['style'] .' '.$border_wbht['color'] .';';}  ?>
<?php $border_wbhl = $nusantara_options['nusantara_border_wbhl'];
if ($border_wbhl) {echo 'border-left:'.$border_wbhl['width'] .' '.$border_wbhl['style'] .' '.$border_wbhl['color'] .';';}  ?>
<?php $border_wbhr = $nusantara_options['nusantara_border_wbhr'];
if ($border_wbhr) {echo 'border-right:'.$border_wbhr['width'] .' '.$border_wbhr['style'] .' '.$border_wbhr['color'] .';';}  ?>
 <?php $nusantara_bnpt = $nusantara_options['nusantara_bnpt'];
            if ($nusantara_bnpt) {                          
  echo 'padding-top:' . $nusantara_bnpt['top']. ';         
        padding-bottom:'.$nusantara_bnpt['bottom'] .';
        padding-left:' . $nusantara_bnpt['left']. ';         
        padding-right:'.$nusantara_bnpt['right'] .';';
            }  ?>
<?php $nusantara_borneo_radius = $nusantara_options['nusantara_borneo_radius'];
            if ($nusantara_borneo_radius) {echo 'border-radius:' . $nusantara_borneo_radius['top'].' '.$nusantara_borneo_radius['bottom'].' '.$nusantara_borneo_radius['left'].' '.$nusantara_borneo_radius['right'].';';}  ?>
<?php $nusantara_borneo_widgetshadow = $nusantara_options['nusantara_borneo_widgetshadow'];
if ($nusantara_borneo_widgetshadow) {echo 'box-shadow:'.$nusantara_borneo_widgetshadow['Xshadow'] .' '.$nusantara_borneo_widgetshadow['Yshadow'] .' '.$nusantara_borneo_widgetshadow ['blur'] .' '.$nusantara_borneo_widgetshadow['scolor'] .';';}  ?>
}
#borneoside .line h3{<?php $nusantara_borneo_twh3 = $nusantara_options['nusantara_borneo_twh3'];
            if ($nusantara_borneo_twh3) {                          
  echo 'font-family: ' . $nusantara_borneo_twh3['face']. '; 
        font-size:'.$nusantara_borneo_twh3['size'] .'; 
        font-style:'.$nusantara_borneo_twh3['style'] .';
        line-height:'.$nusantara_borneo_twh3['height'] .';  
        color:'.$nusantara_borneo_twh3['color'].'; ';
            }  ?>
background:<?php echo $nusantara_options['nusantara_borneowh3_background']; ?>;}
<?php endif; ?>
<?php 
/**
 * Papua Homepage
 * 
 * @since  Nusantara 0.0.3
 */             
if (!empty($nusantara_options['nusantara_remove_papuaside']) == '1'): ?>
.excerpt4{<?php $nusantara_pnpt = $nusantara_options['nusantara_pnpt'];
            if ($nusantara_pnpt) {                          
  echo 'padding-top:' . $nusantara_pnpt['top']. ';         
        padding-bottom:'.$nusantara_pnpt['bottom'] .';
        padding-left:' . $nusantara_pnpt['left']. ';         
        padding-right:'.$nusantara_pnpt['right'] .';';
            }  ?>}
<?php endif; ?>
<?php 
/**
 * Celebes Homepage
 * 
 * @since  Nusantara 0.0.3
 */             
if (!empty($nusantara_options['nusantara_remove_celebesside']) == '1'): ?>
.celebes .line{margin-top:15px;
        background-color:<?php echo $nusantara_options['nusantara_widgetone_celebsidec']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_widgetone_celebsidei']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_widgetone_celebsider']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_widgetone_celebsidep']; ?>;
<?php $border_celebb = $nusantara_options['nusantara_border_celebb'];
if ($border_celebb) {echo 'border-bottom:'.$border_celebb['width'] .' '.$border_celebb['style'] .' '.$border_celebb['color'] .';';}  ?>
<?php $border_celebt = $nusantara_options['nusantara_border_celebt'];
if ($border_celebt) {echo 'border-top:'.$border_celebt['width'] .' '.$border_celebt['style'] .' '.$border_celebt['color'] .';';}  ?>
<?php $border_celebl = $nusantara_options['nusantara_border_celebl'];
if ($border_celebl) {echo 'border-left:'.$border_celebl['width'] .' '.$border_celebl['style'] .' '.$border_celebl['color'] .';';}  ?>
<?php $border_celebr = $nusantara_options['nusantara_border_celebr'];
if ($border_celebr) {echo 'border-right:'.$border_celebr['width'] .' '.$border_celebr['style'] .' '.$border_celebr['color'] .';';}  ?>
<?php $nusantara_celebes_radius = $nusantara_options['nusantara_celebes_radius'];
            if ($nusantara_celebes_radius) {echo 'border-radius:' . $nusantara_celebes_radius['top'].' '.$nusantara_celebes_radius['bottom'].' '.$nusantara_celebes_radius['left'].' '.$nusantara_celebes_radius['right'].';';}  ?>
<?php $nusantara_celebpadding = $nusantara_options['nusantara_celebpadding'];
            if ($nusantara_celebpadding) {                          
  echo 'padding-top:' . $nusantara_celebpadding['top']. ';         
        padding-bottom:'.$nusantara_celebpadding['bottom'] .';
        padding-left:' . $nusantara_celebpadding['left']. ';         
        padding-right:'.$nusantara_celebpadding['right'] .';';
            }  ?>
<?php $nusantara_celebes_boxshadow = $nusantara_options['nusantara_celebes_boxshadow'];
if ($nusantara_celebes_boxshadow) {echo 'box-shadow:'.$nusantara_celebes_boxshadow['Xshadow'] .' '.$nusantara_celebes_boxshadow['Yshadow'] .' '.$nusantara_celebes_boxshadow['blur'] .' '.$nusantara_celebes_boxshadow['scolor'] .';';}  ?>}
.celebes .line h3{
<?php $nusantara_celebes_twh3 = $nusantara_options['nusantara_celebes_twh3'];
            if ($nusantara_celebes_twh3) {                          
  echo 'font-family: ' . $nusantara_celebes_twh3['face']. '; 
        font-size:'.$nusantara_celebes_twh3['size'] .'; 
        font-style:'.$nusantara_celebes_twh3['style'] .';
        line-height:'.$nusantara_celebes_twh3['height'] .';  
        color:'.$nusantara_celebes_twh3['color'].'; ';
            }  ?>}
.celebes2 .line{margin-top:15px;
        background-color:<?php echo $nusantara_options['nusantara_widgetone2_celebsidec']; ?>;
        background-image:url(<?php echo $nusantara_options['nusantara_widgetone2_celebsidei']; ?>);
        background-repeat:<?php echo $nusantara_options['nusantara_widgetone2_celebsider']; ?>;
        background-position:<?php echo $nusantara_options['nusantara_widgetone2_celebsidep']; ?>;
<?php $border_celebb2 = $nusantara_options['nusantara_border_celebb2'];
if ($border_celebb2) {echo 'border-bottom:'.$border_celebb2['width'] .' '.$border_celebb2['style'] .' '.$border_celebb2['color'] .';';}  ?>
<?php $border_celebt2 = $nusantara_options['nusantara_border_celebt2'];
if ($border_celebt2) {echo 'border-top:'.$border_celebt2['width'] .' '.$border_celebt2['style'] .' '.$border_celebt2['color'] .';';}  ?>
<?php $border_celebl2 = $nusantara_options['nusantara_border_celebl2'];
if ($border_celebl2) {echo 'border-left:'.$border_celebl2['width'] .' '.$border_celebl2['style'] .' '.$border_celebl2['color'] .';';}  ?>
<?php $border_celebr2 = $nusantara_options['nusantara_border_celebr2'];
if ($border_celebr2) {echo 'border-right:'.$border_celebr2['width'] .' '.$border_celebr2['style'] .' '.$border_celebr2['color'] .';';}  ?>
<?php $nusantara_celebes_radius2 = $nusantara_options['nusantara_celebes_radius2'];
            if ($nusantara_celebes_radius2) {echo 'border-radius:' . $nusantara_celebes_radius2['top'].' '.$nusantara_celebes_radius2['bottom'].' '.$nusantara_celebes_radius2['left'].' '.$nusantara_celebes_radius['right'].';';}  ?>
<?php $nusantara_celebpadding = $nusantara_options['nusantara_celebpadding'];
            if ($nusantara_celebpadding2) {                          
  echo 'padding-top:' . $nusantara_celebpadding2['top']. ';         
        padding-bottom:'.$nusantara_celebpadding2['bottom'] .';
        padding-left:' . $nusantara_celebpadding2['left']. ';         
        padding-right:'.$nusantara_celebpadding2['right'] .';';
            }  ?>
<?php $nusantara_celebes_boxshadow2 = $nusantara_options['nusantara_celebes_boxshadow2'];
if ($nusantara_celebes_boxshadow2) {echo 'box-shadow:'.$nusantara_celebes_boxshadow2['Xshadow'] .' '.$nusantara_celebes_boxshadow2['Yshadow'] .' '.$nusantara_celebes_boxshadow2['blur'] .' '.$nusantara_celebes_boxshadow['scolor'] .';';}  ?>}
.celebes2 .line h3{
<?php $nusantara_celebes_twh32 = $nusantara_options['nusantara_celebes_twh32'];
            if ($nusantara_celebes_twh32) {                          
  echo 'font-family: ' . $nusantara_celebes_twh32['face']. '; 
        font-size:'.$nusantara_celebes_twh32['size'] .'; 
        font-style:'.$nusantara_celebes_twh32['style'] .';
        line-height:'.$nusantara_celebes_twh32['height'] .';  
        color:'.$nusantara_celebes_twh32['color'].'; ';
            }  ?>}
<?php endif; ?>
<?php 
/**
 * Dinamic CSS Single post
 * 
 * @since  Nusantara 0.0.2
 */             
if (!empty($nusantara_options['nusantara_remove_singleside']) == '1'): ?>
p, .entry{<?php $nusantara_paragraph = $nusantara_options['nusantara_paragraph'];
            if ($nusantara_paragraph) {                      
  echo 'font-family: ' . $nusantara_paragraph['face']. '; 
        font-size:'.$nusantara_paragraph['size'] .'; 
        font-style:'.$nusantara_paragraph['style'] .';
        line-height:'.$nusantara_paragraph['height'] .';  
        color:'.$nusantara_paragraph['color'].'; ';
        }  ?>}     
.entry .title-single{
       text-align:<?php echo $nusantara_options['nusantara_titlesingle_alignment']; ?>; 
       <?php $nusantara_title_excerpt = $nusantara_options['nusantara_title_excerpt'];
            if ($nusantara_title_excerpt) {                          
  echo 'font-family: ' . $nusantara_title_excerpt['face']. '; 
        font-size:'.$nusantara_title_excerpt['size'] .'; 
        font-style:'.$nusantara_title_excerpt['style'] .';
        line-height:'.$nusantara_title_excerpt['height'] .';  
        color:'.$nusantara_title_excerpt['color'].'; ';
            }  ?>}
.commentlist > li.comment{
background:<?php echo $nusantara_options['nusantara_comment_background']; ?>;
<?php $nusantara_comment_typo = $nusantara_options['nusantara_comment_typo'];
            if ($nusantara_comment_typo) {                          
  echo 'font-family: ' . $nusantara_comment_typo['face']. '; 
        font-size:'.$nusantara_comment_typo['size'] .'; 
        font-style:'.$nusantara_comment_typo['style'] .';
        line-height:'.$nusantara_comment_typo['height'] .';  
        color:'.$nusantara_comment_typo['color'].'; ';
            }  ?>}
<?php endif; ?>
<?php 
/**
 * CSS3 button options
 * 
 * @since  Nusantara 0.0.2
 */   
if (!empty($nusantara_options['nusantara_tombol_button'])){
$tombol_button = $nusantara_options['nusantara_tombol_button'];
switch($tombol_button) {
case 1: $tombol_button = '';
        break;	 
case 2: $tombol_button = 'a.tombol{background-color:#4682b4;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#5fb0f4), to(#4682b4));
	background-image:-webkit-linear-gradient(top, #5fb0f4, #4682b4);
	background-image:-moz-linear-gradient(top, #5fb0f4, #4682b4);
	background-image:-ms-linear-gradient(top, #5fb0f4, #4682b4);
	background-image:-o-linear-gradient(top, #5fb0f4, #4682b4);
	background-image:linear-gradient(top, #5fb0f4, #4682b4);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#5fb0f4, endColorstr=#4682b4);
	border:1px solid #386890;
	color:#fff;
	text-shadow:0 1px 0 #386890;}
        a.tombol:hover{background-color:#4682b4;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#4682b4), to(#4682b4));
	background-image:-webkit-linear-gradient(top, #4682b4, #4682b4);
	background-image:-moz-linear-gradient(top, #4682b4, #4682b4);
	background-image:-ms-linear-gradient(top, #4682b4, #4682b4);
	background-image:-o-linear-gradient(top, #4682b4, #4682b4);
	background-image:linear-gradient(top, #4682b4, #4682b4);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#4682b4, endColorstr=#4682b4);
	border:1px solid #386890;
	color:#fff;
	text-shadow:0 1px 0 #386890;}';      		 
        break;
case 3: $tombol_button = 'a.tombol{background-color:#ff8C00;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#fdc37d), to(#ff8C00));
	background-image:-webkit-linear-gradient(top, #fdc37d, #ff8C00);
	background-image:-moz-linear-gradient(top, #fdc37d, #ff8C00);
	background-image:-ms-linear-gradient(top, #fdc37d, #ff8C00);
	background-image:-o-linear-gradient(top, #fdc37d, #ff8C00);
	background-image:linear-gradient(top, #fdc37d, #ff8C00);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fdc37d, endColorstr=#ff8C00);
	color:#fff;
	text-shadow:0 1px 0 #cc7000;}
        a.tombol:hover{background-color:#ff8C00;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#ff8C00), to(#ff8C00));
	background-image:-webkit-linear-gradient(top, #ff8C00, #ff8C00);
	background-image:-moz-linear-gradient(top, #ff8C00, #ff8C00);
	background-image:-ms-linear-gradient(top, #ff8C00, #ff8C00);
	background-image:-o-linear-gradient(top, #ff8C00, #ff8C00);
	background-image:linear-gradient(top, #ff8C00, #ff8C00);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ff8C00, endColorstr=#ff8C00);
	color:#fff;
	text-shadow:0 1px 0 #cc7000;}';      		 
        break;
case 4: $tombol_button = 'a.tombol{background-color:#2e8b57;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#46d686), to(#2e8b57));
	background-image:-webkit-linear-gradient(top, #46d686, #2e8b57);
	background-image:-moz-linear-gradient(top, #46d686, #2e8b57);
	background-image:-ms-linear-gradient(top, #46d686, #2e8b57);
	background-image:-o-linear-gradient(top, #46d686, #2e8b57);
	background-image:linear-gradient(top, #46d686, #2e8b57);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#46d686, endColorstr=#2e8b57);	
	color:#fff;
	text-shadow:0 1px 0 #256f46;}
        a.tombol:hover{background-color:#2e8b57;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#2e8b57), to(#2e8b57));
	background-image:-webkit-linear-gradient(top, #2e8b57, #2e8b57);
	background-image:-moz-linear-gradient(top, #2e8b57, #2e8b57);
	background-image:-ms-linear-gradient(top, #2e8b57, #2e8b57);
	background-image:-o-linear-gradient(top, #2e8b57, #2e8b57);
	background-image:linear-gradient(top, #2e8b57, #2e8b57);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#2e8b57, endColorstr=#2e8b57);	
	color:#fff;
	text-shadow:0 1px 0 #256f46;}';      		 
        break;
case 5: $tombol_button = 'a.tombol{background-color:#9932cc;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#d481fd), to(#9932cc));
	background-image:-webkit-linear-gradient(top, #d481fd, #9932cc);
	background-image:-moz-linear-gradient(top, #d481fd, #9932cc);
	background-image:-ms-linear-gradient(top, #d481fd, #9932cc);
	background-image:-o-linear-gradient(top, #d481fd, #9932cc);
	background-image:linear-gradient(top, #d481fd, #9932cc);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#d481fd, endColorstr=#9932cc);
	color:#fff;
	text-shadow:0 1px 0 #7a28a3;}
a.tombol:hover{background-color:#9932cc;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#9932cc), to(#9932cc));
	background-image:-webkit-linear-gradient(top, #9932cc, #9932cc);
	background-image:-moz-linear-gradient(top, #9932cc, #9932cc);
	background-image:-ms-linear-gradient(top, #9932cc, #9932cc);
	background-image:-o-linear-gradient(top, #9932cc, #9932cc);
	background-image:linear-gradient(top, #9932cc, #9932cc);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#9932cc, endColorstr=#9932cc)
	color:#fff;
	text-shadow:0 1px 0 #7a28a3;}';      		 
        break;
case 6: $tombol_button = 'a.tombol{background-color:#ff69b4;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#fcb8da), to(#ff69b4));
	background-image:-webkit-linear-gradient(top, #fcb8da, #ff69b4);
	background-image:-moz-linear-gradient(top, #fcb8da, #ff69b4);
	background-image:-ms-linear-gradient(top, #fcb8da, #ff69b4);
	background-image:-o-linear-gradient(top, #fcb8da, #ff69b4);
	background-image:linear-gradient(top, #fcb8da, #ff69b4);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fcb8da, endColorstr=#ff69b4);
	color:#fff;
	text-shadow:0 1px 0 #cc5490;}
        a.tombol:hover{background-color:#ff69b4;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#ff69b4), to(#ff69b4));
	background-image:-webkit-linear-gradient(top, #ff69b4, #ff69b4);
	background-image:-moz-linear-gradient(top, #ff69b4, #ff69b4);
	background-image:-ms-linear-gradient(top, #ff69b4, #ff69b4);
	background-image:-o-linear-gradient(top, #ff69b4, #ff69b4);
	background-image:linear-gradient(top, #ff69b4, #ff69b4);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ff69b4, endColorstr=#ff69b4);
	color:#fff;
	text-shadow:0 1px 0 #cc5490;}';      		 
        break;
case 7: $tombol_button = 'a.tombol{background-color:#ff6347;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#fcad9f), to(#ff6347));
	background-image:-webkit-linear-gradient(top, #fcad9f, #ff6347);
	background-image:-moz-linear-gradient(top, #fcad9f, #ff6347);
	background-image:-ms-linear-gradient(top, #fcad9f, #ff6347);
	background-image:-o-linear-gradient(top, #fcad9f, #ff6347);
	background-image:linear-gradient(top, #fcad9f, #ff6347);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fcad9f, endColorstr=#ff6347);
	color:#fff;
	text-shadow:0 1px 0 #cc4f39;}
a.tombol:hover{background-color:#ff6347;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#ff6347), to(#ff6347));
	background-image:-webkit-linear-gradient(top, #ff6347, #ff6347);
	background-image:-moz-linear-gradient(top, #ff6347, #ff6347);
	background-image:-ms-linear-gradient(top, #ff6347, #ff6347);
	background-image:-o-linear-gradient(top, #ff6347, #ff6347);
	background-image:linear-gradient(top, #ff6347, #ff6347);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ff6347, endColorstr=#ff6347);
	color:#fff;
	text-shadow:0 1px 0 #cc4f39;}';     		 
        break;
case 8: $tombol_button = 'a.tombol{background-color:#daa520;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#fbd577), to(#daa520));
	background-image:-webkit-linear-gradient(top, #fbd577, #daa520);
	background-image:-moz-linear-gradient(top, #fbd577, #daa520);
	background-image:-ms-linear-gradient(top, #fbd577, #daa520);
	background-image:-o-linear-gradient(top, #fbd577, #daa520);
	background-image:linear-gradient(top, #fbd577, #daa520);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fbd577, endColorstr=#daa520);
	color:#fff;
	text-shadow:0 1px 0 #ae841a;}
        a.tombol:hover{background-color:#daa520;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#daa520), to(#daa520));
	background-image:-webkit-linear-gradient(top, #daa520, #daa520);
	background-image:-moz-linear-gradient(top, #daa520, #daa520);
	background-image:-ms-linear-gradient(top, #daa520, #daa520);
	background-image:-o-linear-gradient(top, #daa520, #daa520);
	background-image:linear-gradient(top, #daa520, #daa520);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#daa520, endColorstr=#daa520);
	color:#fff;
	text-shadow:0 1px 0 #ae841a;}';     		 
        break;
case 9: $tombol_button = 'a.tombol{background-color:#c0c0c0;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#fbf8f8), to(#c0c0c0));
	background-image:-webkit-linear-gradient(top, #fbf8f8, #c0c0c0);
	background-image:-moz-linear-gradient(top, #fbf8f8, #c0c0c0);
	background-image:-ms-linear-gradient(top, #fbf8f8, #c0c0c0);
	background-image:-o-linear-gradient(top, #fbf8f8, #c0c0c0);
	background-image:linear-gradient(top, #fbf8f8, #c0c0c0);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#fbf8f8, endColorstr=#c0c0c0);
	color:#111;      
        box-shadow:1px 2px 2px #999;
	text-shadow:0 1px 0 #fff;}
        a.tombol:hover{background-color:#c0c0c0;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#c0c0c0), to(#c0c0c0));
	background-image:-webkit-linear-gradient(top, #c0c0c0, #c0c0c0);
	background-image:-moz-linear-gradient(top, #c0c0c0, #c0c0c0);
	background-image:-ms-linear-gradient(top, #c0c0c0, #c0c0c0);
	background-image:-o-linear-gradient(top, #c0c0c0, #c0c0c0);
	background-image:linear-gradient(top, #c0c0c0, #c0c0c0);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#c0c0c0, endColorstr=#c0c0c0);
	color:#111;
	text-shadow:0 1px 0 #fff;}';     		 
        break;
case 10: $tombol_button = 'a.tombol{background-color:#696969;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#c0bfbf), to(#696969));
	background-image:-webkit-linear-gradient(top, #c0bfbf, #696969);
	background-image:-moz-linear-gradient(top, #c0bfbf, #696969);
	background-image:-ms-linear-gradient(top, #c0bfbf, #696969);
	background-image:-o-linear-gradient(top, #c0bfbf, #696969);
	background-image:linear-gradient(top, #c0bfbf, #696969);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#c0bfbf, endColorstr=#696969);
	color:#fff;
	text-shadow:0 1px 0 #111;}
        a.tombol:hover{background-color:#696969;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#696969), to(#696969));
	background-image:-webkit-linear-gradient(top, #696969, #696969);
	background-image:-moz-linear-gradient(top, #696969, #696969);
	background-image:-ms-linear-gradient(top, #696969, #696969);
	background-image:-o-linear-gradient(top, #696969, #696969);
	background-image:linear-gradient(top, #696969, #696969);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#696969, endColorstr=#696969);
	color:#fff;
	text-shadow:0 1px 0 #111;}';     		 
        break;
case 11: $tombol_button = 'a.tombol{background-color:#000000;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#515151), to(#000000));
	background-image:-webkit-linear-gradient(top, #515151, #000000);
	background-image:-moz-linear-gradient(top, #515151, #000000);
	background-image:-ms-linear-gradient(top, #515151, #000000);
	background-image:-o-linear-gradient(top, #515151, #000000);
	background-image:linear-gradient(top, #515151, #000000);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#515151, endColorstr=#000000);
	color:#fff;
	text-shadow:0 1px 0 #000000;}
        a.tombol:hover{background-color:#000000;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#191919), to(#000000));
	background-image:-webkit-linear-gradient(top, #191919, #000000);
	background-image:-moz-linear-gradient(top, #191919, #000000);
	background-image:-ms-linear-gradient(top, #191919, #000000);
	background-image:-o-linear-gradient(top, #191919, #000000);
	background-image:linear-gradient(top, #191919, #000000);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#191919, endColorstr=#000000);
	color:#fff;
	text-shadow:0 1px 0 #000000;}';     		 
        break;
case 12: $tombol_button = 'a.tombol{background-color:#8b4513;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#d3691d), to(#8b4513));
	background-image:-webkit-linear-gradient(top, #d3691d, #8b4513);
	background-image:-moz-linear-gradient(top, #d3691d, #8b4513);
	background-image:-ms-linear-gradient(top, #d3691d, #8b4513);
	background-image:-o-linear-gradient(top, #d3691d, #8b4513);
	background-image:linear-gradient(top, #d3691d, #8b4513);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#d3691d, endColorstr=#8b4513);
	color:#fff;
	text-shadow:0 1px 0 #6f370f;}
        a.tombol:hover{background-color:#8b4513;
	background-image:-webkit-gradient(linear, left top, left bottom, from(#8b4513), to(#8b4513));
	background-image:-webkit-linear-gradient(top, #8b4513, #8b4513);
	background-image:-moz-linear-gradient(top, #8b4513, #8b4513);
	background-image:-ms-linear-gradient(top, #8b4513, #8b4513);
	background-image:-o-linear-gradient(top, #8b4513, #8b4513);
	background-image:linear-gradient(top, #8b4513, #8b4513);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#8b4513, endColorstr=#8b4513);
	color:#fff;
	text-shadow:0 1px 0 #6f370f;}';     		 
        break;
}echo $tombol_button;} ?>
<?php echo $nusantara_options['nusantara_aditional_css']; ?>
<?php } ?>
</style>
<?php } ?>
<?php }
$nusantara_options = get_option('nusantara_options');    	
if (!empty($nusantara_options['nusantara_remove_logicale']) == '1'): 
add_action( 'wp_head', 'nusantara_custom_logical_element' );
endif;