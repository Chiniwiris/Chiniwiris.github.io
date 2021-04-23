<?php

class Success{
    CONST SUCCESS = '120322023';
    CONST SUCCESS_SIGNUP_NEWUSER = 'IIONH56410V56SDF40';
    CONST SUCCESS_USER_UPDATEUSERNAME = 'NZGS612Z0D01GH56';
    CONST SUCCESS_USER_UPDATE_PHOTO = 'DIAONAOFISZG61310';
    CONST SUCCESS_HOME_NEWTASK = 'NAIOFN<F5S64D14';
    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            Success::SUCCESS => 'Success',
            Success::SUCCESS_SIGNUP_NEWUSER => 'New user created',
            Success::SUCCESS_USER_UPDATEUSERNAME => 'Username updated',
            Success::SUCCESS_USER_UPDATE_PHOTO => 'Photo updated',
            Success::SUCCESS_HOME_NEWTASK => 'New Task added',
        ];
    }

    function get($hash){
        return $this->successList[$hash];
    }

    function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}
?>