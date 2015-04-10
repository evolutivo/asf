<?php
// Backup Options
$nusantara_options[] = array( "name" => __('Backup Options','nusantara'),
					"type" => "heading");

$nusantara_options[] = array(
    "std" => __('<div class="bigo">Backup your options !</div>                                                        
                      <p class="intro-admin centering">You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.</p>
                 <div class="clear"></div>', 'nusantara'),
    "type" => "info"
);
					
$nusantara_options[] = array( 
    "name" => __('Backup and restore your last configurations','nusantara'),
    "id" => "nusantara_backup",
    "std" => "",
    "desc" => "",
    "type" => "backup",
);