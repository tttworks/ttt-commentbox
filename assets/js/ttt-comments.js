/**
 * TTT CommentBox — Frontend JavaScript
 *
 * Handles:
 *   - AJAX comment likes
 *   - Reply link interactions
 *   - Cancel reply
 *   - Textarea auto-resize
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 * @author  Aloysius Luo (TTTWorks) — https://tttworks.com
 */

(function () {
    'use strict';

    // Bail if jQuery or the comment box object isn't ready
    if (typeof jQuery === 'undefined' || typeof tttCommentBox === 'undefined') {
        return;
    }

    var $ = jQuery;
    var ajaxUrl = tttCommentBox.ajaxUrl;
    var nonce   = tttCommentBox.nonce;
    var i18n    = tttCommentBox.i18n || {};

    /**
     * Initialize all comment box interactions on the page.
     */
    function initAll() {
        // Find all comment wrapper instances that haven't been initialized
        $('.ttt-comments-wrapper, .ttt-comments-form-wrapper').each(function () {
            var $wrapper = $(this);

            if ($wrapper.data('ttt-initialized')) {
                return;
            }

            $wrapper.data('ttt-initialized', true);
        });
    }

    /**
     * Handle comment like click.
     */
    $(document).on('click', '.ttt-comment-like', function (e) {
        e.stopPropagation();
        var $btn       = $(this);
        var commentId  = $btn.data('comment-id');
        var userIp     = $btn.data('ip');

        // Already liked — show alert
        if ($btn.hasClass('ttt-liked')) {
            alert(i18n.alreadyLiked || 'You have already liked this comment.');
            return false;
        }

        // Prevent double-clicks
        if ($btn.data('loading')) return false;
        $btn.data('loading', true);

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action:    'ttt_comment_like',
                comment_id: commentId,
                user_ip:   userIp,
                nonce:     nonce,
            },
            success: function (response) {
                if (response.success) {
                    $btn.find('.ttt-like-count').text(response.data.like_count);
                    $btn.addClass('ttt-liked');
                } else {
                    alert(response.data.message || i18n.alreadyLiked || 'Already liked.');
                }
            },
            error: function () {
                console.warn('[TTT CommentBox] Like request failed.');
                alert(i18n.likeFailed || 'Like failed. Please try again.');
            },
            complete: function () {
                $btn.data('loading', false);
            },
        });

        return false;
    });

    /**
     * Handle reply link click.
     *
     * @param {number} commentId  Comment ID being replied to.
     * @param {string} authorName  Author name to mention.
     */
    window.tttCommentReply = function (commentId, authorName) {
        var safeName = authorName || '';

        $('#ttt-comment-parent').val(commentId);
        $('#ttt-reply-to-text').text('Replying to ' + safeName);
        $('#ttt-reply-info').show();

        $('html, body').animate(
            {
                scrollTop: $('#ttt-commentform').offset().top - 100,
            },
            300
        );

        $('#ttt-comment').focus();
    };

    /**
     * Handle cancel reply.
     */
    $(document).on('click', '#ttt-cancel-reply', function () {
        $('#ttt-comment-parent').val('0');
        $('#ttt-reply-info').hide();
        $('#ttt-reply-to-text').text('');
    });

    /**
     * Auto-resize comment textarea as user types.
     */
    $(document).on('input', '#ttt-comment', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    /**
     * Keyboard accessibility for like button.
     */
    $(document).on('keydown', '.ttt-comment-like', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).trigger('click');
        }
    });

    /**
     * WordPress / Elementor compatibility hooks.
     */
    function bindElementorHooks() {
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.on('init', function () {
                initAll();
            });

            elementorFrontend.hooks.addAction(
                'frontend/element_ready/ttt-comments-list.default',
                function ($scope) {
                    var $wrapper = $scope.find('.ttt-comments-wrapper');

                    if (!$wrapper.length) {
                        $wrapper = $scope.find('.ttt-comments-form-wrapper');
                    }

                    $wrapper.data('ttt-initialized', false);
                    initAll();
                }
            );

            elementorFrontend.hooks.addAction(
                'frontend/element_ready/ttt-comments-form.default',
                function ($scope) {
                    var $wrapper = $scope.find('.ttt-comments-form-wrapper');

                    if (!$wrapper.length) {
                        $wrapper = $scope.find('.ttt-comments-wrapper');
                    }

                    $wrapper.data('ttt-initialized', false);
      