<?php
//==========================================================================================
// Name : class.counter.statistic.php
// Author : Phongthorn Kumkankaew
// Coptright : @phongthorn kumkankaew 2012
// Date : 2012/01/09
//==========================================================================================
class Statistic_Counter{
	
	// PROPERTIES
	public $last_month;
	public $this_month;
	public $last_week;
	public $yesterday;
	public $today;
	
	// GET LAST_MONTH
	private function get_CountLastMonth($CountLastMonth){
		$this->last_month = $CountLastMonth;
	}
	
	// GET THIS_MONTH
	private function get_CountThisMonth($CountThisMonth){
		$this->this_month = $CountThisMonth;
	}
	
	// GET LAST WEEK
	private function get_CountLastWeek($CountLastWeek){
		$this->last_week = $CountLastWeek;
	}
	
	// GET YESTERDA
	private function get_CountYesterday($CountYesterday){
		$this->yesterday = $CountYesterday;
	}
	
	// GET TODAY COUNTER
	private function get_CountToday($CountDay){
		$this->today = $CountDay;
	}
	
	// =====================================================================================	
	// UPDATE LAST MONTH
	public function set_LastMonthCount(){
		
		$sql = "SELECT SUM(view_counter) AS lastMonthCount FROM counter WHERE DATE_FORMAT(DATE, '%y-%m') = '".date('Y-m', strtotime('-1 month'))."'";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$this->get_CountLastMonth($row['lastMonthCount']);
		if($row['lastMonthCount'] == ''){$this->get_CountLastMonth(0);}
	}
	
	// UPDATE THIS MONTH
	public function set_ThisMonthCount(){
		
		$sql = "SELECT SUM(view_counter) AS thisMonthCount FROM counter WHERE DATE_FORMAT(DATE, '%y-%m') = '".date('y-m')."'";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$this->get_CountThisMonth($row['thisMonthCount']);
		if($row['thisMonthCount'] == ''){$this->get_CountThisMonth(0);}
	}
	
	// UPDATE LAST WEEK
	public function set_LastWeek(){
		
		$sql = "SELECT SUM(view_counter) AS lastWeekCount FROM counter WHERE date BETWEEN '".date('Y-m-d', strtotime('-7 day'))."' AND '".date('Y-m-d', strtotime('-1 day'))."'";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$this->get_CountLastWeek($row['lastWeekCount']);
		if($row['lastWeekCount'] == ''){$this->get_CountLastWeek(0);};
	}
	
	// UPDATE YESTERDAY
	public function set_PreviousDay(){
		
		$sql = "SELECT SUM(view_counter) AS yesterdayCount FROM counter WHERE date = '".date('Y-m-d', strtotime('-1 day'))."'";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$this->get_CountYesterday($row['yesterdayCount']);
		if($row['yesterdayCount'] == ''){$this->get_CountYesterday(0);};
	}
	
	// UPDATE TODAY
	public function set_TodayCount(){
		
		$sql = "SELECT * FROM counter WHERE date = CURRENT_DATE();";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		$rowcount = mysql_num_rows($query);
		
		if($rowcount == 0){
			$this->get_CountToday(1);
			$sql = "INSERT INTO counter VALUES(CURRENT_DATE(), $this->today)";
		}else{
			$new_counter = $row['view_counter'] + 1;
			$this->get_CountToday($new_counter);
			$sql = "UPDATE counter SET view_counter = $this->today WHERE date = CURRENT_DATE();";
		}
		$update = mysql_query($sql);
	}	
}
?>
