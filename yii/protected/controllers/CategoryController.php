<?php

class CategoryController extends Controller
{
        public $layout ='sub';
	public $title = '商品列表';
        
        private function getCatLocation($id,$is_goods = false)
        {
            
                $title = "";
                $goods_name = "";
                $goods_id = $id;
                //如果是产品而非分类，先查询分类名
                if($is_goods)
                {
                        $goods =  Goods::model()->find(
                            array( 'condition'=> 'goods_id=:goods_id ',   
                                    'params'=>array(
                                        ":goods_id"=>intval($id),
                                    ) ,
                                "select"=>'goods_id,goods_name,cat_id',
                            )
                        );
                        $goods_name = $goods->goods_name;
                        $id = $goods->cat_id;
                    
                }
                
                
                
                
                
                $cat =  Category::model()->find(
                     array( 'condition'=> 'cat_id=:cat_id ',   
                            'params'=>array(
                                ":cat_id"=>intval($id),
                            ) ,
                          "select"=>'cat_name,parent_id',
                     )
                );
                
                //一级分类
                if($cat->parent_id == 0)
                {
                    if(!$is_goods)
                        $title = $cat->cat_name;
                    else{
                        $parent_cat_url = $this->createUrl('index',array('id'=>$id));
                        $parent_name = $cat->cat_name;
                        $title =  " <a href= '$parent_cat_url'>$parent_name </a> &gt;&nbsp; "   . $goods_name;
                    }
                }
                //二级分类
                else{
                    //获取一级分类
                    $parent_cat = Category::model()->find(
                     array( 'condition'=> 'cat_id=:cat_id ',   
                            'params'=>array(
                                ":cat_id"=>intval($cat->parent_id),
                            ) ,
                          "select"=>'cat_name',
                     )
                   );
                    $parent_cat_url = $this->createUrl('index',array('id'=>$cat->parent_id));
                    $parent_name = $parent_cat->cat_name;
                    if(!$is_goods)
                        $title = " <a href= '$parent_cat_url'>$parent_name </a> &gt;&nbsp; "   . $cat->cat_name ;
                    else{
                         $title = " <a href= '$parent_cat_url'>$parent_name </a> &gt;&nbsp; ";
                         $cat_url = $this->createUrl('index',array('id'=>$id));
                         $cat_name = $cat->cat_name;
                         
                         $title .= " <a href= '$cat_url'>$cat_name </a> &gt;&nbsp; "   . $goods_name ;
                    }
                }
                return $title;
            
        }
        public function actionIndex($id)
	{

                //get children cat_id
              
                $this->title = $this->getCatLocation($id);
                
                
                $children_cat = Category::model()->findAll(
                     array( 'condition'=> 'parent_id=:parent_id and is_show = 1',   
                            'params'=>array(
                                ":parent_id"=>$id,
                            ) ,
                          "select"=>'cat_id',
                     )
                );
                $children_cat_array = array();
                foreach($children_cat as $cat)
                    $children_cat_array[] = $cat->cat_id; 

                
                $criteria=new CDbCriteria();
                $criteria->addCondition("cat_id=$id ");
                $criteria->addInCondition('cat_id', $children_cat_array,'OR'); //代表where id IN (1,23,,4,5,);    
                
                $criteria->select = "goods_id,market_price,shop_price,goods_name,goods_thumb";
                
                //order
                $order_map = array(
                  'goods_id',
                  'click_count',
                  'shop_price',
                );
                $order_int = empty($_GET['order'])?0:intval($_GET['order']) ;
                $order_index = $order_int%3;
                $order = $order_map[ $order_index];
                $sort = new CSort('Goods');
                $sort->defaultOrder="$order desc";
                $sort->applyOrder($criteria);
            
                
                //page
                $count = Goods::model()->on_sale()->count($criteria);
                $pages = new CPagination($count);
                $pages->pageSize = 10;
                $pages->applyLimit($criteria);
                
                
                $goods_list = Goods::model()->on_sale()->findAll($criteria);
                

		$this->render('index',array(
                    "goods_list" => $goods_list,
                    "pages" => $pages,
                    'count' => $count,
                    'order' => $order_index,
                    'id'=>$id,
                    
                ));
	}
        
        public function actionSearch()
        {
            $key = $_GET['keyWord'];
            if(!empty($key))
            {      
                $criteria=new CDbCriteria();
                $criteria->addCondition("goods_name like '%$key%'");
                
                $criteria->select = "goods_id,market_price,shop_price,goods_name,goods_thumb";
                
                //order
                $order_map = array(
                  'goods_id',
                  'click_count',
                  'shop_price',
                );
                $order_int = empty($_GET['order'])?0:intval($_GET['order']) ;
                $order_index = $order_int%3;
                $order = $order_map[ $order_index];
                $sort = new CSort('Goods');
                $sort->defaultOrder="$order desc";
                $sort->applyOrder($criteria);
            
                
                //page
                $count = Goods::model()->on_sale()->count($criteria);
                $pages = new CPagination($count);
                $pages->pageSize = 10;
                $pages->applyLimit($criteria);
                
                
                $goods_list = Goods::model()->on_sale()->findAll($criteria);
                

		$this->render('index',array(
                    "goods_list" => $goods_list,
                    "pages" => $pages,
                    'count' => $count,
                    'order' => $order_index,
                    'id' => 0,
                    'keyWord'=>$key,
                ));
                
                
            }
            else{
                $this->redirect(array('site/index'));
            }
            
        }

        public function actionGoods($id)
	{
              $this->title = $this->getCatLocation($id,true);
   
              $goods = Goods::model()->on_sale()->with('gallery')->find(
                         array( 
                             'condition'=> 't.goods_id=:goods_id',   
                             'params'=>array(
                                  ":goods_id"=>  intval($id),
                              ) ,
                             'select' => 't.goods_id,goods_sn,goods_name,shop_price,market_price',   
                        )
              );
              $comment_count = Comment::model()->count("id_value=$id") ;
              
                    
              $this->render('goods',array(
                    "goods" => $goods,
                    
                    'comment_count'=>$comment_count,
              ));
              
        }
        
        public function actionAllList()
        {
            
            $this->title = '所有分类';
            $cat_list = Category::model()->topList()->findAll();
            
            $this->render('alllist',array('cat_list' => $cat_list));
            
        }
        
        public function actionSubList()
        {
            
            $results = array();
            
            if($_GET['category'])
            {
                $cat_id = intval( $_GET['category'] );
                
                $cat_list = Category::model()->findAll(
                          array( 
                             'condition'=> 'is_show = 1 and parent_id=:parent_id',   
                             'params'=>array(
                                  ":parent_id"=>  $cat_id,
                              ) ,
                             'select' => 'cat_id,cat_name',   
                             'order' => 'sort_order asc'
                        )
                        
               );
                
                foreach($cat_list as $cat)
                {
                    $results[] = array(
                        "cat_id"=>$cat->cat_id,
                        "cat_name"=>$cat->cat_name,  
                    );
                }
             }
            
            
        
		
            
            echo CJSON::encode($results);
            
            
            
            
        }
        
        
         public function actionReview($id)
	{
              $this->title = $this->getCatLocation($id,true);
              $id = intval($id);
              $comment_list = Comment::model()->findAllByAttributes(array('id_value'=>$id));
              $count = count($comment_list);
              $this->render('review',array(
                    'comment_list'=>$comment_list,
                    'id' => $id,
                    'count' => $count,
              ));
        }
        
         public function actionDetail($id)
	{
             $this->title = $this->getCatLocation($id,true);
             $id = intval($id);
             $goods = Goods::model()->on_sale()->find(
                         array( 
                             'condition'=> 'goods_id=:goods_id',   
                             'params'=>array(
                                  ":goods_id"=>  intval($id),
                              ) ,
                             'select' => 'goods_desc',   
                        )
              );
             $comment_count = Comment::model()->count("id_value=$id") ;
             $content = preg_replace('/<img[^>]*\/>/i', "",$goods->goods_desc);
             $content = $goods->goods_desc;
             $this->render('detail',array(
                    'content'=>$content,
                    'id' => $id,
                    'count'=>$comment_count,
             ));
              
        }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
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
		// return external action classes, e.g.:
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