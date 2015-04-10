<?php
$nusantara_options[] = array(
    "name" => "Single post",
    "type" => "heading"
);
$nusantara_options[] = array(
    "std" => __('<div class="bigo">Single post area !</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => "single post layout",
    "desc" => "",
    "id" => "nusantara_single_layout",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_single_sidebar
);

$nusantara_options[] = array(
    "name" => __('Single post two column', 'nusantara'),
    "id" => "nusantara_single",
    "std" => $nusantara_single_post,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Single post three column', 'nusantara'),
    "id" => "single_nusa",
    "std" => $nusantara_single_ntt,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "name" => __('Single post one column', 'nusantara'),
    "id" => "single_celebes",
    "std" => $nusantara_single_celebes,
    "type" => "sorter"
);


$nusantara_options[] = array(
    "name" => __('Enable settings', 'nusantara') . '',
    "desc" => __('check here if you like to enable settings', 'nusantara'),
    "id" => "nusantara_remove_singleside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);

// Post settings your element
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">SETTINGS YOUR PARAGRAPH POST</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('This is a typographic specific option.', 'nusantara'),
    "id" => "nusantara_paragraph",
    "fold" => "nusantara_remove_singleside",
    "std" => array(
        'face' => '',
        'size' => '16px',
        'height' => '21px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Font title your post', 'nusantara'),
    "id" => "nusantara_title_excerpt",
    "fold" => "nusantara_remove_singleside",
    "std" => array(
        'face' => '',
        'size' => '38px',
        'height' => '21px',
        'style' => 'normal',
        'color' => ''
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('Alignment your title', 'nusantara'),
    "id" => "nusantara_titlesingle_alignment",
    "fold" => "nusantara_remove_singleside",
    "std" => "left",
    "type" => "select",
    "options" => $nusantara_text_align
);


// Comment area  settings
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">COMMENT AREA SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Comment typography settings', 'nusantara'),
    "id" => "nusantara_comment_typo",
    "fold" => "nusantara_remove_singleside",
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
    "desc" => __('comment background', 'nusantara'),
    "id" => "nusantara_comment_background",
    "fold" => "nusantara_remove_singleside",
    "std" => "#eeeeee",
    "type" => "color"
);

