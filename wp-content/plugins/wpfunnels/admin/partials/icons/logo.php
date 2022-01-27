<?php
    $home_link = add_query_arg(
    [
            'page' => WPFNL_MAIN_PAGE_SLUG,
        ],
    admin_url('admin.php')
);
?>

<a href="<?php echo $home_link; ?>">
    <svg width="38" height="28" viewBox="0 0 38 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7.01532 18H31.9847L34 11H5L7.01532 18Z" fill="#EE8134"/>
        <path d="M11.9621 27.2975C12.0923 27.7154 12.4792 28 12.9169 28H26.0831C26.5208 28 26.9077 27.7154 27.0379 27.2975L29 21H10L11.9621 27.2975Z" fill="#6E42D3"/>
        <path d="M37.8161 0.65986C37.61 0.247888 37.2609 0 36.8867 0H1.11326C0.739128 0 0.390003 0.247888 0.183972 0.65986C-0.0220592 1.07193 -0.0573873 1.59277 0.0898627 2.04655L1.69781 7H36.3022L37.9102 2.04655C38.0574 1.59287 38.022 1.07193 37.8161 0.65986Z" fill="#6E42D3"/>
    </svg>
</a>