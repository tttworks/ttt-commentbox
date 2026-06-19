# TTT CommentBox for Elementor

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/tttworks/ttt-commentbox)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

[English](README.md#english) · [中文](README.md#中文) · [日本語](README.md#日本語)

---

# English

## About the Author

**Aloysius Luo** is the founder and CEO of **Tientsin Tesseract Technology (TTTWorks)**, a WordPress development studio based in Tianjin, China. TTTWorks provides WordPress development, web design, and technical consulting services to clients in China, Japan, and worldwide. TTT CommentBox is the first open-source plugin released by TTTWorks — born out of real client needs and refined through production use.

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
- **Text Avatar** — Guest visitors see colorful initials instead of Gravatar. Perfect for mainland China sites where Gravatar is slow or blocked.
- **Three Editors Support** — Elementor widgets, Gutenberg blocks (under "TTT CommentBox" category), and Classic Editor shortcodes.
- **Full Style Control** — Customize colors, typography, avatar sizes via Elementor style panel, Gutenberg sidebar, or shortcode attributes.
- **Zero Conflict with WooCommerce** — Uses `comment_meta` markers alongside WooCommerce Reviews.
- **Multi-language** — `.pot` file + Chinese (zh_CN) and Japanese (ja) translations.
- **Plugin Info Page** — WordPress admin -> TTT CommentBox for a complete product introduction.

## Installation

1. Download `ttt-commentbox.zip`
2. WordPress Admin -> Plugins -> Add New -> Upload Plugin
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
2. Click the TTT CommentBox button in the toolbar.
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
| `avatar_size` | number | 32 | Avatar size in pixels (16-128) |
| `show_like` | 0/1 | 1 | Show or hide the like button |
| `show_like_image` | 0/1 | 0 | Use a custom like icon image |
| `like_image_url` | URL | - | URL of the custom like icon |
| `like_text` | text | - | Custom text next to the like count |
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
| `label_save_info` | text | Save my name... | GDPR cookie consent text |
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

- **Guests** see the first character(s) of their name in a colored circle. "Alice" -> "A", "Zhang San" -> "Z", "Alice Wang" -> "AW"
- **Registered users** continue using their Gravatar or local avatar as normal
- **Colors** are auto-assigned based on name hash — same name always gets the same color
- **Performance** — no external HTTP requests, zero latency

How to enable:
- **Elementor:** Widget settings -> Avatar section -> flip "Text Avatar" on
- **Gutenberg:** Block settings -> Avatar panel -> toggle "Text Avatar"
- **Classic Editor:** Toolbar button popup -> check "Text Avatar", or add `text_avatar="1"` to the shortcode

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

**骆泉** 是 **超方科技（TTTWorks）** 的创始人兼 CEO。超方科技是一家位于中国天津的 WordPress 开发工作室，为中国、日本及全球客户提供 WordPress 开发、网站设计和技术咨询服务。TTT CommentBox 是 TTTWorks 发布的首个开源插件——源于真实客户需求，并在实际生产环境中不断打磨完善。

- 网站：[tttworks.com](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- 邮箱：[a@tttworks.com](mailto:a@tttworks.com)

## 插件简介

**为 Elementor 重塑评论体验。**

TTT CommentBox 是一款专为现代页面构建器设计的完整、轻量级 WordPress 评论系统。它以两个独立的 Elementor 小组件形式提供（评论列表 + 评论表单），同时支持通过短代码在 Gutenberg 和经典编辑器中使用。

## 为什么开发这个插件

**痛点：** WordPress 内置评论系统功能可用，但视觉效果陈旧，在使用页面构建器时几乎没有样式控制能力。Elementor 作为全球最流行的 WordPress 页面构建器，本身没有原生评论小组件——开发者要么嵌入默认评论模板（丑陋且依赖主题），要么安装笨重的第三方评论服务。

**TTT CommentBox 解决的问题：**
- 为 WordPress 评论系统添加了一流的 Elementor 小组件支持——无需任何变通方案
- 赋予设计师完整的视觉控制权：通过 Elementor 熟悉的样式面板自定义颜色、字体、头像大小、布局
- Elementor 免费版即可使用（无需 Pro），对所有用户开放
- 支持所有编辑器：Elementor 小组件、Gutenberg 区块、经典编辑器短代码——一个插件，三种界面
- 为中国大陆站点解决了 Gravatar 问题（在中国大陆 Gravatar 访问缓慢或被屏蔽）——内置文字头像功能
- 与 WooCommerce 评价系统完美共存——通过 `comment_meta` 标记实现零冲突
- 不加载任何外部依赖——轻量、快速，无第三方 SDK

## 功能特色

- **双 Elementor 小组件** — TTT Comments List（带 AJAX 点赞的样式化列表）和 TTT Comments Form（自定义评论表单）。在小组件面板中搜索"TTT"。
- **Elementor 免费版即可使用** — 无需 Elementor Pro。
- **AJAX 点赞** — 一点即赞，无需页面刷新。登录用户：每条评论可赞一次。访客：同一 IP 每 48 小时可赞一次。
- **嵌套回复** — 子评论独立样式显示。
- **文字头像** — 访客显示彩色首字母，而非 Gravatar 头像。非常适合 Gravatar 访问缓慢或被屏蔽的中国大陆站点。
- **三种编辑器支持** — Elementor 小组件、Gutenberg 区块（位于"TTT CommentBox"分类下）、经典编辑器短代码。
- **完整样式控制** — 可通过 Elementor 样式面板、Gutenberg 侧边栏或短代码属性自定义颜色、字体、头像大小。
- **与 WooCommerce 零冲突** — 使用 `comment_meta` 标记，与 WooCommerce 评价共存。
- **多语言** — 附带 `.pot` 模板文件及中文（zh_CN）、日语（ja）翻译。
- **插件介绍页** — WordPress 后台 -> TTT CommentBox 查看完整产品介绍。

## 安装说明

1. 下载 `ttt-commentbox.zip`
2. WordPress 后台 -> 插件 -> 安装插件 -> 上传插件
3. 启用后，在 Elementor 小组件面板中搜索"TTT"

或手动解压到 `/wp-content/plugins/` 后启用。

## 使用手册

### Elementor 编辑器

1. 使用 Elementor 编辑任意页面。
2. 在小组件面板中搜索"TTT"。
3. 将 **TTT Comments List** 拖拽到页面，显示评论列表。
4. 将 **TTT Comments Form** 拖拽到页面，显示评论表单。
5. 使用左侧设置面板自定义标题、颜色、头像大小、点赞按钮等。

### Gutenberg 编辑器

1. 使用区块编辑器编辑任意文章或页面。
2. 点击"+"区块插入器，搜索"TTT"。
3. 从"TTT CommentBox"分类中选择 **TTT Comments List** 或 **TTT Comments Form**。
4. 使用右侧设置面板配置区块外观。
5. 发布——区块将作为实时评论列表/表单在前端渲染。

### 经典编辑器

**方式一 — 可视化配置（推荐）：**
1. 在经典编辑器中打开文章。
2. 点击工具栏中的 TTT CommentBox 按钮。
3. 在弹出窗口中切换"评论列表"和"评论表单"标签页。
4. 填写设置后点击"插入短代码"。

**方式二 — 直接输入短代码：**

显示评论列表：
```
[ttt_comments_list]
```

显示评论表单：
```
[ttt_comment_form]
```

## 短代码参数参考

### `[ttt_comments_list]` — 评论列表

| 参数 | 类型 | 默认值 | 说明 |
|---|---|---|---|
| `avatar_size` | 数字 | 32 | 头像大小（像素，16-128） |
| `show_like` | 0/1 | 1 | 显示或隐藏点赞按钮 |
| `show_like_image` | 0/1 | 0 | 使用自定义点赞图标 |
| `like_image_url` | URL | - | 自定义点赞图标地址 |
| `like_text` | 文本 | - | 点赞数旁边的自定义文字 |
| `list_title` | 文本 | TTTWorks Discuss | 评论列表上方的标题 |
| `list_title_show` | 0/1 | 0 | 显示或隐藏列表标题 |
| `list_title_color` | 十六进制 | #333333 | 标题文字颜色 |
| `comments_color` | 十六进制 | #333333 | 评论内容文字颜色 |
| `children_bg` | 颜色 | rgba(247,249,251,1) | 嵌套回复区域背景色 |
| `text_avatar` | 0/1 | 0 | 访客头像显示彩色首字母（不使用 Gravatar） |

示例：
```
[ttt_comments_list]
[ttt_comments_list avatar_size="40" list_title="用户评价" list_title_color="#1a73e8" like_text="有用"]
[ttt_comments_list show_like="0" avatar_size="48" text_avatar="1"]
```

### `[ttt_comment_form]` — 评论表单

| 参数 | 类型 | 默认值 | 说明 |
|---|---|---|---|
| `form_title` | 文本 | Share your opinion | 表单标题 |
| `form_title_show` | 0/1 | 0 | 显示或隐藏表单标题 |
| `form_title_color` | 十六进制 | #333333 | 表单标题颜色 |
| `form_color` | 十六进制 | #333333 | 表单文字颜色 |
| `show_website` | 0/1 | 1 | 显示或隐藏网站 URL 字段 |
| `label_name` | 文本 | Name | 姓名字段标签 |
| `label_email` | 文本 | Email | 邮箱字段标签 |
| `label_website` | 文本 | Website | 网站字段标签 |
| `label_comment` | 文本 | Comment | 评论文本区标签 |
| `label_submit` | 文本 | Submit A Comment | 提交按钮文字 |
| `label_save_info` | 文本 | Save my name... | GDPR cookie 同意文字 |
| `submit_color` | 十六进制 | #ffffff | 按钮文字颜色 |
| `submit_bg` | 十六进制 | #007bff | 按钮背景颜色 |

示例：
```
[ttt_comment_form]
[ttt_comment_form form_title="发表评论" form_title_color="#e74c3c" show_website="0"]
[ttt_comment_form label_name="您的姓名" label_submit="提交评论" submit_bg="#27ae60"]
```

## 文字头像 — 无需 Gravatar

对于有中国访客的站点，Gravatar 访问缓慢或完全被屏蔽是常见问题。TTT CommentBox 内置了"文字头像"模式，为访客评论生成彩色首字母头像。

- **访客：** 显示姓名首字符，圆形彩色背景。"张三"->"张"，"Li Ming"->"L"
- **注册用户：** 正常使用 Gravatar 或本地头像，不受影响
- **颜色分配：** 基于姓名哈希自动分配，相同姓名始终显示相同颜色
- **性能：** 无外部 HTTP 请求，零延迟

开启方式：
- **Elementor：** 小组件设置 -> 头像区域 -> 开启"文字头像"
- **Gutenberg：** 区块设置 -> 头像面板 -> 切换"文字头像"
- **经典编辑器：** 工具栏按钮弹出窗口 -> 勾选"文字头像"，或在短代码中添加 `text_avatar="1"`

## 环境要求

- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+（可选 — 短代码在任何编辑器中均可使用）

## 相关链接

- 作者：[骆泉 / TTTWorks](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- 问题反馈：[GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)

## 更新日志

### v1.0.0

- 首次公开发布
- TTT Comments List 和 TTT Comments Form Elementor 小组件
- Gutenberg 区块支持（位于"TTT CommentBox"分类下）
- 经典编辑器短代码支持，含工具栏弹出窗口
- 短代码：`[ttt_comments_list]` 和 `[ttt_comment_form]`
- 文字头像模式（访客评论显示彩色首字母）
- AJAX 点赞系统，访客 48 小时冷却
- 自定义点赞图标上传
- 嵌套回复显示，独立样式控制
- 通过 Elementor 控件实现完整样式定制
- 国际化就绪，附带 POT 模板及中文、日语翻译
- 兼容 WooCommerce — 零冲突
- 通过 `ttt_comment_source` 元数据追踪评论来源

---

# 日本語

## 著者について

**駱泉** は、天津に本社を置く WordPress 開発スタジオ **超方科技（TTTWorks）** の創業者兼CEOです。超方科技は中国、日本、および世界中のクライアントに WordPress 開発、ウェブデザイン、技術コンサルティングサービスを提供しています。TTT CommentBox は、超方科技がリリースした初のオープンソースプラグインです。実際のクライアントニーズから生まれ、実運用を通じて磨き上げられました。

- ウェブサイト：[tttworks.com](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- メール：[a@tttworks.com](mailto:a@tttworks.com)

## プラグイン紹介

**Elementor のために再設計されたコメントシステム。**

TTT CommentBox は、モダンなページビルダー向けに設計された、完整で軽量なWordPressコメントシステムです。2つの专用のElementorウィジェット（コメント一覧 + コメントフォーム）として提供され、GutenbergやClassic Editorでもショートコードで対応しています。

## このプラグインを作った理由

**課題：** WordPressの標準コメントシステムは機能的には問題ないものの、ビジュアルは時代遅れで、ページビルダーと連携したスタイル制御ができません。世界で最も人気のWordPressページビルダーであるElementorにはそもそもコメントウィジェットが存在せず、開発者はデフォルトのコメントテンプレートを埋め込むか（醜く、テーマに依存する）、重い第三方コメントサービスを導入するかしなければいけませんでした。

**TTT CommentBox が解决的问题：**
- WordPressコメントシステムに一流のElementorウィジェットサポートを追加——代替手段不要
- デザイナーに完全なビジュアル制御権を付与——Elementorの熟悉のスタイルパネルで色・フォント・アバターサイズ・レイアウトをカスタマイズ可能
- Elementor Freeで動作（Pro不要）——すべてのユーザーに開放
- 全エディタ対応：Elementorウィジェット、Gutenbergブロック、Classic Editorショートコード——1つのプラグインで3つのインターフェース
- 中国本土サイト向けのGravatar問題を解決——の内蔵テキストアバター機能
- WooCommerceレビューと完美に共存——`comment_meta`マーカーでゼロコンフリクト
- 外部依存を読み込まない——軽量、高速、第三方SDK不要

## 機能概要

- **2つのElementorウィジェット** — TTT Comments List（AJAXいいね付き）と TTT Comments Form（カスタム投稿フォーム）。ウィジェットパネルで"TTT"を検索。
- **Elementor Freeで動作** — Elementor Pro不要。
- **AJAXいいね** — ページリロードなしでワンクリックいいね。ログイン済みユーザーは各コメントに1回。ゲストは同一IPから48時間ごとに1回。
- **スレッド返信** — 入れ子の子コメントを独立したスタイルで表示。
- **テキストアバター** — Gravatarの代わりにカラフルなイニシャルを表示。中国本土サイト（Gravatarが遅い・ブロックされている）に最適。
- **3つのエディタ対応** — Elementorウィジェット、Gutenbergブロック（「TTT CommentBox」カテゴリ）、Classic Editorショートコード。
- **柔軟なスタイル制御** — Elementorスタイルパネル、Gutenbergサイドバー、ショートコード属性から色・フォント・アバターサイズをカスタマイズ。
- **WooCommerceと完全共存** — `comment_meta`マーカーでWooCommerceレビューと衝突しない。
- **多言語対応** — `.pot`ファイル＋中国語（zh_CN）・日本語（ja）翻訳ファイル付き。
- **プラグイン紹介ページ** — WordPress管理画面 -> TTT CommentBox で製品紹介を確認。

## インストール方法

1. `ttt-commentbox.zip` をダウンロード
2. WordPress管理画面 -> プラグイン -> 新規追加 -> プラグインのアップロード
3. 有効化後、Elementorウィジェットパネルで"TTT"を検索

手動で `/wp-content/plugins/` に解凍して有効化しても構いません。

## 使い方

### Elementor

1. Elementorで任意のページを編集。
2. ウィジェットパネルで"TTT"を検索。
3. **TTT Comments List** をページにドラッグしてコメント一覧を表示。
4. **TTT Comments Form** をページにドラッグしてコメントフォームを表示。
5. 左側のパネルでタイトル、色、アバターサイズ、いいねボタンなどをカスタマイズ。

### Gutenberg

1. ブロックエディターで任意の記事またはページを編集。
2. "+"ブロックインサーターをクリックし"TTT"を検索。
3. "TTT CommentBox"カテゴリから **TTT Comments List** または **TTT Comments Form** を選択。
4. 右側の設定パネルで外観を構成。
5. 公開——ブロックがライブコメント一覧/フォームとしてフロントエンドにレンダリングされます。

### Classic Editor

**方法1 — ビジュアル設定（推奨)：**
1. Classic Editorで記事を開く。
2. ツールバーのTTT CommentBoxボタンをクリック。
3. ポップアップで「コメント一覧」と「コメントフォーム」タブを切り替え。
4. 設定を入力して「ショートコード挿入」をクリック。

**方法2 — 直接ショートコード入力：**

コメント一覧を表示：
```
[ttt_comments_list]
```

コメントフォームを表示：
```
[ttt_comment_form]
```

## ショートコードパラメーターリファレンス

### `[ttt_comments_list]` — コメント一覧

| パラメータ | タイプ | デフォルト | 説明 |
|---|---|---|---|
| `avatar_size` | 数値 | 32 | アバターサイズ（ピクセル、16-128） |
| `show_like` | 0/1 | 1 | いいねボタンを表示または非表示 |
| `show_like_image` | 0/1 | 0 | カスタムいいねアイコンを使用 |
| `like_image_url` | URL | - | カスタムいいねアイコンのURL |
| `like_text` | テキスト | - | いいね数の横に表示するカスタムテキスト |
| `list_title` | テキスト | TTTWorks Discuss | コメント一覧の上のタイトル |
| `list_title_show` | 0/1 | 0 | タイトルを表示または非表示 |
| `list_title_color` | 16進数 | #333333 | タイトル文字色 |
| `comments_color` | 16進数 | #333333 | コメント本文の文字色 |
| `children_bg` | 色 | rgba(247,249,251,1) | スレッド返信エリアの背景色 |
| `text_avatar` | 0/1 | 0 | ゲストのアバターをカラフルなイニシャルで表示（Gravatar不使用） |

使用例：
```
[ttt_comments_list]
[ttt_comments_list avatar_size="40" list_title="お客様の声" list_title_color="#1a73e8" like_text="参考になった"]
[ttt_comments_list show_like="0" avatar_size="48" text_avatar="1"]
```

### `[ttt_comment_form]` — コメントフォーム

| パラメータ | タイプ | デフォルト | 説明 |
|---|---|---|---|
| `form_title` | テキスト | Share your opinion | フォームタイトル |
| `form_title_show` | 0/1 | 0 | フォームタイトルを表示または非表示 |
| `form_title_color` | 16進数 | #333333 | フォームタイトルの色 |
| `form_color` | 16進数 | #333333 | フォームの文字色 |
| `show_website` | 0/1 | 1 | WebサイトURLフィールドを表示または非表示 |
| `label_name` | テキスト | Name | お名前フィールドのラベル |
| `label_email` | テキスト | Email | メールアドレスフィールドのラベル |
| `label_website` | テキスト | Website | Webサイトフィールドのラベル |
| `label_comment` | テキスト | Comment | コメントテキストエリアのラベル |
| `label_submit` | テキスト | Submit A Comment | 送信ボタンのテキスト |
| `label_save_info` | テキスト | Save my name... | GDPR Cookie同意テキスト |
| `submit_color` | 16進数 | #ffffff | ボタン文字色 |
| `submit_bg` | 16進数 | #007bff | ボタン背景色 |

使用例：
```
[ttt_comment_form]
[ttt_comment_form form_title="レビューを投稿" form_title_color="#e74c3c" show_website="0"]
[ttt_comment_form label_name="お名前" label_submit="コメントを投稿" submit_bg="#27ae60"]
```

## テキストアバター — Gravatar不要

中国本土の訪問者がいるサイトにとって、Gravatarの遅延やブロックはよくある問題です。TTT CommentBoxには訪問者コメント用にカラフルなイニシャルアバターを生成する内置の「テキストアバター」モードが含まれています。

- **ゲスト：** 名前の最初の1〜2文字をカラフルな円形で表示。「田中」->「田」、「Taro Yamada」->「TY」
- **登録ユーザー：** 通常通りGravatarまたはローカルアバターを使用
- **色の割り当て：** 姓名のハッシュに基づき自動割り当て。同じ名前は常に同じ色
- **パフォーマンス：** 外部HTTPリクエストなし、ゼロレイテンシ

有効化方法：
- **Elementor：** ウィジェット設定 -> アバターセクション -> 「テキストアバター」をオン
- **Gutenberg：** ブロック設定 -> アバター面板 -> 「テキストアバター」を切り替え
- **Classic Editor：** ツールバーボタン設定ポップアップ -> 「テキストアバター」をチェック、またはショートコードに `text_avatar="1"` を追加

## 動作環境

- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+（任意 — ショートコードはどのエディタでも動作）

## リンク

- 著者：[駱泉 / TTTWorks](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- イシュー報告：[GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)

## 変更履歴

### v1.0.0

- 初の一般公開リリース
- TTT Comments List および TTT Comments Form Elementorウィジェット
- Gutenbergブロック対応（「TTT CommentBox」カテゴリ）
- Classic Editorショートコード対応＋ツールバーポップアップ
- ショートコード：`[ttt_comments_list]` と `[ttt_comment_form]`
- テキストアバターモード（ゲストコメントのカラフルなイニシャル）
- AJAXいいねシステム（ゲスト48時間クールダウン）
- カスタムいいねアイコンアップロード
- スレッド返信表示（独立スタイル対応）
- Elementorコントロールによる完全スタイルカスタマイズ
- i18n対応（POTファイル＋中国語・日本語翻訳付き）
- WooCommerce Compatible — 完全共存
- `ttt_comment_source`メタによるコメントソース追跡
