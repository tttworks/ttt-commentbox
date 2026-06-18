<?php
/**
 * TTT CommentBox — Elementor Widgets
 *
 * Registers two Elementor Widgets:
 *   - TTT Comments List  : Display a styled comment list with AJAX likes
 *   - TTT Comments Form  : Display the custom comment form
 *
 * Requires Elementor 3.0+.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor integration class.
 *
 * @since 1.0.0
 */
class TTT_Comments_Elementor {

    /**
     * Constructor — register Elementor widgets.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
    }

    /**
     * Register all Elementor widgets.
     *
     * @since 1.0.0
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets( $widgets_manager ) {
        require_once TTT_COMMENTBOX_PATH . 'includes/class-ttt-comments-elementor-list.php';
        require_once TTT_COMMENTBOX_PATH . 'includes/class-ttt-comments-elementor-form.php';

        $widgets_manager->register( new \TTTWorks\CommentBox\Widgets\TTT_Comments_List_Widget() );
        $widgets_manager->register( new \TTTWorks\CommentBox\Widgets\TTT_Comments_Form_Widget() );
    }
}

// Initialize Elementor integration
new TTT_Comments_Elementor();
