<?php
$nusantara_options[] = array(
    "name" => __('Slider Effect', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">Unlimited Slider effect..Yes,,responsive !</div>', 'nusantara'),
    "type" => "info2"
);

$nusantara_options[] = array(
    "name" => __('Active slider effect unlimited', 'nusantara'),
    "desc" => __('How many slider you need?', 'nusantara'),
    "id" => "nusantara_removal_slider",
    "std" => 0,
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => "Slider Options",
    "desc" => __('This slider unlimited with drag and drop sorting. You can upload an image, Suggested height is 35 pixels. ', 'amdhas'),
    "id" => "nusantara_slider_effect",
    "fold" => "nusantara_removal_slider",
    "std" => "",
    "type" => "slider"
);

$nusantara_options[] = array(
     "name" =>  __('Slider Effect', 'amdhas'),
     "desc" => "",
     "id" => "nusantara_slider_mode",
     "std" => "",
     "type" => "select",
     "options" => $nusantara_slide_flex
                                                                      
);