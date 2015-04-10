<?php
$nusantara_options[] = array(
    "name" => "Header Sections",
    "type" => "heading"
);
$nusantara_options[] = array(
    "std" => __('<div class="bigo">Drag and drop your header sections !</div>
                             <p class="wel centering">Would you like remove default header? you just go to <b>appearance -> header</b> and remove default header image.</p>', 'nusantara'),
    "type" => "info2"
);

// Header settings your element
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">HEADER SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Header sections', 'nusantara'),
    "id" => "nusantara_header_section",
    "std" => $nusantara_header_section,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Enable header settings', 'nusantara') . '',
    "desc" => __('check here if you like to Enable header settings', 'nusantara'),
    "id" => "nusantara_remove_headerside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('Font your title H1', 'nusantara'),
    "id" => "nusantara_typo",
    "fold" => "nusantara_remove_headerside",
    "std" => array(
        'face' => '',
        'size' => '40px',
        'height' => '42px',
        'style' => 'bold',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Font stack for your description site', 'nusantara'),
    "id" => "nusantara_description",
    "fold" => "nusantara_remove_headerside",
    "std" => array(
        'face' => '',
        'size' => '16px',
        'height' => '28px',
        'style' => 'bold',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Choose your title H1 color hover', 'nusantara'),
    "id" => "nusantara_header_hover",
    "fold" => "nusantara_remove_headerside",
    "std" => "#41b7d8",
    "type" => "color"
);

$nusantara_options[] = array(
    "name" => "",
    "desc" => __('Choose your background header color', 'nusantara'),
    "id" => "nusantara_color_header",
    "fold" => "nusantara_remove_headerside",
    "std" => "",
    "type" => "color"
);

$url                 = get_template_directory_uri() . '/images/';
$nusantara_options[] = array(
    "desc" => __('Upload your image for background header', 'nusantara'),
    "id" => "nusantara_image_header",
    "fold" => "nusantara_remove_headerside",
    "std" => "$url bg0.png",
    "mod" => "",
    "type" => "media"
);

$nusantara_options[] = array(
    "desc" => __('Header Repeat background image', 'nusantara'),
    "id" => "nusantara_header_repeat",
    "fold" => "nusantara_remove_headerside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_header_position",
    "fold" => "nusantara_remove_headerside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
); 