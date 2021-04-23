<?php

class Errors{
    CONST ERROR = '120322023';
    CONST ERROR_USER_UPDATEPASSWORD_EMPTY = '00145602545';
    CONST ERROR_USER_UPDATEPASSWORD = 'iooghigrd5';
    CONST ERROR_USER_UPDATEPASSWORD_PASSWORDINCORRECT = 'gordj15310wb';
    CONST ERROR_LOGIN_AUTHENTICATE_EMPTY = 'ion1520511541245';
    CONST ERROR_LOGIN_AUTHENTICATE = 'ion152051DASD1541245';
    CONST ERROR_LOGIN_AUTHENTICATE_PASSWORDINCORRECT = 'ion15205FBGF11541245';
    CONST ERROR_SIGNUP_NEWUSER_EMPTY = '4651d5HHJGbgxdfg';
    CONST ERROR_SIGNUP_NEWUSER_EXIST = '4651d5bMGHCgxdfg';
    CONST ERROR_SIGNUP_NEWUSER = '4651d5bgNHCGxdfg';
    CONST ERROR_USER_UPDATEUSERNAME_EMPTY = 'inoidaNGHCJsdbaionda';
    CONST ERROR_USER_UPDATEUSERNAME = 'inoidasdbGHJaionda';
    CONST ERROR_USER_UPDATE_PHOTO = 'inoidasdbCGJGCHJaionda';
    CONST ERROR_USER_UPDATE_PHOTO_FORMAT = 'inoidasdDFSGbaionda';

    CONST ERROR_CREATEHOMEITEM_NEWTASK = 'GJOPISGNM256302'; 
    
    private $errorsList = [];

    public function __construct()
    {
        $this->errorsList = [
            Errors::ERROR => 'Error detected',
            Errors::ERROR_USER_UPDATEPASSWORD_EMPTY => 'you cant not put data',
            Errors::ERROR_USER_UPDATEPASSWORD => 'has been an error updating the password',
            Errors::ERROR_USER_UPDATEPASSWORD_PASSWORDINCORRECT => 'the password is not correct',
            Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'The fields cannot be empty',
            Errors::ERROR_LOGIN_AUTHENTICATE => 'There was an error login',
            Errors::ERROR_LOGIN_AUTHENTICATE_PASSWORDINCORRECT => 'password or username incorrect',
            Errors::ERROR_SIGNUP_NEWUSER_EMPTY => 'The fields cannot be empty',
            Errors::ERROR_SIGNUP_NEWUSER_EXIST => 'This user already exists',
            Errors::ERROR_SIGNUP_NEWUSER => 'There was an error registering',
            Errors::ERROR_USER_UPDATEUSERNAME_EMPTY => 'The fields cannot be empty',
            Errors::ERROR_USER_UPDATEUSERNAME => 'There was an error updating the username',
            Errors::ERROR_USER_UPDATE_PHOTO => 'There was an error updating the Name',
            Errors::ERROR_USER_UPDATE_PHOTO_FORMAT => 'Therer was an error with the image format, try with another one',
            Errors::ERROR_CREATEHOMEITEM_NEWTASK => 'There was an error adding the task',
            
        ];
    }

    function get($hash){
        return $this->errorsList[$hash];
    }

    function existsKey($key){
        if(array_key_exists($key, $this->errorsList)){
            return true;
        }else{
            return false;
        }
    }
}
?>