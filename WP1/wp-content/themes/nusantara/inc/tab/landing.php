<?php
$nusantara_options[] = array(
    "name" => __('Home Settings', 'nusantara'),
    "type" => "heading"
);
$nusantara_options[] = array(
    "id" => "",
    "std" => __('<div class=bigo>What type your Homepage?</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Select your width', 'nusantara'),
    "desc" => __('You can choose width your homepage', 'nusantara'),
    "id" => "nusantara_layout_flex",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_selection_width
);


$url = NUSANTARA_DIR . 'assets/';
$nusantara_options[] = array(
    "name" => __('Select your Homepage', 'nusantara'),
    "id" => "nusantara_layout_options",
    "std" => "batavia",
    "type" => "images",
    "options" => array(
        'batavia' => $url . 'batavia.jpg',
        'java' => $url . 'java.jpg',
        'andalas' => $url . 'andalas.jpg',
        'borneo' => $url . 'borneo.jpg',
        'papua' => $url . 'papua.jpg',
        'celebes' => $url . 'celebes.jpg'
    )
);
                                  