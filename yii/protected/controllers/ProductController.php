<?php

class ProductController extends Controller
{
         public $layout ='sub';
        public $title = '所有分类';
	public function actionIndex()
	{
		$this->render('index');
	}
        
         public function actionAllList()
	{
		$this->render('alllist');
	}
        
        
        public function actionSubList()
	{
            $results = array(
                
                array(
                    "WebChannelCode"=>"0701",
                    "WebChannelName"=>"T恤",
                    "ChannelPath"=>"",
                    "ParentCode"=>"",
                    "CodeLevel"=>1,
                    "IsLeafNode"=>0,
                    "WebSiteCode"=>8,
                    "ADID"=>0,
                    "Sort"=>0,
                    "ProQty"=>185
                    
                ),
                  array(
                  "WebChannelCode"=>"0702","WebChannelName"=>"衬衫","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>81
                    
                ),
                  array(
                    "WebChannelCode"=>"0703","WebChannelName"=>"连衣裙","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>197
                    
                ),
                  array(
                "WebChannelCode"=>"0704","WebChannelName"=>"裤子","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>120
                ),
                
                     array(
                "WebChannelCode"=>"0705","WebChannelName"=>"毛衣","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>126
                ),
                     array(
               "WebChannelCode"=>"0710","WebChannelName"=>"新品抢先1","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>169
                ),
                     array(
               "WebChannelCode"=>"0718","WebChannelName"=>"棉衣羽绒","ChannelPath"=>"","ParentCode"=>"","CodeLevel"=>1,"IsLeafNode"=>0,"WebSiteCode"=>8,"ADID"=>0,"Sort"=>0,"ProQty"=>59
                ),
                
                
                
            );
		
            
            echo CJSON::encode($results);
	}
        
        public function actionList()
	{
		$this->render('list');
	}

        
        public function actionView()
	{
		$this->render('view');
	}
        
         public function actionMiaoSha()
	{
		$this->render('miaosha');
	}
        
        
         public function actionCollect()
	{
		$this->render('collect');
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.=>
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.=>
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}