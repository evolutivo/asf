<?php
$nusantara_options[] = array(
    "name" => __('General Settings', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">General settings !</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Enable General settings', 'nusantara') . '',
    "desc" => __('check here if you like to Enable General settings', 'nusantara'),
    "id" => "nusantara_remove_generalside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);


// Global element configurations
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">GLOBAL BODY ELEMENT - body {}</p>', 'nusantara'),
    "type" => "info"
);


$nusantara_options[] = array(
    "desc" => __('Link color - Global', 'nusantara'),
    "id" => "nusantara_link_color",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Link hover - Global', 'nusantara'),
    "id" => "nusantara_link_hover",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Link visited - Global', 'nusantara'),
    "id" => "nusantara_link_visited",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Font stack copy body', 'nusantara'),
    "id" => "nusantara_typo_body",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'face' => '',
        'size' => '16px',
        'height' => '21',
        'style' => 'normal',
        'color' => '#333333'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_topbody",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_rightbody",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_bottombody",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_leftbody",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);


// Main content settings
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">MAIN CONTENT SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Main content settings', 'nusantara'),
    "id" => "nusantara_main_content",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'face' => '',
        'size' => '16px',
        'height' => '21px',
        'color' => '#222222',
        'style' => 'normal'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_mainconr",
    "fold" => "nusantara_remove_generalside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);
$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_mainconp",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_mainconb",
    "fold" => "nusantara_remove_generalside",
    "std" => "#ffffff",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_mainconi",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

// checkbox global
$nusantara_options[] = array(
    "name" => __('Enable searchform', 'nusantara') . '',
    "desc" => __('check if you want to disable searchform on header [enable is ON]', 'nusantara'),
    "id" => "nusantara_remove_searchform",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);



$nusantara_options[] = array(
    "name" => __('Enable sidebar footer', 'nusantara') . '',
    "desc" => __('check if you want to disable sidebar on the footer [enable is ON]', 'nusantara'),
    "id" => "nusantara_remove_footer",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);


//BUTTON FOR HOME PAGE
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">CSS3 BUTTON</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "nusantara_tombol_button",
    "std" => "1",
    "fold" => "nusantara_remove_generalside",
    "type" => "radio",
    "options" => array(
        1 => __('Red Button', 'nusantara'),
        2 => __('Blue Button', 'nusantara'),
        3 => __('Orange Button', 'nusantara'),
        4 => __('Green Button', 'nusantara'),
        5 => __('Purple Button', 'nusantara'),
        6 => __('Pink Button', 'nusantara'),
        7 => __('Brick Button', 'nusantara'),
        8 => __('Gold Button', 'nusantara'),
        9 => __('Silver Button', 'nusantara'),
        10 => __('Gray Button', 'nusantara'),
        11 => __('Black Button', 'nusantara'),
        12 => __('Brown Button', 'nusantara')
    )
);

// Footer area settings
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">FOOTER AREA SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Font your sidebar H3', 'nusantara'),
    "id" => "nusantara_side_h3",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'face' => '',
        'size' => '25px',
        'height' => '23px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Footer area background', 'nusantara'),
    "id" => "nusantara_footer_color",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Credit background', 'nusantara'),
    "id" => "nusantara_footer_credit",
    "std" => "",
    "fold" => "nusantara_remove_generalside",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Credit typography settings', 'nusantara'),
    "id" => "nusantara_credit_typo",
    "fold" => "nusantara_remove_generalside",
    "std" => array(
        'face' => '',
        'size' => '16px',
        'height' => '21px',
        'color' => '#ffffff',
        'style' => 'normal'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "name" => __('Author Profile', 'nusantara') . '',
    "desc" => __('Check here if you like to enable Your profile description every page', 'nusantara'),
    "id" => "nusantara_author_general_intro",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Author Information single post', 'nusantara') . '',
    "desc" => __('Check here if you like to remove author info every single post and page', 'nusantara'),
    "id" => "nusantara_remove_authorinfo",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Remove breadcrumb', 'nusantara') . '',
    "desc" => __('check here if you like to remove breadcrumb', 'nusantara'),
    "id" => "nusantara_remove_breadcrumb",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Remove Tags', 'nusantara') . '',
    "desc" => __('check here if you like to remove tags every single post, this appear in the bottom your post', 'nusantara'),
    "id" => "nusantara_remove_tags",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "name" => __('Remove Categories', 'nusantara') . '',
    "desc" => __('check here if you like to remove category every single post', 'nusantara'),
    "id" => "nusantara_remove_category",
    "fold" => "nusantara_remove_generalside",
    "std" => "1",
    "type" => "checkbox"
); 

//ADDITIONAL CODE
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">ADDITIONAL CODE</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Footer code', 'nusantara'),
    "desc" => __('Add footer code, it will be put on theme bottom your HTML file.', 'nusantara'),
    "id" => "nusantara_analitic_code",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "name" => __('Additional CSS code', 'nusantara'),
    "desc" => __('add CSS code to &lt;head&gt;, it will be internal file', 'nusantara'),
    "id" => "nusantara_aditional_css",
    "fold" => "nusantara_remove_generalside",
    "std" => "",
    "type" => "textarea"
);