# Contributing to TTT CommentBox

Thank you for your interest in contributing to TTT CommentBox!

## How to Contribute

### Reporting Issues

Found a bug or have a feature request? Please open an issue on GitHub:

- **Bug reports:** Include your WordPress version, PHP version, and steps to reproduce
- **Feature requests:** Describe the use case and why it would benefit users

### Pull Requests

1. Fork the repository
2. Create a new branch: `git checkout -b feature/your-feature-name`
3. Make your changes
4. Test your changes thoroughly
5. Submit a pull request

### Code Standards

All PHP code follows the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).

For JavaScript, we follow modern ES6+ practices.

### Setting Up Development Environment

1. Clone the repository:
   ```bash
   git clone https://github.com/tttworks/ttt-commentbox.git
   ```

2. Place the plugin folder in your WordPress installation:
   ```bash
   /wp-content/plugins/ttt-commentbox/
   ```

3. Activate the plugin in WordPress admin

4. (Optional) Enable `WP_DEBUG` in `wp-config.php` for development

### File Structure

```
ttt-commentbox/
├── ttt-commentbox.php         # Main plugin file
├── includes/
│   ├── class-ttt-comments-core.php       # Core rendering (shared by all integrations)
│   ├── class-ttt-comments-ajax.php       # AJAX handlers
│   ├── class-ttt-comments-shortcodes.php # Shortcode registration
│   ├── class-ttt-comments-elementor.php # Elementor integration
│   ├── class-ttt-comments-gutenberg.php  # Gutenberg integration
│   └── class-ttt-comments-elementor-list.php
│   └── class-ttt-comments-elementor-form.php
├── assets/
│   ├── css/ttt-comments.css
│   └── js/ttt-comments.js
└── languages/
    └── ttt-commentbox.pot
```

### Adding New Features

**Core rendering changes** should go in `class-ttt-comments-core.php` — this ensures all editor integrations (Elementor, Gutenberg, Shortcodes) benefit from the same logic.

**Editor-specific features** should go in their respective files.

### Testing Checklist

Before submitting a PR, verify:

- [ ] Works on WordPress 5.8+
- [ ] PHP 7.4+ compatibility
- [ ] No PHP errors or warnings
- [ ] Elementor widgets register correctly
- [ ] Shortcodes render correctly
- [ ] AJAX likes work for both logged-in and guest users
- [ ] CSS doesn't conflict with common themes
- [ ] Translatable strings use `__()` or `_e()`
- [ ] No new database tables added (use `comment_meta` instead)

## License

By contributing, you agree that your contributions will be licensed under the GPL v2 or later license.

## Contact

- **Author:** Aloysius Luo (TTTWorks)
- **Website:** https://tttworks.com
- **GitHub:** https://github.com/tttworks/ttt-commentbox
