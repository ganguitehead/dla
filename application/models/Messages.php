<?php

class Messages extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('file');
    }

    public function getChatFile($name)
    {
        $fileName     = FCPATH . '/assets/chats/' . $name;
        $chatFileOpen = fopen($fileName, "a+");

        return fread($chatFileOpen, filesize($fileName) < 1 ? 1 : filesize($fileName));
    }

    public function getChatFileArray($name)
    {
        $fileData = $this->getChatFile($name);
        return json_decode($fileData, true);
    }

    public function writeChatFile($name, $data)
    {
        $fileName = FCPATH . '/assets/chats/' . $name;

        if (!write_file($fileName, $data)) {
            return false;
        } else {
            return true;
        }
    }

}

?>