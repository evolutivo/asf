<?php
$nusantara_options[] = array(
    "name" => __('Page Templates', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">Page templates !</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Default Page sections', 'nusantara'),
    "id" => "nusantara_single_page",
    "std" => $nusantara_single_page,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Page three column sections', 'nusantara'),
    "id" => "page_3coloumn",
    "std" => $nusantara_page_3coloumn,
    "type" => "sorter"
);
$nusantara_options[] = array(
    "desc" => __('Ads code on the top', 'nusantara'),
    "id" => "nusantara_adstop_page3column",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "desc" => __('Ads code on the bottom', 'nusantara'),
    "id" => "nusantara_adsbottom_page3column",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "name" => __('Site Map Page sections', 'nusantara'),
    "id" => "nusantara_site_map",
    "std" => $nusantara_site_map,
    "type" => "sorter"
); 