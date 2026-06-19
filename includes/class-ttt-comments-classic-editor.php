<?php
/**
 * TTT CommentBox — Classic Editor (TinyMCE) Integration
 *
 * Adds a toolbar button to the Classic Editor that opens a modal
 * for easy shortcode insertion with visual configuration.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Classic Editor integration class.
 *
 * @since 1.0.0
 */
class TTT_Comments_ClassicEditor {

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'mce_buttons', array( $this, 'register_button' ) );
        add_filter( 'mce_external_plugins', array( $this, 'register_plugin' ) );
        add_action( 'admin_footer', array( $this, 'render_modal' ) );
    }

    /**
     * Enqueue admin CSS for the modal.
     *
     * @since 1.0.0
     *
     * @param string $hook Current admin page hook.
     */
    public function enqueue_scripts( $hook ) {
        // Only on post editor screens
        if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
            return;
        }

        wp_enqueue_style(
            'ttt-commentbox-tinymce',
            TTT_COMMENTBOX_URL . 'assets/css/ttt-comments-tinymce.css',
            array(),
            TTT_COMMENTBOX_VERSION
        );
    }

    /**
     * Register the TinyMCE toolbar button.
     *
     * @since 1.0.0
     *
     * @param array $buttons Existing buttons.
     *
     * @return array
     */
    public function register_button( $buttons ) {
        array_push( $buttons, 'ttt_commentbox' );
        return $buttons;
    }

    /**
     * Register the TinyMCE plugin script.
     *
     * @since 1.0.0
     *
     * @param array $plugins Existing plugins.
     *
     * @return array
     */
    public function register_plugin( $plugins ) {
        $plugins['ttt_commentbox'] = TTT_COMMENTBOX_URL . 'assets/js/ttt-comments-tinymce.js';
        return $plugins;
    }

    /**
     * Render the modal HTML in the admin footer.
     *
     * This modal is opened by the TinyMCE button and provides
     * a visual interface for configuring and inserting shortcodes.
     *
     * @since 1.0.0
     */
    public function render_modal() {
        $screen = get_current_screen();

        if ( ! $screen || ! in_array( $screen->base, array( 'post' ), true ) ) {
            return;
        }

        ?>
        <div id="ttt-commentbox-modal" class="ttt-commentbox-modal" style="display:none;">
            <div class="ttt-commentbox-modal-overlay"></div>
            <div class="ttt-commentbox-modal-content">

                <div class="ttt-commentbox-modal-header">
                    <h2><?php esc_html_e( 'Insert TTT CommentBox', 'ttt-commentbox' ); ?></h2>
                    <button type="button" class="ttt-commentbox-modal-close">&times;</button>
                </div>

                <div class="ttt-commentbox-modal-body">
                    <!-- Tab navigation -->
                    <div class="ttt-commentbox-tabs">
                        <button class="ttt-commentbox-tab active" data-tab="list">
                            📋 <?php esc_html_e( 'Comments List', 'ttt-commentbox' ); ?>
                        </button>
                        <button class="ttt-commentbox-tab" data-tab="form">
                            ✏️ <?php esc_html_e( 'Comments Form', 'ttt-commentbox' ); ?>
                        </button>
                    </div>

                    <!-- Tab: Comments List -->
                    <div class="ttt-commentbox-tab-content active" id="ttt-tab-list">
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'List Title', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-list-title" placeholder="TTTWorks Discuss" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Avatar Size (px)', 'ttt-commentbox' ); ?></label>
                            <input type="number" id="ttt-shortcode-avatar-size" value="32" min="16" max="128" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label>
                                <input type="checkbox" id="ttt-shortcode-show-like" checked />
                                <?php esc_html_e( 'Show Like Button', 'ttt-commentbox' ); ?>
                            </label>
                        </div>
                        <div class="ttt-commentbox-row">
                            <label>
                                <input type="checkbox" id="ttt-shortcode-text-avatar" />
                                <?php esc_html_e( 'Text Avatar (游客文字头像，不请求 Gravatar)', 'ttt-commentbox' ); ?>
                            </label>
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Like Button Text (optional)', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-like-text" placeholder="e.g. Helpful" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Title Color', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-list-title-color" placeholder="#333333" class="ttt-color-input" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Text Color', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-comments-color" placeholder="#333333" class="ttt-color-input" />
                        </div>

                        <div class="ttt-commentbox-preview">
                            <strong><?php esc_html_e( 'Shortcode Preview:', 'ttt-commentbox' ); ?></strong>
                            <code id="ttt-shortcode-list-preview">[ttt_comments_list]</code>
                        </div>
                    </div>

                    <!-- Tab: Comments Form -->
                    <div class="ttt-commentbox-tab-content" id="ttt-tab-form">
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Form Title', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-form-title" placeholder="Share your opinion" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label>
                                <input type="checkbox" id="ttt-shortcode-show-website" checked />
                                <?php esc_html_e( 'Show Website Field', 'ttt-commentbox' ); ?>
                            </label>
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Name Label', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-label-name" placeholder="Name" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Email Label', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-label-email" placeholder="Email" />
                        </div>
                        <div class="ttt-commentbox-row">
                            <label><?php esc_html_e( 'Submit Button Text', 'ttt-commentbox' ); ?></label>
                            <input type="text" id="ttt-shortcode-label-submit" placeholder="Submit A Comment" />
                        </div>

                        <div class="ttt-commentbox-preview">
                            <strong><?php esc_html_e( 'Shortcode Preview:', 'ttt-commentbox' ); ?></strong>
                            <code id="ttt-shortcode-form-preview">[ttt_comment_form]</code>
                        </div>
                    </div>
                </div>

                <div class="ttt-commentbox-modal-footer">
                    <button type="button" class="button" id="ttt-commentbox-cancel">
                        <?php esc_html_e( 'Cancel', 'ttt-commentbox' ); ?>
                    </button>
                    <button type="button" class="button button-primary" id="ttt-commentbox-insert">
                        <?php esc_html_e( 'Insert Shortcode', 'ttt-commentbox' ); ?>
                    </button>
                </div>

            </div>
        </div>
        <?php
    }
}

// Initialize Classic Editor integration
new TTT_Comments_ClassicEditor();
