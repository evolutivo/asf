<?php
$nusantara_options[] = array(
    "name" => __('Papua Home', 'nusantara'),
    "type" => "heading"
);

//PAPUA home page section
$nusantara_options[] = array(
    "std" => __('<div class="bigo">PAPUA HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "homepage_sabang",
    "std" => $nusantara_homepage_sabang,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_papuaside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('<b>Padding</b>', 'nusantara'),
    "id" => "nusantara_pnpt",
    "fold" => "nusantara_remove_papuaside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);