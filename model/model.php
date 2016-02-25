<?php
class model {
	
	protected $db;
	
	public function __construct() {
		$this->db = mysql_connect(HOST,USER,PASSWORD);
		if(!$this->db) {
			exit("Ошибка соединения с базой данных".mysql_error());
		}
		if(!mysql_select_db(DB,$this->db)) {
			exit("Нет такой базы данных".mysql_error());
		}
		mysql_query("SET NAMES 'UTF8'");
		
	}
	
	public function get_left_bar(){
		$query = "SELECT id_category,name_category FROM category";
		
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		for($i = 0;$i < mysql_num_rows($result); $i++) {
			$row[] = mysql_fetch_array($result, MYSQL_ASSOC);
		}
		
		return $row;
	}
	
	public function menu_array() {
		$query = "SELECT id_menu,name_menu FROM menu";
		
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		$row = array();
		
		for($i = 0;$i < mysql_num_rows($result); $i++) {
			$row[] = mysql_fetch_array($result, MYSQL_ASSOC);
		}
		return $row;
	}
	
	public function get_main_content() {
		
		$query = "SELECT id,title,discription,date,img_src FROM statti ORDER BY date DESC";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		
		return $row;
	}
	
	public function get_cat($id_cat) {
		
		$query = "SELECT id,title,discription,date,img_src 
							FROM statti 
							WHERE cat='$id_cat' 
							ORDER BY date DESC";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
				
				$row = array();
				for($i = 0; $i < mysql_num_rows($result);$i++) {
					$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
						
				}
				return $row;
	}
	
	public function get_menu($id_menu) {
		$query = "SELECT id_menu,name_menu,text_menu FROM menu WHERE id_menu='$id_menu'";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
			return $row;	
	}
	
	
}
?>