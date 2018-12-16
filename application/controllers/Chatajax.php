<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('faculty');
        $this->load->model('messages');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function getUserId()
    {
        return $this->session->userdata('user_id');
    }

    public function get_chat()
    {
        /* Request data */
        $request = $this->input->post();
        $output  = array();

        if (!isset($request["id"]) && null($request["id"])) {
            $output = json_encode(array(
                'result' => false,
                'value' => "Error in loading the messages. Refresh the page and try again."
            ));
        } else {

            /*
             * Get the chat for the chat ID
             * Chat ID is the course ID
             * Messages file for the course is in the format : chatId_messages.json
             * */

            /* Check if the chat file exists */
            $fileName = $request["id"] . "_messages.json";
            $messages = $this->messages->getChatFile($fileName);

            $messages = json_decode($messages, true);

            foreach ($messages as &$message) {
                $userDetail      = $this->student->getUserDetailById($message["user_id"]);
                $message["name"] = ucwords($userDetail["firstname"] . " " . $userDetail["lastname"]);
            }

            $output = json_encode(array(
                'result' => true,
                'value' => $messages
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function send_chat()
    {
        /* Request data */
        $request     = $this->input->post();
        $output      = array();
        $missingVars = array();

        foreach ($request as $key => $data) {
            if (strlen($data) < 1) {
                array_push($missingVars, $key);
            }
        }

        if (count($missingVars) > 0) {
            $output = json_encode(array(
                'result' => false,
                'value' => "Error in sending the message. Refresh the page and try again."
            ));
        } else {
            /* Check if the chat file exists */
            $fileName = $request["course"] . "_messages.json";
            $message  = $request["m"];

            /* Get the existing chat append this new message to it */
            $chatArray = $this->messages->getChatFileArray($fileName);

            if (is_array($chatArray) && count($chatArray) < 1) {
                $chatArray = array();
            }

            if (!is_array($chatArray) && strlen($chatArray) < 1) {
                $chatArray = array();
            }

            $userDetail = $this->student->getUserDetailById($this->getUserId());

            $newMessage = array(
                "message" => $message,
                "user_id" => $this->getUserId(),
                "course" => $request["course"],
                "time" => date("l jS F Y h:i:s"),
                "name" => ucwords($userDetail["firstname"] . " " . $userDetail["lastname"])
            );

            array_push($chatArray, $newMessage);

            $chatArrayToJson = json_encode($chatArray);
            $messagesWrite   = $this->messages->writeChatFile($fileName, $chatArrayToJson);
            $updatedMessages = $this->messages->getChatFileArray($fileName);

            $output = json_encode(array(
                'result' => true,
                'value' => $newMessage
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }


}
