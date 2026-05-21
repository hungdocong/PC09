<?php 
if (!function_exists('getCountDay')) {
    function getCountDay($ngay_bd, $ngay_kt)    
	{           
		$hieu_so = abs(strtotime($ngay_kt) - strtotime($ngay_bd));  

        $nam = floor($hieu_so / (365*60*60*24));  
        $thang = floor(($hieu_so - $nam * 365*60*60*24) / (30*60*60*24));  
        $ngay = floor(($hieu_so - $nam * 365*60*60*24 - $thang*30*60*60*24)/ (60*60*24));

        return $ngay; 
	}
}

if (!function_exists('getDatesFromRange')) {
	function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
		
    // Declare an empty array 
		$array = array(); 
		
    // Variable that store the date interval 
    // of period 1 day 
		$interval = new DateInterval('P1D'); 
		
		$realEnd = new DateTime($end); 
		$realEnd->add($interval); 
		
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
		
    // Use loop to store date into array 
		foreach($period as $date) {                  
			$array[] = $date->format($format);  
		} 
		
    // Return the array elements 
		return $array; 
	} 
}