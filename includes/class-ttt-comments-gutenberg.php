<?php
/**
 * TTT CommentBox — Gutenberg Block Support
 *
 * Registers two Gutenberg blocks:
 *   - TTT Comments List  (ttt-commentbox/comments-list)
 *   - TTT Comments Form  (ttt-commentbox/comments-form)
 *
 * Each block mirrors the Elementor widget settings panel as closely
 * as Gutenberg's InspectorControls API allows.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Gutenberg integration class.
 *
 * @since 1.0.0
 */
class TTT_Comments_Gutenberg {

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_blocks' ), 20 );
        add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor' ) );
    }

    /**
     * Register Gutenberg blocks.
     */
    public function register_blocks() {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        register_block_type( 'ttt-commentbox/comments-list', array(
            'title'           => __( 'TTT Comments List', 'ttt-commentbox' ),
            'description'     => __( 'Styled comment list with AJAX likes, threaded replies, and configurable appearance.', 'ttt-commentbox' ),
            'category'        => 'ttt-commentbox',
            'icon'            => 'list-view',
            'keywords'        => array( 'comment', 'comments', 'review', 'reply', 'like', 'ttt' ),
            'supports'        => array( 'html' => false ),
            'attributes'      => $this->list_attributes(),
            'render_callback' => array( $this, 'render_list' ),
            'editor_script'   => 'ttt-commentbox-editor',
        ));

        register_block_type( 'ttt-commentbox/comments-form', array(
            'title'           => __( 'TTT Comments Form', 'ttt-commentbox' ),
            'description'     => __( 'Custom comment form with configurable labels, colors, and layout.', 'ttt-commentbox' ),
            'category'        => 'ttt-commentbox',
            'icon'            => 'editor-table',
            'keywords'        => array( 'comment', 'form', 'submit', 'feedback', 'review', 'ttt' ),
            'supports'        => array( 'html' => false ),
            'attributes'      => $this->form_attributes(),
            'render_callback' => array( $this, 'render_form' ),
            'editor_script'   => 'ttt-commentbox-editor',
        ));
    }

    /** @return array List block attribute schema */
    private function list_attributes() {
        return array(
            'listTitle'      => array( 'type' => 'string',  'default' => '' ),
            'listTitleShow'  => array( 'type' => 'boolean', 'default' => true ),
            'listTitleColor' => array( 'type' => 'string',  'default' => '#333333' ),
            'showLike'       => array( 'type' => 'boolean', 'default' => true ),
            'showLikeImage'  => array( 'type' => 'boolean', 'default' => false ),
            'likeImageUrl'   => array( 'type' => 'string',  'default' => '' ),
            'likeText'       => array( 'type' => 'string',  'default' => '' ),
            'likeColor'      => array( 'type' => 'string',  'default' => '#666666' ),
            'likedColor'     => array( 'type' => 'string',  'default' => '#e74c3c' ),
            'avatarSize'     => array( 'type' => 'number',  'default' => 32 ),
            'commentsColor'  => array( 'type' => 'string',  'default' => '#333333' ),
            'childrenBg'     => array( 'type' => 'string',  'default' => 'rgba(247, 249, 251, 1)' ),
            'textAvatar'     => array( 'type' => 'boolean', 'default' => false ),
        );
    }

    /** @return array Form block attribute schema */
    private function form_attributes() {
        return array(
            'formTitle'      => array( 'type' => 'string',  'default' => '' ),
            'formTitleShow'  => array( 'type' => 'boolean', 'default' => true ),
            'formTitleColor' => array( 'type' => 'string',  'default' => '#333333' ),
            'formColor'      => array( 'type' => 'string',  'default' => '#333333' ),
            'submitColor'    => array( 'type' => 'string',  'default' => '#ffffff' ),
            'submitBg'       => array( 'type' => 'string',  'default' => '#007bff' ),
            'labelName'      => array( 'type' => 'string',  'default' => '' ),
            'labelEmail'     => array( 'type' => 'string',  'default' => '' ),
            'labelWebsite'   => array( 'type' => 'string',  'default' => '' ),
            'labelComment'   => array( 'type' => 'string',  'default' => '' ),
            'labelSubmit'    => array( 'type' => 'string',  'default' => '' ),
            'labelSaveInfo'  => array( 'type' => 'string',  'default' => '' ),
            'showWebsite'    => array( 'type' => 'boolean', 'default' => true ),
        );
    }

    /**
     * Enqueue editor script and register block category.
     */
    public function enqueue_editor() {
        wp_enqueue_script(
            'ttt-commentbox-editor',
            TTT_COMMENTBOX_URL . 'assets/js/ttt-comments-editor.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-block-editor' ),
            TTT_COMMENTBOX_VERSION,
            true
        );

        add_filter( 'block_categories_all', function ( $cats ) {
            array_unshift( $cats, array(
                'slug'  => 'ttt-commentbox',
                'title' => __( 'TTT CommentBox', 'ttt-commentbox' ),
                'icon'  => 'admin-comments',
            ));
            return $cats;
        });
    }

    /**
     * Render the list block.
     *
     * @param array $a Block attributes.
     * @return string
     */
    public function render_list( $a ) {
        if ( ! is_singular() ) return '';

        return TTT_Comments_Core::render_list( array(
            'avatar_size'      => isset( $a['avatarSize'] ) ? (int) $a['avatarSize'] : 32,
            'show_like'        => isset( $a['showLike'] ) ? (bool) $a['showLike'] : true,
            'show_like_image'  => isset( $a['showLikeImage'] ) ? (bool) $a['showLikeImage'] : false,
            'like_image_url'   => isset( $a['likeImageUrl'] ) ? esc_url_raw( $a['likeImageUrl'] ) : '',
            'like_text'        => isset( $a['likeText'] ) ? sanitize_text_field( $a['likeText'] ) : '',
            'comments_color'   => isset( $a['commentsColor'] ) ? sanitize_hex_color( $a['commentsColor'] ) : '#333333',
            'list_title_text'  => empty( $a['listTitle'] ) ? __( 'TTTWorks Discuss', 'ttt-commentbox' ) : sanitize_text_field( $a['listTitle'] ),
            'list_title_show'  => isset( $a['listTitleShow'] ) ? (bool) $a['listTitleShow'] : true,
            'list_title_color' => isset( $a['listTitleColor'] ) ? sanitize_hex_color( $a['listTitleColor'] ) : '#333333',
            'children_bg'      => isset( $a['childrenBg'] ) ? sanitize_text_field( $a['childrenBg'] ) : 'rgba(247, 249, 251, 1)',
            'text_avatar'       => isset( $a['textAvatar'] ) ? (bool) $a['textAvatar'] : false,
            'widget_id'        => 'ttt-gb-list-' . uniqid(),
        ));
    }

    /**
     * Render the form block.
     *
     * @param array $a Block attributes.
     * @return string
     */
    public function render_form( $a ) {
        if ( ! is_singular() ) return '';

        return TTT_Comments_Core::render_form( array(
            'form_title_text'  => empty( $a['formTitle'] ) ? __( 'Share your opinion', 'ttt-commentbox' ) : sanitize_text_field( $a['formTitle'] ),
            'form_title_show'  => isset( $a['formTitleShow'] ) ? (bool) $a['formTitleShow'] : true,
            'form_title_color' => isset( $a['formTitleColor'] ) ? sanitize_hex_color( $a['formTitleColor'] ) : '#333333',
            'form_color'       => isset( $a['formColor'] ) ? sanitize_hex_color( $a['formColor'] ) : '#333333',
            'submit_color'     => isset( $a['submitColor'] ) ? sanitize_hex_color( $a['submitColor'] ) : '#ffffff',
            'submit_bg'        => isset( $a['submitBg'] ) ? sanitize_hex_color( $a['submitBg'] ) : '#007bff',
            'label_name'       => empty( $a['labelName'] ) ? __( 'Name', 'ttt-commentbox' ) : sanitize_text_field( $a['labelName'] ),
            'label_email'      => empty( $a['labelEmail'] ) ? __( 'Email', 'ttt-commentbox' ) : sanitize_text_field( $a['labelEmail'] ),
            'label_website'    => empty( $a['labelWebsite'] ) ? __( 'Website', 'ttt-commentbox' ) : sanitize_text_field( $a['labelWebsite'] ),
            'label_comment'    => empty( $a['labelComment'] ) ? __( 'Comment', 'ttt-commentbox' ) : sanitize_text_field( $a['labelComment'] ),
            'label_submit'     => empty( $a['labelSubmit'] ) ? __( 'Submit A Comment', 'ttt-commentbox' ) : sanitize_text_field( $a['labelSubmit'] ),
            'label_save_info'  => empty( $a['labelSaveInfo'] ) ? __( 'Save my name, email, and website in this browser for the next time I comment.', 'ttt-commentbox' ) : sanitize_text_field( $a['labelSaveInfo'] ),
            'show_website'     => isset( $a['showWebsite'] ) ? (bool) $a['showWebsite'] : true,
            'widget_id'        => 'ttt-gb-form-' . uniqid(),
        ));
    }
}

new TTT_Comments_Gutenberg();
