<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class GLogin
{
    /**
     *  static 
     */

    private static $m_error;
    
    private static $m_username;
    private static $m_email;
    private static $m_discount = 1;
    private static $m_userrank = 0;
    private static $m_userid;
    private static $m_isEditor; //是否为网站编辑
    
    
    private static $m_isLogin = false;
            
    
     const USER_SESSION_KEY = "GLoginUserInfo";
    /**
     *  登陆
     *  
     * 返回值
     * true 成功
     * false 失败 通过GetLastError获得错误 
     * 
     */
    
    public static function login($email,$password,$remember = false)
    {
        $res = self::check_login($email,$password);
        if($res)
        {
            //保存信息
            self::$m_email = $email;
            self::$m_userid =  $res['user_id'];
            self::$m_username = $res['user_name'];
            self::$m_isLogin = true;
            
            self::actionAfterLogin();
            return true;
        }
        else
        {
            $m_error = "用户名密码不符合";
            return false;
        }
        
    }
     /**
     *  利用用户名登陆 
     *  
     * 返回值
     * true 成功
     * false 失败 通过GetLastError获得错误 
     * 
     */
    public static function card_login($card,$password,$remember = false)
    {
        global $user;
        $res = $user->check_user_login($card,$password);
        if($res)
        {
            //保存信息
            self::$m_email = $res['email'];
            self::$m_userid =  $res['user_id'];
            self::$m_username =$card;
            self::$m_isLogin = true;
            
            self::actionAfterLogin();
            return true;
        }
        else
        {
            $m_error = "用户名密码不符合";
            return false;
        }
        
    }
       /*
     *  注册后的登陆
     */
    
    public static function loginAfterReg($email)
    {
        global $db,$ecs;
        $res = $db->getRow("select * from ".$ecs->table("users")."where email = '$email'" );
        if($res)
        {
            //保存信息
            self::$m_email = $email;
            self::$m_userid =  $res['user_id'];
            self::$m_username = $res['user_name'];
            self::$m_isLogin = true;
            self::actionAfterLogin();
            return true;
        }
        else
        {
            $m_error = "找不到注册时的邮箱地址";
            return false;
        }
        
    }
    
    /*
     * 
     *   登陆成功后的操作，更新用户信息，更新购物车信息
     */
    
    private static function actionAfterLogin()
    {
        
           //更新用户信息    
            self::update_user_info();
            //重新计算购物车价格
            self::recalculate_price();
        
            

             //将用户信息储存到session中
            $obj = new stdClass();
            $obj->userid = self::$m_userid;
            $obj->username = self::$m_username;
            $obj->email = self::$m_email;
            $obj->discount = self::$m_discount;
            $obj->userrank = self::$m_userrank;
            $obj->isEditor = self::$m_isEditor;
            
            $_SESSION[self::USER_SESSION_KEY] =   serialize($obj);
            
            //为了兼容ECSHOP 
            $_SESSION['user_id'] = self::$m_userid;
            //记录登录信息
            GLog::Log("member_login", self::$m_username." login");
    }
    
 
    /*
     * 
     * 判断是否已经登录
     * 
     */
    
     public static function isLogin()
     {
         if( !self::$m_isLogin )
         {
             
            if( isset($_SESSION[self::USER_SESSION_KEY]))
            {
                $obj = unserialize($_SESSION[self::USER_SESSION_KEY]) ; 
                self::$m_userid = $obj->userid  ;
                self::$m_username =  $obj->username ;
                self::$m_email = $obj->email ;
                self::$m_discount = $obj->discount ;
                self::$m_userrank = $obj->userrank  ;
                self::$m_isEditor = $obj->isEditor ; 
                self::$m_isLogin  = true;
            }
            else{
                return false;
            }
         }
         return true;
     }
 
     
     /*
     * 
     * 退出登录
     * 
     */
    
     public static function logout()
     {
         self::$m_userid = 0;
         self::$m_username = "";
         self::$m_email = "";
         self::$m_discount = 1;
         self::$m_userrank  = 0;
         self::$m_isEditor = 0;
         
         self::$m_isLogin   = false;
         
         
        self::actionAfterLogin();
        //为了兼容ECSHOP 
        unset($_SESSION['user_id'] );
        unset($_SESSION[self::USER_SESSION_KEY]);
        

                
     }
     
     public static function id()
     {
             return self::isLogin()?self::$m_userid:null;
     }
     public static function name()
     {
         
        return self::isLogin()?self::$m_username:null;
     }
     //保持EC兼容性
     public static function setName($name)
     {
            self::$m_usernamem = $name;
               //将用户信息储存到session中
            $obj = new stdClass();
            $obj->userid = self::$m_userid;
            $obj->username = self::$m_username;
            $obj->email = self::$m_email;
            $obj->discount = self::$m_discount;
            $obj->userrank = self::$m_userrank;
            $obj->isEditor = self::$m_isEditor;
            
            $_SESSION[self::USER_SESSION_KEY] =   serialize($obj);
     }
     public static function rank()
     {
             return self::isLogin()?self::$m_userrank:0;
     }
      public static function email()
     {
             return self::isLogin()?self::$m_email:null;
     }
      public static function discount()
     {
           return self::isLogin()?self::$m_discount:1;
     }
     
    
   






    /*
     * 
     * 检查登陆
     * 
     */
    
     public static function check_login($email,$password)
    {
        global $user;
        return $user->check_email_login($email,$password);
         
    }
    
    /*
     * 
     * 检查是否为网站编辑
     * 
     */ 
    public static function checkEditor($open_id)
    {
        $array_list= array('F83836CA76556D7EB2A79D6429A2DC60','FC523F19D1387F9C9B1B1D6A5AE240DA'
            ,'C6E03FC06B8599F88A5806FB4ACE0DB2','A8B174EB5210282DB21B16A9D88B2475','B0EA154D3FEF0A96924758199FD7179E'
            ,'E2E6018379B2F48971AA7EFF87AC4EF7','74FC50FBFFD876FA1A31D2E035491F61','B7FB19770490D6FF5194DD6228A078CA');
        if(   in_array($open_id,$array_list) )
        {
            self::$m_isEditor = 1;
        }
        else{
             self::$m_isEditor = 0;
        }
    }
       /*
     * 
     * 检查是否为网站编辑
     * 
     */ 
    public static function isEditor()
    {
        //return true;
        return self::isLogin()?self::$m_isEditor:null;
    }
    
    
    
    
    
    
    
    /**
    * 重新计算购物车中的商品价格：目的是当用户登录时享受会员价格，当用户退出登录时不享受会员价格
    * 如果商品有促销，价格不变
    *
    * @access  public
    * @return  void
    */
     private static function recalculate_price()
    {
         
         
         $m_discount = self::$m_discount;
         $m_userrank = self::$m_userrank;
        /* 取得有可能改变价格的商品：除配件和赠品之外的商品 */
        $sql = 'SELECT c.rec_id, c.goods_id, c.goods_attr_id, g.promote_price, g.promote_start_date, c.goods_number,'.
                    "g.promote_end_date, IFNULL(mp.user_price, g.shop_price * '$m_discount') AS member_price ".
                'FROM ' . $GLOBALS['ecs']->table('cart') . ' AS c '.
                'LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . ' AS g ON g.goods_id = c.goods_id '.
                "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
                        "ON mp.goods_id = g.goods_id AND mp.user_rank = '" . $m_userrank . "' ".
                "WHERE session_id = '" .SESS_ID. "' AND c.parent_id = 0 AND c.is_gift = 0 AND c.goods_id > 0 " .
                "AND c.rec_type = '" . CART_GENERAL_GOODS . "' AND c.extension_code <> 'package_buy'";

                $res = $GLOBALS['db']->getAll($sql);

        foreach ($res AS $row)
        {
            $attr_id    = empty($row['goods_attr_id']) ? array() : explode(',', $row['goods_attr_id']);


            $goods_price = get_final_price($row['goods_id'], $row['goods_number'], true, $attr_id);


            $goods_sql = "UPDATE " .$GLOBALS['ecs']->table('cart'). " SET goods_price = '$goods_price' ".
                        "WHERE goods_id = '" . $row['goods_id'] . "' AND session_id = '" . SESS_ID . "' AND rec_id = '" . $row['rec_id'] . "'";

            $GLOBALS['db']->query($goods_sql);
        }

        /* 删除赠品，重新选择 */
        $GLOBALS['db']->query('DELETE FROM ' . $GLOBALS['ecs']->table('cart') .
            " WHERE session_id = '" . SESS_ID . "' AND is_gift > 0");
    }
        
        
        
        
        
        
    
    /*
     * 
     *  更新用户信息
     */
    
    private static function update_user_info()
    {
        
        
        if (!self::$m_userid)
        {
            return false;
        }
        
        $userid = self::$m_userid;
        /* 查询会员信息 */
        $time = date('Y-m-d');
        $sql = 'SELECT u.user_money,u.email, u.pay_points, u.user_rank, u.rank_points, '.
                ' IFNULL(b.type_money, 0) AS user_bonus, u.last_login, u.last_ip'.
                ' FROM ' .$GLOBALS['ecs']->table('users'). ' AS u ' .
                ' LEFT JOIN ' .$GLOBALS['ecs']->table('user_bonus'). ' AS ub'.
                ' ON ub.user_id = u.user_id AND ub.used_time = 0 ' .
                ' LEFT JOIN ' .$GLOBALS['ecs']->table('bonus_type'). ' AS b'.
                " ON b.type_id = ub.bonus_type_id AND b.use_start_date <= '$time' AND b.use_end_date >= '$time' ".
                " WHERE u.user_id = '$userid'";
        
        if ($row = $GLOBALS['db']->getRow($sql))
        {

            /*判断是否是特殊等级，可能后台把特殊会员组更改普通会员组*/
            if($row['user_rank'] >0)
            {
                $sql="SELECT special_rank from ".$GLOBALS['ecs']->table('user_rank')."where rank_id='$row[user_rank]'";
                if($GLOBALS['db']->getOne($sql)==='0' || $GLOBALS['db']->getOne($sql)===null)
                {   
                    $sql="update ".$GLOBALS['ecs']->table('users')."set user_rank='0' where user_id='$userid'";
                    $GLOBALS['db']->query($sql);
                    $row['user_rank']=0;
                }
            }

            /* 取得用户等级和折扣 */
            if ($row['user_rank'] == 0)
            {
                // 非特殊等级，根据等级积分计算用户等级（注意：不包括特殊等级）
                $sql = 'SELECT rank_id, discount FROM ' . $GLOBALS['ecs']->table('user_rank') . " WHERE special_rank = '0' AND min_points <= " . intval($row['rank_points']) . ' AND max_points > ' . intval($row['rank_points']);
                if ($row = $GLOBALS['db']->getRow($sql))
                {
                    self::$m_userrank = $row['rank_id'];
                    self::$m_discount  = $row['discount'] / 100.00;
                    
                }
                else
                {
                    self::$m_userrank  = 0;
                    self::$m_discount  = 1;
                }
            }
            else
            {
                // 特殊等级
                $sql = 'SELECT rank_id, discount FROM ' . $GLOBALS['ecs']->table('user_rank') . " WHERE rank_id = '$row[user_rank]'";
                if ($row = $GLOBALS['db']->getRow($sql))
                {
                    self::$m_userrank  = $row['rank_id'];
                    self::$m_discount   = $row['discount'] / 100.00;
                }
                else
                {
                    self::$m_userrank  = 0;
                    self::$m_discount = 1;
                }
            }
        }

        /* 更新登录时间，登录次数及登录ip */
        $sql = "UPDATE " .$GLOBALS['ecs']->table('users'). " SET".
            " visit_count = visit_count + 1, ".
            " last_ip = '" .real_ip(). "',".
            " last_login = '" .gmtime(). "'".
            " WHERE user_id = '" . $userid . "'";
        $GLOBALS['db']->query($sql);
    }
    
}





?>
