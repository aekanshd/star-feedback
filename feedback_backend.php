<?php
/*
  _   _                                                _     _   _            _ _                    __                                         _    _                             _       _   
 | | | |_ __   ___ ___  _ __ ___  _ __ ___   ___ _ __ | |_  | |_| |__   ___  | (_)_ __   ___  ___   / _| ___  _ __    __ _  __      _____  _ __| | _(_)_ __   __ _   ___  ___ _ __(_)_ __ | |_ 
 | | | | '_ \ / __/ _ \| '_ ` _ \| '_ ` _ \ / _ \ '_ \| __| | __| '_ \ / _ \ | | | '_ \ / _ \/ __| | |_ / _ \| '__|  / _` | \ \ /\ / / _ \| '__| |/ / | '_ \ / _` | / __|/ __| '__| | '_ \| __|
 | |_| | | | | (_| (_) | | | | | | | | | | |  __/ | | | |_  | |_| | | |  __/ | | | | | |  __/\__ \ |  _| (_) | |    | (_| |  \ V  V / (_) | |  |   <| | | | | (_| | \__ \ (__| |  | | |_) | |_ 
  \___/|_| |_|\___\___/|_| |_| |_|_| |_| |_|\___|_| |_|\__|  \__|_| |_|\___| |_|_|_| |_|\___||___/ |_|  \___/|_|     \__,_|   \_/\_/ \___/|_|  |_|\_\_|_| |_|\__, | |___/\___|_|  |_| .__/ \__|
                                                                                                                                                             |___/                  |_|        
																			copyright Aekansh Dixit 2016.

*/

//include_once("dbconnect.php");

if(isset($_GET['star']) && isset($_GET['user']))
{
	$rating = $_GET['star'];
	$user_id = $_GET['user'];
	// $ratingq = mysql_query("INSERT INTO `ratings` (`rating_id`, `rating`, `feedback`, `by_user`) VALUES (NULL, '" . $rating . "', " . (($rating==5)?"'User gave 5 stars.'":"NULL") . ", '" . $user_id . "')");
	// if(mysql_affected_rows()>= 0)
	// {
		 $response_array['status'] = "success";
	// }
	// else
	// {
	// 	 $response_array['status'] = "Oops. Something went wrong. We'll try that next time! Promise.";
	// }
}
else if(isset($_GET['feedback']) && isset($_GET['user']))
{
	$feedback = mysql_escape_string($_GET['feedback']);
	$user_id = $_GET['user'];
	// $ratingq = mysql_query("UPDATE `ratings` SET `feedback` = '" . $feedback . "' WHERE `by_user` = '" . $user_id . "'");
	// if(mysql_affected_rows()>= 0)
	// {
		 $response_array['status'] = "success";
	// }
	// else
	// {
	// 	 $response_array['status'] = "Oops. Something went wrong. We'll try that next time! Promise.";
	// }
}

echo json_encode($response_array);
?>