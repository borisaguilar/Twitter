<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Twitter extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Loads the model as 'user_model'
        $this->load->model('twitter_user_model', 'twitter_user_model', true);
        $this->load->model('twitter_tweets_model', 'tweets_model', true);
    }
 
    function index()
    {
    	/* La logica es la siguiente */
    	/* De los parametros leemos el formato deseado (xml o json)*/
    	/* En esta versión solo retornamos json*/
    	/* para cada usuario! */
		$users =  $this->twitter_user_model->get_list();
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
				/*$this->template['title'] = $timedifference;*/
				/*$this->output('twitter');*/

				/* De la bdd obtenemos el "cantidad_tweets */

				
					/* Obtenemos el usuario y permisos de la bdd */
	    			/* Hacemos el request a twitter  OAUTH single-user*/
	    			/* Actualizamos la bdd con el request y la hora/fecha */
				/* No difieren por mucho */
					/* Mostramos los tweets */
			}else{
				$needs_update = true;
			}

			if ($needs_update){
				/*Curl is -REQUIRED- by twitteroauth*/
				require_once('twitteroauth-master/twitteroauth/twitteroauth.php');

				/* Get user access tokens out of the session. */
				$access_token = '56603624-Qkym4q21INZ4ZA0PBVUUxSC3Y5RzpeQoMQOtyf4F0';
				$access_token_secret = 'UahodBFyVvJXV4RyxuPXwzybfGs8H6ILUAfKqxhpy3Q';
				$consumer_key = 'h4uWeSN9KrZ9vOpsHjwPA';
				$consumer_secret = 'dczEA6SopYfz838pfzvKPsbctftY1CCZNSgoa6qYFw';

				/* Create a TwitterOauth object with consumer/user tokens. */
				$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

				/* If method is set change API call made. Test is called by default. */
				$content = $connection->get('statuses/user_timeline');

				/*save tweets in model*/
				$this->twitter_user_model->update_user($user['id_user'], $content);
			}
		}
		/* Display user's data */
		$conds = array(
        	'order_by' => 'id_tweet DESC'
    	);
		$content = $this->tweets_model->get_list($conds);
		$this->template['data'] = json_encode($content);
		$this->output('twitter');
    }
}