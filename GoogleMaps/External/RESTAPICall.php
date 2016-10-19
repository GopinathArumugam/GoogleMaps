<?php

class RESTAPICall {
    //Content types

    const APPLICATION_JSON = "Content-Type: application/json";
    const APPLICATION_XML = "Content-Type: application/xml";

    //Methods
    const POST = "POST";
    const GET = "GET";
    const DELETE = "DELETE";
    const PUT = "PUT";

    /*
     * Communicates with REST server and give back the resposne
     * 
     * $url - complete endpoint URL of the REST server
     * $method - GET/POST/DELETE/PUT...
     * $contentType - (application/json)/(application/xml)..
     * $xmlDoc - Data to be posted
     */

    public static function makeAPICall($url, $method, $contentType, $xmlDoc = "") {
        //$xmlDoc = CRMAuthentication::addSystemAuthentication($xmlDoc);
        
//        $userName = "your user name";
//        $password = "your password";
        // Create a cURL instance.
        $ch = curl_init($url);

        // Set some cURL options and load the fields.
        curl_setopt_array
                (
                $ch, //instance of cURL
                array //set the options
            (
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HEADER => 0,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: ' . $contentType),
//            CURLOPT_USERPWD => $userName . ":" . $password
                )
        );

        //send data if we need to
        if ($xmlDoc) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlDoc);
        }

        //Execute the HTTP request
        $response = curl_exec($ch);

        if ($response) {
//            echo "Response from " . $method . ": " . $url . "<br />" .
//            "<pre>" . htmlentities($response, ENT_QUOTES) . "</pre>";
        } else {
//            echo ("Error, cURL failed.<br>" . curl_errno($ch) . ": " . curl_error($ch));
        }

        //close the handle to cURL
        curl_close($ch);

        return $response;
    }

}

?>
