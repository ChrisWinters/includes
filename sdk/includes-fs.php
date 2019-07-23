<?php

/**
 * Freemius
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */
if ( false === file_exists( dirname( INCLUDES_FILE ) . '/sdk/freemius/start.php' ) ) {
    return;
}

if ( true === function_exists( 'includes_fs' ) ) {
    includes_fs()->set_basename( true, INCLUDES_FILE );
} elseif ( false === function_exists( 'includes_fs' ) ) {
    /**
     * Freemius Integration
     */
    function includes_fs()
    {
        global  $includes_fs ;
        
        if ( false === isset( $includes_fs ) ) {
            require_once dirname( INCLUDES_FILE ) . '/sdk/freemius/start.php';
            $includes_fs = fs_dynamic_init( [
                'id'             => '3665',
                'slug'           => 'includes',
                'premium_slug'   => 'includes-pro',
                'type'           => 'plugin',
                'public_key'     => 'pk_bf608cedaf195d8ff5591b59e24dc',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'is_live'        => true,
                'menu'           => [
                'account'    => true,
                'contact'    => false,
                'support'    => false,
                'pricing'    => false,
                'slug'       => 'edit.php?post_type=includes',
                'first-path' => 'edit.php?post_type=includes&page=includes&tab=settings',
            ],
            ] );
        }
        
        return $includes_fs;
    }
    
    //end includes_fs()
    includes_fs();
    do_action( 'includes_fs_loaded' );
}
