# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-06-19

### Added

- **Initial release**

- **Elementor Widgets:**
  - `TTT Comments List` — Display approved WordPress comments with threaded replies
  - `TTT Comments Form` — Full comment submission form with customizable labels

- **Shortcodes:**
  - `[ttt_comments_list]` — Display comment list on any page
  - `[ttt_comment_form]` — Display comment form on any page

- **Gutenberg Support:**
  - Dynamic blocks for TTT Comments List and TTT Comments Form
  - Works in any block-enabled post type

- **AJAX Like System:**
  - Logged-in users: one like per comment per account
  - Guest users: one like per comment per IP address, 48-hour cooldown
  - Like counts stored in `comment_meta` (no new database tables)

- **Styling:**
  - Complete default CSS included
  - Full style customization via Elementor Style tab
  - Responsive design for mobile
  - Threaded reply (children) background and border customization

- **Internationalization:**
  - All strings translatable
  - `.pot` template file included at `languages/ttt-commentbox.pot`

- **Developer Features:**
  - PSR-4 class autoloading
  - Centralized core rendering class shared by all editor integrations
  - Secure AJAX handlers with `wp_verify_nonce()`
  - WordPress coding standards compliant

[1.0.0]: https://github.com/tttworks/ttt-commentbox/releases/tag/1.0.0
