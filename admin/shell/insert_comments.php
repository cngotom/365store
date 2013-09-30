<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//.die("No rights");
define('IN_ECS', true);
require('../includes/init_1.php');

$start_time = 1334805741;
$now_time = 1350357741 ;

function rand_times($count,$beg,$end)
{

    
    $times = array();
    $start_time = rand($beg,$end);
    array_push( $times,$start_time );
    $add_day = rand(50,300);
   $current = $start_time;
    for($i=0; $i <$count -1 ; ++$i)
    {
        $current =   $current + $i * sqrt($i) * sqrt($add_day) * $add_day ;
        if($current > $end)
        {
                $current = $end;
        }
       array_push( $times, $current );
    }
    return $times;
}


function get_all_comments($filename)
{
        global $ecs;
        $line_number = 0;
        $file = fopen($filename,'r');
        $comment_list = array();
        while ($line = fgetcsv($file))
        {
            // 跳过第一行
            if ($line_number < 1)
            {
                $line_number++;
                continue;
            }
            else{
                $line_number++;
            }

            $line_list = array();
            if (($_POST['charset'] == 'GB2312') && (strpos(strtolower(EC_CHARSET), 'utf') == 0))
            {
                
                foreach($line as $key =>$value)
                {
                    $line_list[$key] = ecs_iconv($_POST['charset'], 'UTF8', $value);
                    
                }
            }
            else
            {
                $line_list = $line;
            }
       
             $arr['id_value'] = trim($line_list[0]);
             $arr['user_name'] = addslashes(trim($line_list[1]));
             $arr['comment_rank'] = trim($line_list[2]);
             $arr['content'] = addslashes(trim($line_list[3]));
             
            
           // $arr['content'] = substr( $arr['content'] , strpos($arr['content'], '：') +2  );
            
         
             $arr['status'] =1;

             
             
             if( $comment_list[  $arr['id_value']  ]  ) {
                 $comment_list[  $arr['id_value']  ] []  = $arr;
             }
             else {
                 $comment_list[  $arr['id_value']  ] = array() ;
                 $comment_list[  $arr['id_value']  ] []  = $arr;
             }
      }
      return $comment_list;
    
}
$comment_list = get_all_comments("../data/a.csv");
foreach($comment_list as $key => $val )
{
    $size = count($val);
    $times =  rand_times($size,$start_time,$now_time);
    foreach($val as $index => $comment)
    {
        $comment['add_time'] = $times[$index];
        
         $db->autoExecute($ecs->table('comment'), $comment, 'INSERT');
       # print_r($comment);
    }
 
}


exit();

foreach( rand_times(50,$start_time,$now_time) as $time )
{
    echo date("Y-M-d h:m:s",$time)."\n";
}

$db->autoExecute($ecs->table('goods'), $field_arr, 'INSERT');

?>
