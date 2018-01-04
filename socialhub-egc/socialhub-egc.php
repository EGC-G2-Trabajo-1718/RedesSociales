<?php
/*  Copyright 2017 EGC (email: egc1718@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
* Plugin Name: SocialHub by EGC
* Plugin URI: https://github.com/EGC-G2-Trabajo-1718/RedesSociales
* Description: SocialHub is a plugin that has several features: share buttons, follow buttons, timeline widgets, comment box, etc. The available social networks are Twitter, Facebook, Instagram, LinkedIn, Google+ and Reddit.
* Version: 1.0.0
* Author: Daniel Martinez, Juan Huerta, Cristian Galan, Alberto Gomez, Luis M. Garcia and Carlos Ruano
* Author URI: https://1984.lsi.us.es/wiki-egc/index.php/Gesti%C3%B3n_de_integraci%C3%B3n_con_redes_sociales_-_17_18_-_G2
* License: GPL2
*/
defined('ABSPATH') or die ('Denied');
	
// Import widget classes
//include_once(dirname(__FILE__).'/widgets/class-follow-button-widget.php');
//include_once(dirname(__FILE__).'/widgets/class-share-button-widget.php');
//include_once(dirname(__FILE__).'/widgets/class-timeline-widget.php');
include_once(dirname(__FILE__).'/widgets/class-comment-box-widget.php');
//include_once(dirname(__FILE__).'/widgets/class-RSS-widget.php');
//include_once(dirname(__FILE__).'/widgets/class-message-button-widget.php');

// Fires after all default WordPress widgets have been registered
add_action('widgets_init', 'load_widgets_EGC');

function load_widgets_EGC() {
	//register_widget('Follow_Button_Widget');
	//register_widget('Share_Button_Widget');
	//register_widget('Timeline_Widget');
	register_widget('Comment_Box_Widget');
	//register_widget('RSS_Widget');
	//register_widget('Message_Button_Widget');
}

// Prints scripts before the closing body tag on the front end
add_action('wp_footer', 'include_API_EGC');

function include_API_EGC() {
    // Twitter
    $api = '<script>window.twttr = (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                    t = window.twttr || {};
                if (d.getElementById(id)) return t;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);

                t._e = [];
                t.ready = function(f) {
                    t._e.push(f);
                };

                return t;
            }(document, "script", "twitter-wjs"));</script>';
    // Facebook
    $api .= '<div id="fb-root"></div>
             <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11";
                fjs.parentNode.insertBefore(js, fjs);
             }(document, "script", "facebook-jssdk"));</script>';
    // LinkedIn
    $api .= '<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>';
    // Google+
    $api .= '<script src="https://apis.google.com/js/platform.js" async defer>
                {lang: "en"}
            </script>';

    echo $api;
}
?>