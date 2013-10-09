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
 
        $this->template['usersx'] = $this->twitter_user_model->get_list();
 
        $this->output('admin/user_list');
    }
 
    /**
     * Outputs the detail of one user
     * @param  int    ID of the user
     *
     */
    public function get($id){
        $where = array(
            'id_user' => $id
        );
        $this->template = $this->twitter_user_model->get($where);
        $this->output('admin/user_detail');
    }
 
    /**
     * Saves one user
     *
     */
    public function save()
    {
        $invalid = ($this->input->post('username')=='') or 
        ($this->input->post('accesstoken')=='') or
        ($this->input->post('accesstokensecret')=='') or
        ($this->input->post('consumerkey')=='') or
        ($this->input->post('consumersecret')=='')or
        ($this->input->post('lastupdate')=='')or
        ($this->input->post('max_time_difference')=='');

        if (!$invalid){
            $id_user = $this->twitter_user_model->save($this->input->post());
            $this->update[] = array(
                'element' => 'moduleTwitterUsersList',
                'url' => admin_url() . 'module/twitter/user/get_list'
            );
            $this->success(lang('ionize_message_operation_ok'));
        }else{
            $this->success(lang('ionize_message_operation_nok'));
        }

    }

    public function create(){
        $this->twitter_user_model->feed_blank_template($this->template);
        $this->output('admin/user_detail');
    }

    /**
     * Delete one user
     *
     */
    public function delete($id)
    {
        if ($this->twitter_user_model->delete($id) > 0)
        {
            // Update the authors list
            $this->update[] = array(
                'element' => 'moduleTwitterUsersList',
                'url' => admin_url() . 'module/twitter/user/get_list'
            );
     
            // Send the user a message
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            // Send the user a message
            $this->error(lang('ionize_message_operation_nok'));
        }
    }

}