<?php
/**
 * TTT CommentBox — AJAX Handlers
 *
 * Handles all AJAX requests: liking comments.
 * Uses WordPress nonces for security validation.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * AJAX handler class.
 *
 * @since 1.0.0
 */
class TTT_Comments_AJAX {

    /**
     * Comment source identifier for TTT CommentBox.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const SOURCE = 'ttt-commentbox';

    /**
     * Constructor — register AJAX hooks.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Logged-in users
        add_action( 'wp_ajax_ttt_comment_like', array( $this, 'handle_like' ) );

        // Guest (non-logged-in) users
        add_action( 'wp_ajax_nopriv_ttt_comment_like', array( $this, 'handle_like' ) );
    }

    /**
     * Handle comment like AJAX request.
     *
     * Strategy:
     *   - Logged-in users: one like per comment per account
     *   - Guests: one like per IP per 48 hours
     *
     * Likes are stored in WordPress comment meta:
     *   - ttt_like_count   : total number of likes
     *   - ttt_liked_users : array of user IDs who liked (for logged-in users)
     *   - ttt_liked_ips   : array of IP => timestamp (for guests)
     *
     * @since 1.0.0
     */
    public function handle_like() {
        // Verify nonce
        $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

        if ( ! wp_verify_nonce( $nonce, 'ttt_commentbox_nonce' ) ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Security verification failed. Please refresh the page and try again.', 'ttt-commentbox' ),
                )
            );
            wp_die();
        }

        // Get and validate comment ID
        $comment_id = isset( $_POST['comment_id'] ) ? (int) $_POST['comment_id'] : 0;

        if ( ! $comment_id ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Invalid comment ID.', 'ttt-commentbox' ),
                )
            );
            wp_die();
        }

        // Verify comment exists
        $comment = get_comment( $comment_id );

        if ( ! $comment ) {
            wp_send_json_error(
                array(
                    'message' => __( 'Comment not found.', 'ttt-commentbox' ),
                )
            );
            wp_die();
        }

        // Safety: only allow liking comments created by TTT CommentBox
        $source = get_comment_meta( $comment_id, 'ttt_comment_source', true );
        if ( self::SOURCE !== $source ) {
            wp_send_json_error(
                array(
                    'message' => __( 'This comment is not from TTT CommentBox.', 'ttt-commentbox' ),
                )
            );
            wp_die();
        }

        $user_ip = isset( $_POST['user_ip'] ) ? sanitize_text_field( wp_unslash( $_POST['user_ip'] ) ) : '';

        // ----- Check if already liked -----
        if ( is_user_logged_in() ) {
            $user_id     = get_current_user_id();
            $liked_users = get_comment_meta( $comment_id, 'ttt_liked_users', true );

            if ( ! is_array( $liked_users ) ) {
                $liked_users = array();
            }

            if ( in_array( (string) $user_id, $liked_users, true ) ) {
                wp_send_json_error(
                    array(
                        'message' => __( 'You have already liked this comment.', 'ttt-commentbox' ),
                    )
                );
                wp_die();
            }

            // Record the like
            $liked_users[] = (string) $user_id;
            update_comment_meta( $comment_id, 'ttt_liked_users', $liked_users );

        } else {
            // Guest: check IP + 48h window
            $liked_ips = get_comment_meta( $comment_id, 'ttt_liked_ips', true );

            if ( ! is_array( $liked_ips ) ) {
                $liked_ips = array();
            }

            if ( isset( $liked_ips[ $user_ip ] ) ) {
                $last_like_time = (int) $liked_ips[ $user_ip ];

                if ( time() - $last_like_time < 48 * HOUR_IN_SECONDS ) {
                    wp_send_json_error(
                        array(
                            'message' => __( 'You can only like each comment once every 48 hours.', 'ttt-commentbox' ),
                        )
                    );
                    wp_die();
                }
            }

            // Record the like with current timestamp
            $liked_ips[ $user_ip ] = time();
            update_comment_meta( $comment_id, 'ttt_liked_ips', $liked_ips );
        }

        // Increment like count
        $like_count = get_comment_meta( $comment_id, 'ttt_like_count', true );

        if ( '' === $like_count ) {
            $like_count = 0;
        }

        $like_count = (int) $like_count + 1;

        update_comment_meta( $comment_id, 'ttt_like_count', $like_count );

        wp_send_json_success(
            array(
                'like_count' => $like_count,
            )
        );

        wp_die();
    }
}

// Initialize AJAX handler
new TTT_Comments_AJAX();
