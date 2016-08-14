<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time {

	public function diff_second($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = $e-$s;
		return $result;
	}
	
	public function diff_minute($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = ($e-$s) / 60;
		return $result;
	}
	
	public function diff_hour($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = ($e-$s)/3600;
		return $result;
	}
	
	public function diff_day($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = ($e-$s)/(3600*24);
		return $result;
	}
	
	public function diff_month($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = ($e-$s)/(3600*24*30);
		return $result;
	}	

	public function diff_year($start,$end){
		$s =	strtotime($start);
		$e =	strtotime($end);

		$result = ($e-$s)/(3600*24*30*12);
		return $result;
	}

	/*Work Time*/
	
	public function timediff_workhour($start,$end){
		$s =	explode(':',$start);
		$e =	explode(':',$end);

		$min = $e[1]-$s[1];

		if( ($e[0] <= 12 && $s[0] <= 12) || ($e[0] >= 13 && $s[0] >= 13) ){
				$breaktime = 0;
			}else{
				$breaktime = 1;
			}

		if($min < 0){
				$min += 60;
				$breaktime += 1;
			}

		$hour = $e[0]-$s[0]-$breaktime;
		$min = floor(($min/60)*100);

		$result = $hour.'.'.$min;
		return $result;
	}	

	public function timediff_workday($start,$end){
		$s =	explode(':',$start);
		$e =	explode(':',$end);

		$min = $e[1]-$s[1];

		if( ($e[0] <= 12 && $s[0] <= 12) || ($e[0] >= 13 && $s[0] >= 13) ){
				$breaktime = 0;
			}else{
				$breaktime = 1;
			}

		if($min < 0){
				$min += 60;
				$breaktime += 1;
			}

		$hour = $e[0]-$s[0]-$breaktime;
		$min = floor(($min/60)*100);

		$result = $hour.'.'.$min;
		return $result/8;
	}

}