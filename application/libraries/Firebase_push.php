<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Single Sender FIrebase Push To Android
 *
 * @package Codeigniter
 * @author Vicky Saputra <http://vicky.work
 **/
class Firebase_push
{
    protected $ci;

    private $api_key = "AAAAUCJXdIc:APA91bEldjhnbsMu36-Gf8oYzYjcJ3p_dP1RD3i5fWhAF33xRQnCV_0l43OA6HQfaHARty7eQVSY_QrX8rm1_oXtB5yf_Yp0tWM02rbU2bDsdqCxCBe4-cYuoP-gQFE2dURhEWVkAq8J";
    private $url = 'https://fcm.googleapis.com/fcm/send';

    // push message title
    private $to;
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }

    // sending push message to single user by firebase reg id
    public function send() {
        $fields = array(
            'to' => $this->to,
            'data' => $this->getPush(),
        );
        return $this->sendPushNotification($fields);
    }
 
    // Sending message to a topic by topic name
    public function sendToTopic() {
        $fields = array(
            'to' => '/topics/' . $this->to,
            'data' => $this->getPush(),
        );
        return $this->sendPushNotification($fields);
        

    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple() {
        $fields = array(
            'to' => $this->to,
            'data' => $this->getPush(),
        );
 
        return $this->sendPushNotification($fields);
    }
 
    // function makes curl request to firebase servers
    public function sendPushNotification($fields) {
        $curl = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, 
            array(
                'Authorization: key='.$this->api_key,
                'Content-Type: application/json'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        // Disabling SSL Certificate support temporarly
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($curl);
        if ($result === FALSE) 
           die('Curl failed: ' . curl_error($curl));
        // Close connection
        curl_close($curl);
        return $result;
    }
}

/* End of file Firebase_push.php */
/* Location: ./application/libraries/Firebase_push.php */