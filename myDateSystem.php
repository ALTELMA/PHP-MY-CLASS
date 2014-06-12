<?php

/**
 *
 * FileName : mydatesystem.php
 * Author : Phongthorn Kumkankaew
 * Create Date : 18/10/2555
 * Update Date : 30/5/2557
 * 
 * version : 0.0.3
 * Description
 * - Add new method "normalDate" use to generate str date for international language
 * - Fixed to use string from @str_Month for system multi language
 *
 */
 
class MyDateSystem{

	private $day;
	private $month;
	private $year;
	private $th_year;

	private $hour;
	private $minute;
	private $second;

	public $str_Month = array(
	    1 => array(
	        'en' => 'January',
	        'th' => 'มกราคม',
	        'sth' => 'ม.ค.'
	    ),
	    2 => array(
	        'en' => 'Febuary',
	        'th' => 'กุมภาพันธ์',
	        'sth' => 'ก.พ.'
	    ),
	    3 => array(
	        'en' => 'March',
	        'th' => 'มีนาคม',
	        'sth' => 'มี.ค.'
	    ),
	    4 => array(
	        'en' => 'April',
	        'th' => 'เมษายน',
	        'sth' => 'เม.ย.'
	    ),
	    5 => array(
	        'en' => 'May',
	        'th' => 'พฤษภาคม',
	        'sth' => 'พ.ค.'
	    ),
	    6 => array(
	        'en' => 'June',
	        'th' => 'มิถุนายน',
	        'sth' => 'มิ.ย.'
	    ),
	    7 => array(
	        'en' => 'July',
	        'th' => 'กรกฎาคม',
	        'sth' => 'ก.ค.'
	    ),
	    8 => array(
	        'en' => 'August',
	        'th' => 'สิงหาคม',
	        'sth' => 'ส.ค.'
	    ),
	    9 => array(
	        'en' => 'September',
	        'th' => 'กันยายน',
	        'sth' => 'ก.ย.'
	    ),
	    10 => array(
	        'en' => 'October',
	        'th' => 'ตุลาคม',
	        'sth' => 'ต.ค.'
	    ),
	    11 => array(
	        'en' => 'November',
	        'th' => 'พฤศจิกายน',
	        'sth' => 'พ.ย.'
	    ),

	    12 => array(
	        'en' => 'December',
	        'th' => 'ธันวาคม',
	        'sth' => 'ธ.ค.'
	    ),
	);

	// Method to split date and seperate it.
	public function splitDateTime($input){

		$splitDateTime = explode(' ', $input);
		$splitDate = !empty($splitDateTime[0])?explode('-', $splitDateTime[0]):'';
		$splitTime = !empty($splitDateTime[1])?explode(':', $splitDateTime[1]):'';

		// SETUP VARIABLE
		// DATE
		$this->day = !empty($splitDate[2])?(int)$splitDate[2]:'';
		$this->month = !empty($splitDate[1])?(int)$splitDate[1]:'';
		$this->year = !empty($splitDate[0])?(int)$splitDate[0]:'';;
		$this->th_year = !empty($splitDate[0])?(int)$splitDate[0] + 543:'';

		// TIME
		$this->hour = !empty($splitTime[0])?$splitTime[0]:'';
		$this->minute = !empty($splitTime[1])?$splitTime[1]:'';
		$this->second = !empty($splitTime[2])?$splitTime[2]:'';
		$this->fullTime = !empty($splitDateTime[1])?$splitDateTime[1]:'';
	}

	// Method to change data to default format
	public function restoreDate($delimiter, $input){
		
		$defaultFormat = date('Y-m-d', strtotime(str_replace($delimiter,'-',$input)));
		
		return $defaultFormat;
	}

	// Method to change data to thai format
	public function thaiDate($input, $format = 1, $hasTime = FALSE){

		if($input != '0000-00-00' && $input != '0000-00-01'){

			$this->splitDateTime($input);

			if($format == 1){
				if($hasTime){
					$newFormat = $this->day.' '.$this->str_Month[$this->month]['sth'].' '.$this->th_year.' เวลา '.$this->fullTime.' น.';
				}else{
					$newFormat = $this->day.' '.$this->str_Month[$this->month]['sth'].' '.$this->th_year;
				}
			}elseif($format == 2){
				if($hasTime){
					$newFormat = $this->day.' '.$this->str_Month[$this->month]['th'].' พ.ศ. '.$this->th_year.' เวลา '.$this->fullTime.' น.';
				}else{
					$newFormat = $this->day.' '.$this->str_Month[$this->month]['th'].' พ.ศ. '.$this->th_year;
				}
			}elseif($format == 3){
				if($hasTime){
					$newFormat = $this->str_Month[$this->month]['th'].' พ.ศ. '.$this->th_year.' เวลา '.$this->fullTime.' น.';
				}else{
					$newFormat = $this->str_Month[$this->month]['th'].' พ.ศ. '.$this->th_year;
				}
			}

			return $newFormat;
		}

		return;
	}

	// Method to change data to normal format
	public function normalDate($input, $format = 1, $hasTime = FALSE){

		if(!empty($input)){

			$this->splitDateTime($input);

			if(!empty($this->day) && !empty($this->month) && !empty($this->year)){

				if($format == 1){
					if($hasTime){
						$newFormat = $this->day.' '.$this->str_Month[$this->month]['en'].' '.$this->year.' '.$this->fullTime;
					}else{
						$newFormat = $this->day.' '.$this->str_Month[$this->month]['en'].' '.$this->year;
					}
				}elseif($format == 2){
					if($hasTime){
						$newFormat = $this->str_Month[$this->month]['en'].' '.$this->year.' '.$this->fullTime;
					}else{
						$newFormat = $this->str_Month[$this->month]['en'].' '.$this->year;
					}
				}

				return $newFormat;
			}
		}

		return;
	}
}
?>
