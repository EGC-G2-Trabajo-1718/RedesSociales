<?php
/**
 * Timeline_Widget
 *
 * This widget implements the timeline for a user social network.
 *
 * @see WP_Widget
 */
class Timeline_Widget extends WP_Widget {
	const BASE_ID = 'timeline-egc';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Timeline by EGC',
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
		return 'This widget implements the timeline for a user social 
		network.';
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
		// Widget output
		
		
		
		
		//TWITTER
		$user = $instance['userTwitter'];	
		$theme = $instance['theme'];	
		$widthTwitter = $instance['widthTwitter'];	
		$heightTwitter = $instance['heightTwitter'];	
			if ($user!="")		
				echo '<a class="twitter-timeline"
						data-lang="en" 
						data-width="'.$widthTwitter.'" 
						data-height="'.$heightTwitter.'"
						data-theme="'.$theme.'" 	
						data-link-color="#19CF86"
						href="https://twitter.com/'.$user.'">
						Tweets by '.$user.'</a>
						</br>
						</br>';
						
		 			
						
						
		
		
		//FACEBOOK - EL USER AQUI ES LA PÁGINA QUE QUERAMOS VISUALIZAR
		$user = $instance['userFacebook'];	
		$anchoFacebook = $instance['anchoFacebook'];
		$alturaFacebook = $instance['alturaFacebook'];
			if ($user!="")
				echo '<div class="fb-page" data-href="https://www.facebook.com/'.$user.'" 
						data-tabs="timeline" data-small-header="true" 
						data-adapt-container-width="true"
						data-width="'.$anchoFacebook.'"
						data-height="'.$alturaFacebook.'"
						data-hide-cover="false" 
						data-show-facepile="false">
						<blockquote cite="https://www.facebook.com/'.$user.'"
						class="fb-xfbml-parse-ignore">
						<a href="https://www.facebook.com/'.$user.'"></a>
						</blockquote>
					</div>
					</br>
					</br>';
		
		
		//TWITTER HASTAG E ID DEL WIDGET CREADO POR EL USUARIO
		$hashtag = $instance['hashtag'];	
		$widgetId = $instance['widgetId'];
			if ($hashtag!="" && $widgetId!="")		
				echo '<a class="twitter-timeline"  href="
						https://twitter.com/hashtag/'.$hashtag.'" 
						data-widget-id="'.$widgetId.'">
						Tweets sobre '.$hashtag.'
					</a>
					
					
					<script>
						!function(d,s,id){
							var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";
								if(!d.getElementById(id)){
								js=d.createElement(s);
								js.id=id;
								js.src=p+"://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
								}
						}(document,"script","twitter-wjs");
					</script>
					</br>
					</br>';	
		            
                                
				
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
		$instance['hashtag'] = strip_tags($new_instance['hashtag']);
		$instance['widgetId'] = strip_tags($new_instance['widgetId']);
		$instance['alturaFacebook'] = static::checkHeight(strip_tags($new_instance['alturaFacebook']));
		$instance['anchoFacebook'] = static::checkWidth(strip_tags($new_instance['anchoFacebook']));
		$instance['heightTwitter'] = static::checkHeight(strip_tags($new_instance['heightTwitter']));
		$instance['widthTwitter'] = static::checkWidth(strip_tags($new_instance['widthTwitter']));
		$instance['theme'] = strip_tags($new_instance['theme']);

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
		// Output admin widget options form
		
		//Getting usernames
		$userTwitter = esc_attr($instance['userTwitter']);	
		$userFacebook = esc_attr($instance['userFacebook']);		
		$hashtag = esc_attr($instance['hashtag']);		
		$widgetId = esc_attr($instance['widgetId']);		
		$alturaFacebook = esc_attr($instance['alturaFacebook']);		
		$anchoFacebook = esc_attr($instance['anchoFacebook']);		
		$theme = esc_attr($instance['theme']);		
		$widthTwitter = esc_attr($instance['widthTwitter']);		
		$heightTwitter = esc_attr($instance['heightTwitter']);		
		
        ?>
			<br/><span id="info">Please, input the account whose 
			information will be shown in the timeline</span>
			<p>
			<!--ATRIBUTO PARA LA CUENTA DE TWITTER -->
			<h3>Twitter Timeline</h3>
				<label for="<?php echo $this->get_field_id('userTwitter'); 
				?>">
					<?php _e('Twitter account:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('userTwitter'); ?>" placeholder="TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" type="text"
					value="<?php echo $userTwitter; ?>" />
				</label>
				<!--ESTILO PARA EL WIDGET DE TWITTER -->
				<strong>Twitter timeline Style</strong>
				</br>
				<label for="<?php echo $this->get_field_id('widthTwitter'); ?>">
					<?php _e('Width:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('widthTwitter'); ?>" placeholder="Width (>= 100)" name="<?php echo $this->get_field_name('widthTwitter'); ?>" type="text"
					value="<?php echo $widthTwitter; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id('heightTwitter'); ?>">
					<?php _e('Height:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('heightTwitter'); ?>" placeholder="Height (>= 300)" name="<?php echo $this->get_field_name('heightTwitter'); ?>" type="text"
					value="<?php echo $heightTwitter; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id('theme'); ?>">
					<?php _e('Theme(dark/light):'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('theme'); ?>" placeholder="dark/light" name="<?php echo $this->get_field_name('theme'); ?>" type="text"
					value="<?php echo $theme; ?>" />
				</label>
			</p>
			
			<p>
			<!--ATRIBUTO PARA LA PAGINA DE FACEBOOK -->
			<h3>Facebook Timeline</h3>
				<label for="<?php echo $this->get_field_id('userFacebook'); ?>">
					<?php _e('Facebook page:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('userFacebook'); ?>" placeholder="Facebook page" name="<?php echo $this->get_field_name('userFacebook'); ?>" type="text"
					value="<?php echo $userFacebook; ?>" />
				</label>
				
				<!--ESTILO PARA EL WIDGET DE FACEBOOK -->
				<strong>Facebook timeline Style</strong>
				</br>
				<label for="<?php echo $this->get_field_id('anchoFacebook'); ?>">
					<?php _e('Width:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('anchoFacebook'); ?>" placeholder="Width (>= 100)" name="<?php echo $this->get_field_name('anchoFacebook'); ?>" type="text"
					value="<?php echo $anchoFacebook; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id('alturaFacebook'); ?>">
					<?php _e('Height:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('alturaFacebook'); ?>" placeholder="Height (>= 300)" name="<?php echo $this->get_field_name('alturaFacebook'); ?>" type="text"
					value="<?php echo $alturaFacebook; ?>" />
				</label>
				
			</p>
			
			<p>
			<h3>Hashtag Timeline</h3>
				<label for="<?php echo $this->get_field_id('hashtag'); ?>">
					<?php _e('Hashtag:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('hashtag'); ?>" placeholder="hashtag" name="<?php echo $this->get_field_name('hashtag'); ?>" type="text"
					value="<?php echo $hashtag; ?>" />
				</label>
				<span id="info">Please, create your widget in your twitter account and set the "data-widget ID" here.</span>
				</br>
				<label for="<?php echo $this->get_field_id('widgetId'); ?>">
					<?php _e('Your widget ID:'); ?> 
					<input class="widefat" id="<?php echo $this->
					get_field_id('widgetId'); ?>" placeholder="widgetId" name="<?php echo $this->get_field_name('widgetId'); ?>" type="text"
					value="<?php echo $widgetId; ?>" />
				</label>
			</p>
			
	<?php

    }

    /**
	 * Check if the height is correct. If not, it returns a default value
	 *
	 * @param integer $height
	 *
	 * @return integer $res The correct height
	 */
    public static function checkHeight($height) {
    	$res;

    	if(!is_numeric($height) || $height < 300){
    		$res = 300;
    	} else {
    		$res = intval($height);
    	}

    	return $res;
    }

    /**
	 * Check if the width is correct. If not, it returns a default value
	 *
	 * @param integer $width
	 *
	 * @return integer $res The correct width
	 */
    public static function checkWidth($width) {
    	$res;

    	if(!is_numeric($width) || $width < 100){
    		$res = 100;
    	} else {
    		$res = intval($width);
    	}

    	return $res;
    }
}
?>
