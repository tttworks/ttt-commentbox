# TTT CommentBox for Elementor

**Comments, Reimagined for Elementor.**

A complete, lightweight comment system for WordPress — works seamlessly with Elementor, Gutenberg, Classic Editor, and any theme via Shortcodes. Zero configuration required. Just drag, drop, and go.

**[Repository](https://github.com/tttworks/ttt-commentbox)** · **[Documentation](https://tttworks.com)** · **[Support](https://github.com/tttworks/ttt-commentbox/issues)**

---

## Features

**Works everywhere:**
- **Elementor** — Drag in the TTT Comments List and TTT Comments Form widgets
- **Gutenberg** — Insert via the TTT CommentBox block
- **Classic Editor / Any Theme** — Use `[ttt_comments_list]` and `[ttt_comment_form]` shortcodes
- **WooCommerce** — Works on product pages that have WordPress comments enabled

**Comment list widget:**
- Displays approved comments in a clean, customizable list
- Threaded replies (children) with independent styling
- AJAX-powered like button — no page reload needed
- Custom like icon and text support
- Full WordPress comment styling override
- 🔤 **Text Avatar** — Guests see colored initials instead of Gravatar (ideal for mainland China). Registered users continue with Gravatar normally.

**Comment form widget:**
- Clean, styled comment form with responsive layout
- All labels fully customizable
- Website field toggle
- GDPR-compliant cookie consent text
- Logged-in user detection with "Logged in as X — Log out?" link

**Developer-friendly:**
- All rendering logic is centralized in one class — easy to extend
- PSR-4 class autoloading
- Full i18n support with `.pot` file included
- Chinese (zh_CN) and Japanese (ja) translations included
- Hooks and filters for customizations

## Screenshots

> _(Screenshots coming soon — the plugin is currently in initial release preparation.)_

## Requirements

- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+ (optional — only if using the Elementor widgets)

## Installation

### Method 1: Upload via WordPress Admin

1. Download the latest release from the [Releases page](https://github.com/tttworks/ttt-commentbox/releases)
2. Go to **Plugins → Add New → Upload Plugin**
3. Upload the `.zip` file
4. Click **Activate**

### Method 2: Upload via FTP

1. Download and unzip the release
2. Upload the `ttt-commentbox` folder to `/wp-content/plugins/`
3. Go to **Plugins** in WordPress admin and activate TTT CommentBox

### Method 3: Install as a Must-Use Plugin (MU-Plugin)

1. Upload the `ttt-commentbox` folder to `/wp-content/mu-plugins/`
2. The plugin activates automatically

## Usage

### Elementor

1. Edit a page with Elementor
2. Find **TTT Comments List** and **TTT Comments Form** in the widget panel
3. Drag them onto your page
4. Configure the settings in the Elementor panel

### Gutenberg / Classic Editor

On any post or page, add a **Custom HTML** block (Gutenberg) or open the **Text** editor (Classic), and paste:

```html
[ttt_comments_list]
[ttt_comment_form]
```

Both widgets will display at that position.

### Shortcode Options

**Comment List:**
```
[ttt_comments_list avatar_size="32" list_title="Customer Reviews" show_like="1"]
```

**Comment Form:**
```
[ttt_comment_form form_title="Leave a Review" show_website="0"]
```

## Configuration

### Widget Settings (Elementor)

Each widget has two tabs:

**Content tab:**
- Title text and visibility
- Like button toggle
- Custom like icon upload
- Field labels (form only)
- Website field toggle (form only)

**Style tab:**
- Typography (title, comments, form fields)
- Colors (text, background, borders)
- Padding and spacing
- Hover states
- Responsive controls

### Shortcode Attributes

| Attribute | Default | Description |
|----------|--------|-------------|
| `avatar_size` | 32 | Avatar size in pixels |
| `show_like` | 1 | Show like button (1/0) |
| `list_title` | "Netizens discuss" | Comment list title |
| `form_title` | "Share your opinion" | Form title |
| `show_website` | 1 | Show website field (1/0) |
| `show_like_image` | 0 | Use custom like icon (1/0) |
| `like_image_url` | — | URL of custom like icon |
| `like_text` | — | Custom text next to like count |

| `children_bg` | rgba(247,249,251,1) | Background color for threaded replies area |
| `text_avatar` | 0 | Guest avatars as colored initials — no Gravatar (1=on) |

## WooCommerce

TTT CommentBox works on WooCommerce product pages with WordPress comments enabled.

1. Enable reviews on your products: **Edit Product → Product Data → Advanced → Enable reviews**
2. Add a TTT Comments Form widget to your single product template
3. Comments submitted will appear in both TTT CommentBox and the WooCommerce reviews tab

## Frequently Asked Questions

**Does it work with my theme?**
Yes. TTT CommentBox uses its own CSS and is designed to look good on any theme. The default styles are minimal and non-intrusive — they override only what's necessary.

**What is Text Avatar and how do I enable it?**
In the widget/block settings, flip "Text Avatar" to ON. Guest visitors will see colorful initial-based avatars (e.g., "Alice" → "A", "张三" → "张") instead of Gravatar. This is especially useful for Chinese sites where Gravatar is slow or blocked. Registered users are unaffected and continue using their Gravatar.

**Does it create its own database tables?**
No. TTT CommentBox uses WordPress's built-in comment system as its data source. It stores only like counts and like records in `comment_meta`. No new tables are created.

**Does it work without Elementor?**
Yes. You can use the shortcodes `[ttt_comments_list]` and `[ttt_comment_form]` in any editor or theme template.

**Can I translate it?**
Yes. The plugin is fully internationalized. A `.pot` file is included in the `languages/` folder. Translations can be submitted via the [GitHub repository](https://github.com/tttworks/ttt-commentbox).

**Is Gutenberg support included?**
Basic Gutenberg support is included via shortcodes and dynamic block rendering. Full block editor blocks with dedicated control panels are planned for a future release.

## Changelog

See [CHANGELOG.md](./CHANGELOG.md) for the full version history.

## Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](./CONTRIBUTING.md) before submitting issues or pull requests.

## Credits

- **Author:** [Aloysius Luo](https://github.com/moniterluo) — [TTTWorks](https://tttworks.com)
- **Organization:** [tttworks](https://github.com/tttworks) on GitHub
- **Website:** [tttworks.com](https://tttworks.com) — WordPress & Web Development, Tianjin, China

## License

GPL v2 or later.

---

```
TTT CommentBox for Elementor
Copyright (C) 2025  Aloysius Luo (TTTWorks)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
```
