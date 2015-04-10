<?php
$nusantara_options[] = array(
    "name" => __('Java Home', 'nusantara'),
    "type" => "heading"
);


//JAVA HOMEPAGE
$nusantara_options[] = array(
    "std" => __('<div class="bigo">JAVA HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "homepage_java",
    "std" => $nusantara_homepage_java,
    "type" => "sorter"
);


$nusantara_options[] = array(
    "desc" => __('Check here if you like to remove author info on homepage', 'nusantara'),
    "id" => "nusantara_remove_javaauthorinfo",
    "std" => "1",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('<a href="http://codex.wordpress.org/Function_Reference/the_content" target="_blank">the_content()</a> are used to display the Post Content for the current post.</br> <a href="http://codex.wordpress.org/Function_Reference/the_excerpt" target="_blank">the_excerpt()</a> are used to display the Post Excerpt for the current post.', 'nusantara'),
    "id" => "nusantara_content_choices",
    "std" => "1",
    "type" => "radio",
    'options' => array(
        1 => __('Automatic read more button', 'nusantara'),
        2 => __('Full content summary - Manualy readmore button', 'nusantara')
    )
);

$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_javaside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

// skining widget
$nusantara_options[] = array(
    "name" => __('Widget and sidebar skin', 'nusantara'),
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_widgetone_side",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Link typography', 'nusantara'),
    "id" => "nusantara_javasidelink_a",
    "fold" => "nusantara_remove_javaside",
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
    "desc" => __('Link hover color color', 'nusantara'),
    "id" => "nusantara_javahover_a",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_widgetone_bgimg",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_widgetone_bgrpt",
    "fold" => "nusantara_remove_javaside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_widgetone_bgpst",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('<b>Padding sidebar widget</b>', 'nusantara'),
    "id" => "nusantara_1c_padding",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);


$nusantara_options[] = array(
    "desc" => __('<b>Border</b>', 'nusantara'),
    "id" => "nusantara_1c_border",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

// CSS3
$nusantara_options[] = array(
    "name" => __('CSS3 configurations', 'nusantara'),
    "desc" => __('Title background color', 'nusantara'),
    "id" => "nusantara_widgetone_h3title",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Title widget', 'nusantara'),
    "id" => "nusantara_widgetone_h3color",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'face' => '',
        'size' => '23px',
        'height' => '23px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('<b>Text shadow</b>', 'nusantara'),
    "id" => "nusantara_1c_textshadow",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);

$nusantara_options[] = array(
    "name" => __('List style widgets', 'nusantara'),
    "desc" => __('<b>Padding list style</b>', 'nusantara'),
    "id" => "nusantara_javali_padding",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'top' => '0px',
        'bottom' => '0px',
        'left' => '0px',
        'right' => '0px'
    ),
    "type" => "padding"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border top</b>', 'nusantara'),
    "id" => "border_javali_bt",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border bottom</b>', 'nusantara'),
    "id" => "border_javali_bb",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#999999'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border left</b>', 'nusantara'),
    "id" => "border_javali_bl",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border left</b>', 'nusantara'),
    "id" => "border_javali_br",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '0px',
        'style' => 'none',
        'color' => ''
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "name" => __('Image thumbnail settings', 'nusantara'),
    "desc" => __('<b>Image Padding</b>', 'nusantara'),
    "id" => "nusantara_javathumb_padding",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'top' => '5px',
        'bottom' => '5px',
        'left' => '5px',
        'right' => '5px'
    ),
    "type" => "padding"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border</b>', 'nusantara'),
    "id" => "nusantara_javathumb_border",
    "fold" => "nusantara_remove_javaside",
    "std" => array(
        'width' => '1px',
        'style' => 'solid',
        'color' => '#dddddd'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('Enter your width image thumbnail, you can use value like px, em, pt, % for your image width. <b>Example: 180px</b>', 'nusantara'),
    "id" => "nusantara_javathumb_width",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('Enter your height image thumbnail, you can use value like px, em, pt, % for your image height. <b>Example: 180px</b>', 'nusantara'),
    "id" => "nusantara_javathumb_height",
    "fold" => "nusantara_remove_javaside",
    "std" => "",
    "type" => "text"
);