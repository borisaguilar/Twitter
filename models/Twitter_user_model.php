<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Twitter_user_model extends Base_model
{
    // User tables
    protected $_tweets_table = 'module_twitter_tweets';
    protected $_user_table = 'module_twitter_user';
 
    // Link table between authors and parents (page, article)
    //protected $_link_table = 'module_demo_links';
 
    /**
     * Model Constructor
     *
     * @access  public
     */
    public function __construct()
    {
        $this->set_table($this->_user_table);
        //$this->set_lang_table($this->_tweets_table);
        $this->set_pk_name('id_user');
 
        parent::__construct();
    }
}