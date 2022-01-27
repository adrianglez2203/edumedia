<?php

// Add credit links in plugins list
function flying_scripts_add_shortcuts($links) {
    $plugin_shortcuts = array(
        '<a href="'.admin_url('options-general.php?page=flying-scripts').'">Settings</a>',
        '<a href="https://www.buymeacoffee.com/gijovarghese" target="_blank" style="color:#3db634;">Buy developer a coffee</a>'
    );
    return array_merge($links, $plugin_shortcuts);
}
