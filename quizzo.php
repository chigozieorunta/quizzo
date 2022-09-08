<?php
/**
 * Plugin Name: Quizzo
 * Plugin URI:  https://github.com/chigozieorunta/quizzo
 * Description: A simple plugin to help you set up Quizzes behind a PayWall.
 * Version:     1.0.0
 * Author:      Chigozie Orunta
 * Author URI:  https://chigozieorunta.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: quizzo
 * Domain Path: /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_SLUG', 'quizzo' );
define( 'PLUGIN_ROLE', 'manage_options' );
define( 'PLUGIN_DOMAIN', 'quizzo' );

/**
 * Applied Hooks
 */
add_action( 'init', 'register_quizzo_cpts' );
add_action( 'admin_menu', 'register_quizzo_menu', 9 );
add_action( 'admin_enqueue_scripts', 'register_quizzo_css' );
add_action( 'add_meta_boxes', 'register_quizzo_meta_boxes' );

/**
 * Enqueue Quizzo Plugin CSS file
 *
 * @return void
 */
function register_quizzo_css() {
    wp_enqueue_style(
        PLUGIN_SLUG,
        plugin_dir_url( __FILE__ ) . './assets/css/dist/quizzo.css'
    );
}

/**
 * Register Quiz, Question and Score CPTs
 *
 * @return void
 */
function register_quizzo_cpts() {
    register_post_type( 'quiz',
        array(
            'labels'       => array(
                'name'          => __( 'Quizzes' ),
                'singular_name' => __( 'Quiz' ),
                'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
                'add_new_item'  => __( 'Add New Quiz', PLUGIN_DOMAIN ),
                'new_item'      => __( 'New Quiz', PLUGIN_DOMAIN ),
                'edit_item'     => __( 'Edit Quiz', PLUGIN_DOMAIN ),
                'view_item'     => __( 'View Quiz', PLUGIN_DOMAIN ),
                'menu_name'     => __( 'Quizzes', PLUGIN_DOMAIN ),
            ),
            'public'       => true,
            'has_archive'  => true,
            'show_in_menu' => PLUGIN_SLUG,
            'supports'     => array( 'title', 'thumbnail' ),
            'taxonomies'   => array( 'category' ),
            'show_in_rest' => false
        )
    );

    register_post_type( 'question',
        array(
            'labels'       => array(
                'name'          => __( 'Questions' ),
                'singular_name' => __( 'Question' ),
                'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
                'add_new_item'  => __( 'Add New Question', PLUGIN_DOMAIN ),
                'new_item'      => __( 'New Question', PLUGIN_DOMAIN ),
                'edit_item'     => __( 'Edit Question', PLUGIN_DOMAIN ),
                'view_item'     => __( 'View Question', PLUGIN_DOMAIN ),
            ),
            'public'       => true,
            'has_archive'  => true,
            'show_in_menu' => PLUGIN_SLUG,
            'supports'     => array( 'title', 'thumbnail' ),
            'taxonomies'   => array( 'category' ),
            'show_in_rest' => false,
        )
    );

    register_post_type( 'score',
        array(
            'labels'       => array(
                'name'          => __( 'Scores' ),
                'singular_name' => __( 'Score' ),
                'add_new'       => __( 'Add New', PLUGIN_DOMAIN ),
                'add_new_item'  => __( 'Add New Quiz', PLUGIN_DOMAIN ),
                'new_item'      => __( 'New Quiz', PLUGIN_DOMAIN ),
                'edit_item'     => __( 'Edit Quiz', PLUGIN_DOMAIN ),
                'view_item'     => __( 'View Quiz', PLUGIN_DOMAIN ),
                'menu_name'     => __( 'Scores', PLUGIN_DOMAIN ),
            ),
            'public'       => true,
            'has_archive'  => true,
            'show_in_menu' => PLUGIN_SLUG,
            'supports'     => array( 'title', 'thumbnail' ),
            'show_in_rest' => false,
        )
    );
}

/**
 * Register Quizzo menu
 *
 * @return void
 */
function register_quizzo_menu() {
    add_menu_page(
        __( 'Quizzo', PLUGIN_DOMAIN ),
        'Quizzo',
        PLUGIN_ROLE,
        PLUGIN_SLUG,
        false,
        'dashicons-edit-page',
        ''
    );

    add_submenu_page(
        PLUGIN_SLUG,
        'Quizzo',
        'Dashboard',
        PLUGIN_ROLE,
        PLUGIN_SLUG,
        'quizzo_plugin_page',
    );
}

/**
 * Register Meta boxes for Quizzo
 *
 * @return void
 */
function register_quizzo_meta_boxes() {
    /*add_meta_box(
        'quizzo_quiz_id',
        __( 'Quiz', PLUGIN_DOMAIN ),
        'quiz_metabox_quiz_id',
        'question'
    );*/

    add_meta_box(
        'quizzo_options',
        __( 'Options', PLUGIN_DOMAIN ),
        'quiz_metabox_options',
        'question'
    );

    add_meta_box(
        'quizzo_answer',
        __( 'Answer', PLUGIN_DOMAIN ),
        'quiz_metabox_answer',
        'question'
    );

    add_meta_box(
        'quizzo_questions',
        __( 'Questions', PLUGIN_DOMAIN ),
        'quiz_metabox_questions',
        'quiz'
    );

    add_meta_box(
        'quizzo_scores',
        __( 'Scores', PLUGIN_DOMAIN ),
        'quiz_metabox_scores',
        'score'
    );
}
