<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    
        private $user_name;
        private $user_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		if(!isset($this->username))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else { //登陆成功

                    $record = User::model()->findByAttributes(array('user_name'=>$this->username,'password' => md5($this->password))); 
                    if($record===null) 
                        $this->errorCode=self::ERROR_PASSWORD_INVALID;
                    else {
                        $this->user_name = $record->user_name;
                        $this->user_id = $record->user_id;
                        
                        $this->setState('user_name',$record->user_name);
                        $this->setState('user_id',$record->user_id);
                     
                        
                     //   print_r(Yii::app()->user);exit();
			$this->errorCode=self::ERROR_NONE; 
                    }

                }        
                return !$this->errorCode;
	}
        
        public function getId()
        {
            return  $this->user_id ;
        }
}