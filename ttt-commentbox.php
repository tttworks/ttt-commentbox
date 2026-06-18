<?php
/**
 * Plugin Name: TTT CommentBox for Elementor
 * Plugin URI: https://github.com/tttworks/ttt-commentbox
 * Description: A complete comment system for Elementor pages — custom list display, AJAX likes, threaded replies, and a full comment form. Also supports Gutenberg and Classic Editor via Shortcodes. Zero conflict with WooCommerce Reviews.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Aloysius Luo (TTTWorks)
 * Author URI: https://tttworks.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ttt-commentbox
 * Domain Path: /languages
 *
 * @package TTTWorks/CommentBox
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin constants
define( 'TTT_COMMENTBOX_VERSION', '1.0.0' );
define( 'TTT_COMMENTBOX_PATH',    plugin_dir_path( __FILE__ ) );
define( 'TTT_COMMENTBOX_URL',     plugin_dir_url( __FILE__ ) );
define( 'TTT_COMMENTBOX_BASENAME', plugin_basename( __FILE__ ) );
define( 'TTT_COMMENTBOX_PHP_MIN_VERSION', '7.4' );
define( 'TTT_COMMENTBOX_ELEMENTOR_MIN_VERSION', '3.0.0' );

/**
 * Comment source identifier.
 *
 * Every comment created through TTT CommentBox widgets/shortcodes
 * gets a `ttt_comment_source` comment meta key set to this value.
 * This allows:
 *   - Filtering only TTT comments in the future admin panel
 *   - Zero conflict with WooCommerce reviews (comment_type='review')
 *
 * @since 1.0.0
 */
define( 'TTT_COMMENTBOX_SOURCE', 'ttt-commentbox' );

/**
 * Autoloader for plugin classes.
 *
 * Maps classes in the TTTWorks\CommentBox namespace to includes/ files.
 * Class naming convention: class-ttt-comments-{lowercase-name}.php
 *
 * @since 1.0.0
 *
 * @param string $class Fully-qualified class name.
 */
spl_autoload_register(
    function ( $class ) {
        $prefix = 'TTTWorks\\CommentBox\\';

        if ( strpos( $class, $prefix ) !== 0 ) {
            return;
        }

        $relative_class = substr( $class, strlen( $prefix ) );
        $file          = strtolower( str_replace( '\\', '/', $relative_class ) );
        $file_path     = TTT_COMMENTBOX_PATH . 'includes/class-ttt-comments-' . $file . '.php';

        if ( file_exists( $file_path ) ) {
            require_once $file_path;
        }
    }
);

/**
 * Shorthand for the plugin instance.
 *
 * @since 1.0.0
 *
 * @return TTT_CommentBox
 */
function ttt_commentbox() {
    return TTT_CommentBox::instance();
}

/**
 * Main plugin class.
 *
 * @since 1.0.0
 */
class TTT_CommentBox {

    /**
     * Singleton instance.
     *
     * @since 1.0.0
     *
     * @var TTT_CommentBox
     */
    private static $instance = null;

    /**
     * Get the singleton instance.
     *
     * @since 1.0.0
     *
     * @return TTT_CommentBox
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    private function __construct() {
        if ( ! $this->meets_requirements() ) {
            return;
        }

        $this->init_hooks();
    }

    /**
     * Check PHP and WordPress version requirements.
     *
     * @since 1.0.0
     *
     * @return bool
     */
    private function meets_requirements() {
        if ( version_compare( PHP_VERSION, TTT_COMMENTBOX_PHP_MIN_VERSION, '<' ) ) {
            add_action( 'admin_notices', array( $this, 'notice_php_version' ) );
            return false;
        }

        global $wp_version;

        if ( version_compare( $wp_version, '5.8', '<' ) ) {
            add_action( 'admin_notices', array( $this, 'notice_wp_version' ) );
            return false;
        }

        return true;
    }

    /**
     * Show PHP version notice.
     *
     * @since 1.0.0
     */
    public function notice_php_version() {
        printf(
            '<div class="notice notice-error"><p><strong>TTT CommentBox:</strong> %s</p></div>',
            esc_html(
                sprintf(
                    /* translators: %s: PHP version numbers */
                    __( 'Requires PHP %s or higher. You are running %s.', 'ttt-commentbox' ),
                    TTT_COMMENTBOX_PHP_MIN_VERSION,
                    PHP_VERSION
                )
            )
        );
    }

    /**
     * Show WordPress version notice.
     *
     * @since 1.0.0
     */
    public function notice_wp_version() {
        printf(
            '<div class="notice notice-error"><p><strong>TTT CommentBox:</strong> %s</p></div>',
            esc_html(
                sprintf(
                    /* translators: %s: WordPress version number */
                    __( 'Requires WordPress %s or higher.', 'ttt-commentbox' ),
                    '5.8'
                )
            )
        );
    }

    /**
     * Initialize WordPress hooks.
     *
     * @since 1.0.0
     */
    private function init_hooks() {
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 0 );
        add_action( 'plugins_loaded', array( $this, 'init_components' ), 20 );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_menu', array( $this, 'register_intro_page' ) );
    }

    /**
     * Load plugin text domain.
     *
     * @since 1.0.0
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'ttt-commentbox',
            false,
            dirname( TTT_COMMENTBOX_BASENAME ) . '/languages'
        );
    }

    /**
     * Initialize all plugin components.
     *
     * @since 1.0.0
     */
    public function init_components() {
        // Core comment rendering and source marking — always loaded
        $this->load( 'class-ttt-comments-core.php' );

        // AJAX handlers — always loaded
        $this->load( 'class-ttt-comments-ajax.php' );

        // Shortcodes — works everywhere (Classic Editor, Gutenberg, theme templates)
        $this->load( 'class-ttt-comments-shortcodes.php' );

        // Elementor Widgets — only when Elementor is active
        if ( defined( 'ELEMENTOR_VERSION' ) ) {
            $this->load( 'class-ttt-comments-elementor.php' );
        }

        // Gutenberg Blocks — only when block editor is available
        if ( function_exists( 'register_block_type' ) ) {
            $this->load( 'class-ttt-comments-gutenberg.php' );
        }

        // Classic Editor (TinyMCE) — only in admin
        if ( is_admin() && ! wp_is_block_theme() ) {
            $this->load( 'class-ttt-comments-classic-editor.php' );
        }
    }

    /**
     * Safely load a component file.
     *
     * @since 1.0.0
     *
     * @param string $file File name relative to includes/.
     */
    private function load( $file ) {
        $path = TTT_COMMENTBOX_PATH . 'includes/' . $file;

        if ( file_exists( $path ) ) {
            require_once $path;
        }
    }

    /**
     * Register the plugin introduction page.
     *
     * @since 1.0.0
     */
    public function register_intro_page() {
        add_menu_page(
            __( 'TTT CommentBox', 'ttt-commentbox' ),
            __( 'TTT CommentBox', 'ttt-commentbox' ),
            'manage_options',
            'ttt-commentbox',
            array( $this, 'render_intro_page' ),
            'dashicons-admin-comments',
            65
        );
    }

    /**
     * Render the plugin introduction page.
     *
     * @since 1.0.0
     */
    public function render_intro_page() {
        // Load the intro page styles on this page only
        wp_enqueue_style(
            'ttt-commentbox-intro',
            TTT_COMMENTBOX_URL . 'assets/css/ttt-comments-intro.css',
            array(),
            TTT_COMMENTBOX_VERSION
        );

        // Include the intro page template
        include TTT_COMMENTBOX_PATH . 'includes/page-intro.php';
    }

    /**
     * Enqueue frontend CSS and JavaScript.
     *
     * @since 1.0.0
     */
    public function enqueue_assets() {
        // Only load on singular pages that might display comments
        if ( ! is_singular() && ! is_admin() ) {
            return;
        }

        // CSS
        wp_enqueue_style(
            'ttt-commentbox',
            TTT_COMMENTBOX_URL . 'assets/css/ttt-comments.css',
            array(),
            TTT_COMMENTBOX_VERSION
        );

        // JavaScript (requires jQuery)
        wp_enqueue_script(
            'ttt-commentbox',
            TTT_COMMENTBOX_URL . 'assets/js/ttt-comments.js',
            array( 'jquery' ),
            TTT_COMMENTBOX_VERSION,
            true
        );

        // Pass data to JavaScript
        wp_localize_script(
            'ttt-commentbox',
            'tttCommentBox',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'ttt_commentbox_nonce' ),
                'i18n'    => array(
                    'alreadyLiked' => __( 'You have already liked this comment.', 'ttt-commentbox' ),
                    'likeFailed'   => __( 'Like failed. Please try again.', 'ttt-commentbox' ),
                    'submitFailed' => __( 'Comment submission failed. Please try again.', 'ttt-commentbox' ),
                    'replyTo'      => __( 'Replying to', 'ttt-commentbox' ),
                ),
            )
        );
    }
}

// Boot the plugin
add_action( 'plugins_loaded', array( 'TTT_CommentBox', 'instance' ), 5 );

/**
 * Plugin activation hook.
 *
 * @since 1.0.0
 */
function ttt_commentbox_activate() {
    flush_rewrite_rules();
    set_transient( 'ttt_commentbox_activated', true, 30 );
}
register_activation_hook( __FILE__, 'ttt_commentbox_activate' );

/**
 * Plugin deactivation hook.
 *
 * @since 1.0.0
 */
function ttt_commentbox_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ttt_commentbox_deactivate' );
