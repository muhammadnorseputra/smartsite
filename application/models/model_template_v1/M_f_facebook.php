<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_facebook extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_facebook_user_has_registered($user_id)
    {
        $check = $this->db
            ->where(array('oauth_provider' => 'facebook', 'oauth_uid' => $user_id))
            ->get('t_users_portal');

        return ($check->num_rows() > 0) ? TRUE : FALSE;
    }

    public function register_new_user($data)
    {
        $this->db->insert('t_users_portal', $data);

        return $this->db->insert_id();
    }

    public function is_facebook_user_exist($email, $uid)
    {
        $check = $this->db
            ->where(array('email' => $email, 'oauth_provider' => 'facebook', 'oauth_uid' => $uid))
            ->get('t_users_portal');

        return ($check->num_rows() > 0) ? TRUE : FALSE;
    }

    public function get_facebook_user_data($uid)
    {
        $data = $this->db
            ->where(array('oauth_provider' => 'facebook', 'oauth_uid' => $uid))
            ->get('t_users_portal');

        return $data->row();
    }
}