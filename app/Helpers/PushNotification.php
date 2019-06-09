<?php
namespace App\Helpers;
class PushNotification
{
    public static function push_notification($data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = 'AIzaSyAugXwruyWaHYMloeE3RF-UMDFeQqZ9lTc';
        // data to send .
        $fields = array();
        $fields['content_available'] = true;
        $fields['priority'] = 'high';
        if(is_array($data['target'])){
           $fields['registration_ids'] = $data['target'];
        }else{
            $fields['to'] = $data['target'];
        }
        //header with content_type api key
        $headers = array(
            'Content-Type :application/json',
            'Authorization: key='.$server_key
        );
        $data['target'] = null;
        $fields['data'] = $data;
        $fields['notification'] = array('title'=>$data['title']);
        // send notification to google servers.            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return (["status"=>-1]); //errror during sending
        }
        else
        {
            return (["status"=>1]); //sended successfully
        }
        curl_close($ch);
    }
}