<?php

/**
 * Helper Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */
namespace Includes;

/**
 * WP Query Interaction For Shortcodes
 */
trait Trait_Shortcode_Wp_Query
{
    /**
     * WP Query Attribute
     *
     * @var string
     */
    protected  $category ;
    /**
     * WP Query Attribute
     *
     * @var string
     */
    protected  $orderby ;
    /**
     * WP Query Attribute
     *
     * @var string
     */
    protected  $order ;
    /**
     * WP Query Attribute
     *
     * @var string
     */
    protected  $slug ;
    /**
     * Set Class Parameters & Initialize Class
     *
     * @param string $posttype Post Type Slug.
     * @param string $taxonomy Taxonomy Slug.
     * @param array  $atts     Shortcode Attributes.
     */
    public final function wpquery( $posttype, $taxonomy = '', $atts = array() )
    {
        if ( true === empty($atts) ) {
            return [];
        }
        $this->slug = '';
        if ( true !== empty($atts['slug']) ) {
            $this->slug = $atts['slug'];
        }
        $this->posttype = $posttype;
        $this->taxonomy = $taxonomy;
        return $this->set_wpquery();
    }
    
    //end wpquery()
    /**
     * Merge Arrays/Values & Build WP Query.
     *
     * @return array
     */
    private final function set_wpquery()
    {
        
        if ( '1' === $this->get_setting( 'shortcode_posts_pages' ) ) {
            $post_type = [ $this->posttype, 'post', 'page' ];
        } else {
            $post_type = $this->posttype;
        }
        
        return array_merge( $this->set_query_type(), [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'orderby'        => $this->set_order_by(),
            'order'          => $this->set_order(),
        ] );
    }
    
    //end set_wpquery()
    /**
     * Build WP Query Query Type
     * Sets the slug name or taxonomy slug name
     *
     * @return array
     */
    private final function set_query_type()
    {
        $array = [];
        if ( true !== empty($this->slug) ) {
            /*
             * Sanitizes a string key.
             * https://developer.wordpress.org/reference/functions/sanitize_key/
             */
            $array = [
                'name' => sanitize_key( $this->slug ),
            ];
        }
        if ( true !== empty($this->category) ) {
            /*
             * Sanitizes a string key.
             * https://developer.wordpress.org/reference/functions/sanitize_key/
             */
            $array = [
                'tax_query' => [ [
                'taxonomy' => $this->taxonomy,
                'field'    => 'slug',
                'terms'    => sanitize_key( $this->category ),
            ] ],
            ];
        }
        return $array;
    }
    
    //end set_query_type()
    /**
     * Build WP Query Orderby.
     *
     * @return string
     */
    private final function set_order_by()
    {
        $allowed_orderbys = [
            'none',
            'ID',
            'date',
            'title',
            'slug',
            'rand',
            'modified'
        ];
        $orderby = 'slug';
        return $orderby;
    }
    
    //end set_order_by()
    /**
     * Build WP Query Order.
     *
     * @return string
     */
    private final function set_order()
    {
        $order = 'DESC';
        return $order;
    }

}
//end trait