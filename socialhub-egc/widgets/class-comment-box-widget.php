<?php
/**
 * Comment_Box_Widget
 *
 * Box of comments that are made from the Facebook user.
 *
 * @see WP_Widget
 */
class Comment_Box_Widget extends WP_Widget {
	const BASE_ID = 'comment-box-egc';
	public $size;
	public $num;
	public $style;
	public $background;
	
	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Comment Box by EGC',
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
		return 'Box of comments that are made from the Facebook user.';
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
	
		//Getting configuration values
		$size = esc_attr($instance['size']);
		$num = esc_attr($instance['num']);
		$style = esc_attr($instance['style']);
		$background = esc_attr($instance['background']);
		
		// The strip_tags() function strips a string from HTML, XML, and PHP tags
		$size = strip_tags($size);
		$num = strip_tags($num);
		$style = strip_tags($style);
		$background = strip_tags($background);
		
		// Check the parameters
		$size = static::checkSize($size);
		$num = static::checkNum($num);
		$style = static::checkStyle($style);
		$background = static::checkBackground($background);
		
	?>
		<!-- This <styele> is not found in the .css to be edited to the consumer's liking -->
		<style>
			div.comment-box-background {
				background-color: <?php echo $background;?>;
			}
		</style>
		
		<div class="comment-box-background">
		
			<strong>BOX OF COMMENT</strong>
			<div id="comment-box-egc">
			<div class="fb-comments" data-href="<?php the_permalink(); ?>" 
				data-width="<?php echo $size;?>" 
				data-numposts="<?php echo $num;?>"
				data-colorscheme="<?php echo $style;?>"
				data-order-by="reverse_time"></div>
			</div>
			
		</div>
		
		<!-- Show total comments -->
		<span class="fb-comments-count" data-href="<?php the_permalink(); ?>"></span>
		total comments<br>
		
			
		<!-- Button to hide or show all comments -->
		<button id="hide-show">Hide/show comments</button>
	<?php
	}
	
	/**
	* Checks of parameters
	*
	* @return the corresponding attribute checked
	*/
	public static function checkSize($size){
		if( is_numeric($size) && $size > 0 )
			return $size;
		else{
			if( is_numeric(substr($size, 0, -1)) && substr($size, 0, -1) > 0 && substr($size, -1) == "%" )
				return $size;
			else
				return "100%";
		}
	}
	
	public static function checkNum($num){
		if( is_numeric($num) && $num > 0 )
			return $num;
		else
			return "5";
	}
	
	public static function checkStyle($style){
		if( $style=="light" or $style=="dark" )
			return $style;
		else
			return "light";
	}
	
	// If the parameter does not meet the format, an empty string is returned
	public static function checkBackground($background){
		if( $background!="" && $background[0] == "#" && strlen($background) == 7 ) {
			$cadena = "0123456789abcdef";
			for( $i=1; $i < strlen($background); $i++ ){
				if( strpos($cadena, $background[$i]) === false ){
					return ""; // The parameter is wrong, return empty string
					break;
				}
			}	
			return $background;
		}
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
		$instance['size'] = static::checkSize(strip_tags($new_instance['size']));
		$instance['num'] = static::checkNum(strip_tags($new_instance['num']));
		$instance['style'] = static::checkStyle(strip_tags($new_instance['style']));
		$instance['background'] = static::checkBackground(strip_tags($new_instance['background']));

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
		
		//Getting configuration values
		$size = esc_attr($instance['size']);
		$num = esc_attr($instance['num']);
		$style = esc_attr($instance['style']);
		$background = esc_attr($instance['background']);
		
		?> 
		
		<strong>Size</strong>
		<br/><span id="info">Enter the size of the widget (on pixel or %, default value = 100%):</span>
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php echo $size; ?>" />
			</label>
		</p>
		<strong>Num of comments</strong>
		<br/><span id="info">Enter the number of comments to show (default value = 5):</span>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $num; ?>" />
			</label>
		</p>
		<strong>Style</strong>
		<br/><span id="info">Enter the style light or dark (default value = light):</span>
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="text" value="<?php echo $style; ?>" />
			</label>
		</p>
		<strong>Background color</strong>
		<br/><span id="info">Enter the background color of the widget in hexadecimal format, example #fff000 (default background of the web):</span>
		<p>
			<label for="<?php echo $this->get_field_id('background'); ?>">
				<input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php echo $background; ?>" />
			</label>
		</p>
<?php
	}
	
	/**
	 * Add this script on footer to hide and show comments
	 *
	 * @return void
	 */
	public static function toFooter() {
	
		echo '<script>
			$(document).ready(function(){
				$("#hide-show").click(function(){
					$("#comment-box-egc").toggle();
				});
			});
		</script>';
	}
	
	/**
	* Getters of class attributes
	*
	* @return the corresponding attribute
	*/
	public function getSize() {
        return $this->size;
    }
	
	public function getNum() {
        return $this->num;
    }
	
	public function getStyle() {
        return $this->style;
    }
	
	public function getBackground() {
        return $this->background;
    }
	
	/**
	 * Prints scripts or data in the head tag on the front end
	 *
	 * @return void
	 */
	public static function wp_head() {
		// Adds a hook for a shortcode tag
		add_shortcode('comment-box-egc', array('Comment_Box_Widget', 'shortcode'));
	}
	
	/**
	 * Create a shortcode, that is, a tag that allows you to add 
	 * functionality to the content of a page or article.
	 *
	 * TO USE: copy this [comment-box-egc] on the page where you want,
	 * for it, go to the SPLC tab and then to the pages tab.
	 * 
	 * NOTE: This widget can't be customized (because it doesn't need a form to show it).
	 *
	 * @param array $atts User defined attributes in shortcode tag
	 *
	 * @return void
	 */
	public static function shortcode($atts) {
		$array = shortcode_atts(array(
				'size' => '',
				'num' => '',
				'style' => '',
				'background' => '',
			), $atts);
		$size = $array['size'];
		$num = $array['num'];
		$style = $array['style'];
		$background = $array['background'];
		
		// The strip_tags() function strips a string from HTML, XML, and PHP tags
		$size = strip_tags($size);
		$num = strip_tags($num);
		$style = strip_tags($style);
		$background = strip_tags($background);
		
		?>
		<!-- This <styele> is not found in the .css to be edited to the consumer's liking -->
		<style>
			div.comment-box-background {
				background-color: <?php if($background!="") echo $background;?>;
			}
		</style>
		
		<div class="comment-box-background">
		
			<strong>BOX OF COMMENT</strong>
			<div id="comment-box-egc">
			<div class="fb-comments" data-href="<?php the_permalink(); ?>" 
				data-width="<?php if($size!="" && is_numeric($num)) echo $size; else echo "100%" ?>" 
				data-numposts="<?php if($num!="" && is_numeric($num) && $num>0) echo $num; else echo "5" ?>"
				data-colorscheme="<?php if($style=="light" or $style=="dark") echo $style; else echo "light" ?>"
				data-order-by="reverse_time"></div>
			</div>
			
		</div>
		
		<!-- Show total comments -->
		<span class="fb-comments-count" data-href="<?php the_permalink(); ?>"></span>
		total comments<br>
		
			
		<!-- Button to hide or show all comments -->
		<button id="hide-show">Hide/show comments</button>
	<?php
	}
}

// Adds shortcode for comment box
add_action('wp_head', array('Comment_Box_Widget', 'wp_head'));

// Add this method on head
add_action('wp_footer', array('Comment_Box_Widget', 'toFooter'));
?>
