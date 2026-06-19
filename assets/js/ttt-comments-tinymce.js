/**
 * TTT CommentBox — TinyMCE Plugin
 *
 * Adds a toolbar button in the Classic Editor that opens a modal
 * for visual shortcode configuration and insertion.
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

(function () {
    'use strict';

    tinymce.PluginManager.add('ttt_commentbox', function (editor) {

        // Register toolbar button
        editor.addButton('ttt_commentbox', {
            title: 'TTT CommentBox',
            text: '💬',
            icon: false,
            onclick: function () {
                openModal(editor);
            },
        });

        /**
         * Open the shortcode configuration modal.
         *
         * @param {Object} ed TinyMCE editor instance.
         */
        function openModal(ed) {
            var modal = document.getElementById('ttt-commentbox-modal');

            if (!modal) {
                // Modal HTML not rendered — fall back to simple insert
                ed.insertContent('[ttt_comments_list]\n\n[ttt_comment_form]');
                return;
            }

            // Reset all fields
            resetFields();

            // Show the modal
            modal.style.display = 'block';

            // ---- Tab switching ----
            var tabs = modal.querySelectorAll('.ttt-commentbox-tab');
            var tabContents = modal.querySelectorAll('.ttt-commentbox-tab-content');

            tabs.forEach(function (tab) {
                tab.onclick = function () {
                    var tabName = this.getAttribute('data-tab');

                    tabs.forEach(function (t) { t.classList.remove('active'); });
                    tabContents.forEach(function (c) { c.classList.remove('active'); });

                    this.classList.add('active');

                    var content = modal.querySelector('#ttt-tab-' + tabName);
                    if (content) {
                        content.classList.add('active');
                    }
                };
            });

            // ---- Build shortcode preview on input ----
            var listInputs = modal.querySelectorAll('#ttt-tab-list input');
            var formInputs = modal.querySelectorAll('#ttt-tab-form input');

            listInputs.forEach(function (input) {
                input.addEventListener('input', updateListPreview);
                input.addEventListener('change', updateListPreview);
            });

            formInputs.forEach(function (input) {
                input.addEventListener('input', updateFormPreview);
                input.addEventListener('change', updateFormPreview);
            });

            // ---- Close button ----
            var closeBtn = modal.querySelector('.ttt-commentbox-modal-close');
            var cancelBtn = modal.querySelector('#ttt-commentbox-cancel');
            var overlay  = modal.querySelector('.ttt-commentbox-modal-overlay');

            closeBtn.onclick = closeModal;
            cancelBtn.onclick = closeModal;
            overlay.onclick  = closeModal;

            // ---- Insert button ----
            var insertBtn = modal.querySelector('#ttt-commentbox-insert');

            insertBtn.onclick = function () {
                var activeTab = modal.querySelector('.ttt-commentbox-tab.active');
                var tabName   = activeTab ? activeTab.getAttribute('data-tab') : 'list';

                var shortcode = '';

                if (tabName === 'list') {
                    shortcode = buildListShortcode();
                } else {
                    shortcode = buildFormShortcode();
                }

                ed.insertContent(shortcode);
                closeModal();
            };

            // ESC key to close
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    closeModal();
                }
            });
        }

        /**
         * Close the modal.
         */
        function closeModal() {
            var modal = document.getElementById('ttt-commentbox-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        /**
         * Reset all form fields to defaults.
         */
        function resetFields() {
            var listTitle      = document.getElementById('ttt-shortcode-list-title');
            var avatarSize     = document.getElementById('ttt-shortcode-avatar-size');
            var showLike       = document.getElementById('ttt-shortcode-show-like');
            var likeText       = document.getElementById('ttt-shortcode-like-text');
            var titleColor     = document.getElementById('ttt-shortcode-list-title-color');
            var commentsColor  = document.getElementById('ttt-shortcode-comments-color');

            var formTitle      = document.getElementById('ttt-shortcode-form-title');
            var showWebsite    = document.getElementById('ttt-shortcode-show-website');
            var labelName      = document.getElementById('ttt-shortcode-label-name');
            var labelEmail     = document.getElementById('ttt-shortcode-label-email');
            var labelSubmit    = document.getElementById('ttt-shortcode-label-submit');

            if (listTitle)     listTitle.value = '';
            if (avatarSize)    avatarSize.value = '32';
            if (showLike)      showLike.checked = true;
            if (likeText)      likeText.value = '';
            if (titleColor)    titleColor.value = '';
            if (commentsColor) commentsColor.value = '';

            var textAvatar    = document.getElementById('ttt-shortcode-text-avatar');
            if (textAvatar) textAvatar.checked = false;

            if (formTitle)     formTitle.value = '';
            if (showWebsite)   showWebsite.checked = true;
            if (labelName)     labelName.value = '';
            if (labelEmail)    labelEmail.value = '';
            if (labelSubmit)   labelSubmit.value = '';

            updateListPreview();
            updateFormPreview();
        }

        /**
         * Build the [ttt_comments_list] shortcode from form fields.
         *
         * @returns {string}
         */
        function buildListShortcode() {
            var attrs = [];

            var title     = document.getElementById('ttt-shortcode-list-title');
            var avatar    = document.getElementById('ttt-shortcode-avatar-size');
            var like      = document.getElementById('ttt-shortcode-show-like');
            var likeText  = document.getElementById('ttt-shortcode-like-text');
            var titleCol  = document.getElementById('ttt-shortcode-list-title-color');
            var commCol   = document.getElementById('ttt-shortcode-comments-color');

            if (title && title.value)     attrs.push('list_title="' + escAttr(title.value) + '"');
            if (avatar && avatar.value !== '32') attrs.push('avatar_size="' + escAttr(avatar.value) + '"');
            if (like && !like.checked)    attrs.push('show_like="0"');
            if (likeText && likeText.value) attrs.push('like_text="' + escAttr(likeText.value) + '"');
            if (titleCol && titleCol.value) attrs.push('list_title_color="' + escAttr(titleCol.value) + '"');
            if (commCol && commCol.value)  attrs.push('comments_color="' + escAttr(commCol.value) + '"');

            // Text avatar
            var textAvatar = document.getElementById('ttt-shortcode-text-avatar');
            if (textAvatar && textAvatar.checked) attrs.push('text_avatar="1"');

            if (attrs.length > 0) {
                return '[ttt_comments_list ' + attrs.join(' ') + ']';
            }

            return '[ttt_comments_list]';
        }

        /**
         * Build the [ttt_comment_form] shortcode from form fields.
         *
         * @returns {string}
         */
        function buildFormShortcode() {
            var attrs = [];

            var title     = document.getElementById('ttt-shortcode-form-title');
            var website   = document.getElementById('ttt-shortcode-show-website');
            var nameLabel = document.getElementById('ttt-shortcode-label-name');
            var emailLabel = document.getElementById('ttt-shortcode-label-email');
            var submitLabel = document.getElementById('ttt-shortcode-label-submit');

            if (title && title.value)       attrs.push('form_title="' + escAttr(title.value) + '"');
            if (website && !website.checked) attrs.push('show_website="0"');
            if (nameLabel && nameLabel.value) attrs.push('label_name="' + escAttr(nameLabel.value) + '"');
            if (emailLabel && emailLabel.value) attrs.push('label_email="' + escAttr(emailLabel.value) + '"');
            if (submitLabel && submitLabel.value) attrs.push('label_submit="' + escAttr(submitLabel.value) + '"');

            if (attrs.length > 0) {
                return '[ttt_comment_form ' + attrs.join(' ') + ']';
            }

            return '[ttt_comment_form]';
        }

        /**
         * Escape attribute values for shortcode.
         *
         * @param {string} str Raw input string.
         *
         * @returns {string}
         */
        function escAttr(str) {
            return str.replace(/["\\]/g, function (c) {
                return c === '"' ? '&quot;' : '\\\\';
            });
        }

        /**
         * Update the list shortcode preview.
         */
        function updateListPreview() {
            var preview = document.getElementById('ttt-shortcode-list-preview');
            if (preview) {
                preview.textContent = buildListShortcode();
            }
        }

        /**
         * Update the form shortcode preview.
         */
        function updateFormPreview() {
            var preview = document.getElementById('ttt-shortcode-form-preview');
            if (preview) {
                preview.textContent = buildFormShortcode();
            }
        }

    });

})();
