<?php
/**
 * GPageCommonLog
 * PV，性能日志等常用日志记录
 * @author evenzhang
 */
class GPageCommonLog {
	private static $startTime = - 1;
	private static $stopTime = - 1;
	/**
	 * writePVLog
	 * 记录PV日志，不包含性能记录
	 */
	public static function writePVLog() {
		if (isset ( $_SESSION ['GROUTER_FIRST_QUEST'] )) {
			$logType = 'COMMON-PV';
			$userAgent = '';
		} else {
			//第一次进来采集浏览器信息
			$_SESSION ['GROUTER_FIRST_QUEST'] = true;
                        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
			$userAgent = $_SERVER ['HTTP_USER_AGENT'].' refer:'.$referer;
			$logType = 'FIRST-PV';
		}
		session_commit ();
		$log = array ($logType, date ( 'Y-m-d H:i:s' ), $_SERVER ['REMOTE_ADDR'] . ':' . $_SERVER ['REMOTE_PORT'], PAGE_KEY, 'guest', count ( $_POST ) > 0 ? 'POST' : 'GET', (isset($_SERVER ['HTTP_X_REQUESTED_WITH'])&&strlen ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) > 0) ? 'AJAX' : 'PAGE', session_id (), $_SERVER ['REQUEST_URI'], $userAgent );
		self::log ( 'pv_', $log );
	}
	/**
	 * log
	 * 记录LOG日志
	 * @param string $key     日志文件前缀
	 * @param string $logInfo 日志信息
	 */
	private static function log($key, $log) {
		$logInfo = "";
		if (is_array ( $log )) {
			foreach ( $log as $item ) {
				$logInfo .= $item . "\t";
			}
		}
		$handle = fopen ( ROOT_PATH . 'data/log/' . $key . '_' . date ( 'Ymd' ) . '.log', 'a' );
		fwrite ( $handle, $logInfo . "\r\n" );
		fclose ( $handle );
	}
	
	////////////////////////// 性能 ////////////////////////////////////////
	public static function start() {
		if (self::$startTime < 0) {
			self::$startTime = self::get_microtime ();
		}
	}
	private static function get_microtime() {
		list ( $usec, $sec ) = explode ( ' ', microtime () );
		return (( float ) $usec + ( float ) $sec);
	}
	/**
	 * writePerformanceLog
	 * 记录性能日志	 
	 */
	public static function writePerformanceLog() {
		$stopTime = self::get_microtime ();
		$timeSpan = round ( ($stopTime - self::$startTime) * 1000, 2 );
		$log = array (date ( 'Y-m-d H:i:s' ), $_SERVER ['REMOTE_ADDR'], 'guest', count ( $_POST ) > 0 ? 'POST' : 'GET', isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) ? 'AJAX' : 'PAGE', self::$startTime, $stopTime, $timeSpan, $_SERVER ['REQUEST_URI'], PAGE_KEY, session_id () );
		self::log ( 'performance_', $log );
	}
}

/**
 * GApplication
 * 应用程序实例,涵盖路由、初始化等
 * @author evenzhang
 *
 */
class GRouter {
	const URLMODE_REWRITE = 1;
	
	private static $m_gPageCommonLog = null;
	private static $m_isDebug = false;
	private static function printDebugInfo($info) {
		if (self::$m_isDebug)
			echo 'GApp:router:' . $info . '<br/>';
	}
	public static function route() {
		self::printDebugInfo ( __FUNCTION__ );
		//单件模式只加载一次
		static $routeResult = null;
		if ($routeResult != null)
			return $routeResult;
		
		//模式处理	
		if (self::isUrlWriteMode ()) {
			$routeResult = self::MVCTypeRoute ();
		} else {
			$routeResult = self::oldshopRoute ();
		}
		return $routeResult;
	}
	
	private static function MVCTypeRoute() {
		self::printDebugInfo ( __FUNCTION__ );
		//解析URL，获取controler和action
		$arr = explode ( '/', $_SERVER ['REQUEST_URI'] );
		$controllerName = ucfirst ( $arr [1] ) . 'Controller';
		if (count ( $arr ) == 2) {
			$actionName = 'Index';
		} else {
			$actionName = ucfirst ( $arr [2] );
		}
		self::printDebugInfo ( $controllerName . '/' . $actionName );
		
		//生成参数列表
		$params = array ();
		for($i = 3; $i < count ( $arr ); $i ++) {
			array_push ( $params, $arr [$i] );
		}
		
		//构造controller对象
		require_once BIN_PATH . 'controller/' . $controllerName . '.class.php';
		$ctrlObj = new $controllerName ();
		//反射调用action
		$class = new ReflectionClass ( $controllerName );
		$setter = $class->getMethod ( 'action' . $actionName );
		$setter->invokeArgs ( $ctrlObj, $params );
		return self::URLMODE_REWRITE;
	}
	private static function oldshopRoute() {
		self::printDebugInfo ( __FUNCTION__ );
                $hostToDir = array('wap' => 'wap',"www"=>'oldshop' ,'m' => 'mobile');
                $host =  explode('.',$_SERVER ['HTTP_HOST']);
                if( array_key_exists($host[0],$hostToDir ))
                    $dirname = $hostToDir[$host[0]];
                //默认定向到oldshop
                else
                    $dirname = "oldshop";
		$arr = explode ( '?', $_SERVER ['REQUEST_URI'] );
		$incFilePath = ROOT_PATH . $dirname . (($arr [0] == '/') ? '/index.php' : $arr [0]);
		return $incFilePath;
	}
	private static function isUrlWriteMode() {
		self::printDebugInfo ( __FUNCTION__ );
		//判断是否是URL重写	
		$requestUrl = $_SERVER ['REQUEST_URI'];
		if ($requestUrl == '/' || stripos ( $requestUrl, '.php?' ) > 0 || stripos ( $requestUrl, '.php' ) == strlen ( $requestUrl ) - 4) {
			return false;
		}
		return true;
	}
	/**
	 * 初始化环境（监控、Session、URL类别）	 
	 */
	private static function initEnv() {
		self::printDebugInfo ( __FUNCTION__ );
		GPageCommonLog::start ();
		
		$m_isDebug = GApp::C('RouterDebug');
		
		defined ( 'PAGE_KEY' ) or define ( 'PAGE_KEY', GApp::createGUID());
		date_default_timezone_set ( 'PRC' );
		if(GApp::C('Debug')==true){
			ini_set("display_errors", "On");
			error_reporting(E_ALL);
		}else{
			error_reporting(0);
		}
	}
	/**
	 * 请求开始	 
	 */
	public static function beginRequest() {
		if (! isset ( $_SESSION ))
			session_start ();
		
		self::printDebugInfo ( __FUNCTION__ );
		self::initEnv ();
		GPageCommonLog::writePvLog ();
	}
	/**
	 * 请求结束	 
	 */
	public static function endRequest() {
		self::printDebugInfo ( __FUNCTION__ );
		GPageCommonLog::writePerformanceLog ();
	
	}
}

class GApplication {
	const PATH_ROOT = ROOT_PATH;
	const PATH_BIN = BIN_PATH;
	const PATH_GLIB = GLIB_PATH;
	
	static function C($key) {
		$config = include ROOT_PATH . 'config/Globle.class.php';
		
		if (isset ( $config [$key] ))
			return $config [$key];
		throw new Exception ( 'CApp::C("' . $key . '")不存在' );
	}
	
	static function createGUID() {
		if (function_exists ( 'com_create_guid' )) {
			return strtoupper ( dechex ( time () ) . substr ( md5 ( com_create_guid () ), 8, 16 ) );
		} else {
			return strtoupper ( dechex ( time () ) . substr ( md5 ( uniqid ( rand (), true ) ), 8, 16 ) );
		}
	}
}
/**
 * GApplication 短名称
 * @author evenzhang
 *
 */
class GApp extends GApplication {
}

/**
 * 控制器基类，限定必须有默认action -> actionIndex
 * @author evenzhang
 */
abstract class GController {
	public abstract function actionIndex();
}