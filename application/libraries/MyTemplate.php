<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of DuetCS
 *
 * @author Application & project development group of DUETCS. This class is for designing template.
 * 
 */
class MyTemplate{
    function MetaTag(){
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'DUET computer society'),
            array('name' => 'keywords', 'content' => 'DUET computer society,duet cs,DUET,computer society'),
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'keywords', 'content' => 'DUET computer society,DUET,computer society', 'type' => 'equiv')
        );
        $metaTag = meta($meta);
        return($metaTag);
    }
    function Head(){
        $head  = link_tag('images/duetcs.ico', 'icon', 'image/x-ico');
        $head .= link_tag('images/duetcs.ico', 'shortcut icon', 'image/x-ico');
        $head .= link_tag('css/960_24_col.css');
        $head .= link_tag('css/reset.css');
        $head .= link_tag('css/normalize.css');
        $head .= link_tag('css/styles.css');
        $head .= link_tag('css/jquery.treeview.css'); //Archive
        $head .= link_tag('css/menu.css'); //menu
        $head .= link_tag('css/jquery-ui.css');
        $head .= '<script type="text/javascript" src='.base_url("script/jquery-1.7.1.min.js").'></script>';
        $head .= '<script type="text/javascript" src='.base_url("script/jquery_cookie.js").'></script>';//Archive
        $head .= '<script type="text/javascript" src='.base_url("script/jquery.treeview.js").'></script>'; //Archive
        $head .= '<script type="text/javascript" src='.base_url("script/jquery-ui.min.js").'></script>';
        return($head);
    }
    function Archive(){
        
        return($archive);
    }
    
    function Header(){
        $header = '<div class="headTop">';
        
        $DUET_image_properties = array(
            'src'   => 'images/duet.gif',
            'alt'   => 'DUET logo not found',
            'border'=> 0,
            'height' => '90'
        );
        $CS_image_properties = array(
            'src'   => 'images/cs.png',
            'alt'   => 'Computer Society logo not found',
            'border'=> 0,
            'height' => '90'
        );
        $header .= '<div class="grid_4 duetLogo">'.img($DUET_image_properties).'</div>';
        $header .= '<div class="grid_16 title">DUET Computer Society</div>';
        $header .= '<div class="grid_4 cslogo">'.img($CS_image_properties).'</div>';
        $header .= '</div>'; //End of headTop
        return($header);
    }
    
    function Footer(){
        $footer = '<div>Copyright © 2011-2012 All Rights Reserved by DUETCS</div>';
        $footer .= '<p>';
        $footer .= anchor('http://www.duet.ac.bd/', 'DUET', array('target' => '_blank'));
        $footer .= ' | ';
        $footer .= anchor('groups/developers', 'Developers');
        $footer .= '</p>';
        return($footer);
    }
}
