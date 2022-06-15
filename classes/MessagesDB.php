<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Message.php';

class MessagesDB extends Database
{

    // get all by userid
    public function get_all_by_user($user_id)
    {
        $query = "SELECT * FROM usersMessage WHERE userID = ? ORDER BY id DESC";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $all_messages = [];

        foreach ($db_messages as $db_message) {

            $db_id = $db_message["id"];
            $db_contact_option = $db_message["contactOption"];
            $db_title = $db_message["title"];
            $db_origin_message = $db_message["message"];
            $db_user_id = $db_message["userID"];
            $db_respones_message = $db_message["responseMessage"];

            $all_messages[] = new Message($db_user_id, $db_contact_option, $db_title, $db_origin_message, $db_respones_message, $db_id);
        }

        return $all_messages;
    }

    // get all - as admin
    public function get_all()
    {
        $query = "SELECT * FROM usersMessage ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);
        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $messages = [];

        foreach ($db_messages as $db_message) {

            $db_id = $db_message["id"];
            $db_contact_option = $db_message["contactOption"];
            $db_title = $db_message["title"];
            $db_origin_message = $db_message["message"];
            $db_user_id = $db_message["userID"];
            $db_respones_message = $db_message["responseMessage"];

            $messages[] = new Message($db_user_id, $db_contact_option, $db_title, $db_origin_message, $db_respones_message, $db_id);
        }

        return $messages;
    }

    // create 
    public function create(Message $message)
    {

        $query = "INSERT INTO usersMessage (contactOption, title, `message`, userID) VALUES (?, ?, ?, ?)";
        
        $contact_option = $message->contact_option;
        $title = $message->title;
        $customer_message = $message->message;
        $customer_id = $message->user_id;

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('sssi', $contact_option, $title, $customer_message, $customer_id);

        $success = $stmt->execute();

        return $success;
    }

    // update
    public function update($answer, $id)
    {
        $query = 'UPDATE usersMessage SET responseMessage = ? WHERE id = ?';

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('si', $answer, $id);

        $success = $stmt->execute();

        return $success;
    }
}
