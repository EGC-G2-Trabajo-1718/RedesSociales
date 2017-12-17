<?php
/*
Plugin Name: Social Network Buttons
Description: Botones para interactuar con las diferentes redes sociales de la Web: Twitter, Facebook, Instagram, Linkedin, Google+. Para configurar el plugin, basta con activarlo, proporcionar un título para la entrada (si queremos personalizarlo) y un usuario por cada red social que queramos usar (las redes sociales de las que se deje el usuario en blanco, no aparecerán en la web).
Version: 1.0.0
Author: Daniel Jesús Martínez Suárez
*/

add_action('wp_print_styles', 'bts_style');
add_action('widgets_init', create_function('', 'return register_widget("SocialNetwork");'));

function bts_style() {
	$myStyleUrl  = plugin_dir_url (__FILE__).'style.css';
	$myStyleFile = plugin_dir_path(__FILE__).'style.css';
	if ( file_exists($myStyleFile) ) {
	    wp_register_style('buttons_style', $myStyleUrl);
	    wp_enqueue_style ('buttons_style');
	}
}

class SocialNetwork extends WP_Widget {
    /** constructor */
    function __construct() {
         parent::__construct(
		 // widget ID
		 'SocialWidget',
		 // widget name
		 __('Social Network Buttons', 'social_widget_domain')
		 );
    }

    function widget($args, $instance) {		
	
		$permalink = get_permalink($post->ID);
		$ttl = get_the_title($ID);
		$imagepath = plugins_url().'/wp-social-network/img/';
		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		
        echo $before_widget;
        if ( $title )
			echo "<span style='font-weight:800;text-transform:uppercase;letter-spacing: 0.1818em;color: #222;font-size: 0.6875rem;'>".$before_title.$title.$after_title."</span>";
		else
			echo "<span style='font-weight:800;text-transform:uppercase;letter-spacing: 0.1818em;color: #222;font-size: 0.6875rem;'>Social Networks</span>";
		echo '
		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
		<div class="buttons" style="">';
		
		//TWITTER
		$user = getUsername($instance, 'twitter');		
		if ($user!="")
		echo '<div style="height:55px;" class="network" ><img src="'.$imagepath.'twitter.png" width=35% /><br/>
		<a lang="en" class="twitter-follow-button" href="https://twitter.com/'.$user.'?ref_src=twsrc%5Etfw" data-show-screen-name="false" data-size="large" data-show-count="false"></a>
		<a lang="en" class="twitter-share-button" href="https://twitter.com/share" data-url="'.$permalink.'" data-size="large" data-text="'.$ttl.'" data-hashtags="splc,splc2017" data-via="'.$user.'"></a></div>';
		
		//FACEBOOK
		$user = getUsername($instance, 'facebook');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'facebook.png" width=30% /><br/>
		<input style="padding:0.75em 2em;" type="button" value="Like" />
		<input style="padding:0.75em 2em;" type="button" value="Share" /></div>';
		
		//INSTAGRAM
		$user = getUsername($instance, 'instagram');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'instagram.png" width=38% /><br/>
		<input style="padding:0.75em 2em;" type="button" value="Like" />
		<input style="padding:0.75em 2em;" type="button" value="Share" /></div>';
		
		//LINKEDIN
		$user = getUsername($instance, 'linkedin');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'linkedin.png" width=30% /><br/>
		<input style="padding:0.75em 2em;" type="button" value="Like" />
		<input style="padding:0.75em 2em;" type="button" value="Share" /></div>';
		
		//GOOGLEPLUS
		$user = getUsername($instance, 'googleplus');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'googleplus.png" width=30% /><br/>
		<input style="padding:0.75em 2em;" type="button" value="Like" />
		<input style="padding:0.75em 2em;" type="button" value="Share" /></div>';
		
		echo '</div>';
        echo $after_widget;
		
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['userTwitter'] = strip_tags($new_instance['userTwitter']);
		$instance['userFacebook'] = strip_tags($new_instance['userFacebook']);
		$instance['userInstagram'] = strip_tags($new_instance['userInstagram']);
		$instance['userLinkedin'] = strip_tags($new_instance['userLinkedin']);
		$instance['userGoogleplus'] = strip_tags($new_instance['userGoogleplus']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
		$userTwitter = esc_attr($instance['userTwitter']);
		$userFacebook = esc_attr($instance['userFacebook']);
		$userInstagram = esc_attr($instance['userInstagram']);
		$userLinkedin = esc_attr($instance['userLinkedin']);
		$userGoogleplus = esc_attr($instance['userGoogleplus']);
		
        ?>
            <p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php _e('Title:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userTwitter'); ?>">
					<?php _e('Twitter user:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitter'); ?>" placeholder="@TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" type="text" value="<?php echo $userTwitter; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userFacebook'); ?>">
					<?php _e('Facebook user:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userFacebook'); ?>" name="<?php echo $this->get_field_name('userFacebook'); ?>" type="text" value="<?php echo $userFacebook; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userInstagram'); ?>">
					<?php _e('Instagram user:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userInstagram'); ?>" name="<?php echo $this->get_field_name('userInstagram'); ?>" type="text" value="<?php echo $userInstagram; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userLinkedin'); ?>">
					<?php _e('Linkedin user:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userLinkedin'); ?>" name="<?php echo $this->get_field_name('userLinkedin'); ?>" type="text" value="<?php echo $userLinkedin; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userGoogleplus'); ?>">
					<?php _e('Google+ user:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userGoogleplus'); ?>" name="<?php echo $this->get_field_name('userGoogleplus'); ?>" type="text" value="<?php echo $userGoogleplus; ?>" />
				</label>
			</p>
        <?php 
    }

}
//AUXILIARY METHODS

/* params: 
$instance: $instance
$socialnetwork: twitter, facebook, instagram, linkedin, googleplus (Choose one) */
function getUsername($instance, $socialnetwork){
	
	$network = ucfirst($socialnetwork);
	
	$user = apply_filters('widget_user'.$network, $instance['user'.$network]);
	
	if($socialnetwork=="twitter"){
		$user = str_replace("@", "", $user);
	}
	
	return $user;
	
}

	
?>