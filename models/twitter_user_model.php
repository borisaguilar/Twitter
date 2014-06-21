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

    public function update_user($id_user, $content){
        //delete older tweets data
        parent::delete($id_user, $this->_tweets_table);
        //insert new data
        foreach ($content as $tweet){
            $data = array(
                'id_user' => $id_user,
                'id_tweet' => $tweet->id_str,
                'screen_name' => $tweet->user->screen_name,
                'userurl' => $tweet->user->url,
                'created_at' => $tweet->created_at,
                'text' => $tweet->text
            );
            $this->{$this->db_group}->insert($this->_tweets_table, $data);
        }
        $update = array(
            'lastupdate' => time()
        );
        $where = array(
            'id_user' => $id_user
        );
        //update user last access table
        $this->{$this->db_group}->update($this->_user_table, $update, $where);
    }

    public function save($inputs){
        $data = array();
        $fields = $this->list_fields();
        foreach ($fields as $field)
            $data[$field] = $inputs[$field];
        return parent::save($data);
    }
    public function delete($id)
    {
        $nb_rows = parent::delete($id, $this->_user_table);
        if ($nb_rows > 0){
            parent::delete($id, $this->_tweets_table);
        }
        return $nb_rows;
    }
}