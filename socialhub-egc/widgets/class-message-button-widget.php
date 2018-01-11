<?php
/**
 * Message_Button_Widget
 *
 * A buttom to send a direct message, by Twitter, to a predefined profile.
 *
 * @see WP_Widget
 */
class Message_Button_Widget extends WP_Widget {
	
	const BASE_ID = 'message-button-widget';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Message Button Widget by EGC',
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
		
		return 'A buttom to send a direct message, by Twitter, to a predefined profile. And a buttom to 
		call, by Hangouts, a predefined profile';
		
	}

	/**
	 * Front-end display of widget
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and 
	 after_widget
	 * @param array $instance The settings for the particular instance of the widget
	 *
	 * @return void
	 */
	public function widget($args, $instance) {
	
		//Cuenta de usuario de Twitter
		$userTwitter = esc_attr($instance['userTwitter']);	
		//ID de usuario de Twitter
		$userTwitterID = esc_attr($instance['userTwitterID']);
		//Mensaje que vamos a mandar de manera predefinida
		$message = esc_attr($instance['message']);
		//Cuenta de Google
		$usuarioHangout = esc_attr($instance['usuarioHangout']);
		
		
		$userTwitterFormateado = static::getUserTwitterFormateado($instance,$userTwitter);
		$messageFormateado = static::getMessageFormateado($instance,$message);
		$usuarioHangoutFormateado = static::getUserHangoutFormateado($instance,$usuarioHangout);
		
		if ($userTwitterFormateado!=""){
			
			$html .='<aside id="text-message-button-widget" class="widget widget_text">
						<h4 class="widget-title">
							Contact us by Twitter here
						</h4>	
					</aside>
					
					<div>
					
						<a lang="en" class="twitter-dm-button"  href="
						https://twitter.com/messages/compose?recipient_id='.$userTwitterID.'&text='.
						$messageFormateado.'" data-screen-name="'.$userTwitterFormateado.'" 
						data-show-screen-name="false" data-size="large" data-show-count="false">
							Message '.userTwitterFormateado.'
						</a>
						
					<div>';
		}
		
		if ($usuarioHangoutFormateado!=""){
			
			$html .='<aside id="text-message-button-widget" class="widget widget_text">
						<h4 class="widget-title">
							Contact us by Hangouts here
						</h4>
					</aside>
					
					<div>
					
						<script src="https://apis.google.com/js/platform.js" async defer>
						</script>
						<g:hangout render="createhangout" invites="[ { id : "'
						.$usuarioHangoutFormateado.'", invite_type : "EMAIL" }]">
						</g:hangout>
							
					</div>';
					
		}	
		
		echo $html;
		
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
		$instance['userTwitterID'] = strip_tags($new_instance['userTwitterID']);
		$instance['message'] = strip_tags($new_instance['message']);
		$instance['usuarioHangout'] = strip_tags($new_instance['usuarioHangout']);

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
		
		$userTwitter = esc_attr($instance['userTwitter']);
		$userTwitterID = esc_attr($instance['userTwitterID']);
		$message = esc_attr($instance['message']);
		$usuarioHangout = esc_attr($instance['usuarioHangout']);
		
		?>
		
		<br/>
		<span id="info">Please, input the user who will receive de message. Remember the account that
		you will be used, should have permissions to receive message from unknown people. 
		</span>
		
			<p>
			
				<label for="<?php echo $this->get_field_id('userTwitter'); ?>">
					<?php _e('Twitter account to send direct message:'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitter'); ?>" 
					placeholder="TwitterUser" name="<?php echo $this->get_field_name('userTwitter'); ?>" 
					type="text" value="<?php echo $userTwitter; ?>" 
					/>
				</label>
				
			</p>
			
			<p>
			
				<label for="<?php echo $this->get_field_id('userTwitterID'); ?>">
					<?php _e('Twitter ID account to send direct message, to find the id, logged into the 
					account you must navigate: Settings, Your data, and there is the id.'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('userTwitterID'); ?>" 
					placeholder="userTwitterID like (942047040904859653)" name="<?php echo $this->
					get_field_name('userTwitterID'); ?>" type="text" value="<?php echo $userTwitterID; ?>" 
					/>
				</label>
				
			</p>
			<p>
			
				<label for="<?php echo $this->get_field_id('message'); ?>">
					<?php _e('Predefined message that you send to the previous account'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" 
					placeholder="Message" name="<?php echo $this->
					get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" 
					/>
				</label>
				
			</p>
			<p>
			
				<label for="<?php echo $this->get_field_id('usuarioHangout'); ?>">
					<?php _e('Hangout account'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('usuarioHangout'); ?>" 
					placeholder="Hangouts account" name="<?php echo $this->
					get_field_name('usuarioHangout');?>" type="text" value="<?php echo $usuarioHangout; ?>" 
					/>
				</label>
				
			</p>
			
		<?php

	}
	
	/*
	Metodo utlizado para proporcionar un formato correcto al mensaje predefinido a mandar por mensajeria 
	directa de Twitter
	Parametros de entrada: 
	$instance: $instance
	$message: una cadena de caracteres cualquiera 
	*/
	public static function getMessageFormateado($instance, $message){
	
		$messageFormateado = str_replace(" ","%20",$message);
	
		return $messageFormateado;
	
	}
	
	/*
	Metodo utlizado para proporcionar un formato correcto a la cuenta de Twitter que se va a utilizar para 
	contactar mediante Twitter
	Parametros de entrada: 
	$instance: $instance
	$userTwitter: una cadena de caracteres cualquiera 
	*/
	public static function getUserTwitterFormateado($instance, $userTwitter){
	
		if ($userTwitter!=""){
			
			$userTwitterFormateado = "@" . $userTwitter;
		
		}
	
		return $userTwitterFormateado;
	
	}
	
	/*
	Metodo utlizado para proporcionar un formato correcto a la cuenta de google que se va a utilizar para 
	contactar mediante hangouts
	Parametros de entrada: 
	$instance: $instance
	$userTwitter: una cadena de caracteres cualquiera 
	*/
	public static function getUserHangoutFormateado($instance, $usuarioHangout){
	
		if ($usuarioHangout!=""){
			
			$usuarioHangoutFormateado = $usuarioHangout . "@gmail.com";
	
		}
		
		return $usuarioHangoutFormateado;
	
	}
	
}
?>