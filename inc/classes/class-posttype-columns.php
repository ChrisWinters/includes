<?php

/**
 * Feature Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */
namespace Includes;

use  Includes\Trait_Option_Manager as TraitOptionManager ;
use  Includes\Trait_Posttype_Key as TraitPosttypeKey ;
use  Includes\Trait_Taxonomy_Key as TraitTaxonomyKey ;
/**
 * Post Type Columns Injector
 */
final class Posttype_Columns
{
    use  TraitOptionManager ;
    use  TraitPosttypeKey ;
    use  TraitTaxonomyKey ;
    /**
     * Taxonomy Name.
     *
     * @var string
     */
    protected  $posttype ;
    /**
     * Taxonomy Name.
     *
     * @var string
     */
    protected  $taxonomy ;
    /**
     * Shortcode Key Name.
     *
     * @var string
     */
    protected  $shortcode ;
    /**
     * Columns To Unset.
     *
     * @var array
     */
    protected  $unset_columns = array() ;
    /**
     * Columns To Set.
     *
     * @var array
     */
    protected  $set_columns = array() ;
    /**
     * Set Class Parameters
     *
     * @param string $args Class Args.
     */
    public function __construct( $args = array() )
    {
        $this->posttype = $this->clean_posttype( $args['posttype'] );
        $this->taxonomy = $this->clean_taxonomy( $args['taxonomy'] );
        $this->shortcode = $args['shortcode'];
        $this->unset_columns = [ 'title', 'author', 'date' ];
        $this->set_columns = [
            'title'     => esc_html__( 'Include Name', 'includes' ),
            'shortcode' => esc_html__( 'Shortcode', 'includes' ),
            'author'    => esc_html__( 'Created By', 'includes' ),
            'date'      => esc_html__( 'Published', 'includes' ),
        ];
        if ( filter_input( INPUT_GET, 'post_type' ) !== $this->posttype ) {
            return;
        }
    }
    
    //end __construct()
    /**
     * Init Columns
     */
    public function init()
    {
        /*
         * Filters the columns displayed in the Posts list table for a specific post type
         * https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
         */
        add_filter(
            'manage_' . $this->posttype . '_posts_columns',
            [ $this, 'columns' ],
            10,
            1
        );
        /*
         * Fires for each custom column of a specific post type in the Posts list table.
         * https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
         */
        add_action(
            'manage_' . $this->posttype . '_posts_custom_column',
            [ $this, 'contents' ],
            10,
            2
        );
    }
    
    //end init()
    /**
     * Unset/Set Custom Custom Post Type Columns
     *
     * @param array $columns Current Post Type Columns.
     *
     * @return array $columns
     */
    public function columns( $columns )
    {
        $unset_columns = [];
        if ( true !== empty($this->unset_columns) ) {
            $unset_columns = $this->unset_columns;
        }
        foreach ( $unset_columns as $column ) {
            if ( true === isset( $column ) ) {
                unset( $columns[$column] );
            }
        }
        $set_columns = [];
        if ( true !== empty($this->set_columns) ) {
            $set_columns = $this->set_columns;
        }
        foreach ( $set_columns as $column => $label ) {
            if ( true === isset( $column ) && true === isset( $label ) ) {
                $columns[$column] = $label;
            }
        }
        return $columns;
    }
    
    //end columns()
    /**
     * Inject Columns Contents
     *
     * @param string $column  The Column To Target.
     * @param int    $post_id Current Posts Post ID.
     *
     * @return void
     */
    public function contents( $column, $post_id )
    {
        global  $post ;
        if ( 'shortcode' === $column ) {
            echo  wp_kses_post( $this->shortcode( $post_id, $post->post_name ) ) ;
        }
    }
    
    //end categories__premium_only()
    /**
     * Shortcode Column
     *
     * @param int    $post_id  Current Post ID.
     * @param string $post_slug Post Slug Value.
     *
     * @return void
     */
    private function shortcode( $post_id, $post_slug )
    {
        /*
         * Retrieves the permalink for a post of a custom post type.
         * https://developer.wordpress.org/reference/functions/get_post_permalink/
         */
        $permalink = get_post_permalink();
        $dashicon = '<span class="dashicons dashicons-visibility" style="margin-top:4px;"></span>';
        $shortcode_include = htmlentities( '[includes slug="' . $post_slug . '"]', ENT_QUOTES );
        $html = "<a href=\"{$permalink}\" target=\"_blank\">{$dashicon}</a> <input type=\"text\" name=\"{$this->posttype}\" value=\"{$shortcode_include}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" />";
        /*
         * Filters text content and strips out disallowed HTML.
         * https://developer.wordpress.org/reference/functions/wp_kses/
         */
        echo  wp_kses( $html, [
            'br'    => true,
            'a'     => [
            'href'   => true,
            'target' => true,
        ],
            'span'  => [
            'class' => true,
            'style' => true,
        ],
            'input' => [
            'type'    => true,
            'name'    => true,
            'value'   => true,
            'style'   => true,
            'onclick' => true,
        ],
        ] ) ;
    }

}
//end class