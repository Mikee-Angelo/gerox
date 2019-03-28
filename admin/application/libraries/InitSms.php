<?php 

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class InitSms{

    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function loadsms($data){
        require_once APPPATH.'third_party/sms/autoload.php';

        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1MTk2NzIyNSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY4ODIyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.EUIgQ--vQz_LoWdlOkpwayHJPMJytQsAk4AZRMp9LbQ');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest($data);

        $sendMessages = $messageClient->sendMessages([$sendMessageRequest1]);
        return $sendMessages;
    }
}

 