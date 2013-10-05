<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Module Admin controller
 *
 */
class Twitter extends Module_Admin
{
    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function construct(){}
     /**
     * Admin panel
     * Called from the modules list.
     *
     * @access  public
     * @return  parsed view
     *
     */
    public function index()
    {
        $this->output('admin/twitter');
    }

}