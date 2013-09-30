<?php

class RegionController extends Controller
{
	public function actionGetChildren($parent_id)
	{
           // $list = Region::model()->findAllByAttributes(array('parent_id'=>$parent_id));
            
            $criteria=new CDbCriteria();
            $sort = new CSort('Region');
            $sort->defaultOrder=" region_id asc";
            $sort->applyOrder($criteria);
            $criteria->addCondition('parent_id='.$parent_id);
            $criteria->select = "region_id,region_name";

            $list = Region::model()->findAll($criteria);
            
            $children = array();
            foreach($list as $l)
            {
                $c = array('region_id' => $l->region_id,'region_name'=>$l->region_name);
                $children[] = $c;
            }
            
            echo CJSON::encode($children);
        
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