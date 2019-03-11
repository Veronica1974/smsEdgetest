<?php

class Model_Main extends Model
{
	
    public function GetDateFromSendLog($from_date, $to_date, $cnt_id = null, $user_id = null){	
        $usr_sql = '';
        $cnt_sql = '';
        $data = array();
        if(!empty($user_id) && is_numeric($user_id) ){
            $usr_sql = "AND sl.usr_id = '".$user_id."'";
        }
        
        if(!empty($cnt_id) && is_numeric($cnt_id) ){
            $cnt_sql = "AND c.cnt_id = '".$cnt_id."'";
        }
        $sql_select = "SELECT c.cnt_title,
         u.usr_name , 
         COUNT(IF (log_success=1, 1, null)) as success, 
         COUNT(IF( log_success=0, 1, null)) as faild, log_created
         FROM send_log sl
         INNER JOIN users u ON u.usr_id = sl.usr_id
         INNER JOIN numbers n ON n.num_id = sl.num_id
         INNER JOIN countries c ON c.cnt_id = n.cnt_id
         WHERE sl.log_created BETWEEN '".$from_date."' AND '".$to_date."' ".$usr_sql."  ".$cnt_sql."
         GROUP BY sl.log_created , sl.usr_id
         ORDER BY sl.log_created ";
		$res = $this->select($sql_select);
		if(!empty($res)){
		    $data = $this->arrForDisplay($res, $from_date, $to_date, $cnt_id, $user_id);
		}
		
		//return $sql_select;
		//return $res;
		return $data;
			
			
	}
	
	
	private function arrForDisplay($res, $from_date, $to_date, $cnt_id = null, $user_id = null){
	    $data['usr_name'] = "";
	    $data['cnt_title'] =  "";
	    $data['from_date'] = $from_date;
	    $data['to_date'] =  $to_date;
	    $data['date'] = array();
	    $cc_res = count($res);
	    
	    if(!empty($cnt_id) && !empty($user_id)){
	        $data['usr_name'] = $res[0]['usr_name'];
	        $data['cnt_title'] =  $res[0]['cnt_title'];
	       
	        for($i=0; $i<$cc_res;$i++){
	            $data['date'][$i]['log_created'] = $res[$i]['log_created'];
	            $data['date'][$i]['success'] = $res[$i]['success'];
	            $data['date'][$i]['fail'] = $res[$i]['faild'];
	        }
	    }elseif(!empty($cnt_id) && empty($user_id)){
	        $data['cnt_title'] =  $res[0]['cnt_title'];
	        
	        for($i=0; $i<$cc_res;$i++){
	            $data['date'][$i]['usr_name'] = $res[$i]['usr_name'];
	            $data['date'][$i]['log_created'] = $res[$i]['log_created'];
	            $data['date'][$i]['success'] = $res[$i]['success'];
	            $data['date'][$i]['fail'] = $res[$i]['faild'];
	        }
	    }elseif(empty($cnt_id) && !empty($user_id)){
	        $data['usr_name'] = $res[0]['usr_name'];
	        
	        for($i=0; $i<$cc_res;$i++){
	            $data['date'][$i]['countries'] =  $res[$i]['cnt_title'];
	            $data['date'][$i]['log_created'] = $res[$i]['log_created'];
	            $data['date'][$i]['success'] = $res[$i]['success'];
	            $data['date'][$i]['fail'] = $res[$i]['faild'];
	        }
	    }else{
	        for($i=0; $i<$cc_res;$i++){
	            $data['date'][$i]['countries'] =  $res[$i]['cnt_title'];
	            $data['date'][$i]['usr_name'] = $res[$i]['usr_name'];
	            $data['date'][$i]['log_created'] = $res[$i]['log_created'];
	            $data['date'][$i]['success'] = $res[$i]['success'];
	            $data['date'][$i]['fail'] = $res[$i]['faild'];
	        }
	    }
	    return $data;
	}
	
	
	public function __call($method, $args) {
	  
	    if(isset($method)) {
	       
	        if(isset($args[0]) && isset($args[1]) && isset($args[2]) ){
	            if(is_array($args[1]) ){
	                $select_list = implode(',', $args[1]);
	            }else{
	                $select_list = $args[1];
	            }
	            $sql_select = "SELECT DISTINCT ".$select_list." FROM ".$args[0]." ORDER BY ".$args[2];
	           
	            $res = $this->select($sql_select);
	            return $res;
	        }
	        
	    }
	    return false;
	}
}
