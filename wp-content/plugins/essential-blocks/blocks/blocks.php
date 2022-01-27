<?php

function essential_block_scripts()
{
    wp_register_script(
        'essential-blocks-vendor-bundle',
        ESSENTIAL_BLOCKS_ADMIN_URL . 'vendor-bundle/index.js',
        [],
        ESSENTIAL_BLOCKS_VERSION,
        true
    );

    $blocks_dependencies = include_once ESSENTIAL_BLOCKS_DIR_PATH . 'dist/index.asset.php';
    $blocks_dependencies['dependencies'][] = 'essential-blocks-vendor-bundle';
    $blocks_dependencies['dependencies'][] = 'essential-blocks-controls-util';

    wp_register_script(
        'essential-blocks-editor-script',
        ESSENTIAL_BLOCKS_ADMIN_URL . 'dist/index.js',
        $blocks_dependencies['dependencies'],
        $blocks_dependencies['version'],
        true
    );

    wp_register_style(
        'essential-blocks-frontend-style',
        ESSENTIAL_BLOCKS_ADMIN_URL . 'dist/style.css', 
        array(),
        EssentialAdmin::get_version(ESSENTIAL_BLOCKS_DIR_PATH . 'dist/style.css'),
        'all'
    );
}
add_action('init', 'essential_block_scripts');
