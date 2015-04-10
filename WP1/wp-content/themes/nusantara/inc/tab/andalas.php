<?php
$nusantara_options[] = array(
    "name" => __('Andalas Home', 'nusantara'),
    "type" => "heading"
);

//ANDALAS HOMEPAGE SECTIONS
$nusantara_options[] = array(
    "std" => __('<div class="bigo">ANDALAS HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "homepage_andalas",
    "std" => $nusantara_homepage_andalas,
    "type" => "sorter"
);
$nusantara_options[] = array(
    "desc" => __('Welcome Text H2', 'nusantara'),
    "id" => "nusantara_heading_intro_andalas",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('Description before button', 'nusantara'),
    "id" => "nusantara_general_intro_andalas",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "desc" => __('Text button', 'nusantara'),
    "id" => "nusantara_text_button_andalas",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('URL button', 'nusantara'),
    "id" => "nusantara_url_button_andalas",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('Show the button', 'nusantara'),
    "id" => "nusantara_button_andalas",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_andalasside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Andalas Box padding', 'nusantara'),
    "desc" => __('<b>Padding box</b>', 'nusantara'),
    "id" => "nusantara_anpt",
    "fold" => "nusantara_remove_andalasside",
    "std" => array(
        'top' => '15px',
        'bottom' => '15px',
        'left' => '15px',
        'right' => '10px'
    ),
    "type" => "padding"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border box</b>', 'nusantara'),
    "id" => "nusantara_andbor",
    "fold" => "nusantara_remove_andalasside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#999999'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Margin box</b>', 'nusantara'),
    "id" => "nusantara_anmar",
    "fold" => "nusantara_remove_andalasside",
    "std" => array(
        'top' => '20px',
        'bottom' => '20px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);

$nusantara_options[] = array(
    "desc" => __('Title typhography', 'nusantara'),
    "id" => "nusantara_andalas_h2",
    "fold" => "nusantara_remove_andalasside",
    "std" => array(
        'face' => '',
        'size' => '14px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Repeat background image', 'nusantara'),
    "id" => "nusantara_andlr",
    "fold" => "nusantara_remove_andalasside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);
$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_andlp",
    "fold" => "nusantara_remove_andalasside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('Choose your background boxes', 'nusantara'),
    "id" => "nusantara_andlc",
    "fold" => "nusantara_remove_andalasside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_andli",
    "fold" => "nusantara_remove_andalasside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
); 