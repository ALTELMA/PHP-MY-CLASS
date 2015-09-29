<?php

/*****************************************************************************
* PAGINATION CLASS FLEXIBILITY SETUP v 0.02
******************************************************************************
* Name : class.pagination.setup.php
* Authur : Phongthorn Kumkankaew
* Copy Right : 2011 Phongthorn Kumkankaew
* Date : 14/9/2011
* Edit : 23/12/2011
******************************************************************************
* CHANGELOG v 0.02
******************************************************************************
*
* Fixed method set_TotalRecord.
*
*****************************************************************************/

class pagination_config{

	public $current_page;
	public $limit_page;
	public $start_page;
	public $prev_page;
	public $next_page;
	public $total_record;
	public $total_page;
	public $first_range;
	public $last_range;
	public $mid_range;
	public $url;

	/// Set Pagination Variable ///
	private function set_CurrentPage($page){

		if(isset($_GET[$page])){$current_page = $_GET[$page];}else{$current_page = 1;}
		$this->current_page = $current_page;
		$this->url = $page;
	}
	private function set_LimitPage($limit){

		$this->limit_page = $limit;
	}
	private function set_StartPage(){

		$this->start_page = ($this->current_page - 1) * $this->limit_page;
	}
	private function set_PrevPage(){

		$this->prev_page = $this->current_page - 1;
	}
	private function set_NextPage(){

		$this->next_page = $this->current_page + 1;
	}
	private function set_TotalRecord($string_sql){

		$sql_record = $string_sql;
		$query_record = mysql_query($sql_record);
		$resource_record = mysql_num_rows($query_record);
		$rowcount = $resource_record;

		$this->total_record = $rowcount;
	}
	private function set_TotalPage(){

		$this->total_page = ceil($this->total_record / $this->limit_page);
	}
	private function set_RangePage($range){

		$this->mid_range = $range;
		$this->first_range = $this->current_page - $range;
		if($this->first_range < 1){$this->first_range = 1;}
		$this->last_range = $this->current_page + $range;
		if($this->last_range > $this->total_page){$this->last_range = $this->total_page;}
	}

	/// Set All Initial Value ///
	public function set_InitPage($current_string_page, $limit){

		$this->set_CurrentPage($current_string_page);
		$this->set_LimitPage($limit);
		$this->set_StartPage();
		$this->set_PrevPage();
		$this->set_NextPage();
	}
	/// Set All Second Value ///
	public function set_SecondPage($range,$string_sql){

		$this->set_TotalRecord($string_sql);
		$this->set_TotalPage();
		$this->set_RangePage($range);
	}

	/// Show Pagination information value ///
	public function PageInfo(){

		echo 'CURRENT PAGE : '.$this->current_page.'<br />';
		echo 'LIMIT PAGE : '.$this->limit_page.'<br />';
		echo 'START PAGE : '.$this->start_page.'<br />';
		echo 'TOTAL RECORD : '.$this->total_record.'<br />';
		echo 'TOTAL PAGE : '.$this->total_page.'<br />';
		echo 'RANGE PAGE : '.$this->mid_range.'<br />';
		echo 'FIRST RANGE PAGE : '.$this->first_page.'<br />';
		echo 'LAST RANGE PAGE : '.$this->last_range.'<br />';
	}

	/// This medthod is build page number but it's fixed and used for single param ///
	public function paginator(){

		echo '<div class=\'pageNumA\'><table align=\'right\'>';

		if($this->total_page > 1){

			/// First and Previous Link ///
			if($this->current_page > 1){
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'=1\'>first</a></td>';
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->prev_page.'\'><< </a></td>';
			}

			/// Middle Number page Link ///
			for($i = $this->first_range; $i <= $this->last_range; $i++){
				if($this->current_page == $i){
					echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$i.'\' class=\'select\'>'.$i.'</a></td>';
				}else{
					echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$i.'\' class=\'\'>'.$i.'</a></td>';
				}
			}

			/// Next and End Link ///
			if($this->current_page != $this->total_page){
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->next_page.'\'> >></a></td>';
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->total_page.'\'>last</a></td>';
			}
		}
		echo '</table></div>';
	}

	/// Custom Pagination use when many GET param ///
	///*** Ex. '?page=1&text_search=2&text_date='2011-05-23'' ///
	public function custom_paginator($str_param_link){

		$link_param = $str_param_link;

		echo '<div class=\'pageNumB\'><table align=\'right\'>';

		if($this->total_page > 1){
			if($this->current_page > 1){
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'=1'.$link_param.'\'>first</a></td>';
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->prev_page.$link_param.'\'><< </a></td>';
			}

			for($i = $this->first_range; $i <= $this->last_range; $i++){
				if($this->current_page == $i){
					echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$i.$link_param.'\' class=\'select\'>'.$i.'</a></td>';
				}else{
					echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$i.$link_param.'\' class=\'\'>'.$i.'</a></td>';
				}
			}

			if($this->current_page != $this->total_page){
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->next_page.$link_param.'\'> >></a></td>';
				echo '<td><a href=\''.$_SERVER['SCRIPT_NAME'].'?'.$this->url.'='.$this->total_page.$link_param.'\'>last</a></td>';
			}
		}

		echo '</table></div>';

	}

}
?>
