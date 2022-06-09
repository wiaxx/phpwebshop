<?php

class Message
{
    public $id;
    public $user_id;
    public $contact_option;
    public $title;
    public $message;
    public $response_message;

    public function __construct($user_id, $contact_option, $title, $message, $response_message = null, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        if ($response_message != null) {
            $this->response_message = $response_message;
        }

        $this->user_id = $user_id;
        $this->contact_option = $contact_option;
        $this->title = $title;
        $this->message = $message;
    }
}
