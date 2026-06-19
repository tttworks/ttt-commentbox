# TTT CommentBox for Elementor

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/tttworks/ttt-commentbox)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

<!--lan-->English · [中文](README.md#中文) · [日本語](README.md#日本語)<!--/lan-->

---

<!--lan EN-->
## English

**Comments, Reimagined for Elementor.**

A complete, lightweight comment system for WordPress — works seamlessly with Elementor, Gutenberg, Classic Editor, and any theme via Shortcodes.

**[Repository](https://github.com/tttworks/ttt-commentbox)** · **[Website](https://tttworks.com)** · **[Issues](https://github.com/tttworks/ttt-commentbox/issues)**
<!--/lan EN-->

<!--lan CN-->
## 中文

**为 Elementor 重塑评论体验。**

一款完整、轻量的 WordPress 评论系统 — 与 Elementor、Gutenberg、经典编辑器及任何主题的短代码无缝协作。

**[仓库](https://github.com/tttworks/ttt-commentbox)** · **[网站](https://tttworks.com)** · **[问题反馈](https://github.com/tttworks/ttt-commentbox/issues)**
<!--/lan CN-->

<!--lan JA-->
## 日本語

**Elementor のために再設計されたコメントシステム。**

Elementor、Gutenberg、Classic Editor 以及びショートコード対応のあらゆるテーマとシームレスに連携する、軽量なWordPressコメントシステムです。

**[リポジトリ](https://github.com/tttworks/ttt-commentbox)** · **[ウェブサイト](https://tttworks.com)** · **[イシュー](https://github.com/tttworks/ttt-commentbox/issues)**
<!--/lan JA-->

---

## ✨ Features / 功能特色 / 機能概要

<!--lan EN-->
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
<!--/lan EN-->

<!--lan CN-->
- **双 Elementor 小组件** — TTT Comments List（带 AJAX 点赞的样式化列表）和 TTT Comments Form（自定义评论表单）。在小组件面板中搜索"TTT"。
- **Elementor 免费版即可使用** — 无需 Elementor Pro。
- **AJAX 点赞** — 一点即赞，无需页面刷新。登录用户：每条评论可赞一次。访客：同一 IP 每 48 小时可赞一次。
- **嵌套回复** — 子评论独立样式显示。
- **🔤 文字头像** — 访客显示彩色首字母，而非 Gravatar 头像。非常适合 Gravatar 访问缓慢或被屏蔽的中国大陆站点。
- **三种编辑器支持** — Elementor 小组件、Gutenberg 区块（位于"TTT CommentBox"分类下）、经典编辑器短代码。
- **完整样式控制** — 可通过 Elementor 样式面板、Gutenberg 侧边栏或短代码属性自定义颜色、字体、头像大小。
- **与 WooCommerce 零冲突** — 使用 `comment_meta` 标记，与 WooCommerce 评价共存。
- **多语言** — 附带 `.pot` 模板文件及中文（zh_CN）、日语（ja）翻译。
- **插件介绍页** — WordPress 后台 → TTT CommentBox 查看完整产品介绍。
<!--/lan CN-->

<!--lan JA-->
- **2つのElementorウィジェット** — TTT Comments List（AJAXいいね付き）と TTT Comments Form（カスタム投稿フォーム）。ウィジェットパネルで"TTT"を検索。
- **Elementor Freeで動作** — Elementor Pro不要。
- **AJAXいいね** — ページリロードなしでワンクリックいいね。ログイン済みユーザーは各コメントに1回。ゲストは同一IPから48時間ごとに1回。
- **スレッド返信** — 入れ子の子コメントを独立したスタイルで表示。
- **🔤 テキストアバター** — Gravatarの代わりにカラフルなイニシャルを表示。中国本土サイト（Gravatarが遅い・ブロックされている）に最適。
- **3つのエディタ対応** — Elementorウィジェット、Gutenbergブロック（「TTT CommentBox」カテゴリ）、Classic Editorショートコード。
- **柔軟なスタイル制御** — Elementorスタイルパネル、Gutenbergサイドバー、ショートコード属性から色・フォント・アバターサイズをカスタマイズ。
- **WooCommerceと完全共存** — `comment_meta`マーカーでWooCommerceレビューと衝突しない。
- **多言語対応** — `.pot`ファイル＋中国語（zh_CN）・日本語（ja）翻訳ファイル付き。
- **プラグイン紹介ページ** — WordPress管理画面 → TTT CommentBox で製品紹介を確認。
<!--/lan JA-->

---

## 📦 Installation / 安装说明 / インストール方法

<!--lan EN-->
1. Download `ttt-commentbox.zip`
2. WordPress Admin → Plugins → Add New → Upload Plugin
3. Activate, then search "TTT" in Elementor widget panel

Or manually extract to `/wp-content/plugins/` and activate.
<!--/lan EN-->

<!--lan CN-->
1. 下载 `ttt-commentbox.zip`
2. WordPress 后台 → 插件 → 安装插件 → 上传插件
3. 启用后，在 Elementor 小组件面板中搜索"TTT"

或手动解压到 `/wp-content/plugins/` 后启用。
<!--/lan CN-->

<!--lan JA-->
1. `ttt-commentbox.zip` をダウンロード
2. WordPress管理画面 → プラグイン → 新規追加 → プラグインのアップロード
3. 有効化後、Elementorウィジェットパネルで"TTT"を検索

手動で `/wp-content/plugins/` に解凍して有効化しても構いません。
<!--/lan JA-->

---

## 🖥️ Requirements / 环境要求 / 動作環境

<!--lan EN-->
- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+ (optional — shortcodes work in any editor)
<!--/lan EN-->

<!--lan CN-->
- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+（可选 — 短代码在任何编辑器中均可使用）
<!--/lan CN-->

<!--lan JA-->
- WordPress 5.8+
- PHP 7.4+
- Elementor 3.0+（任意 — ショートコードはどのエディタでも動作）
<!--/lan JA-->

---

## 🔗 Links / 相关链接 / リンク

<!--lan EN-->
- Author: [Aloysius Luo / TTTWorks](https://tttworks.com)
- GitHub: [@tttworks](https://github.com/tttworks)
- Report issues: [GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)
<!--/lan EN-->

<!--lan CN-->
- 作者：[Aloysius Luo / TTTWorks](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- 问题反馈：[GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)
<!--/lan CN-->

<!--lan JA-->
- 著者：[Aloysius Luo / TTTWorks](https://tttworks.com)
- GitHub：[@tttworks](https://github.com/tttworks)
- イシュー報告：[GitHub Issues](https://github.com/tttworks/ttt-commentbox/issues)
<!--/lan JA-->

---

## 📄 Changelog / 更新日志 / 変更履歴

### v1.0.0

<!--lan EN-->
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
<!--/lan EN-->

<!--lan CN-->
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
<!--/lan CN-->

<!--lan JA-->
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
- WooCommerceCompatible — 完全共存
- `ttt_comment_source`メタによるコメントソース追跡
<!--/lan JA-->