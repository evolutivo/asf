<?php
$nusantara_options[] = array(
    "name" => __('Celebes Home', 'nusantara'),
    "type" => "heading"
);


//CELEBES home page section
$nusantara_options[] = array(
    "std" => __('<div class="bigo">CELEBES HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "nusantara_homecelebes",
    "std" => $nusantara_homepage_celebes,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_celebesside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('Check here if you like to remove author info on homepage', 'nusantara'),
    "id" => "nusantara_remove_celebesauthorinfo",
    "fold" => "nusantara_remove_celebesside",
    "std" => "1",
    "type" => "checkbox"
); 

//skining left sidebar widgets
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SKINNING LEFT SIDEBAR WIDGET</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_widgetone_celebsidec",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_widgetone_celebsidei",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_widgetone_celebsider",
    "fold" => "nusantara_remove_celebesside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_widgetone_celebsidep",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "name" => __('Sidebar left widgets skinr', 'nusantara'),
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_celebt",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_celebr",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_celebb",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_celebl",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_celebes_radius",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
); 

$nusantara_options[] = array(
    "desc" => __('<b>Padding for your widget</b>', 'nusantara'),
    "id" => "nusantara_celebpadding",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
); 

$nusantara_options[] = array(   
    "desc" => __('<b>CSS3 box shadow</b>', 'nusantara'),
    "id" => "nusantara_celebes_boxshadow",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);   

$nusantara_options[] = array(    
    "desc" => __('Title widget H3', 'nusantara'),
    "id" => "nusantara_celebes_twh3",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'face' => '',
        'size' => '20px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
); 


//skining left sidebar widgets
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SKINNING RIGHT SIDEBAR WIDGET</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_widgetone2_celebsidec",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_widgetone2_celebsidei",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_widgetone2_celebsider",
    "fold" => "nusantara_remove_celebesside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_widgetone2_celebsidep",
    "fold" => "nusantara_remove_celebesside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "name" => __('Sidebar right widgets skinr', 'nusantara'),
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_celebt2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_celebr2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_celebb2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_celebl2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_celebes_radius2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
); 

$nusantara_options[] = array(
    "desc" => __('<b>Padding for your widget</b>', 'nusantara'),
    "id" => "nusantara_celebpadding2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
); 

$nusantara_options[] = array(   
    "desc" => __('<b>CSS3 box shadow</b>', 'nusantara'),
    "id" => "nusantara_celebes_boxshadow2",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);   

$nusantara_options[] = array(    
    "desc" => __('Title widget H3', 'nusantara'),
    "id" => "nusantara_celebes_twh32",
    "fold" => "nusantara_remove_celebesside",
    "std" => array(
        'face' => '',
        'size' => '20px',
        'height' => '20px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);                                                                                                                                                               