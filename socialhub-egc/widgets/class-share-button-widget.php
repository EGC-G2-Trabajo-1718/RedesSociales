<?php
/**
 * Share_Button_Widget
 *
 * Create buttons for sharing content on social networks.
 *
 * @see WP_Widget
 */
class Share_Button_Widget extends WP_Widget {
	const BASE_ID = 'share-button-egc';

	/**
	 * Register widget with WordPress
	 *
	 */
	public function __construct() {
		// Instantiate the parent object
		parent::__construct(static::getBaseID(),
							'Share button by EGC',
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
		return 'Create buttons for sharing content on social networks.';
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
		$currentUrl = static::getCurrentUrl();
		$tweetText = esc_attr($instance['tweetText']);
		$hashtags = esc_attr($instance['hashtags']);
		$tweetParameters = static::getTweetParameters($tweetText, $hashtags);
		$telegramText = esc_attr($instance['telegramText']);

		$html = '<div class="egc-title"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</div>';
		$html .= '<div class="egc-flex-container">';
		// Twitter
		$html .= '<div><a class="twitter-share-button" href="https://twitter.com/intent/tweet'.$tweetParameters.'" data-size="large">Tweet</a></div>';
		// Facebook
		$html .= '<div class="fb-share-button" data-href="'.$currentUrl.'" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($currentUrl).'&amp;src=sdkpreparse">Share</a></div>';
		// LinkedIn
		$html .= '<div><script type="IN/Share"></script></div>';
		// Google+
		$html .= '<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>';
		// Reddit
		$html .= '<div><a href="//www.reddit.com/submit" onclick="window.location = '."'//www.reddit.com/submit?url='".' + encodeURIComponent(window.location); return false"> <img src="//www.redditstatic.com/spreddit10.gif" alt="submit to reddit" border="0" /> </a></div>';
		// Telegram
		$html .= '<div><a class="telegram-share-button" href="https://t.me/share/url?url='.urlencode($currentUrl).'&text='.$telegramText.'"><i class="fa fa-telegram" aria-hidden="true"></i>&nbsp; Telegram</a></div>';
		$html .= '</div>';

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
		// Strips a string from HTML, XML, and PHP tags
		$instance['tweetText'] = trim(strip_tags($new_instance['tweetText']));
		$instance['hashtags'] = '';
		$instance['telegramText'] = trim(strip_tags($new_instance['telegramText']));

		$hashtags = trim(strip_tags($new_instance['hashtags']));
		$arrayHashtags = explode(',', $hashtags);

		if(count($arrayHashtags) > 0) {
			foreach ($arrayHashtags as $hashtag) {
				$hashtag = trim($hashtag);
				if(!empty($hashtag)) {
					$instance['hashtags'] .= $hashtag.',';
				}
			}
			if(!empty($instance['hashtags'])) {
				$instance['hashtags'] = substr($instance['hashtags'], 0, strlen($instance['hashtags'])-1);
			}
		}

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
		$tweetText = $instance['tweetText'];
		$hashtags = $instance['hashtags'];
		$telegramText = $instance['telegramText'];

		// Twitter settings
		$html = '<p>Twitter settings:</p>';
		$html .= '<p>';
		$html .= '<label for="'.$this->get_field_id('tweetText').'">Type the tweet text:</label>';
		$html .= '<input class="widefat" id="'.$this->get_field_id('tweetText').'" name="'.$this->get_field_name('tweetText').'" type="text" value="'.$tweetText.'"/>';
		$html .= '</p>';
		$html .= '<p>';
		$html .= '<label for="'.$this->get_field_id('hashtags').'">Type each hashtag separated by a comma:</label>';
		$html .= '<input class="widefat" id="'.$this->get_field_id('hashtags').'" placeholder="hashtag1,hashtag2,hashtag3" name="'.$this->get_field_name('hashtags').'" type="text" value="'.$hashtags.'"/>';
		$html .= '</p>';
		// Telegram settings
		$html .= '<p>Telegram settings:</p>';
		$html .= '<p>';
		$html .= '<label for="'.$this->get_field_id('telegramText').'">Type the Telegram text:</label>';
		$html .= '<input class="widefat" id="'.$this->get_field_id('telegramText').'" name="'.$this->get_field_name('telegramText').'" type="text" value="'.$telegramText.'"/>';
		$html .= '</p>';

		echo $html;
	}

	/**
	 * Get the current url with PHP
	 *
	 * @return string Current url
	 */
	public static function getCurrentUrl() {
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}

	/**
	 * Get the URL parameters for tweet button
	 *
	 * @param string $tweetText The text of tweet
	 * @param string $hashtags The hashtags of tweet
	 *
	 * @return string URL parameters like a string
	 */
	public static function getTweetParameters($tweetText, $hashtags) {
		$tweetParameters = '';

		if(!empty($tweetText)) {
			// The function urlencode is convenient when encoding a string to be used in a query part of a URL
			$tweetParameters = '?text='.urlencode($tweetText);
		}

		if(!empty($hashtags)) {
			if(empty($tweetParameters)) {
				$tweetParameters = '?hashtags='.urlencode($hashtags);
			} else {
				$tweetParameters .= '&hashtags='.urlencode($hashtags);
			}
		}

		return $tweetParameters;
	}

	/**
	 * Prints scripts or data in the head tag on the front end
	 *
	 * @return void
	 */
	public static function wp_head() {
		// Adds a hook for a shortcode tag
		add_shortcode('share-button-egc', array('Share_Button_Widget', 'shortcode'));
	}

	/**
	 * Create a shortcode, that is, a tag that allows you to add 
	 * functionality to the content of a page or article.
	 *
	 * @param array $atts User defined attributes in shortcode tag
	 *
	 * @return void
	 */
	public static function shortcode($atts) {
		$a = shortcode_atts(array(
				'tweetText' => 'Visit',
				'hashtags' => '',
			), $atts);
		$currentUrl = static::getCurrentUrl();
		$tweetText = $a['tweetText'];
		$hashtags = $a['hashtags'];
		$tweetParameters = static::getTweetParameters($tweetText, $hashtags);

		$html = '<div class="egc-title"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</div>';
		$html .= '<div class="egc-flex-container">';
		// Twitter
		$html .= '<div><a class="twitter-share-button" href="https://twitter.com/intent/tweet'.$tweetParameters.'" data-size="large">Tweet</a></div>';
		// Facebook
		$html .= '<div class="fb-share-button" data-href="'.$currentUrl.'" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($currentUrl).'&amp;src=sdkpreparse">Share</a></div>';
		// LinkedIn
		$html .= '<div><script type="IN/Share"></script></div>';
		// Google+
		$html .= '<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>';
		// Reddit
		$html .= '<div><a href="//www.reddit.com/submit" onclick="window.location = '."'//www.reddit.com/submit?url='".' + encodeURIComponent(window.location); return false"> <img src="//www.redditstatic.com/spreddit10.gif" alt="submit to reddit" border="0" /> </a></div>';
		// Telegram
		$html .= '<div><a class="telegram-share-button" href="https://t.me/share/url?url='.urlencode($currentUrl).'&text='.$telegramText.'"><i class="fa fa-telegram" aria-hidden="true"></i>&nbsp; Telegram</a></div>';
		$html .= '</div>';

		echo $html;
	}
}

// Adds shortcode for share buttons
add_action('wp_head', array('Share_Button_Widget', 'wp_head'));
?>