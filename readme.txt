=== TTT CommentBox for Elementor ===
Contributors: tttworks
Tags: comments, elementor, gutenberg, comment form, comment list, reviews, testimonials
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A complete comment system for WordPress — works with Elementor, Gutenberg, and Classic Editor. Custom comment list display, AJAX likes, threaded replies, and a full comment form.
== Description ==

**Comments, Reimagined for Elementor.**

TTT CommentBox fills the gap between WordPress's native comment system and modern page builders. It gives you complete control over how comments are displayed and submitted on any page built with Elementor, Gutenberg, or any other editor.

**Why TTT CommentBox?**

Elementor's built-in form handles submissions — but what about displaying and managing them on non-blog pages like landing pages, portfolio entries, or custom post types? TTT CommentBox solves this.

= Key Features =

* **Drag-and-Drop Widgets** — Two dedicated Elementor widgets: TTT Comments List and TTT Comments Form
* **Works Everywhere** — Also available as Gutenberg blocks and WordPress shortcodes for use in Classic Editor or any theme
* **Threaded Replies** — Nested comment display with independent styling
* **AJAX Likes** — Like comments without page reload; supports both logged-in users and guests
* **🔤 Text Avatar** — Guests see colorful initials (e.g., "Alice" → "A", "张三" → "张"); registered users continue with Gravatar
* **Custom Like Icons** — Upload your own like button image
* **Fully Styled** — Clean, modern default styles that integrate with any theme
* **WooCommerce Ready** — Works on product pages with WordPress comments enabled
* **Fully Translatable** — i18n-ready with `.pot` file included

= Perfect For =

* Landing pages with comment sections
* Portfolio or case study pages
* Product showcase pages
* Custom post type pages
* Any page where you want more than Elementor's default form

== Installation ==

1. Upload the `ttt-commentbox` folder to `/wp-content/plugins/` or upload the zip via WordPress Plugins screen
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit a page with Elementor
4. Drag **TTT Comments List** or **TTT Comments Form** widget onto the page
5. Configure settings and style as needed

**For non-Elementor pages:** Use shortcodes `[ttt_comments_list]` and `[ttt_comment_form]` in any editor.

== Frequently Asked Questions ==

= Does it require Elementor? =

No. Elementor is optional. You can use the shortcodes `[ttt_comments_list]` and `[ttt_comment_form]` in any WordPress editor or theme.

= Does it create new database tables? =

No. TTT CommentBox uses WordPress's built-in comment system. It stores only like counts and user/IP records in `comment_meta`.

= Can I customize the styles? =

Yes. All CSS uses the `.ttt-*` prefix and is enqueued from the `assets/css/` folder. You can override styles in your theme or child theme.

= Is it compatible with WooCommerce? =

Yes. Works on any page with WordPress comments enabled, including WooCommerce product pages with the Reviews tab enabled.

== Changelog ==

= 1.0.0 =
* Initial release
* TTT Comments List and TTT Comments Form Elementor widgets
* Shortcode support: [ttt_comments_list] and [ttt_comment_form]
* Gutenberg block support (dynamic rendering)
* Text Avatar mode (colored initials for guests)
* AJAX like system with guest IP tracking (48h cooldown)
* Threaded reply display
* Custom like icon upload
* Full style customization via Elementor controls
* WordPress comment system as data source (no new tables)
* i18n-ready with POT file

== Upgrade Notice ==

= 1.0.0 =
Initial release. No upgrade necessary.

== Screenshots ==

1. TTT Comments List widget in Elementor
2. TTT Comments Form widget in Elementor
3. Frontend display example
4. Widget settings panel
