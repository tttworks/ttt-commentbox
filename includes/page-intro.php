<?php
/**
 * TTT CommentBox — Plugin Introduction Page
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */
?>

<div class="wrap ttt-intro-page">

    <!-- Header -->
    <div class="ttt-intro-header">
        <h1>💬 <?php esc_html_e( 'TTT CommentBox', 'ttt-commentbox' ); ?></h1>
        <p class="ttt-intro-subtitle">
            <?php esc_html_e( 'Comments, Reimagined for Elementor.', 'ttt-commentbox' ); ?>
        </p>
        <p class="ttt-intro-meta">
            <span><?php echo esc_html__( 'Version', 'ttt-commentbox' ) . ' ' . esc_html( TTT_COMMENTBOX_VERSION ); ?></span>
            <span class="ttt-intro-sep">|</span>
            <span><?php esc_html_e( 'Built by', 'ttt-commentbox' ); ?> <a href="https://tttworks.com" target="_blank">Aloysius Luo / TTTWorks</a></span>
            <span class="ttt-intro-sep">|</span>
            <span><a href="https://github.com/tttworks/ttt-commentbox" target="_blank"><?php esc_html_e( 'GitHub Repository', 'ttt-commentbox' ); ?></a></span>
        </p>
    </div>

    <!-- Quick links -->
    <div class="ttt-intro-links">
        <a href="https://github.com/tttworks/ttt-commentbox" target="_blank" class="button button-secondary">⭐ <?php esc_html_e( 'Star on GitHub', 'ttt-commentbox' ); ?></a>
        <a href="https://github.com/tttworks/ttt-commentbox/issues" target="_blank" class="button button-secondary">🐛 <?php esc_html_e( 'Report Bug', 'ttt-commentbox' ); ?></a>
        <a href="https://tttworks.com" target="_blank" class="button button-secondary">🌐 TTTWorks.com</a>
    </div>

    <!-- Feature cards -->
    <div class="ttt-intro-grid">

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">🧩</div>
            <h3><?php esc_html_e( 'Two Dedicated Widgets', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'TTT Comments List — display approved comments with AJAX likes and threaded replies. TTT Comments Form — a complete comment submission form with configurable labels.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">❤️</div>
            <h3><?php esc_html_e( 'AJAX Likes', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Logged-in users can like each comment once. Guest visitors get one like per IP address every 48 hours. No page reloads — smooth AJAX interaction throughout.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">💬</div>
            <h3><?php esc_html_e( 'Threaded Replies', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Reply to any comment, with nested children styled independently. Cancel reply with a single click. Full reply-to-author labeling.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">🎨</div>
            <h3><?php esc_html_e( 'Full Style Control', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Customize colors, typography, avatar sizes, borders, padding — all from the Elementor Style panel, Gutenberg sidebar, or Classic Editor shortcode attributes.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">🔤</div>
            <h3><?php esc_html_e( 'Text Avatars', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Guest visitors see a colorful initial-based avatar instead of Gravatar — ideal for mainland Chinese sites where Gravatar is slow or blocked. Registered users continue using their Gravatar normally.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">🔄</div>
            <h3><?php esc_html_e( 'Works Everywhere', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Elementor widgets, Gutenberg blocks, Classic Editor shortcodes — choose your editor, same complete experience. One plugin, three interfaces.', 'ttt-commentbox' ); ?></p>
        </div>

        <div class="ttt-intro-card">
            <div class="ttt-intro-card-icon">🤝</div>
            <h3><?php esc_html_e( 'WooCommerce Friendly', 'ttt-commentbox' ); ?></h3>
            <p><?php esc_html_e( 'Zero conflict with WooCommerce Reviews. Each system uses its own comment type and meta markers. Install both — they coexist peacefully.', 'ttt-commentbox' ); ?></p>
        </div>

    </div>

    <!-- Usage: Elementor -->
    <div class="ttt-intro-section">
        <h2>🧩 <?php esc_html_e( 'How to Use — Elementor', 'ttt-commentbox' ); ?></h2>
        <p><?php esc_html_e( 'TTT CommentBox adds two Elementor widgets. You can place them independently or together on any page.', 'ttt-commentbox' ); ?></p>

        <div class="ttt-intro-steps">
            <div class="ttt-intro-step">
                <strong>1.</strong> <?php esc_html_e( 'Edit any page with Elementor.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>2.</strong> <?php esc_html_e( 'Search for "TTT" in the widget panel.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>3.</strong> <?php esc_html_e( 'Drag "TTT Comments List" onto the page to show comments.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>4.</strong> <?php esc_html_e( 'Drag "TTT Comments Form" onto the page to show the comment form.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>5.</strong> <?php esc_html_e( 'Use the left-side Settings panel to customize titles, colors, avatar sizes, the like button, and more.', 'ttt-commentbox' ); ?>
            </div>
        </div>

        <div class="ttt-intro-notice">
            <strong><?php esc_html_e( 'Widget names in the Elementor panel:', 'ttt-commentbox' ); ?></strong><br>
            🔹 <code>TTT Comments List</code> — <?php esc_html_e( 'Comment list with avatar, likes, threaded replies', 'ttt-commentbox' ); ?><br>
            🔹 <code>TTT Comments Form</code> — <?php esc_html_e( 'Comment submission form with configurable labels', 'ttt-commentbox' ); ?>
        </div>
    </div>

    <!-- Usage: Gutenberg -->
    <div class="ttt-intro-section">
        <h2>🧱 <?php esc_html_e( 'How to Use — Gutenberg', 'ttt-commentbox' ); ?></h2>
        <p><?php esc_html_e( 'TTT CommentBox registers two Gutenberg blocks under a dedicated "TTT CommentBox" category.', 'ttt-commentbox' ); ?></p>

        <div class="ttt-intro-steps">
            <div class="ttt-intro-step">
                <strong>1.</strong> <?php esc_html_e( 'Edit any post or page with the Block Editor.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>2.</strong> <?php esc_html_e( 'Click the "+" block inserter and search for "TTT".', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>3.</strong> <?php esc_html_e( 'Select "TTT Comments List" or "TTT Comments Form" from the "TTT CommentBox" category.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>4.</strong> <?php esc_html_e( 'Use the right-side Settings panel to configure the block appearance.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>5.</strong> <?php esc_html_e( 'Publish — the block will render as a live comment list/form on the frontend.', 'ttt-commentbox' ); ?>
            </div>
        </div>

        <div class="ttt-intro-notice">
            <strong><?php esc_html_e( 'Block names in the inserter:', 'ttt-commentbox' ); ?></strong><br>
            🔹 <code>TTT Comments List</code> — <?php esc_html_e( 'under category "TTT CommentBox"', 'ttt-commentbox' ); ?><br>
            🔹 <code>TTT Comments Form</code> — <?php esc_html_e( 'under category "TTT CommentBox"', 'ttt-commentbox' ); ?>
        </div>

        <p style="margin-top:12px; font-size:13px; color:#666;">
            <?php esc_html_e( 'The right sidebar settings include: 📋 Title, ❤️ Like Button (icon upload, colors), 👤 Avatar size, 🎨 Color palette, 💬 Replies area style.', 'ttt-commentbox' ); ?>
        </p>
    </div>

    <!-- Usage: Classic Editor -->
    <div class="ttt-intro-section">
        <h2>📝 <?php esc_html_e( 'How to Use — Classic Editor', 'ttt-commentbox' ); ?></h2>
        <p><?php esc_html_e( 'In the Classic Editor, you have two ways to insert TTT CommentBox. Way 1: use the toolbar button to open a visual configuration popup. Way 2: type the shortcode directly.', 'ttt-commentbox' ); ?></p>

        <h3><?php esc_html_e( 'Way 1: Visual Configuration (recommended)', 'ttt-commentbox' ); ?></h3>
        <div class="ttt-intro-steps">
            <div class="ttt-intro-step">
                <strong>1.</strong> <?php esc_html_e( 'Open a post in the Classic Editor.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>2.</strong> <?php esc_html_e( 'Click the 💬 button in the toolbar (labeled "TTT CommentBox").', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>3.</strong> <?php esc_html_e( 'Switch between the "Comments List" and "Comments Form" tabs in the popup.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>4.</strong> <?php esc_html_e( 'Fill in your settings — title, like button, avatar size, colors, labels.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>5.</strong> <?php esc_html_e( 'Click "Insert Shortcode" — the shortcode is inserted at your cursor position.', 'ttt-commentbox' ); ?>
            </div>
        </div>

        <h3 style="margin-top:24px;"><?php esc_html_e( 'Way 2: Direct Shortcode (advanced)', 'ttt-commentbox' ); ?></h3>
        <p><?php esc_html_e( 'Type the following shortcodes directly into the editor. Use attributes to customize.', 'ttt-commentbox' ); ?></p>

        <!-- Comments List Shortcode -->
        <div class="ttt-intro-shortcode-block">
            <h4>📋 <?php esc_html_e( 'Comments List', 'ttt-commentbox' ); ?> — <code>[ttt_comments_list]</code></h4>
            <p><?php esc_html_e( 'Displays approved comments with avatar, AJAX likes, and threaded replies.', 'ttt-commentbox' ); ?></p>

            <table class="ttt-intro-params">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'Attribute', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Type', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Default', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Description', 'ttt-commentbox' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><code>avatar_size</code></td><td>number</td><td>32</td><td><?php esc_html_e( 'Avatar size in pixels (16–128)', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>show_like</code></td><td>0/1</td><td>1</td><td><?php esc_html_e( 'Show or hide the like button', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>show_like_image</code></td><td>0/1</td><td>0</td><td><?php esc_html_e( 'Use a custom like icon image', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>like_image_url</code></td><td>URL</td><td>—</td><td><?php esc_html_e( 'URL of the custom like icon image', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>like_text</code></td><td>text</td><td>—</td><td><?php esc_html_e( 'Custom text next to the like count', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>list_title</code></td><td>text</td><td>Netizens discuss</td><td><?php esc_html_e( 'Title text above the comment list', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>list_title_show</code></td><td>0/1</td><td>1</td><td><?php esc_html_e( 'Show or hide the list title', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>list_title_color</code></td><td>hex color</td><td>#333333</td><td><?php esc_html_e( 'Title text color', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>comments_color</code></td><td>hex color</td><td>#333333</td><td><?php esc_html_e( 'Comment content text color', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>children_bg</code></td><td>color</td><td>rgba(247,249,251,1)</td><td><?php esc_html_e( 'Background color for threaded replies area', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>text_avatar</code></td><td>0/1</td><td>0</td><td><?php esc_html_e( 'Guest avatars as colored initials (no Gravatar)', 'ttt-commentbox' ); ?></td></tr>
                </tbody>
            </table>

            <h5><?php esc_html_e( 'Examples:', 'ttt-commentbox' ); ?></h5>
            <pre><code>[ttt_comments_list]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ Basic usage: avatar 32px, like button on, title "Netizens discuss".', 'ttt-commentbox' ); ?></p>

            <pre><code>[ttt_comments_list avatar_size="40" list_title="Customer Reviews" list_title_color="#1a73e8" like_text="Helpful"]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ Customized: larger avatars, custom title with blue color, "Helpful" label on the like button.', 'ttt-commentbox' ); ?></p>

            <pre><code>[ttt_comments_list show_like="0" avatar_size="48" comments_color="#555555"]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ No like button, large avatars, gray comment text.', 'ttt-commentbox' ); ?></p>
        </div>

        <!-- Comments Form Shortcode -->
        <div class="ttt-intro-shortcode-block">
            <h4>✏️ <?php esc_html_e( 'Comments Form', 'ttt-commentbox' ); ?> — <code>[ttt_comment_form]</code></h4>
            <p><?php esc_html_e( 'Displays a complete comment submission form with configurable labels.', 'ttt-commentbox' ); ?></p>

            <table class="ttt-intro-params">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'Attribute', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Type', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Default', 'ttt-commentbox' ); ?></th>
                        <th><?php esc_html_e( 'Description', 'ttt-commentbox' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><code>form_title</code></td><td>text</td><td>Share your opinion</td><td><?php esc_html_e( 'Form title text', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>form_title_show</code></td><td>0/1</td><td>1</td><td><?php esc_html_e( 'Show or hide the form title', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>form_title_color</code></td><td>hex color</td><td>#333333</td><td><?php esc_html_e( 'Form title color', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>form_color</code></td><td>hex color</td><td>#333333</td><td><?php esc_html_e( 'Form text color', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>show_website</code></td><td>0/1</td><td>1</td><td><?php esc_html_e( 'Show or hide the website URL field', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_name</code></td><td>text</td><td>Name</td><td><?php esc_html_e( 'Name field label', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_email</code></td><td>text</td><td>Email</td><td><?php esc_html_e( 'Email field label', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_website</code></td><td>text</td><td>Website</td><td><?php esc_html_e( 'Website field label', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_comment</code></td><td>text</td><td>Comment</td><td><?php esc_html_e( 'Comment textarea label', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_submit</code></td><td>text</td><td>Submit A Comment</td><td><?php esc_html_e( 'Submit button text', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>label_save_info</code></td><td>text</td><td>Save my name…</td><td><?php esc_html_e( 'GDPR cookie consent text', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>submit_color</code></td><td>hex color</td><td>#ffffff</td><td><?php esc_html_e( 'Button text color (via inline style)', 'ttt-commentbox' ); ?></td></tr>
                    <tr><td><code>submit_bg</code></td><td>hex color</td><td>#007bff</td><td><?php esc_html_e( 'Button background color (via inline style)', 'ttt-commentbox' ); ?></td></tr>
                </tbody>
            </table>

            <h5><?php esc_html_e( 'Examples:', 'ttt-commentbox' ); ?></h5>
            <pre><code>[ttt_comment_form]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ Basic usage: all default labels and layout.', 'ttt-commentbox' ); ?></p>

            <pre><code>[ttt_comment_form form_title="Leave a Review" form_title_color="#e74c3c" show_website="0"]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ Custom title with red color, website field hidden.', 'ttt-commentbox' ); ?></p>

            <pre><code>[ttt_comment_form label_name="Your Name" label_email="Your Email" label_submit="Post Comment" submit_bg="#27ae60"]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ All labels customized, green submit button.', 'ttt-commentbox' ); ?></p>

            <pre><code>[ttt_comment_form label_save_info="Remember my info for next time."]</code></pre>
            <p class="ttt-intro-hint"><?php esc_html_e( '→ Custom GDPR cookie consent text.', 'ttt-commentbox' ); ?></p>
        </div>

        <!-- Combined Shortcode Example -->
        <div class="ttt-intro-shortcode-block">
            <h4>🔗 <?php esc_html_e( 'Combined Example (Comments List + Form together)', 'ttt-commentbox' ); ?></h4>
            <p><?php esc_html_e( 'The two shortcodes work together on the same page. Comments submitted through the form appear in the list immediately after approval.', 'ttt-commentbox' ); ?></p>
            <pre><code>[ttt_comments_list avatar_size="36" list_title="What Our Customers Say" like_text="Found this helpful"]
<br>
[ttt_comment_form form_title="Join the Conversation"]</code></pre>
        </div>
    </div>

    <!-- Text Avatar Feature -->
    <div class="ttt-intro-section">
        <h2>🔤 <?php esc_html_e( 'Text Avatar — No Gravatar, No Problem', 'ttt-commentbox' ); ?></h2>
        <p><?php esc_html_e( 'For sites with Chinese visitors, Gravatar is often slow or completely blocked. TTT CommentBox includes a built-in "Text Avatar" mode that generates colorful initial-based avatars for guest comments.', 'ttt-commentbox' ); ?></p>

        <div class="ttt-intro-steps">
            <div class="ttt-intro-step">
                <strong>🙋 <?php esc_html_e( 'Guests:', 'ttt-commentbox' ); ?></strong> <?php esc_html_e( 'First character(s) of their name displayed in a colored circle. "Alice" → "A", "张三" → "张", "Alice Wang" → "AW".', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>👤 <?php esc_html_e( 'Registered users:', 'ttt-commentbox' ); ?></strong> <?php esc_html_e( 'Continue using their Gravatar or local avatar as normal. No change.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>🎨 <?php esc_html_e( 'Colors:', 'ttt-commentbox' ); ?></strong> <?php esc_html_e( '10 preset colors, auto-assigned based on name hash — same name always gets the same color.', 'ttt-commentbox' ); ?>
            </div>
            <div class="ttt-intro-step">
                <strong>⚡ <?php esc_html_e( 'Performance:', 'ttt-commentbox' ); ?></strong> <?php esc_html_e( 'No external HTTP requests. Zero latency.', 'ttt-commentbox' ); ?>
            </div>
        </div>

        <h3 style="margin-top:20px;"><?php esc_html_e( 'How to Enable in Each Editor', 'ttt-commentbox' ); ?></h3>

        <div class="ttt-intro-notice">
            <strong>🧩 Elementor:</strong> <?php esc_html_e( 'Widget settings → Avatar section → flip "游客文字头像" to "字母".', 'ttt-commentbox' ); ?><br>
            <strong>🧱 Gutenberg:</strong> <?php esc_html_e( 'Block settings → Avatar panel → toggle "Text Avatar (游客文字头像)".', 'ttt-commentbox' ); ?><br>
            <strong>📝 Classic Editor:</strong> <?php esc_html_e( 'Toolbar button → popup → check "Text Avatar (游客文字头像)". Or add to shortcode:', 'ttt-commentbox' ); ?> <code>text_avatar="1"</code>
        </div>

        <h5><?php esc_html_e( 'Shortcode Examples:', 'ttt-commentbox' ); ?></h5>
        <pre><code>[ttt_comments_list text_avatar="1"]</code></pre>
        <p class="ttt-intro-hint"><?php esc_html_e( '→ Guests see colored initials. Registered users see Gravatar.', 'ttt-commentbox' ); ?></p>

        <pre><code>[ttt_comments_list avatar_size="40" text_avatar="1" like_text="Helpful"]</code></pre>
        <p class="ttt-intro-hint"><?php esc_html_e( '→ Larger text avatars + custom like text.', 'ttt-commentbox' ); ?></p>
    </div>

    <!-- Compatibility -->
    <div class="ttt-intro-section">
        <h2>🤝 <?php esc_html_e( 'Compatibility', 'ttt-commentbox' ); ?></h2>
        <div class="ttt-intro-grid ttt-intro-grid-two">
            <div class="ttt-intro-card">
                <h3>✅ <?php esc_html_e( 'Works With', 'ttt-commentbox' ); ?></h3>
                <ul>
                    <li>Elementor 3.0+</li>
                    <li>WordPress 5.8+ / PHP 7.4+</li>
                    <li>Gutenberg / Block Editor</li>
                    <li>Classic Editor (TinyMCE)</li>
                    <li>Any WordPress theme</li>
                    <li>WooCommerce (no conflict)</li>
                </ul>
            </div>
            <div class="ttt-intro-card">
                <h3>🧪 <?php esc_html_e( 'Requirements', 'ttt-commentbox' ); ?></h3>
                <ul>
                    <li><?php esc_html_e( 'Pages must be singular (posts, pages, CPT)', 'ttt-commentbox' ); ?></li>
                    <li><?php esc_html_e( 'WordPress comments enabled on the post', 'ttt-commentbox' ); ?></li>
                    <li><?php esc_html_e( 'jQuery (loaded by WordPress by default)', 'ttt-commentbox' ); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- About the Developer -->
    <div class="ttt-intro-section">
        <h2>👤 <?php esc_html_e( 'About the Developer', 'ttt-commentbox' ); ?></h2>
        <div class="ttt-intro-about">
            <p>
                <strong><?php esc_html_e( 'TTT CommentBox', 'ttt-commentbox' ); ?></strong>
                <?php esc_html_e( 'is built and maintained by', 'ttt-commentbox' ); ?>
                <strong>Aloysius Luo</strong>,
                <?php esc_html_e( 'Owner & CEO of', 'ttt-commentbox' ); ?>
                <strong><?php esc_html_e( 'Tianjin TTTWORKS Technology Co., Ltd.', 'ttt-commentbox' ); ?> (TTTWorks)</strong>.
                <?php esc_html_e( 'Based in Tianjin, China, TTTWorks provides WordPress development, web design, and technical consulting services to clients in China, Japan, and worldwide.', 'ttt-commentbox' ); ?>
            </p>
            <p>
                <strong>🌐</strong> <a href="https://tttworks.com" target="_blank">tttworks.com</a>
                &nbsp;&nbsp;<strong>💻</strong> <a href="https://github.com/tttworks" target="_blank">GitHub @tttworks</a>
                &nbsp;&nbsp;<strong>📧</strong> <a href="mailto:a@tttworks.com">a@tttworks.com</a>
            </p>
        </div>

        <div class="ttt-intro-grid ttt-intro-grid-two" style="margin-top:16px;">
            <div class="ttt-intro-card">
                <h3>🚀 <?php esc_html_e( 'More Plugins by TTTWorks', 'ttt-commentbox' ); ?></h3>
                <p><?php esc_html_e( 'TTTWorks is building a suite of high-quality Elementor extensions — form handlers, gallery widgets, slider components, and more. Follow us on GitHub for updates.', 'ttt-commentbox' ); ?></p>
                <p><a href="https://github.com/tttworks" target="_blank" class="button button-secondary"><?php esc_html_e( 'View All Plugins', 'ttt-commentbox' ); ?></a></p>
            </div>
            <div class="ttt-intro-card">
                <h3>💡 <?php esc_html_e( 'Need Custom Development?', 'ttt-commentbox' ); ?></h3>
                <p><?php esc_html_e( 'We build custom WordPress plugins, Elementor widgets, and WooCommerce integrations for agencies and businesses worldwide. Contact us for a quote.', 'ttt-commentbox' ); ?></p>
                <p>
                    <a href="mailto:a@tttworks.com" class="button button-primary">✉️ <?php esc_html_e( 'Contact TTTWorks', 'ttt-commentbox' ); ?></a>
                    &nbsp;
                    <a href="https://tttworks.com" target="_blank" class="button button-secondary">🌐 <?php esc_html_e( 'Visit Website', 'ttt-commentbox' ); ?></a>
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="ttt-intro-footer">
        <p>
            <?php printf(
                /* translators: %s: Plugin version number */
                esc_html__( 'TTT CommentBox v%s. Made with ❤️ in Tianjin by TTTWorks.', 'ttt-commentbox' ),
                esc_html( TTT_COMMENTBOX_VERSION )
            ); ?>
            <?php esc_html_e( 'Licensed under GPL v2 or later.', 'ttt-commentbox' ); ?>
        </p>
    </div>
</div>
