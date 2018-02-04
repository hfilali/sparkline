<?php

/**********************************************************
## Twitter feed which uses twitteroauth for authentication
##	 * 
##	 * @version	1.0
##	
## 
##	
***********************************************************/

date_default_timezone_set('Europe/London');
	
	// Require TwitterOAuth files. (Downloadable from : https://github.com/abraham/twitteroauth)
	require_once("twitteroauth/twitteroauth/twitteroauth.php");
		
	// Function to authenticate app with Twitter.
	
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	
	// Function to display the latest tweets.
	function display_latest_tweets(
		
		// Function parameters.
		$twitter_user_id,
		$tweets_to_display   = 5,               // Number of tweets you would like to display. (Default : 5)
		$ignore_replies      = false,           // Ignore replies from the timeline. (Default : false)
		$include_rts         = false,           // Include retweets. (Default : false)
		$twitter_wrap_open   = '<ul class="home-tweets-ul">',
		$twitter_wrap_close  = '</ul>',
		$tweet_wrap_open     = '<li><span class="icon-twitter"></span><div class="tweet_box home-tweet-tweet">',
		/*$meta_wrap_open      = '<br/><span class="home-tweet-date">',
		$meta_wrap_close     = '</span>', */
		$tweet_wrap_close    = '</div></li>',
		$date_format         = 'g:i A M jS',    // Date formatting. (http://php.net/manual/en/function.date.php)
		$twitter_style_dates = true){           // Twitter style days. [about an hour ago] (Default : true)
			
		// Twitter keys (You'lll need to visit https://dev.twitter.com and register to get these.
		$consumerkey         = "TDXbOOHOpRINABTLkbIgg";
		$consumersecret      = "4jRXjc8tE5cYK91l60CaHnGsvYP6AegXPGo8gMU4";
		$accesstoken         = "1488188462-4mfUA4kbt5YLOT4ClvnKsP1Z4ZsPvubSk6qwz52";
		$accesstokensecret   = "dzBVAKR2heFHMMgxYUBUO1hfimHP8ALX7JKXezNU4Q";
		
		
		
		// Cache file not found, or old. Authenticae app.
		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		
			if($connection){
				// Get the latest tweets from Twitter
 				$get_tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_user_id."&count=".$tweets_to_display."&include_rts=".$include_rts);
				
				// Error check: Make sure there is at least one item.
				if (count($get_tweets)) {
 					
					// Define tweet_count as zero
					$tweet_count = 0;
 
					// Start output buffering.
					ob_start();
 
					// Open the twitter wrapping element.
					$twitter_html = $twitter_wrap_open;
					$tweet_array[]=array();
					// Iterate over tweets.
					foreach($get_tweets as $tweet) {
						
						// If we are not ignoring replies, or tweet is not a reply, process it.
						if ($ignore_replies==false){
 
							$tweet_found = true;
							$tweet_count++;
 							$tweet_desc = $tweet->text;
							// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
							$tweet_desc = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1" target="_blank">$1</a>',$tweet_desc);
							$tweet_desc = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2" target="_blank">@$2</a>', $tweet_desc);
							$tweet_desc = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2" target="_blank">#$2</a>', $tweet_desc);
 
 							// Convert Tweet display time to a UNIX timestamp. Twitter timestamps are in UTC/GMT time.
							
							$tweet_time = strtotime($tweet->created_at);	
 							if ($twitter_style_dates){
								// Current UNIX timestamp.
								$current_time = time();
								$time_diff = abs($current_time - $tweet_time);
								switch ($time_diff){
									case ($time_diff < 60):
										$display_time = $time_diff.' seconds ago';                  
										break;      
									case ($time_diff >= 60 && $time_diff < 3600):
										$min = floor($time_diff/60);
										$display_time = $min.' minutes ago';                  
										break;      
									case ($time_diff >= 3600 && $time_diff < 86400):
										$hour = floor($time_diff/3600);
										$display_time = 'about '.$hour.' hour';
										if ($hour > 1){ $display_time .= 's'; }
										$display_time .= ' ago';
										break;          
									default:
										$display_time = date($date_format,$tweet_time);
										break;
								}
 							} else {
 								$display_time = date($date_format,$tweet_time);
 							}
							
							$tweet_array[]= array(
								'time' =>  $display_time,
								'tweet_desc' =>  $tweet_desc
							);
						//	$tweet_array['time']=  $display_time;
						//	$tweet_array['tweet_desc']=  $tweet_desc;
							
							// Render the tweet.
							$twitter_html .= $tweet_wrap_open.html_entity_decode($tweet_desc).$meta_wrap_open.'<a href="http://twitter.com/'.$twitter_user_id.'"></a>'.$meta_wrap_close.$tweet_wrap_close;
 
						}
 
						// If we have processed enough tweets, stop.
						if ($tweet_count >= $tweets_to_display){
							break;
						}
 
					}
 
					// Close the twitter wrapping element.
					$twitter_html .= '<div class="follow_btn"> <a class="button twitter_follow_btn" target="_blank" href="http://twitter.com/'.$twitter_user_id.'">Follow @'.$twitter_user_id.'</a></div>'.$twitter_wrap_close;
					
					return $twitter_html;
				}
				
			}
			
		
		
	}
	
	function json_readable_encode($in, $indent = 0, $from_array = false){
		$_myself = __FUNCTION__;
		$_escape = function ($str){
			return preg_replace("!([\b\t\n\r\f\"\\'])!", "\\\\\\1", $str);
		};

    $out = '';

    foreach ($in as $key=>$value){
        $out .= str_repeat("\t", $indent + 1);
        $out .= "\"".$_escape((string)$key)."\": ";

        if (is_object($value) || is_array($value)){
            $out .= "\n";
            $out .= $_myself($value, $indent + 1);
        }
        elseif (is_bool($value)){
            $out .= $value ? 'true' : 'false';
        }
        elseif (is_null($value)){
            $out .= 'null';
        }
        elseif (is_string($value)){
            $out .= "\"" . $_escape($value) ."\"";
        }
        else {
            $out .= $value;
        }

        $out .= ",\n";
    }

    if (!empty($out)) {
        $out = substr($out, 0, -2);
    }

    $out = str_repeat("\t", $indent) . "{\n" . $out;
    $out .= "\n" . str_repeat("\t", $indent) . "}";

    return $out;
}
	
	// Display latest tweets. (Modify username to your Twitter handle)
	if($_POST['user']) {
		echo display_latest_tweets($_POST['user'], 2);
	}else{
		echo "User Unavailable";
	}
?>