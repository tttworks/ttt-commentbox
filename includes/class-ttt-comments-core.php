<?php
/**
 * TTT CommentBox — Core Comment Rendering
 *
 * Handles rendering of the comment list and comment form HTML,
 * and marks all new comments created via this plugin's widgets.
 * This class is used by Shortcodes, Elementor Widgets, and Gutenberg Blocks —
 * all editor integrations share the same rendering logic.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Core comment rendering class.
 *
 * @since 1.0.0
 */
class TTT_Comments_Core {

    /**
     * Comment source identifier for TTT CommentBox.
     *
     * Stored in comment_meta: ttt_comment_source = 'ttt-commentbox'
     * This allows distinguishing TTT CommentBox comments from other
     * WordPress comments (e.g. WooCommerce product reviews).
     *
     * @since 1.0.0
     *
     * @var string
     */
    const SOURCE = 'ttt-commentbox';

    /**
     * Constructor — register WordPress comment hooks.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Mark all new comments created via this plugin
        add_filter( 'comment_post', array( __CLASS__, 'mark_comment_source' ), 10, 3 );
    }

    /**
     * Mark a new comment as originating from TTT CommentBox.
     *
     * This runs when any WordPress comment is created.
     * We check if the current post/page has a TTT CommentBox widget/shortcode
     * rendered on it — the most reliable way to identify TTT-generated comments
     * without relying on referer headers.
     *
     * Strategy:
     *   1. Check if the post contains our CSS class in the content (shortcode rendering)
     *   2. If so, mark it as TTT CommentBox source
     *   3. Otherwise leave it unmarked (e.g. WooCommerce reviews, other comment forms)
     *
     * @since 1.0.0
     *
     * @param int        $comment_id   Comment ID.
     * @param int|string $comment_approved Approval status. 'spam', 'trash', 1, or 0.
     * @param array      $commentdata Comment data array.
     */
    public static function mark_comment_source( $comment_id, $comment_approved, $commentdata ) {
        // Skip spam/trash
        if ( 'spam' === $comment_approved || 'trash' === $comment_approved ) {
            return;
        }

        // Only mark approved or pending comments
        if ( 1 !== $comment_approved && 0 !== $comment_approved && 'hold' !== $comment_approved ) {
            return;
        }

        $post_id = isset( $commentdata['comment_post_ID'] ) ? (int) $commentdata['comment_post_ID'] : 0;

        if ( ! $post_id ) {
            return;
        }

        // Check if the post content contains our shortcode or widgets
        $post = get_post( $post_id );

        if ( ! $post ) {
            return;
        }

        $content = $post->post_content;

        // Check for our shortcodes
        $has_shortcode = (
            has_shortcode( $content, 'ttt_comments_list' )
            || has_shortcode( $content, 'ttt_comment_form' )
            || has_shortcode( $content, 'ttt_comments' )
        );

        // Check for our CSS class (rendered by Elementor/Gutenberg widgets)
        $has_widget_class = (
            false !== strpos( $content, 'ttt-comments-wrapper' )
            || false !== strpos( $content, 'ttt-comment-form' )
        );

        if ( $has_shortcode || $has_widget_class ) {
            update_comment_meta( $comment_id, 'ttt_comment_source', self::SOURCE );
            error_log( '[TTT CommentBox] Comment marked: ID ' . $comment_id . ' | Post: ' . $post_id );
        }
    }

    /**
     * Get the visitor's IP address.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function get_client_ip() {
        $ip = '';

        if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
            $ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
        }

        return $ip;
    }

    /**
     * Get the WordPress comment query args, filtered to TTT CommentBox comments only.
     *
     * @since 1.0.0
     *
     * @param array $base_args Base comment query args.
     *
     * @return array
     */
    private static function filter_to_ttt_comments( $base_args ) {
        // Add meta query to only show comments created by TTT CommentBox
        $base_args['meta_query'] = array(
            array(
                'key'     => 'ttt_comment_source',
                'value'   => self::SOURCE,
                'compare' => '=',
            ),
        );

        return $base_args;
    }

    /**
     * Render the comment list.
     *
     * Used by:
     *   - Shortcode: [ttt_comments_list]
     *   - Elementor Widget: TTT Comments List
     *
     * @since 1.0.0
     *
     * @param array $settings Widget / shortcode settings.
     *
     * @return string HTML output.
     */
    public static function render_list( $settings = array() ) {
        $post_id = get_the_ID();

        if ( ! $post_id ) {
            return '';
        }

        // Defaults
        $settings = wp_parse_args(
            $settings,
            array(
                'avatar_size'       => 32,
                'show_like'         => true,
                'show_like_image'   => false,
                'like_image_url'    => '',
                'like_text'         => '',
                'comments_color'    => '#333333',
                'list_title_text'   => __( 'Netizens discuss', 'ttt-commentbox' ),
                'list_title_show'   => true,
                'list_title_color'  => '#333333',
                'children_bg'       => 'rgba(247, 249, 251, 1)',
                'widget_id'         => 'ttt-comments-list-' . uniqid(),
            'text_avatar'         => false,
            )
        );

        $user_id = get_current_user_id();
        $user_ip = self::get_client_ip();

        ob_start();
        ?>
        <div class="ttt-comments-wrapper"
             id="<?php echo esc_attr( $settings['widget_id'] ); ?>"
             data-post-id="<?php echo esc_attr( $post_id ); ?>"
             data-avatar-size="<?php echo esc_attr( $settings['avatar_size'] ); ?>"
             data-show-like="<?php echo $settings['show_like'] ? '1' : '0'; ?>"
             data-show-like-image="<?php echo $settings['show_like_image'] ? '1' : '0'; ?>"
             data-like-image="<?php echo esc_url( $settings['like_image_url'] ); ?>"
             data-like-text="<?php echo esc_attr( $settings['like_text'] ); ?>"
             data-comments-color="<?php echo esc_attr( $settings['comments_color'] ); ?>"
             data-user-id="<?php echo esc_attr( $user_id ); ?>"
             data-user-ip="<?php echo esc_attr( $user_ip ); ?>"
             data-children-bg="<?php echo esc_attr( $settings['children_bg'] ); ?>">

            <div class="ttt-comments-list" style="color:<?php echo esc_attr( $settings['comments_color'] ); ?>;">

                <?php if ( $settings['list_title_show'] && $settings['list_title_text'] ) : ?>
                    <h3 class="ttt-comments-title"
                        style="color:<?php echo esc_attr( $settings['list_title_color'] ); ?>">
                        <?php echo esc_html( $settings['list_title_text'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php
                echo self::render_comments(
                    $post_id,
                    $settings['avatar_size'],
                    $settings['show_like'],
                    $settings['show_like_image'],
                    $settings['like_image_url'],
                    $settings['like_text'],
                    $user_id,
                    $user_ip
                );
                ?>

            </div>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Render a list of approved TTT CommentBox comments for a post.
     *
     * Only queries comments that have ttt_comment_source = 'ttt-commentbox'
     * in their comment meta, ensuring we don't show WooCommerce reviews
     * or other third-party comments.
     *
     * @since 1.0.0
     *
     * @param int    $post_id         Post ID.
     * @param int    $avatar_size     Avatar size in pixels.
     * @param bool   $show_like      Whether to show like button.
     * @param bool   $show_like_img Whether to show custom like image.
     * @param string $like_img_url  Custom like image URL.
     * @param string $like_text     Custom like button text.
     * @param int    $user_id       Current user ID.
     * @param string $user_ip       Current visitor IP.
     *
     * @return string HTML output.
     */
    private static function render_comments(
        $post_id,
        $avatar_size,
        $show_like,
        $show_like_img,
        $like_img_url,
        $like_text,
        $user_id,
        $user_ip
    ) {

        $args = self::filter_to_ttt_comments(
            array(
                'post_id' => $post_id,
                'number'  => 100,
                'status'  => 'approve',
                'parent'  => 0,
            )
        );

        $comments = get_comments( $args );

        if ( empty( $comments ) ) {
            return '<p class="ttt-no-comments">' .
                esc_html__( 'No comments yet. Be the first to comment!', 'ttt-commentbox' ) .
                '</p>';
        }

        ob_start();
        ?>

        <ol class="ttt-comments-ol">
            <?php
            foreach ( $comments as $comment ) {
                echo self::render_single_comment(
                    $comment,
                    $avatar_size,
                    $show_like,
                    $show_like_img,
                    $like_img_url,
                    $like_text,
                    $user_id,
                    $user_ip
                );
            }
            ?>
        </ol>

        <?php

        return ob_get_clean();
    }

    /**
     * Render a single comment (including its children).
     *
     * @since 1.0.0
     *
     * @param \WP_Comment $comment        Comment object.
     * @param int        $avatar_size    Avatar size in pixels.
     * @param bool       $show_like     Whether to show like button.
     * @param bool       $show_like_img Whether to show custom like image.
     * @param string     $like_img_url Custom like image URL.
     * @param string     $like_text    Custom like button text.
     * @param int        $user_id      Current user ID.
     * @param string     $user_ip     Current visitor IP.
     *
     * @return string HTML output.
     */
    private static function render_single_comment(
        $comment,
        $avatar_size,
        $show_like_img,
        $show_like,
        $like_img_url,
        $like_text,
        $user_id,
        $user_ip
    ) {

        $comment_id       = (int) $comment->comment_ID;
        $author_name     = get_comment_author( $comment );
        $comment_date     = get_comment_date( 'M jS G:i', $comment );
        $comment_date_full = get_comment_date( 'M jS, Y', $comment );
        $comment_content = wpautop( get_comment_text( $comment ) );
        $avatar          = get_avatar( $comment, $avatar_size, '', $author_name, array( 'force_display' => true ) );

        // 文字头像：如果开启了 text_avatar 功能，则为游客替换为字母头像
        if ( ! empty( $settings['text_avatar'] ) && empty( $comment->user_id ) ) {
            $author_name_clean = trim( wp_strip_all_tags( $author_name ) );
            if ( '' === $author_name_clean ) {
                $author_name_clean = 'V'; // Visitor
            }
            $avatar = self::render_text_avatar( $author_name_clean, $avatar_size );
        }

        // Like count
        $like_count = get_comment_meta( $comment_id, 'ttt_like_count', true );
        if ( '' === $like_count ) {
            $like_count = 0;
        }

        // Check if current user already liked
        $liked_class = '';

        if ( is_user_logged_in() ) {
            $current_user_id = get_current_user_id();
            $liked_users    = get_comment_meta( $comment_id, 'ttt_liked_users', true );

            if ( is_array( $liked_users ) && in_array( (string) $current_user_id, $liked_users, true ) ) {
                $liked_class = ' ttt-liked';
            }
        } else {
            $liked_ips = get_comment_meta( $comment_id, 'ttt_liked_ips', true );

            if ( is_array( $liked_ips ) && isset( $liked_ips[ $user_ip ] ) ) {
                if ( time() - (int) $liked_ips[ $user_ip ] < 48 * HOUR_IN_SECONDS ) {
                    $liked_class = ' ttt-liked';
                }
            }
        }

        // Build safe reply author string
        $reply_author = str_replace(
            array( '"', "'" ),
            array( '&quot;', "\\'" ),
            $author_name
        );

        ob_start();
        ?>

        <li class="ttt-comment-item" id="comment-<?php echo esc_attr( $comment_id ); ?>">

            <div class="ttt-comment-avatar">
                <?php echo $avatar; ?>
            </div>

            <div class="ttt-comment-body">

                <div class="ttt-comment-meta">
                    <span class="ttt-comment-author"><?php echo esc_html( $author_name ); ?></span>
                    <span class="ttt-comment-date"
                          title="<?php echo esc_attr( $comment_date_full ); ?>">
                        <?php echo esc_html( $comment_date ); ?>
                    </span>
                </div>

                <div class="ttt-comment-content">
                    <?php echo wp_kses_post( $comment_content ); ?>
                </div>

                <div class="ttt-comment-actions">

                    <?php if ( $show_like ) : ?>
                        <?php
                        $like_icon_html = '';

                        if ( $show_like_img && $like_img_url ) {
                            $like_icon_html = sprintf(
                                '<img src="%s" alt="%s" class="ttt-like-icon" /> ',
                                esc_url( $like_img_url ),
                                esc_attr__( 'Like', 'ttt-commentbox' )
                            );
                        }

                        $like_text_html = $like_text
                            ? '<span class="ttt-like-text">' . esc_html( $like_text ) . '</span>'
                            : '';
                        ?>

                        <span class="ttt-comment-like<?php echo esc_attr( $liked_class ); ?>"
                              data-comment-id="<?php echo esc_attr( $comment_id ); ?>"
                              data-ip="<?php echo esc_attr( $user_ip ); ?>"
                              role="button"
                              tabindex="0"
                              aria-label="<?php esc_attr_e( 'Like this comment', 'ttt-commentbox' ); ?>">
                            <?php echo $like_icon_html; ?>
                            <span class="ttt-like-count"><?php echo esc_html( $like_count ); ?></span>
                            <?php echo $like_text_html; ?>
                        </span>
                    <?php endif; ?>

                    <span class="ttt-comment-reply">
                        <a href="#respond"
                           class="comment-reply-link"
                           onclick="tttCommentReply(<?php echo esc_attr( $comment_id ); ?>, '<?php echo esc_attr( $reply_author ); ?>'); return false;"
                           rel="nofollow">
                            <?php esc_html_e( 'Reply', 'ttt-commentbox' ); ?>
                        </a>
                    </span>

                </div>
            </div>
        </li>

        <?php
        // Render child comments (threaded replies) — also filter to TTT CommentBox only
        $child_args = self::filter_to_ttt_comments(
            array(
                'parent'       => $comment_id,
                'status'       => 'approve',
                'hierarchical' => false,
            )
        );

        $child_comments = get_comments( $child_args );

        if ( ! empty( $child_comments ) ) {
            ?>
            <ul class="ttt-children">
                <?php
                foreach ( $child_comments as $child ) {
                    echo self::render_single_comment(
                        $child,
                        $avatar_size,
                        $show_like,
                        $show_like_img,
                        $like_img_url,
                        $like_text,
                        $user_id,
                        $user_ip
                    );
                }
                ?>
            </ul>
            <?php
        }

        return ob_get_clean();
    }

    /**
     * Render a text-based avatar instead of an image.
     *
     * Rules:
     * - Single word / CJK name: show first character (e.g. "Alice" → "A", "张三" → "张")
     * - Two+ words: show first character of first two words (e.g. "Alice Wang" → "AW")
     * - Empty name: show "V" (Visitor)
     * - Color assigned based on CRC32 hash of the name — same name = same color
     *
     * @since 1.1.0
     *
     * @param string $name Cleaned author name.
     * @param int    $size Avatar size in pixels.
     *
     * @return string HTML output.
     */
    private static function render_text_avatar( $name, $size ) {
        // 提取首字母
        $initials = self::get_initials( $name );

        // 预设背景颜色池，根据名字哈希自动分配
        $colors = array(
            '#e57373', '#f06292', '#ba68c8', '#9575cd', '#64b5f6',
            '#4db6ac', '#81c784', '#ffb74d', '#a1887f', '#90a4ae',
        );

        $index = abs( crc32( $name ) ) % count( $colors );
        $bg    = $colors[ $index ];

        // 两个字符时字体略小，防止溢出圆形边界
        $font_size = strlen( $initials ) > 1
            ? round( $size * 0.38 )
            : round( $size * 0.45 );

        $style = sprintf(
            'width:%1$dpx;height:%1$dpx;line-height:%1$dpx;border-radius:50%%;background:%2$s;color:#fff;display:inline-block;text-align:center;font-size:%3$dpx;font-weight:600;text-transform:uppercase;',
            $size,
            esc_attr( $bg ),
            max( 12, $font_size )
        );

        return sprintf(
            '<span class="ttt-text-avatar avatar avatar-%1$d photo" style="%2$s" aria-hidden="true">%3$s</span>',
            $size,
            esc_attr( $style ),
            esc_html( $initials )
        );
    }

    /**
     * Extract initials from a name string.
     *
     * @since 1.1.0
     *
     * @param string $name Author name.
     *
     * @return string 1–2 character initials.
     */
    private static function get_initials( $name ) {
        $name = trim( preg_replace( '/\s+/u', ' ', $name ) );

        if ( '' === $name ) {
            return 'V';
        }

        $words = preg_split( '/\s+/u', $name );

        if ( count( $words ) >= 2 ) {
            $first  = mb_substr( $words[0], 0, 1, 'UTF-8' );
            $second = mb_substr( $words[1], 0, 1, 'UTF-8' );
            return mb_strtoupper( $first . $second, 'UTF-8' );
        }

        return mb_strtoupper( mb_substr( $name, 0, 1, 'UTF-8' ), 'UTF-8' );
    }

    /**
     * Render the comment form.
     *
     * Used by:
     *   - Shortcode: [ttt_comment_form]
     *   - Elementor Widget: TTT Comments Form
     *
     * @since 1.0.0
     *
     * @param array $settings Widget / shortcode settings.
     *
     * @return string HTML output.
     */
    public static function render_form( $settings = array() ) {
        $post_id = get_the_ID();

        if ( ! $post_id ) {
            return '';
        }

        // Defaults
        $settings = wp_parse_args(
            $settings,
            array(
                'form_title_text'  => __( 'Share your opinion', 'ttt-commentbox' ),
                'form_title_show'  => true,
                'form_title_color' => '#333333',
                'form_color'      => '#333333',
                'submit_color'   => '#ffffff',
                'submit_bg'      => '#007bff',
                'label_name'     => __( 'Name', 'ttt-commentbox' ),
                'label_email'   => __( 'Email', 'ttt-commentbox' ),
                'label_website' => __( 'Website', 'ttt-commentbox' ),
                'label_comment' => __( 'Comment', 'ttt-commentbox' ),
                'label_submit'  => __( 'Submit A Comment', 'ttt-commentbox' ),
                'label_save_info' => __( 'Save my name, email, and website in this browser for the next time I comment.', 'ttt-commentbox' ),
                'show_website' => true,
                'widget_id'   => 'ttt-comments-form-' . uniqid(),
            )
        );

        $commenter          = wp_get_current_commenter();
        $require_name_email = (bool) get_option( 'require_name_email' );
        $aria_required    = $require_name_email ? ' aria-required="true"' : '';

        ob_start();
        ?>

        <div class="ttt-comments-form-wrapper"
             id="<?php echo esc_attr( $settings['widget_id'] ); ?>"
             data-post-id="<?php echo esc_attr( $post_id ); ?>">

            <div class="ttt-comment-form" style="color:<?php echo esc_attr( $settings['form_color'] ); ?>;">

                <?php if ( $settings['form_title_show'] && $settings['form_title_text'] ) : ?>
                    <h3 class="ttt-comment-form-title"
                        style="color:<?php echo esc_attr( $settings['form_title_color'] ); ?>">
                        <?php echo esc_html( $settings['form_title_text'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( is_user_logged_in() ) : ?>
                    <?php
                    $current_user = wp_get_current_user();
                    $logout_url  = wp_logout_url( get_permalink() );
                    ?>
                    <p class="ttt-logged-in-as">
                        <?php
                        printf(
                            /* translators: %s: Current user display name */
                            esc_html__( 'Logged in as %s.', 'ttt-commentbox' ),
                            '<strong>' . esc_html( $current_user->display_name ) . '</strong>'
                        );
                        ?>
                        <a href="<?php echo esc_url( $logout_url ); ?>">
                            <?php esc_html_e( 'Log out?', 'ttt-commentbox' ); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <div id="ttt-reply-info" class="ttt-reply-info" style="display:none; margin-bottom:15px; padding:10px; background:#f5f5f5; border-radius:4px;">
                    <span id="ttt-reply-to-text"></span>
                    <a href="javascript:void(0);"
                       id="ttt-cancel-reply"
                       style="margin-left:15px; color:#007bff; cursor:pointer;">
                        <?php esc_html_e( 'Cancel reply', 'ttt-commentbox' ); ?>
                    </a>
                </div>

                <form id="ttt-commentform"
                      class="ttt-commentform"
                      action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>"
                      method="post"
                      novalidate>

                    <div class="ttt-form-row">

                        <p class="ttt-form-field ttt-form-field-half">
                            <label for="ttt-author" class="ttt-label">
                                <?php echo esc_html( $settings['label_name'] ); ?>
                                <?php if ( $require_name_email ) : ?>
                                    <span class="required" aria-hidden="true">*</span>
                                <?php endif; ?>
                            </label>
                            <input type="text"
                                   name="author"
                                   id="ttt-author"
                                   class="ttt-input"
                                   value="<?php echo esc_attr( $commenter['comment_author'] ); ?>"
                                   <?php echo $aria_required; ?>
                                   autocomplete="name"
                                   required />
                        </p>

                        <p class="ttt-form-field ttt-form-field-half">
                            <label for="ttt-email" class="ttt-label">
                                <?php echo esc_html( $settings['label_email'] ); ?>
                                <?php if ( $require_name_email ) : ?>
                                    <span class="required" aria-hidden="true">*</span>
                                <?php endif; ?>
                            </label>
                            <input type="email"
                                   name="email"
                                   id="ttt-email"
                                   class="ttt-input"
                                   value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>"
                                   <?php echo $aria_required; ?>
                                   autocomplete="email"
                                   required />
                        </p>

                    </div>

                    <?php if ( $settings['show_website'] ) : ?>
                        <p class="ttt-form-field">
                            <label for="ttt-url" class="ttt-label">
                                <?php echo esc_html( $settings['label_website'] ); ?>
                            </label>
                            <input type="url"
                                   name="url"
                                   id="ttt-url"
                                   class="ttt-input"
                                   value="<?php echo esc_attr( $commenter['comment_author_url'] ); ?>"
                                   autocomplete="url" />
                        </p>
                    <?php endif; ?>

                    <p class="ttt-form-field">
                        <label for="ttt-comment" class="ttt-label">
                            <?php echo esc_html( $settings['label_comment'] ); ?>
                            <span class="required" aria-hidden="true">*</span>
                        </label>
                        <textarea name="comment"
                                  id="ttt-comment"
                                  class="ttt-textarea"
                                  rows="5"
                                  aria-required="true"
                                  required></textarea>
                    </p>

                    <p class="ttt-form-field ttt-form-checkbox">
                        <label>
                            <input type="checkbox"
                                   name="wp-comment-cookies-consent"
                                   id="ttt-cookies-consent"
                                   value="yes"
                                   checked />
                            <span><?php echo esc_html( $settings['label_save_info'] ); ?></span>
                        </label>
                    </p>

                    <p class="ttt-form-submit">
                        <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr( $post_id ); ?>" id="ttt-comment-post-ID" />
                        <input type="hidden" name="comment_parent" id="ttt-comment-parent" value="0" />
                        <button type="submit"
                                class="ttt-submit-btn"
                                style="color:<?php echo esc_attr( $settings['submit_color'] ); ?>; background-color:<?php echo esc_attr( $settings['submit_bg'] ); ?>;">
                            <?php echo esc_html( $settings['label_submit'] ); ?>
                        </button>
                    </p>

                </form>

            </div>
        </div>

        <?php

        return ob_get_clean();
    }
}

// Boot the core class to register the comment_post hook
new TTT_Comments_Core();
