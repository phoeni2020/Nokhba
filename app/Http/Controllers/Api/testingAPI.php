<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testingAPI extends Controller
{
    function sendFCM()
    {
        // FCM API Url
        $url = 'https://fcm.googleapis.com/fcm/send';

        // Put your Server Response Key here
        $apiKey = 'AAAA3Kma2Uw:APA91bHPeZaDv5Ku0S8F_gpXvtiR3F7RC5imlbx0cR22tp7OfVcz6DaQWY_2-dphE7JvRjEIrbko07lyC_97BQi64tSjsjWu1IvuoPnaUai7lvFNIxl4ggaH-45WkOMFWit_79jZ1O5X';

        // Compile headers in one variable
        $headers = array(
            'Authorization:key=' . $apiKey,
            'Content-Type:application/json'
        );

        // Add notification content to a variable for easy reference
        $notifData = [
            'title' => "Test Title",
            'body' => "Test notification body",
            'click_action' => "android.intent.action.MAIN"
        ];

        // Create the api body
        $apiBody = [
            'notification' => $notifData,
            'data' => $notifData,
            'to' => '/topics/all',
            //'dCbVVDa4RCu7ZV2_9SoSeF:APA91bFkbrS_RJMI2qGT72XvMeZQI7fWUhlgVID-sO3G5SnRqxybGr4TE_Z_gpCe8kxDRYztnrNotGWWkZto3BOtCtogr_2ww2uQ6nRQRgUpNPP-hp7ui8TktAvxfEqkEoXWYWNdLMt_' // Replace 'mytargettopic' with your intended notification audience
        ];

        // Initialize curl with the prepared headers and body
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

        // Execute call and save result
        $result = curl_exec($ch);

        // Close curl after call
        curl_close($ch);

        return $result;
    }
}
