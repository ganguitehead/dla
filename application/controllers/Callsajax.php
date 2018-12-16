<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callsajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('faculty');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /* Student sign up*/
    public function student()
    {
        /* Request data */
        $request     = $this->input->post();
        $missingVars = array();
        $output      = array();

        foreach ($request as $key => $data) {
            if (strlen($data) < 1) {
                array_push($missingVars, $key);
            }
        }

        if (count($missingVars) > 0) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {

            /* No account with the email address */
            if (!$this->student->getIdByEmail($request["email"])) {
                // Create a new student account
                $data = $this->student->insert_student($request);

                if ($data) {
                    $output = json_encode(array(
                        'result' => true,
                        'value' => "Successfully created student account."
                    ));
                } else {
                    $output = json_encode(array(
                        'result' => false,
                        'value' => "Error in creating your account. Try again"
                    ));
                }

            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "An account with the entered email address exists."
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function faculty()
    {
        /* Request data */
        $request     = $this->input->post();
        $missingVars = array();
        $output      = array();

        foreach ($request as $key => $data) {
            if (strlen($data) < 1) {
                array_push($missingVars, $key);
            }
        }

        if (count($missingVars) > 0) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {

            /* No account with the email address */
            if (!$this->faculty->getIdByEmail($request["email"])) {
                // Create a new student account
                $data = $this->faculty->insert_faculty($request);

                if ($data) {
                    $output = json_encode(array(
                        'result' => true,
                        'value' => "Successfully created faculty account."
                    ));
                } else {
                    $output = json_encode(array(
                        'result' => false,
                        'value' => "Error in creating your account. Try again"
                    ));
                }

            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "An account with the entered email address exists."
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function login()
    {
        $request = $this->input->post();
        $output  = array();

        $missingVars = array();

        foreach ($request as $key => $data) {
            if (strlen($data) < 1) {
                array_push($missingVars, $key);
            }
        }

        if (count($missingVars) > 0) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {

            if ($user_id = $this->student->getIdByEmail(data_clean($request["email"]))) {

                $loginProcess = $this->student->getIdByEmailAndPassword(data_clean($request["email"]), data_clean($request["password"]));

                if ($loginProcess) {
                    $userType = $this->student->getUserTypeById($user_id);

                    /* Set session for the User ID */
                    $loginSessionData = array(
                        'email' => data_clean($request["email"]),
                        'user_id' => $user_id,
                        'logged_in' => TRUE,
                        'user_type' => $userType
                    );

                    $this->session->set_userdata($loginSessionData);

//                    $redirect = $userType == 1 ? base_url('home/') : base_url('phome/');
                    $redirect = base_url('home/');

                    $output = json_encode(array(
                        'result' => true,
                        'user_type' => $userType,
                        'redirect' => $redirect
                    ));
                } else {
                    $output = json_encode(array(
                        'result' => false,
                        'value' => "Username or password incorrect."
                    ));
                }
            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "Account with the entered email not found."
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }


}
