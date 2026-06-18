<?php
/**
 * TTT CommentBox — Shortcodes
 *
 * Registers [ttt_comments_list] and [ttt_comment_form] shortcodes
 * for use in Classic Editor, Gutenberg Custom HTML block, or any theme.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shortcode registration class.
 *
 * @since 1.0.0
 */
class TTT_Comments_Shortcodes {

    /**
     * Constructor — register shortcodes.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_shortcode( 'ttt_comments_list',   array( $this, 'shortcode_list' ) );
        add_shortcode( 'ttt_comment_form',    array( $this, 'shortcode_form' ) );
        add_shortcode( 'ttt_comments_list',   array( $this, 'shortcode_list' ), true );
        add_shortcode( 'ttt_comment_form',    array( $this, 'shortcode_form' ), true );
    }

    /**
     * [ttt_comments_list] shortcode.
     *
     * Usage:
     *   [ttt_comments_list]
     *   [ttt_comments_list avatar_size="40" list_title="Customer Reviews" show_like="1"]
     *
     * @since 1.0.0
     *
     * @param array $atts Shortcode attributes.
     *
     * @return string
     */
    public function shortcode_list( $atts ) {
        $atts = shortcode_atts(
            array(
                'avatar_size'     => 32,
                'show_like'      => '1',
                'show_like_image' => '0',
                'like_image_url'  => '',
                'like_text'      => '',
                'comments_color'  => '#333333',
                'list_title'     => __( 'Netizens discuss', 'ttt-commentbox' ),
                'list_title_show' => '1',
                'list_title_color' => '#333333',
                'children_bg'     => 'rgba(247, 249, 251, 1)',
                'text_avatar'    => '0',
            ),
            $atts,
            'ttt_comments_list'
        );

        // Ensure we are on a singular page
        if ( ! is_singular() ) {
            return '<!-- TTT CommentBox: [ttt_comments_list] only works on singular pages (posts, pages, custom post types). -->';
        }

        $settings = array(
            'avatar_size'     => (int) $atts['avatar_size'],
            'show_like'      => '1' === $atts['show_like'],
            'show_like_image' => '1' === $atts['show_like_image'],
            'like_image_url'  => esc_url_raw( $atts['like_image_url'] ),
            'like_text'      => sanitize_text_field( $atts['like_text'] ),
            'comments_color'  => sanitize_hex_color( $atts['comments_color'] ),
            'list_title_text' => sanitize_text_field( $atts['list_title'] ),
            'list_title_show' => '1' === $atts['list_title_show'],
            'list_title_color' => sanitize_hex_color( $atts['list_title_color'] ),
            'children_bg'    => sanitize_text_field( $atts['children_bg'] ),
            'text_avatar'    => '1' === $atts['text_avatar'],
            'widget_id'      => 'ttt-comments-sc-list-' . uniqid(),
        );

        return TTT_Comments_Core::render_list( $settings );
    }

    /**
     * [ttt_comment_form] shortcode.
     *
     * Usage:
     *   [ttt_comment_form]
     *   [ttt_comment_form form_title="Leave a Review" show_website="0"]
     *
     * @since 1.0.0
     *
     * @param array $atts Shortcode attributes.
     *
     * @return string
     */
    public function shortcode_form( $atts ) {
        $atts = shortcode_atts(
            array(
                'form_title'      => __( 'Share your opinion', 'ttt-commentbox' ),
                'form_title_show' => '1',
                'form_title_color' => '#333333',
                'form_color'       => '#333333',
                'submit_color'    => '#ffffff',
                'submit_bg'       => '#007bff',
                'label_name'      => __( 'Name', 'ttt-commentbox' ),
                'label_email'     => __( 'Email', 'ttt-commentbox' ),
                'label_website'   => __( 'Website', 'ttt-commentbox' ),
                'label_comment'   => __( 'Comment', 'ttt-commentbox' ),
                'label_submit'    => __( 'Submit A Comment', 'ttt-commentbox' ),
                'label_save_info' => __( 'Save my name, email, and website in this browser for the next time I comment.', 'ttt-commentbox' ),
                'show_website'    => '1',
            ),
            $atts,
            'ttt_comment_form'
        );

        // Ensure we are on a singular page
        if ( ! is_singular() ) {
            return '<!-- TTT CommentBox: [ttt_comment_form] only works on singular pages (posts, pages, custom post types). -->';
        }

        $settings = array(
            'form_title_text'  => sanitize_text_field( $atts['form_title'] ),
            'form_title_show'  => '1' === $atts['form_title_show'],
            'form_title_color' => sanitize_hex_color( $atts['form_title_color'] ),
            'form_color'       => sanitize_hex_color( $atts['form_color'] ),
            'submit_color'     => sanitize_hex_color( $atts['submit_color'] ),
            'submit_bg'        => sanitize_hex_color( $atts['submit_bg'] ),
            'label_name'       => sanitize_text_field( $atts['label_name'] ),
            'label_email'      => sanitize_text_field( $atts['label_email'] ),
            'label_website'    => sanitize_text_field( $atts['label_website'] ),
            'label_comment'    => sanitize_text_field( $atts['label_comment'] ),
            'label_submit'     => sanitize_text_field( $atts['label_submit'] ),
            'label_save_info'  => sanitize_text_field( $atts['label_save_info'] ),
            'show_website'     => '1' === $atts['show_website'],
            'widget_id'        => 'ttt-comments-sc-form-' . uniqid(),
        );

        return TTT_Comments_Core::render_form( $settings );
    }
}

// Initialize shortcodes
new TTT_Comments_Shortcodes();
