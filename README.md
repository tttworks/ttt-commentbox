# TTT CommentBox for Elementor

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/tttworks/ttt-commentbox)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

[English](README.md#english) · [中文](README.md#中文) · [日本語](README.md#日本語)

---

# English

## About the Author

**Aloysius Luo** is the owner and CEO of **Tientsin Tesseract Technology Co., Ltd. (TTTWorks)**, a WordPress development studio based in Tianjin, China. TTTWorks provides WordPress development, web design, and technical consulting services to clients in China, Japan, and worldwide. TTT CommentBox is the first open-source plugin released by TTTWorks — born out of real client needs and refined through production use.

- Website: [tttworks.com](https://tttworks.com)
- GitHub: [@tttworks](https://github.com/tttworks)
- Email: [a@tttworks.com](mailto:a@tttworks.com)

## About the Plugin

**Comments, Reimagined for Elementor.**

TTT CommentBox is a complete, lightweight WordPress comment system built for modern page builders. It ships as two dedicated Elementor widgets (Comments List + Comments Form), with full support for Gutenberg and the Classic Editor via shortcodes.

## Why This Plugin Exists

**The problem:** WordPress's built-in comment system is functional but visually dated and offers no style control when used with page builders. Elementor, the world's most popular WordPress page builder, has no native comment widget — developers either embed the default comment template (ugly and theme-dependent) or install a heavy third-party comment service.

**What TTT CommentBox solves:**
- Adds first-class Elementor widget support to WordPress comments — no more workarounds
- Gives designers full visual control: colors, typography, avatar sizes, layout via Elementor's familiar style panel
- Works on Elementor Free (no Pro required) so it's accessible to everyone
- Supports all editors: Elementor widgets, Gutenberg blocks, Classic Editor shortcodes — one plugin, three interfaces
- Solves the Gravatar problem for Chinese mainland sites (where Gravatar is slow or blocked) with built-in text avatars
- Plays nicely with WooCommerce Reviews — zero conflict using `comment_meta` markers
- Loads no external dependencies — lightweight, fast, no third-party SDKs

## Features

- **Two Elementor Widgets** — TTT Comments List (styled list with AJAX likes) and TTT Comments Form (custom submission form). Search "TTT" in the widget panel.
- **Works on Elementor Free** — No Elementor Pro required.
- **AJAX Likes** — One-click likes, no page reload. Logged-in users: one per comment. Guests: one per IP every 48 hours.
- **Threaded Replies** — Nested children with independent styling.
- **🔤 Text Avatar** — Guest visitors see colorful initials instead of Gravatar. Perfect for mainland China sites where Gravatar is slow or blocked.
- **Three Editors Support** — Elementor widgets, Gutenberg blocks (under "TTT CommentBox" category), and Classic Editor shortcodes.
- **Full Style Control** — Customize colors, typography, avatar sizes via Elementor style panel, Gutenberg sidebar, or shortcode attributes.
- **Zero Conflict with WooCommerce** — Uses `comment_meta` markers alongside WooCommerce Reviews.
- **Multi-language** — `.pot` file + Chinese (zh_CN) and Japanese (ja) translations.
- **Plugin Info Page** — WordPress admin → TTT CommentBox for a complete product introduction.

## Installation

1. Download `ttt-commentbox.zip`
2. WordPress Admin → Plugins → Add New → Upload Plugin
3. Activate, then search "TTT" in Elementor widget panel

Or manually extract to `/wp-content/plugins/` and activate.

## How to Use

### Elementor

1. Edit any page with Elementor.
2. Search for "TTT" in the widget panel.
3. Drag **TTT Comments List** onto the page to show comments.
4. Drag **TTT Comments Form** onto the page to show the comment form.
5. Use the left-side Settings panel to customize titles, colors, avatar sizes, the like button, and more.

### Gutenberg

1. Edit any post or page with the Block Editor.
2. Click the "+" block inserter and search for "TTT".
3. Select **TTT Comments List** or **TTT Comments Form** from the "TTT CommentBox" category.
4. Use the right-side Settings panel to configure appearance.
5. Publish — the block renders as a live comment list/form on the frontend.

### Classic Editor

**Way 1 — Visual Configuration (recommended):**
1. Open a post in the Classic Editor.
2. Click the 💬 button in the toolbar ("TTT CommentBox").
3. Switch between "Comments List" and "Comments Form" tabs.
4. Fill in your settings and click "Insert Shortcode".

**Way 2 — Direct Shortcode:**

Display the comment list:
```
[ttt_comments_list]
```

Display the comment form:
```
[ttt_comment_form]
```

## Shortcode Reference

### `[ttt_comments_list]` — Comment List

| Attribute | Type | Default | Description |
|---|---|---|---|
| `avatar_size` | number | 32 | Avatar size in pixels (16–128) |
| `show_like` | 0/1 | 1 | Show or hide the like button |
| `show_like_image` | 0/1 | 0 | Use a custom like icon image |
| `like_image_url` | URL | — | URL of the custom like icon |
| `like_text` | text | — | Custom text next to the like count |
| `list_title` | text | TTTWorks Discuss | Title above the comment list |
| `list_title_show` | 0/1 | 0 | Show or hide the list title |
| `list_title_color` | hex | #333333 | Title text color |
| `comments_color` | hex | #333333 | Comment content text color |
| `children_bg` | color | rgba(247,249,251,1) | Background color for threaded replies |
| `text_avatar` | 0/1 | 0 | Guest avatars as colored initials (no Gravatar) |

Examples:
```
[ttt_comments_list]
[ttt_comments_list avatar_size="40" list_title="Customer Reviews" list_title_color="#1a73e8" like_text="Helpful"]
[ttt_comments_list show_like="0" avatar_size="48" text_avatar="1"]
```

### `[ttt_comment_form]` — Comment Form

| Attribute | Type | Default | Description |
|---|---|---|---|
| `form_title` | text | Share your opinion | Form title text |
| `form_title_show` | 0/1 | 0 | Show or hide the form title |
| `form_title_color` | hex | #333333 | Form title color |
| `form_color` | hex | #333333 | Form text color |
| `show_website` | 0/1 | 1 | Show or hide the website URL field |
| `label_name` | text | Name | Name field label |
| `label_email` | text | Email | Email field label |
| `label_website` | text | Website | Website field label |
| `label_comment` | text | Comment | Comment textarea label |
| `label_submit` | text | Submit A Comment | Submit button text |
| `label_save_info` | text | Save my name… | GDPR cookie consent text |
| `submit_color` | hex | #ffffff | Button text color |
| `submit_bg` | hex | #007bff | Button background color |

Examples:
```
[ttt_comment_form]
[ttt_comment_form form_title="Leave a Review" form_title_color="#e74c3c" show_website="0"]
[ttt_comment_form label_name="Your Name" label_submit="Post Comment" submit_bg="#27ae60"]
```

## Text Avatar — No Gravatar, No Problem

For sites with Chinese visitors, Gravatar is often slow or completely blocked. TTT CommentBox includes a built-in "Text Avatar" mode that generates colorful initial-based avatars for guest comments.

- **Guests** see the first character(s) of their name in a colored circle. "Alice" → "A", "张三" → "张", "Alice Wang" → "AW"
- **Registered users** continue using their Gravatar or local avatar as normal
- **Colors** are auto-assigned based on name hash — same name always gets the same color
- **Performance** — no external HTTP requests, zero latency

How to enable:
- **Elementor:** Widget settings → Avatar section → flip "Text Avatar" on
- **Gutenberg:** Block settings → Avatar panel → toggle "Text Avatar"
- **Classic Editor:** Toolbar button popup → check "Text Avatar", or add `text_avatar="1"` to the shortcode

## Requirements

- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+ (optional — shortcodes work in any editor)

## Links

- Author: [Aloysius Luo / TTTWorks](https://tttworks.com)
- GitHub: [@tttworks](https://github.com/tttworks)
- Report issues: [GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)

## Changelog

### v1.0.0

- Initial public release
- TTT Comments List and TTT Comments Form Elementor widgets
- Gutenberg block support under "TTT CommentBox" category
- Classic Editor shortcode support with toolbar popup
- Shortcode: `[ttt_comments_list]` and `[ttt_comment_form]`
- Text Avatar mode (colored initials for guest comments)
- AJAX like system with 48h guest cooldown
- Custom like icon upload
- Threaded reply display with independent styling
- Full style customization via Elementor controls
- i18n-ready with POT file + zh_CN and ja translations
- WooCommerce compatible — zero conflict
- Comment source tracking via `ttt_comment_source` meta

---

# 中文

## 关于作者

**Aloysius Luo** 是 **天津Tesseract科技有限公司（TTTWorks）** 的创始人兼 CEO。TTTWorks 是一家位于中国天津的 WordPress 开发工作室，为中国、日本及全球客户提供 WordPress 开发、网站设计和技术咨询服务。TTT CommentBox 是 TTTWorks 发布的首个开源插件——源于真实客户需求，并在实际生产环境中不断打磨完善。

- 网站：[tttworks.com](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- 邮箱：[a@tttworks.com](mailto:a@tttworks.com)

## 插件简介

**为 Elementor 重塑评论体验。**

TTT CommentBox 是一款专为现代页面构建器设计的完整、轻量级 WordPress 评论系统。它以两个独立的 Elementor 小组件形式提供（评论列表 + 评论表单），同时支持通过短代码在 Gutenberg 和经典编辑器中使用。

## 为什么开发这个插件

**痛