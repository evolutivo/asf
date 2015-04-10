<?php
$nusantara_options[] = array(
    "name" => __('Navigation Element', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">Primary and secondary</div>
                             <p class="intro-admin" style="text-align:center">Uh....Navigation are you sure your visitors click the menu? Yeah,  depend on your settings and the website usability.</p>', 'nusantara'),
    "type" => "info2"
);

$nusantara_options[] = array(
    "name" => __('Enable Menu settings', 'nusantara') . '',
    "desc" => __('check here if you like to Enable Menu settings', 'nusantara'),
    "id" => "nusantara_remove_menuside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">PRIMARY MENU SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

//primary menu settings
$nusantara_options[] = array(
    "name" => __('Primary Menu', 'nusantara'),
    "desc" => __('You can choose your primary menu appear on the left or right', 'nusantara'),
    "id" => "nusantara_primary_menu_layout",
    "fold" => "nusantara_remove_menuside",
    "std" => "",
    "type" => "select",
    'options' => $nusantara_primary_menu
);

$nusantara_options[] = array(
    "name" => __('Remove Primary Menu', 'nusantara') . '',
    "desc" => __('check here if you like to remove Primary Menu', 'nusantara'),
    "id" => "nusantara_remove_primarymenu",
    "fold" => "nusantara_remove_menuside",
    "std" => "1",
    "type" => "checkbox"
);
$nusantara_options[] = array(
    "desc" => __('Bacground color your primary menu', 'nusantara'),
    "id" => "nusantara_primary_color",
    "fold" => "nusantara_remove_menuside",
    "std" => "#123456",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Primary menu font styling', 'nusantara'),
    "id" => "nusantara_primary_a",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'face' => 'Arial, sans-serif',
        'size' => '13px',
        'style' => 'normal',
        'height' => '50px',
        'color' => '#eeeeee'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left -- NOTE : This for border left your link not for entire menu.</b>', 'nusantara'),
    "id" => "nusantara_blc",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#999999'
    ),
    
    "type" => "border"
);

// Global border primary menu
$nusantara_options[] = array(
    "desc" => __('<b>Border</b>', 'nusantara'),
    "id" => "nusantara_border_primary_menu",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);




// Secondary menu setting
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SECONDARY MENU SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Secondary Menu', 'nusantara'),
    "desc" => __('You can choose your secondary menu appear on the left or right', 'nusantara'),
    "id" => "nusantara_menu_layout",
    "fold" => "nusantara_remove_menuside",
    "std" => "left secondary menu",
    "type" => "select",
    'options' => $nusantara_secondary_menu
);

$nusantara_options[] = array(
    "name" => __('Remove Secondary Menu', 'nusantara') . '',
    "desc" => __('check here if you like to remove Secondary Menu', 'nusantara'),
    "id" => "nusantara_remove_secondarymenu",
    "fold" => "nusantara_remove_menuside",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('secondary font styling', 'nusantara'),
    "id" => "nusantara_secondary_font",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'face' => '',
        'size' => '15px',
        'style' => 'normal'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Bacground color your secondary menu', 'nusantara'),
    "id" => "nusantara_secondary_color",
    "fold" => "nusantara_remove_menuside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Link color', 'nusantara'),
    "id" => "nusantara_secondary_colormenu",
    "fold" => "nusantara_remove_menuside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Link hover', 'nusantara'),
    "id" => "nusantara_secondary_hover",
    "fold" => "nusantara_remove_menuside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_topsecondary",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_rightsecondary",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_bottomsecondary",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_leftsecondary",
    "fold" => "nusantara_remove_menuside",
    "std" => array(
        'width' => '0',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
); 