<?php
class Twitter_Tags extends TagManager
{
    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     */
    public static $tag_definitions = array
    (
        // <ion:twitter:tweets /> calls the method tag_tweets
        "twitter:tweets" =>      "tag_tweets",
        "twitter:tweets:tweet" =>    "tag_tweet"
    );
 
 
    /**
     * Base module tag
     * The index function of this class refers to the <ion:#module_name /> tag
     * In other words, this function makes the <ion:#module_name /> tag
     * available as main module parent tag for all other tags defined
     * in this class.
     *
     * @usage  <ion:twitter >
     *      ...
     *    </ion:twitter>
     *
     */
    public static function index(FTL_Binding $tag)
    {
        $str = $tag->expand();
        return $str;
    }
 
 
    /**
     * Loops through tweets
     *
     * @param FTL_Binding $tag
     * @return string
     *
     * @usage  <ion:twitter:tweets max="#num" >
     *        ...
     *    </ion:twitter:tweets>
     *
     */
    public static function tag_tweets(FTL_Binding $tag)
    {
        // Model load
        self::load_model('twitter_tweets_model', 'tweets_model');
        self::load_model('twitter_user_model', 'twitter_user_model');

        $users =  self::$ci->twitter_user_model->get_list();
        foreach ($users as $user){
            /* De la bdd obtenemos el "ultima_actualizacion*/
            $lastupdate = $user['lastupdate'];
            /*No last update*/
            $needs_update = false;
            if ($lastupdate != null){
                /*Calculamos el delta de actualizacion*/
                $timedifference = time() - $lastupdate;
                $max_time_difference = $user['max_time_difference'];
                /* Si ambas difieren por mas de el valor de "actualización" */
                if ($timedifference > $max_time_difference){
                    $needs_update = true;
                }
            }else{
                $needs_update = true;
            }

            if ($needs_update){
                /*Curl is -REQUIRED- by twitteroauth*/
                require_once('twitteroauth-master/twitteroauth/twitteroauth.php');

                /* Get user access tokens out of the session. */
                $access_token = $user['accesstoken'];
                $access_token_secret = $user['accesstokensecret'];
                $consumer_key = $user['consumerkey'];
                $consumer_secret = $user['consumersecret'];

                /* Create a TwitterOauth object with consumer/user tokens. */
                $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

                /* If method is set change API call made. */
                $content = $connection->get('statuses/user_timeline');

                /*save tweets in model*/
                self::$ci->twitter_user_model->update_user($user['id_user'], $content);
            }
        }
        // Returned string
        $str = '';
        $max = $tag->getAttribute('max');
        $limit = 20;
        if (! is_null($max)){
            $limit = $max + 0;
        }
        
        // Tweets array
        $conds = array(
                'order_by' => 'id_tweet DESC',
                'limit' => $limit
            );
        $tweets = self::$ci->tweets_model->get_list($conds);
 
        foreach($tweets as $tweet)
        {
            // Set the local tag var "tweet"
            $tag->set('tweet', $tweet);
            // Tag expand : Process of the children tags
            $str .= $tag->expand();
        }
        return $str;
    }
 
 
    /**
     * Tweet tag
     *
     * @param    FTL_Binding    Tag object
     * @return    String      Tag attribute or ''
     *
     * @usage    <ion:twitter:tweets>
     *        <ion:tweet field="id_user|id_tweet|screen_name|userurl|text" />
     *       </ion:twitter:tweets>
     *
     */
    public static function tag_tweet(FTL_Binding $tag)
    {
        // Returns the field value or NULL if the attribute is not set
        $field = $tag->getAttribute('field');
 
        if ( ! is_null($field))
        {
            $tweet = $tag->get('tweet');
 
            if ( ! empty($tweet[$field]))
            {
                $text = self::output_value($tag, $tweet[$field]);
                
                if ($field == 'text') {
                    $text = preg_replace("%www\.%", "http://www.", $text);
                    $text = preg_replace("%http://http://www\.%", "http://www.", $text);
                    $text = preg_replace("%https://http://www\.%", "https://www.", $text);
                    $exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    preg_match_all($exUrl, $text, $url);
                    foreach($url[0] as $k=>$v) $text = str_replace($url[0][$k], '<a href="'.$url[0][$k].'" target="_blank" rel="nofollow">'.$url[0][$k].'</a>', $text);
                }
                
                return $text;
            }
 
            // Here we have the choice :
            // - Ether return nothing if the field attribute isn't set or doesn't exist
            // - Ether silently return ''
            return self::show_tag_error(
                $tag,
                'The attribute <b>"field"</b> is not set'
            );
            // return '';
        }
    }
}
