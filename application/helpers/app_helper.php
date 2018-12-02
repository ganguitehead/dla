<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('data_clean')) {

    function data_clean($data)
    {
        $ci = get_instance();

        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);;

        return $data;
    }
}

function is_logged_in()
{
    $ci =& get_instance();

    if (!is_null($ci->session->userdata('user_id')) && !is_null($ci->session->userdata('logged_in'))) {
        if (!is_null($ci->session->userdata('user_type'))) {
            return true;
        }
    } else {
        return false;
    }
}

function getLoggedInUserType()
{
    $ci =& get_instance();

    if (!is_null($ci->session->userdata('user_type'))) {
        return $ci->session->userdata('user_type');
    }
    return false;
}

function getLoggedInUserDetail()
{
    $ci =& get_instance();

    if (is_logged_in()) {
        if (!is_null($ci->session->userdata('logged_in'))) {
            return $ci->student->getUserDetailById($ci->session->userdata('user_id'));
        }
    }
    return false;
}

function checkUserTypeAndGoHome()
{
    switch (getLoggedInUserType()) {
        case 1:
            redirect(base_url() . 'home/');
            break;
        case 0:
            redirect(base_url() . 'phome/');
            break;
    }
}

?>