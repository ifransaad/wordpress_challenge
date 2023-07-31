<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

return array(
    'title' => __('Color Swatches Settings', 'color-swatches'),
    'type' => 'title',
    'desc' => '',
    'id' => 'color_swatches_settings',
);

return array(
    array(
        'title' => __('Enable Custom Product Variation Display', 'color-swatches'),
        'desc' => __('Enable or disable the custom product variation display feature.', 'color-swatches'),
        'id' => 'color_swatches_enable',
        'default' => 'no',
        'type' => 'checkbox',
        'desc_tip' => true,
    ),
);

return array(
    'type' => 'sectionend',
    'id' => 'color_swatches_settings',
);