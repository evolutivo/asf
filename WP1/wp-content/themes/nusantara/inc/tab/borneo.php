<?php
$nusantara_options[] = array(
    "name" => __('Borneo Home', 'nusantara'),
    "type" => "heading"
);

//BORNEO home page
$nusantara_options[] = array(
    "std" => __('<div class="bigo">BORNEO HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "homepage_borneo",
    "std" => $nusantara_homepage_borneo,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_borneoside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

// skining boxes
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SKINING BOXES</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_widgetone_borneosidec",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_widgetone_borneosidei",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_widgetone_borneosider",
    "fold" => "nusantara_remove_borneoside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_widgetone_borneosidep",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "name" => __('CSS3 Box shadow', 'nusantara'),
    "desc" => __('<b>box shadow</b>', 'nusantara'),
    "id" => "nusantara_borneo_boxshadow",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);

$nusantara_options[] = array(
    "name" => __('Typhography box', 'nusantara'),
    "desc" => __('Title typhography', 'nusantara'),
    "id" => "nusantara_borneo_h2",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '20px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Hover title box', 'nusantara'),
    "id" => "nusantara_borneo_h2hover",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '20px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Postmeta text', 'nusantara'),
    "id" => "nusantara_borneo_postmeta",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '12px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);


$nusantara_options[] = array(
    "desc" => __('Postmeta link', 'nusantara'),
    "id" => "nusantara_borneo_postmetaa",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '12px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Postmeta hover', 'nusantara'),
    "id" => "nusantara_borneo_postmetaahover",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '12px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "name" => __('Border box', 'nusantara'),
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_bht",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_bhr",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_bhb",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_bhl",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_borneo_radius2",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);


//skining sidebar widgets
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SKINING SIDEBAR WIDGET</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_widgetone_sidec",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_widgetone_sidei",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_widgetone_sider",
    "fold" => "nusantara_remove_borneoside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_widgetone_sidep",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "name" => __('Border widgets', 'nusantara'),
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_wbht",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_wbhr",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_wbhb",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_wbhl",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_borneo_radius",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);

$nusantara_options[] = array(
    "name" => __('Widget padding', 'nusantara'),
    "desc" => __('<b>Padding for your widget</b>', 'nusantara'),
    "id" => "nusantara_bnpt",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);


$nusantara_options[] = array(
    "name" => __('CSS3 Box shadow', 'nusantara'),
    "desc" => __('<b>box shadow</b>', 'nusantara'),
    "id" => "nusantara_borneo_widgetshadow",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);

$nusantara_options[] = array(
    "name" => __('Widgets typhography', 'nusantara'),
    "desc" => __('Title widget H3', 'nusantara'),
    "id" => "nusantara_borneo_twh3",
    "fold" => "nusantara_remove_borneoside",
    "std" => array(
        'face' => '',
        'size' => '20px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_borneowh3_background",
    "fold" => "nusantara_remove_borneoside",
    "std" => "",
    "type" => "color"
);                                                         