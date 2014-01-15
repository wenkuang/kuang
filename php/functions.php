<?php
//获取两个时间之间的所有月份 $date1 = 2013-01-01 ;$date2 = 2013-03-23
function get_months($date1, $date2) {  
   $time1  = strtotime($date1);  
   $time2  = strtotime($date2);  
   $my     = date('n-Y', $time2);  
   $mesi = array(1,2,3,4,5,6,7,8,9,10,11,12); 
   $months = array();  
   $f      = '';  
   while($time1 < $time2) {  
      if(date('n-Y', $time1) != $f) {  
         $f = date('n-Y', $time1);  
         if(date('n-Y', $time1) != $my && ($time1 < $time2)) { 
             $str_mese=$mesi[(date('n', $time1)-1)]; 
             if($str_mese < 10){
                 $str_mese = "0$str_mese";
             }
            $months[] = date('Y', $time1) . "$str_mese";  
         } 
      }  
      $time1 = strtotime((date('Y-n-d', $time1).' +15days'));  
   }  

   $str_mese=$mesi[(date('n', $time2)-1)]; 
   if($str_mese < 10){
         $str_mese = "0$str_mese";
   }
   $months[] = date('Y', $time2) .$str_mese;  
   return $months;  
}  
$date1 = "2013-08-01";
$date2 = "2014-02-01";
print_r(get_months($date1, $date2));
