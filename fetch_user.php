
<style>

.order {
  position: absolute;
  margin:3px;

  width: 15px;
  line-height: 15px;
  text-align:centre;
  opacity: 1;
  background: red;
  color:#fff;
  border-radius:50%;
  -webkit-animation: bounce .2s infinite alternate;
  -moz-animation: bounce .1s infinite alternate;
  animation: bounce .4s infinite alternate;
  box-shadow: #000 0 -1px 6px 1px, inset #600 0 -1px 7px, #F00 0 2px 10px;
}
@-webkit-keyframes bounce {
  to { -webkit-transform: scale(1.2); }
}
@-moz-keyframes bounce {
  to { -moz-transform: scale(1.2); }
}
@keyframes bounce {
  to { transform: scale(1.2); }
}

.success{
  position: absolute;
  margin:3px;

  width: 15px;
  line-height: 15px;
  text-align:centre;
  opacity: 1;
  background: green;
  color:#fff;
  border-radius:50%;
  -webkit-animation: bounce .2s infinite alternate;
  -moz-animation: bounce .1s infinite alternate;
  animation: bounce .4s infinite alternate;
  box-shadow: #000 0 -1px 6px 1px, inset #600 0 -1px 7px,  0 2px 10px;}
@-webkit-keyframes bounce {
  to { -webkit-transform: scale(1.2); }
}
@-moz-keyframes bounce {
  to { -moz-transform: scale(1.2); }
}
@keyframes bounce {
  to { transform: scale(1.2); }
}
.start_chat {
  display: block;
  width: 200px;
  height: 40px;
  line-height: 40px;
  font-size: 18px;
  font-family: sans-serif;
  text-decoration: none;
  color: #333;
  border: 2px solid #333;
  letter-spacing: 2px;
  text-align: center;
  position: relative;
  transition: all .35s;
}

.start_chat span{
  position: relative;
  z-index: 2;
}

.start_chat:after{
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background-color: #a4508b;
background-image: linear-gradient(326deg, #a4508b 0%, #5f0a87 74%);

  color:white;
  transition: all .51s;
}

.start_chat:hover{
	font-family: sans-serif;
	color:white;
}

.start_chat:hover:after{
  width: 100%;
}


</style>

<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM login 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="success">.</span>';
	}
	else
	{
		$status = '<span class="order">.</span>' ;
	}
	$output .= '
	<tr class="table-cell">
		<td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'"><span>Start Chat</span></button></td>
		<td></td>


		</tr>
	';
}

$output .= '</table>';

echo $output;

?>