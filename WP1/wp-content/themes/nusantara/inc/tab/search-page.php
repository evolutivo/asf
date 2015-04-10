<?php
$nusantara_options[] = array(
    "name" => __('Search Page', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">Search result page !</div>', 'nusantara'),
    "type" => "info"
);


$nusantara_options[] = array(
    "name" => __('Search Result Page sections', 'nusantara'),
    "id" => "nusantara_search_page",
    "std" => $nusantara_search_page,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Ads code on the top', 'nusantara'),
    "desc" => __('Ads code on the top', 'nusantara'),
    "id" => "nusantara_ads_top_search",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "name" => __('Ads code on the bottom', 'nusantara'),
    "desc" => __('Ads code on the top', 'nusantara'),
    "id" => "nusantara_ads_bottom_search",
    "std" => "",
    "type" => "textarea"
);