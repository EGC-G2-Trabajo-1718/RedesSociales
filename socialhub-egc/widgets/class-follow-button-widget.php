<?php 

/**
 * Follow_Button_Widget
 *
 * This widget implements the buttons to follow other users that share the same social network (By default the SPLC 17-18 account).
 *
 * @see WP_Widget
 */
class Follow_Button_Widget extends WP_Widget {
	const BASE_ID = 'follow-button-egc';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Follow Buttons by EGC',
							array('description' => static::getDescription()));
	}

	/**
	 * Get the base ID used to identify widgets of this type installed in a widget area
	 *
	 * @return string Widget base ID
	 */
	public static function getBaseID() {
		return static::BASE_ID;
	}

	/**
	 * Describe the functionality offered by the widget
	 *
	 * @return string Description of the widget functionality
	 */
	public static function getDescription() {
		return 'This widget implements the buttons to follow other users that share the same social network (By default the SPLC 17-18 account)';
	}

	/**
	 * Front-end display of widget
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and after_widget
	 * @param array $instance The settings for the particular instance of the widget
	 *
	 * @return void
	 */
	public function widget($args, $instance) {
		
		//Plugin imagepath
		$imagepath = plugins_url().'/socialhub-egc/widgets/img/';
		
		echo $before_widget;
		
		//The follow buttons
		if ($instance['background_color']!=""){
			echo '<div class="buttons" style="background-color:'.$instance['background_color'].'">';
		}else{
			echo '<div class="buttons" style="background-color:none">';
		}
		
		//TWITTER
		$user = getUsername($instance, 'twitter');		
		if ($user!="")
		echo '<div style="height:55px;" class="network" ><img src="'.$imagepath.'twitter.png" width=35% /><br/>
		<a lang="en" class="twitter-follow-button" href="https://twitter.com/'.$user.'?ref_src=twsrc%5Etfw" data-show-screen-name="false" data-size="large" data-show-count="false"></a></div>';
		
		//FACEBOOK
		$user = getUsername($instance, 'facebook');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'facebook.png" width=30% /><br/>
		<iframe src="https://www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2F'.$user.'&width=78&height=65&layout=button&size=large&show_faces=false&appId=800516066625151" width="78" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';
		
		//INSTAGRAM
		$user = getUsername($instance, 'instagram');
		if ($user!="")
		echo '<div class="network" id="instagram"><img src="'.$imagepath.'instagram.png" width=38% /><br/>
		<a href="https://www.instagram.com/'.$user.'/?hl=en" target="_blank"><img src="'.$imagepath.'instagram-connect.png" width="16%" /></a></div>';
		
		//LINKEDIN
		$user = getUsername($instance, 'linkedin');
		if ($user!="")
		echo '<div class="network" id="linkedin"><img src="'.$imagepath.'linkedin.png" width=30% /><br/>
		<a href="https://www.linkedin.com/in/'.$user.'" target="_blank"><img src="'.$imagepath.'linkedin-connect.png" width="15%" /></a></div>';
		
		//GOOGLEPLUS
		$user = getUsername($instance, 'googleplus');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'googleplus.png" width=30% /><br/>
		<div class="g-follow" data-annotation="bubble" data-height="24" data-href="https://plus.google.com/'.$user.'" data-rel="author"></div></div>';
		
		//REDDIT
		$user = getUsername($instance, 'reddit');
		if ($user!="")
		echo '<div class="network" ><img src="'.$imagepath.'reddit.png" width=30% /><br/>
		<a href="https://www.reddit.com/user/'.$user.'" target="_blank"><img src="'.$imagepath.'reddit-connect.png" width="25%" /></a></div>';

		echo '</div>';
		
		echo $after_widget;
	}

	/**
	 * Update a widget instance
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 *
	 * @return bool|array settings to save or false to cancel saving
	 */
	public function update($new_instance, $old_instance) {
		
		// Save widget options
		$instance = $old_instance;
		$instance['userTwitter'] = strip_tags($new_instance['userTwitter']);
		$instance['userFacebook'] = strip_tags($new_instance['userFacebook']);
		$instance['userInstagram'] = strip_tags($new_instance['userInstagram']);
		$instance['userLinkedin'] = strip_tags($new_instance['userLinkedin']);
		$instance['userGoogleplus'] = strip_tags($new_instance['userGoogleplus']);
		$instance['userReddit'] = strip_tags($new_instance['userReddit']);
		$instance = $new_instance;
		$instance['background_color'] = strip_tags($new_instance['background_color']);
		
		
		
		return $instance;
	}

	/**
	 * Settings update form
	 *
	 * @param array $instance Current settings
	 *
	 * @return void
	 */
	public function form($instance) {
		
		//Getting usernames
		$userTwitter = esc_attr($instance['userTwitter']);
		$userFacebook = esc_attr($instance['userFacebook']);
		$userInstagram = esc_attr($instance['userInstagram']);
		$userLinkedin = esc_attr($instance['userLinkedin']);
		$userGoogleplus = esc_attr($instance['userGoogleplus']);
		$userReddit = esc_attr($instance['userReddit']);
		
        ?>
			<br/><span id="info">Please, input the users to follow when click the several follow buttons</span>
			<p>
				<label for="<?php echo $this->get_field_id('userTwitter'); ?>">
					<?php _e('Twitter follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitter'); ?>" placeholder="@TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" type="text" value="<?php echo $userTwitter; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userFacebook'); ?>">
					<?php _e('Facebook follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userFacebook'); ?>" name="<?php echo $this->get_field_name('userFacebook'); ?>" type="text" value="<?php echo $userFacebook; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userInstagram'); ?>">
					<?php _e('Instagram follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userInstagram'); ?>" name="<?php echo $this->get_field_name('userInstagram'); ?>" type="text" value="<?php echo $userInstagram; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userLinkedin'); ?>">
					<?php _e('Linkedin follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userLinkedin'); ?>" name="<?php echo $this->get_field_name('userLinkedin'); ?>" type="text" value="<?php echo $userLinkedin; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userGoogleplus'); ?>">
					<?php _e('Google+ follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userGoogleplus'); ?>" placeholder="i.e. 106189723444098348646" name="<?php echo $this->get_field_name('userGoogleplus'); ?>" type="text" value="<?php echo $userGoogleplus; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('userReddit'); ?>">
					<?php _e('Reddit follow account:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userReddit'); ?>" name="<?php echo $this->get_field_name('userReddit'); ?>" type="text" value="<?php echo $userReddit; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Panel Color:'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" placeholder="i.e. lightgreen, lightblue, yellow, #eeeee, ..." name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />                            
			</p>
        <?php 
	}
}

//AUXILIARY METHODS

/* params: 
$instance: $instance
$socialnetwork: twitter, facebook, instagram, linkedin, googleplus, reddit (Choose one) */
function getUsername($instance, $socialnetwork){
	
	$network = ucfirst($socialnetwork);
	
	$user = apply_filters('widget_user'.$network, $instance['user'.$network]);
	
	if($socialnetwork=="twitter"){
		$user = str_replace("@", "", $user);
	}
	
	return $user;
	
}
?>
