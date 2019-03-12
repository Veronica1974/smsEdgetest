<?php
$combooptions_countries = "";
$combooptions_users = "";
$combooptions_from_date = "";
$combooptions_to_date = "";

if(!empty($data['countries'])){
    $cc_countries = count($data['countries']);
    for($i = 0; $i<$cc_countries; $i++){
        $combooptions_countries .= "<option value = ".$data['countries'][$i]['cnt_id'].">".$data['countries'][$i]['cnt_title']."</option>";
    }
}
if(!empty($data['users'])){
   $cc_users = count($data['users']);
   for($i = 0; $i<$cc_users; $i++){
       $combooptions_users .= "<option value = ".$data['users'][$i]['usr_id'].">".$data['users'][$i]['usr_name']."</option>";
   }
}
if(!empty( $data['from_date'])){
    $cc_date = count($data['from_date']);
    for($i = 0; $i<$cc_date; $i++){
        $combooptions_from_date .= "<option value = ".$data['from_date'][$i]['log_created'].">".$data['from_date'][$i]['log_created']."</option>";
        $combooptions_to_date .= "<option value = ".$data['from_date'][$i]['log_created'].">".$data['from_date'][$i]['log_created']."</option>";
        
        
    }
}
	
	
?>
<div id="sidebar">
<form>
    <div>				
     Select country code:<br>
    <select id="countries">
    	<option value="0" selected >Select Country</option>
    	<?php echo $combooptions_countries ;?>
    </select>
    <div id="error_countries" class="error"></div>
    </div>
   
     <div>
       Select User Name:<br>
    <select id="users">
    	<option value="0" selected>Select User Name</option>
    	<?php echo $combooptions_users;?>
    </select>
    <div id="error_users" class="error"></div>
    </div>

     <div>
     Seletc start date
     <select id="from_date">
    	<option value="0" selected >From Date</option>
    	<?php echo $combooptions_from_date;?>
    </select>
    <div id = "error_from_date" class="error"></div>
    </div>

    <div>
    Select end Date
    <select id="to_date">
    	<option value="0" selected >To date</option>
    	<?php echo $combooptions_to_date;?>
    </select>
     <div id = "error_to_date" class="error"></div>
    </div>
   
<input type="button" id="button" value="Show Data"><br>
</form>
</div>

<div class="box">
<div class = "error_data_empty"></div>
<div>Country: <span id="country_data_sp"></span></div>
<div>User: <span id="user_data_sp"></span></div>
<div>From: <span id="from_data_sp"></span></div>
<div>To: <span id="to_data_sp"></span></div>
<div class="dataoutput">
<table id="table_data">
<thead>
  <tr>
   <th class="cnt_data">Country</th>
	  <th class="usr_data">User Name</th>
    <th class="log_created">Date</th>
    <th class="success">Successfully sent</th> 
    <th class = "fail">Failed</th>
  </tr>
 </thead>
  <tbody>
  
  </tbody>

</table>

</div>
</div>

