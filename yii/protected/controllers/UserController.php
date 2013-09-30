<?php

class UserController extends Controller
{
    
    public $layout ='sub';
    public $title = "用户中心";
    public function actionIndex()
    {
        $act =$_POST['act'];
        if($act == 'do_login')
        {
            $cardno = $_POST['cardno'];
            $password = $_POST['password'];
            
            $prev_sessionid = Yii::app()->session->sessionID;
            
            
            
            
            $identity=new UserIdentity($cardno,$password);
            if($identity->authenticate()) {
                Yii::app()->user->login($identity);
                
                $curr_sessionid = Yii::app()->session->sessionID;;
                //修改购物车
                Cart::model()->updateAll(array('session_id'=>$curr_sessionid),'session_id=:session_id',array(':session_id'=>$prev_sessionid)); 
                
           
                $this->redirect(array('user/center'));

                
            }
            else{
                $tips = "用户名密码不正确";
                $this->render('user/index',array('tips'=>$tips));
            }
          
            
        }
        else{
            $this->render('index');
        }
    }
    
    
    
    public function  actionCenter()
    {
        if(!Yii::app()->user->isGuest)
        {
            $user = User::model()->findByPk(Yii::app()->user->user_id);
            $this->render('center',array('user'=>$user));
            
        }
        else{
            $this->redirect(array('user/index'));
        }
        
    }
    
     public function  actionRegister()
    {

        $this->render('register',array('user'=>$user));
 
    }
    
      public function  actionLogout()
    {
        Yii::app()->user->logout();
	$this->redirect(Yii::app()->homeUrl);

    }
	
}