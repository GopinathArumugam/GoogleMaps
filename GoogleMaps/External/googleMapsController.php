<?php

//use \RESTAPICall;

include dirname(__FILE__) . "/RESTAPICall.php";

ob_start();
session_start();

if (isset($_POST['action_name']) && !empty($_POST['action_name'])) {
    $action = $_POST['action_name'];
    switch ($action) {
        case 'getGoogleMaps' : getGoogleMaps();
            break;
        case 'validateCredentials' : validateCredentials();
            break;
    }
}

function validateCredentials() {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        if ($_POST['username'] == 'admin' &&
                $_POST['password'] == 'admin') {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
//            echo 'You have entered valid use name and password';
//            header("location: mapShow.php");
            echo "mapShow.php";
        } else {
            unset($_SESSION["username"]);
            echo "invalid_login";
        }
    } else {
        unset($_SESSION["username"]);
        echo "invalid_login";
    }
}

function getGoogleMaps() {

//        $url = "http://10.5.3.119:8090/wsw/get?phoneNumber=9790687405";        
//        $content = RESTAPICall::makeAPICall($url, RESTAPICall::GET, RESTAPICall::APPLICATION_XML, "");
//        print_r($content);

    if (isset($_SESSION['username'])) {
        $content = '[
  {
    "class": "com.md.LocData",
    "id": 1,
    "emailId": "mouli.dreamlovers@gmail.com",
    "installed": true,
    "latitude": "12.99",
    "longitude": "80.18",
    "markerData": "Chennai, TamilNadu, 600017",
    "notifyNum": [
      {
        "class": "com.md.NotifyNum",
        "id": 6
      },
      {
        "class": "com.md.NotifyNum",
        "id": 1
      },
      {
        "class": "com.md.NotifyNum",
        "id": 11
      }
    ],
    "phoneNumber": "9790687405",
    "uniqueId": "800497"
  },
  {
    "class": "com.md.LocData",
    "id": 2,
    "emailId": "vijaya.dinak@gmail.com",
    "installed": true,
    "latitude": "26.77",
    "longitude": "82.14",
    "markerData": "Faziabad, Uttar Pradesh, 224001",
    "notifyNum": [
      {
        "class": "com.md.NotifyNum",
        "id": 5
      },
      {
        "class": "com.md.NotifyNum",
        "id": 9
      }
    ],
    "phoneNumber": "9443037134",
    "uniqueId": "188217"
  },
  {
    "class": "com.md.LocData",
    "id": 4,
    "emailId": "premaa.sundararajan@gmail.com",
    "installed": true,
    "latitude": "19.16",
    "longitude": "72.85",
    "markerData": "Mumbai, Maharastra, 400063",
    "notifyNum": [
      {
        "class": "com.md.NotifyNum",
        "id": 8
      },
      {
        "class": "com.md.NotifyNum",
        "id": 7
      }
    ],
    "phoneNumber": "9994401286",
    "uniqueId": "733759"
  },
  {
    "class": "com.md.LocData",
    "id": 5,
    "emailId": "kmmurali2691@gmail.com",
    "installed": true,
    "latitude": "12.91",
    "longitude": "79.13",
    "markerData": "Vellore, TamilNadu, 632009",
    "notifyNum": [
      {
        "class": "com.md.NotifyNum",
        "id": 10
      }
    ],
    "phoneNumber": "9789489092",
    "uniqueId": "404457"
  }
]';
        print_r(json_encode(json_decode($content, true)));
    } else {
        unset($_SESSION["username"]);
        echo "session_error";
    }
}

?>
