<?php
$nusantara_options[] = array(
    "name" => __('Batavia Home', 'nusantara'),
    "type" => "heading"
);

//BATAVIA HOMEPAGE 
$nusantara_options[] = array(
    "std" => __('<div class="bigo">BATAVIA HOMEPAGE SECTIONS</div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "id" => "homepage_blocks",
    "std" => $nusantara_homepage_batavia,
    "type" => "sorter"
);

$nusantara_options[] = array(
    "desc" => __('Welcome Text H2', 'nusantara'),
    "id" => "nusantara_heading_intro",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('Description before button', 'nusantara'),
    "id" => "nusantara_general_intro",
    "std" => "",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "desc" => __('Text button', 'nusantara'),
    "id" => "nusantara_text_button",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('URL Button', 'nusantara'),
    "id" => "nusantara_url_button",
    "std" => "",
    "type" => "text"
);

$nusantara_options[] = array(
    "desc" => __('Show the button', 'nusantara'),
    "id" => "nusantara_button",
    "std" => "1",
    "type" => "checkbox"
);

// BATAVIA SETTINGS ENABLE
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">ENABLE BATAVIA SETTINGS</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Enable batavia settings', 'nusantara') . '',
    "desc" => __('check here if you like to Enable batavia settings', 'nusantara'),
    "id" => "nusantara_remove_bataviaside",
    "std" => "",
    "folds" => 1,
    "type" => "checkbox"
);



$nusantara_options[] = array(
    "desc" => __('Heading text welcome', 'nusantara'),
    "id" => "nusantara_side_h2",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'face' => '',
        'size' => '30px',
        'height' => '23px',
        'style' => 'normal',
        'color' => '#41b7d8'
    ),
    "type" => "typography"
);

// ONE column summary
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">Welcome text full width</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Intro one column', 'nusantara'),
    "id" => "nusantara_intro_two",
    "std" => "",
    "fold" => "nusantara_remove_bataviaside",
    "type" => "textarea"
);

$nusantara_options[] = array(
    "desc" => __('background repeat', 'nusantara'),
    "id" => "nusantara_sidehome2_repeat",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);

$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_sidehome2_position",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('background color', 'nusantara'),
    "id" => "nusantara_sidehome2_color",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "#f6f6f6",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_sidehome2_image",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

// TESTIMONIAL
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">Testimonial unlimited element</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Enable page testimonial', 'nusantara'),
    "id" => "nusantara_removal_testimonial",
    "std" => 0,
    "folds" => 2,
    "fold" => "nusantara_remove_bataviaside",
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => __('Title page testimonial', 'nusantara'),
    "id" => "nusantara_heading_testimoni",
    "std" => "",
    "fold" => "nusantara_removal_testimonial",
    "type" => "text"
);

$nusantara_options[] = array(
    "name" => __('Unlimited testimonial with image..just fill out', 'nusantara'),
    "desc" => __('Unlimited testimonial or description', 'nusantara'),
    "id" => "nusantara_testimonial",
    "std" => "",
    "fold" => "nusantara_removal_testimonial",
    "type" => "slider"
);

$nusantara_options[] = array(
    "name" => __('Aside image testimonial region', 'nusantara'),
    "desc" => __('Enter your image aside testimonial region', 'nusantara'),
    "id" => "nusantara_imgasidetestimonial",
    "fold" => "nusantara_removal_testimonial",
    "std" => "",
    "type" => "slider"
);

// testimonial skins
$nusantara_options[] = array(
    "name" => __('Testimonial skin configurations', 'nusantara'),
    "desc" => __('Repeat background image', 'nusantara'),
    "id" => "nusantara_tmbr",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);
$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_tmbp",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('Choose your background testimonial', 'nusantara'),
    "id" => "nusantara_tmbc",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "#eeeeee",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_tmbi",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('<b>Padding testimonial</b>', 'nusantara'),
    "id" => "nusantara_padt",
    "std" => array(
        'top' => '15px',
        'bottom' => '15px',
        'left' => '15px',
        'right' => '15px'
    ),
    "fold" => "nusantara_remove_bataviaside",
    "type" => "padding"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border</b>', 'nusantara'),
    "id" => "nusantara_tmobb",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'width' => '4px',
        'style' => 'solid',
        'color' => '#999999'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_batavia_radius",
    "fold" => "nusantara_remove_bataviaside",
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
    "id" => "nusantara_batavia_boxshadow",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);   

$url = get_template_directory_uri() . '/images/';
// Side home batavia three column
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">Three column batavia</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('Repeat background image', 'nusantara'),
    "id" => "nusantara_sidehome_repeat",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "repeat",
    "type" => "select",
    "options" => $nusantara_body_repeat
);
$nusantara_options[] = array(
    "desc" => __('Background Position', 'nusantara'),
    "id" => "nusantara_sidehome_position",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "type" => "select",
    "options" => $nusantara_positioning
);

$nusantara_options[] = array(
    "desc" => __('Choose your background three column', 'nusantara'),
    "id" => "nusantara_sidehome_color",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "",
    "type" => "color"
);

$nusantara_options[] = array(
    "desc" => __('Upload your image for background', 'nusantara'),
    "id" => "nusantara_sidehome_image",
    "fold" => "nusantara_remove_bataviaside",
    "std" => "$url f-bg.png",
    "mod" => "",
    "type" => "upload"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Top</b>', 'nusantara'),
    "id" => "nusantara_border_sht",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'width' => '4px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Right</b>', 'nusantara'),
    "id" => "nusantara_border_shr",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'width' => '4px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Bottom</b>', 'nusantara'),
    "id" => "nusantara_border_shb",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'width' => '4px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border Left</b>', 'nusantara'),
    "id" => "nusantara_border_shl",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'width' => '4px',
        'style' => 'solid',
        'color' => '#eeeeee'
    ),
    "type" => "border"
);

$nusantara_options[] = array(
    "desc" => __('Font stack', 'nusantara'),
    "id" => "nusantara_sidehome_h3",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'face' => '',
        'size' => '25px',
        'height' => '21px',
        'style' => 'bold',
        'color' => '#222222'
    ),
    "type" => "typography"
);

$nusantara_options[] = array(
    "desc" => __('<b>Border radius CSS3 - Rounded corner</b>', 'nusantara'),
    "id" => "nusantara_batavia_radius2",
    "fold" => "nusantara_remove_bataviaside",
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
    "id" => "nusantara_batavia_boxshadow2",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'Xshadow' => '0px',
        'Yshadow' => '0px',
        'blur' => '0px',
        'scolor' => ''
    ),
    "type" => "shadow"
);   

//padding
$nusantara_options[] = array(
    "std" => __('<p class="title-sechome">One column batavia</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "desc" => __('<b>Padding one colomn text</b>', 'nusantara'),
    "id" => "nusantara_ih2padding",
    "fold" => "nusantara_remove_bataviaside",
    "std" => array(
        'top' => '4px',
        'bottom' => '0px',
        'left' => '15px',
        'right' => '20px'
    ),
    "type" => "padding"
);