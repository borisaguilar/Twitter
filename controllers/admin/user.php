<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Module User controller
 *
 */
class User extends Module_Admin
{
    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function construct(){
        // Loads the model as 'user_model'
        $this->load->model('twitter_user_model', 'twitter_user_model', true);
    }

    /**
     * Outputs the users list
     *
     */
    public function get_list()
    {
        $conds = array();
 
        $this->template['usersx'] = $this->twitter_user_model->get_list($conds);
 
        $this->output('admin/user_list');
    }
 
    /**
     * Outputs the detail of one user
     * @param  int    ID of the user
     *
     */
    public function get($id)
    {
        /* has to be written */
    }
 
    /**
     * Saves one user
     *
     */
    public function save()
    {
        /* has to be written */
    }

}