<?php
namespace App\Service;
    class Sms {
        function __construct() {
        }
        private $SMS_SENDER = "Cileasing";
        private $RESPONSE_TYPE = 'json';
    
        private $SMS_USERNAME = 'cileasinginfotech@gmail.com';
    
        private $SMS_PASSWORD = 'flower12345';
    
     
    
     
    
       public function initiateSmsActivation($OTP, $phone_number) {
    
            $isError = 0;
    
            $errorMessage = true;
            $message = "Welcome to cileasing , Your OTP is : $OTP";
    
     
    
            //Preparing post parameters
    
            $postData = array(
    
                        'username' => $this->SMS_USERNAME,
    
                        'password' => $this->SMS_PASSWORD,
    
                        'message' => $message,
    
                        'sender' => $this->SMS_SENDER,
    
                        'mobiles' => $phone_number,
    
                        'response' => $this->RESPONSE_TYPE
    
            );
    
     
    
            //$url = "http://portal.bulksmsnigeria.net/api/"; // portal.nigeriabulksms.com
    
             $url = "http://portal.nigeriabulksms.com/api/";
    
             
    
            $ch = curl_init();
    
            curl_setopt_array($ch, array(
    
                CURLOPT_URL => $url,
    
                CURLOPT_RETURNTRANSFER => true,
    
                CURLOPT_POST => true,
    
                CURLOPT_POSTFIELDS => $postData
    
            ));
    
     
    
     
    
            //Ignore SSL certificate verification
    
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
     
    
     
    
            //get response
    
            $output = curl_exec($ch);
    
     
    
     
    
            //Print error if any
    
     
    
            if (curl_errno($ch)) {
    
                $isError = true;
    
                $errorMessage = curl_error($ch);
    
            }
    
            curl_close($ch);
    
            if ($isError) {
    
     
    
                return array('error' => 1, 'message' => $errorMessage);
    
            } else {
    
     
    
                return array('error' => 0);
    
            }
    
        }
    } 