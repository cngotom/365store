<?php

//demo:test/TestPrint/1/2/3

class TestController extends GController{
	public function actionIndex(){
		
	}
	public function actionTestPrint($a,$b,$c){
		echo "===TestPrint=======<br/>";
		echo "===a==== $a ==<br/>";
		echo "===b==== $b ==<br/>";
		echo "===c==== $c ==<br/>";	

		
	}
}
