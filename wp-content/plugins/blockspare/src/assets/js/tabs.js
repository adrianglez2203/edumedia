/**
 * Tabs that can create an accordion for mobile.
 */

jQuery( document ).ready( function( $ ) {
    $( '.bs-tabs-wrap' ).each( function( a ) {
        var ktStartTab = $( this ).find( '> .bs-tabs-title-list .bs-tab-title-active' ).attr( 'data-tab' );
        var ktTabsList = $( this ).find( '> .bs-tabs-title-list' ).attr( {
            role: 'tablist',
        } );
        $( this ).find( '> .bs-tabs-content-wrap > .bs-tab-inner-content' ).attr( {
            role: 'tabpanel',
            'aria-hidden': 'true',
        } );
        $( this ).find( '> .bs-tabs-title-list a' ).each( function( b ) {
            var tabId = $( this ).attr( 'data-tab' );
            var tabName = $( this ).parent().attr( 'id' );
            $( this ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-content-wrap > .bs-inner-tab-' + tabId ).attr( 'aria-labelledby', tabName );
        } );
        $( this ).find( '.bs-tabs-content-wrap > .bs-inner-tab-' + ktStartTab ).attr( 'aria-hidden', 'false' );
        $( this ).find( '> .bs-tabs-title-list li:not(.bs-tab-title-active) a' ).each( function() {
            $( this ).attr( {
                role: 'tab',
                'aria-selected': 'false',
                tabindex: '-1',
            } ).parent().attr( 'role', 'presentation' );
        } );
        $( this ).find( '> .bs-tabs-title-list li.bs-tab-title-active a' ).attr( {
            role: 'tab',
            'aria-selected': 'true',
            tabindex: '0',
        } ).parent().attr( 'role', 'presentation' );
        $( ktTabsList ).delegate( 'a', 'keydown', function( e ) {
            switch ( e.which ) {
                case 37: case 38:
                    if ( $( this ).parent().prev().length != 0 ) {
                        $( this ).parent().prev().find( '> a' ).click();
                    } else {
                        $( ktTabsList ).find( 'li:last > a' ).click();
                    }
                    break;
                case 39: case 40:
                    if ( $( this ).parent().next().length != 0 ) {
                        $( this ).parent().next().find( '> a' ).click();
                    } else {
                        $( ktTabsList ).find( 'li:first > a' ).click();
                    }
                    break;
            }
        } );
    } );
    $( '.bs-tabs-title-list li a' ).click( function( e ) {
        e.preventDefault();
        var tabId = $( this ).attr( 'data-tab' );

        $( this ).closest( '.bs-tabs-title-list' ).find( '.bs-tab-title-active' )
            .addClass( 'bs-tab-title-inactive' )
            .removeClass( 'bs-tab-title-active' )
            .find( 'a.bs-tab-title' ).attr( {
            tabindex: '-1',
            'aria-selected': 'false',
        } );
        $( this ).closest( '.bs-tabs-wrap' ).removeClass( function( index, className ) {
            return ( className.match( /\bbs-active-tab-\S+/g ) || [] ).join( ' ' );
        } ).addClass( 'bs-active-tab-' + tabId );
        $( this ).parent( 'li' ).addClass( 'bs-tab-title-active' ).removeClass( 'bs-tab-title-inactive' );
        $( this ).attr( {
            tabindex: '0',
            'aria-selected': 'true',
        } ).focus();
        $( this ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-content-wrap > .bs-tab-inner-content:not(.bs-inner-tab-' + tabId + ')' ).attr( 'aria-hidden', 'true' );
        $( this ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-content-wrap > .bs-inner-tab-' + tabId ).attr( 'aria-hidden', 'false' );
        $( this ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-content-wrap > .bs-tabs-accordion-title:not(.bs-tabs-accordion-title-' + tabId + ')' ).addClass( 'bs-tab-title-inactive' ).removeClass( 'bs-tab-title-active' ).attr( {
            tabindex: '-1',
            'aria-selected': 'false',
        } );
        $( this ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-content-wrap > .bs-tabs-accordion-title.bs-tabs-accordion-title-' + tabId ).addClass( 'bs-tab-title-active' ).removeClass( 'bs-tab-title-inactive' ).attr( {
            tabindex: '0',
            'aria-selected': 'true',
        } );
        var resizeEvent = window.document.createEvent( 'UIEvents' );
        resizeEvent.initUIEvent( 'resize', true, false, window, 0 );
        window.dispatchEvent( resizeEvent );
        var tabEvent = window.document.createEvent( 'UIEvents' );
        tabEvent.initUIEvent( 'blockspare-tabs-open', true, false, window, 0 );
        window.dispatchEvent( tabEvent );
    } );

    function bs_anchor_tabs() {
        if ( window.location.hash != '' ) {
            if ( $( window.location.hash + '.bs-title-item' ).length ) {
                var tabid = window.location.hash.substring(1);
                var tabnumber = $( '#' + tabid + ' a' ).attr( 'data-tab' );
                $( '#' + tabid ).closest( '.bs-tabs-title-list' ).find( '.bs-tab-title-active' )
                    .addClass( 'bs-tab-title-inactive' )
                    .removeClass( 'bs-tab-title-active' );
                $( '#' + tabid ).closest( '.bs-tabs-wrap' ).removeClass( function( index, className ) {
                    return ( className.match( /\bbs-active-tab-\S+/g ) || [] ).join( ' ' );
                } ).addClass( 'bs-active-tab-' + tabnumber );
                $( '#' + tabid ).addClass( 'bs-tab-title-active' );
                $( '#' + tabid ).closest( '.bs-tabs-wrap' ).find( '.bs-tabs-accordion-title.bs-tabs-accordion-title-' + tabid ).addClass( 'bs-tab-title-active' ).removeClass( 'bs-tab-title-inactive' );
            }
        }
    }
    window.addEventListener( 'hashchange', bs_anchor_tabs, false );
    bs_anchor_tabs();
} );