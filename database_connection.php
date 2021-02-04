<?php

//database_connection.php

$connect = new PDO("mysql:host=remotemysql.com;dbname=EYkMccsrdC;charset=utf8mb4", "EYkMccsrdC", "3nlczbMrJV");
date_default_timezone_set('Asia/Karachi');

function fetch_user_last_activity($user_id, $connect)
{
	$query = "
	SELECT * FROM login_details 
	WHERE user_id = '$user_id' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['last_activity'];
	}
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $from_user_id)
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em style="color:red;">This message has been removed</em>';
				$user_name = '<b style="font-family:Lucida Sans Typewriter;color:#000">You</b>';
			}
			else
			{
				$chat_message = $row['chat_message'];
				$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b style="font-family:Lucida Sans Typewriter;color:#000">You</b>';
			}
			$dynamic_background = 'background: #ebebeb none repeat scroll 0 0;border-radius: 3px;color: #646464;margin: 26px 0 26px;padding: 5px 10px 5px 12px;font-family:Lucida Sans Typewriter;color:#000;width:80%; margin-left:20%';
		
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em style="color:red;">This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b style="font-family:Lucida Sans Typewriter;color:#000;">'.get_user_name($row['from_user_id'], $connect).'</b>';
			
			$dynamic_background = 'font-family:Lucida Sans Typewriter;background: #05728f none repeat scroll 0 0;border-radius: 3px;color: #fff;margin: 2px 0 22px;padding: 5px 8px 5px 10px;width: 80%;';
	
		}
		$output .= '
		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:9px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.'
				<div align="right">
					<small><span style="color: #000;font-size: 12px;margin: 6px 0 0;">'.$row['timestamp'].'</span></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;
}

function get_user_name($user_id, $connect)
{
	$query = "SELECT username FROM login WHERE user_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['username'];
	}
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if($count > 0)
	{
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id, $connect)
{
	$query = "
	SELECT is_type FROM login_details 
	WHERE user_id = '".$user_id."' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}
	}
	return $output;
}

function fetch_group_chat_history($connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE to_user_id = '0'  
	ORDER BY timestamp DESC
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $_SESSION["user_id"])
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em style="color: #747474;font-size: 12px;margin: 6px 0 0;">This message has been removed</em>';
				$user_name = '<b style="font-family:Lucida Sans Typewriter;color:red;">You</b>';
			}
			else
			{
				$chat_message = $row["chat_message"];
				$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b style="font-family:Lucida Sans Typewriter;color:#000">You</b>';
			}
			
			$dynamic_background = 'background-color:#ffe6e6;';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em style="font-family:Lucida Sans Typewriter;color:#red">This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}

		$output .= '

		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.' 
				<div align="right">
					- <small><span style="color:#fff;font-size: 12px;margin: 6px 0 0;">'.$row['timestamp'].'</span></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	return $output;
}


?>
