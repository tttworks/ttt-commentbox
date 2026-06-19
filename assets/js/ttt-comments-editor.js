/**
 * TTT CommentBox — Gutenberg Editor Script
 *
 * Defines Gutenberg block edit/save functions with full sidebar controls
 * matching the Elementor widget settings as closely as possible.
 *
 * Available controls per block:
 *   TTT Comments List:   Title, Likes, Avatar, Colors, Children Style
 *   TTT Comments Form:   Title, Labels, Website toggle
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

(function (wp) {
    'use strict';

    var el                = wp.element.createElement;
    var __                = wp.i18n.__;
    var registerBlockType = wp.blocks.registerBlockType;
    var useBlockProps    = wp.blockEditor.useBlockProps;
    var InspectorControls = wp.blockEditor.InspectorControls;

    var PanelBody     = wp.components.PanelBody;
    var ToggleControl = wp.components.ToggleControl;
    var TextControl   = wp.components.TextControl;
    var RangeControl  = wp.components.RangeControl;
    var ColorPicker   = wp.components.ColorPicker;
    var ColorPalette  = wp.components.ColorPalette;
    var BaseControl   = wp.components.BaseControl;
    var MediaUpload   = wp.blockEditor.MediaUpload;
    var Button        = wp.components.Button;

    // Common color swatches
    var COLOR_SWATCHES = [
        { name: 'Black',       color: '#333333' },
        { name: 'Dark Gray',   color: '#666666' },
        { name: 'Blue',        color: '#007bff' },
        { name: 'Red',         color: '#e74c3c' },
        { name: 'Green',       color: '#28a745' },
        { name: 'White',       color: '#ffffff' },
        { name: 'Light Gray',  color: '#f9f9f9' },
    ];

    // =============================================================
    //  Helper: ColorPickerControl
    // =============================================================
    function ColorPickerControl(label, value, onChange, help) {
        return el(BaseControl, { label: label, help: help || '' },
            el(ColorPalette, {
                colors: COLOR_SWATCHES,
                value: value,
                onChange: onChange,
                disableCustomColors: false,
                clearable: false,
            })
        );
    }

    // =============================================================
    //  Block: TTT Comments List
    // =============================================================
    registerBlockType('ttt-commentbox/comments-list', {
        title: __('TTT Comments List', 'ttt-commentbox'),
        description: __('Styled comment list with AJAX likes, threaded replies, and configurable appearance.', 'ttt-commentbox'),
        category: 'ttt-commentbox',
        icon: 'list-view',
        keywords: ['comment', 'comments', 'review', 'reply', 'like', 'ttt'],
        supports: { html: false },

        attributes: {
            // Title
            listTitle:       { type: 'string',  default: '' },
            listTitleShow:   { type: 'boolean', default: true },
            listTitleColor:  { type: 'string',  default: '#333333' },
            // Likes
            showLike:        { type: 'boolean', default: true },
            showLikeImage:   { type: 'boolean', default: false },
            likeImageUrl:    { type: 'string',  default: '' },
            likeText:        { type: 'string',  default: '' },
            likeColor:       { type: 'string',  default: '#666666' },
            likedColor:      { type: 'string',  default: '#e74c3c' },
            // Avatar
            avatarSize:      { type: 'number',  default: 32 },
            // Colors
            commentsColor:   { type: 'string',  default: '#333333' },
            // Children
            childrenBg:      { type: 'string',  default: 'rgba(247, 249, 251, 1)' },
            // Text Avatar
            textAvatar:      { type: 'boolean', default: false },
        },

        edit: function (props) {
            var attrs = props.attributes;
            var setAttr = props.setAttributes;

            return el('div', useBlockProps(),

                // ========== Sidebar Controls ==========
                el(InspectorControls, {},

                    // Panel 1: Title
                    el(PanelBody, { title: __('📋 List Title', 'ttt-commentbox'), initialOpen: true },
                        el(ToggleControl, {
                            label: __('Show Title', 'ttt-commentbox'),
                            checked: attrs.listTitleShow,
                            onChange: function (v) { setAttr({ listTitleShow: v }); },
                        }),
                        attrs.listTitleShow && el(TextControl, {
                            label: __('Title Text', 'ttt-commentbox'),
                            value: attrs.listTitle,
                            onChange: function (v) { setAttr({ listTitle: v }); },
                            placeholder: 'TTTWorks Discuss',
                        }),
                        attrs.listTitleShow && ColorPickerControl(
                            __('Title Color', 'ttt-commentbox'),
                            attrs.listTitleColor,
                            function (v) { setAttr({ listTitleColor: v }); }
                        )
                    ),

                    // Panel 2: Like Button
                    el(PanelBody, { title: __('❤️ Like Button', 'ttt-commentbox'), initialOpen: false },
                        el(ToggleControl, {
                            label: __('Show Like Button', 'ttt-commentbox'),
                            checked: attrs.showLike,
                            onChange: function (v) { setAttr({ showLike: v }); },
                        }),
                        attrs.showLike && el(ToggleControl, {
                            label: __('Use Custom Like Icon', 'ttt-commentbox'),
                            checked: attrs.showLikeImage,
                            onChange: function (v) { setAttr({ showLikeImage: v }); },
                        }),
                        attrs.showLike && attrs.showLikeImage && el('div', { style: { marginBottom: '16px' } },
                            el(BaseControl, { label: __('Like Icon Image', 'ttt-commentbox') },
                                el(MediaUpload, {
                                    onSelect: function (media) {
                                        setAttr({ likeImageUrl: media.url });
                                    },
                                    allowedTypes: ['image'],
                                    render: function (obj) {
                                        return el(Button, {
                                            isSecondary: true,
                                            onClick: obj.open,
                                            style: { width: '100%', justifyContent: 'center' },
                                        }, attrs.likeImageUrl
                                            ? __('✓ Image selected — click to change', 'ttt-commentbox')
                                            : __('Choose Image', 'ttt-commentbox')
                                        );
                                    },
                                })
                            )
                        ),
                        attrs.showLike && el(TextControl, {
                            label: __('Like Button Text (optional)', 'ttt-commentbox'),
                            value: attrs.likeText,
                            onChange: function (v) { setAttr({ likeText: v }); },
                            placeholder: 'e.g. Helpful',
                        }),
                        attrs.showLike && ColorPickerControl(
                            __('Normal Color', 'ttt-commentbox'),
                            attrs.likeColor,
                            function (v) { setAttr({ likeColor: v }); }
                        ),
                        attrs.showLike && ColorPickerControl(
                            __('Liked Color', 'ttt-commentbox'),
                            attrs.likedColor,
                            function (v) { setAttr({ likedColor: v }); }
                        )
                    ),

                    // Panel 3: Avatar
                    el(PanelBody, { title: __('👤 Avatar', 'ttt-commentbox'), initialOpen: false },
                        el(RangeControl, {
                            label: __('Avatar Size (px)', 'ttt-commentbox'),
                            value: attrs.avatarSize,
                            onChange: function (v) { setAttr({ avatarSize: v }); },
                            min: 16,
                            max: 128,
                        }),
                        el(ToggleControl, {
                            label: __('Text Avatar (游客文字头像)', 'ttt-commentbox'),
                            help: __('Guest comments show initials instead of Gravatar. Logged-in users unaffected.', 'ttt-commentbox'),
                            checked: attrs.textAvatar,
                            onChange: function (v) { setAttr({ textAvatar: v }); },
                        })
                    ),

                    // Panel 4: Colors
                    el(PanelBody, { title: __('🎨 Colors', 'ttt-commentbox'), initialOpen: false },
                        ColorPickerControl(
                            __('Comment Text Color', 'ttt-commentbox'),
                            attrs.commentsColor,
                            function (v) { setAttr({ commentsColor: v }); }
                        )
                    ),

                    // Panel 5: Children (Replies)
                    el(PanelBody, { title: __('💬 Replies Area', 'ttt-commentbox'), initialOpen: false },
                        ColorPickerControl(
                            __('Background Color', 'ttt-commentbox'),
                            attrs.childrenBg,
                            function (v) { setAttr({ childrenBg: v }); },
                            __('The background behind threaded replies.', 'ttt-commentbox')
                        )
                    )
                ),

                // ========== Block Preview ==========
                el('div', {
                    style: {
                        padding: '20px',
                        background: '#f9f9f9',
                        border: '1px dashed #ccc',
                        borderRadius: '4px',
                        textAlign: 'center',
                    },
                },
                    el('span', {
                        style: { fontSize: '14px', color: '#666', fontWeight: 500 },
                        className: 'dashicons-before dashicons-list-view',
                    }, ' TTT Comments List'),
                    el('p', {
                        style: { fontSize: '12px', color: '#999', marginTop: '8px', marginBottom: 0 },
                    }, __('Comments will appear here on the published page.', 'ttt-commentbox')),
                    el('p', {
                        style: { fontSize: '11px', color: '#bbb', marginTop: '4px', marginBottom: 0 },
                    }, __('Settings → right sidebar ↑', 'ttt-commentbox'))
                )
            );
        },
        save: function () { return null; },
    });

    // =============================================================
    //  Block: TTT Comments Form
    // =============================================================
    registerBlockType('ttt-commentbox/comments-form', {
        title: __('TTT Comments Form', 'ttt-commentbox'),
        description: __('Custom comment form with configurable labels, colors, and layout.', 'ttt-commentbox'),
        category: 'ttt-commentbox',
        icon: 'editor-table',
        keywords: ['comment', 'form', 'submit', 'feedback', 'review', 'ttt'],
        supports: { html: false },

        attributes: {
            // Title
            formTitle:      { type: 'string',  default: '' },
            formTitleShow:  { type: 'boolean', default: true },
            formTitleColor: { type: 'string',  default: '#333333' },
            // Form
            formColor:      { type: 'string',  default: '#333333' },
            // Submit
            submitColor:    { type: 'string',  default: '#ffffff' },
            submitBg:       { type: 'string',  default: '#007bff' },
            // Labels
            labelName:      { type: 'string',  default: '' },
            labelEmail:     { type: 'string',  default: '' },
            labelWebsite:   { type: 'string',  default: '' },
            labelComment:   { type: 'string',  default: '' },
            labelSubmit:    { type: 'string',  default: '' },
            labelSaveInfo:  { type: 'string',  default: '' },
            // Display
            showWebsite:    { type: 'boolean', default: true },
        },

        edit: function (props) {
            var attrs = props.attributes;
            var setAttr = props.setAttributes;

            return el('div', useBlockProps(),

                // ========== Sidebar Controls ==========
                el(InspectorControls, {},

                    // Panel 1: Title
                    el(PanelBody, { title: __('📋 Form Title', 'ttt-commentbox'), initialOpen: true },
                        el(ToggleControl, {
                            label: __('Show Form Title', 'ttt-commentbox'),
                            checked: attrs.formTitleShow,
                            onChange: function (v) { setAttr({ formTitleShow: v }); },
                        }),
                        attrs.formTitleShow && el(TextControl, {
                            label: __('Title Text', 'ttt-commentbox'),
                            value: attrs.formTitle,
                            onChange: function (v) { setAttr({ formTitle: v }); },
                            placeholder: 'Share your opinion',
                        }),
                        attrs.formTitleShow && ColorPickerControl(
                            __('Title Color', 'ttt-commentbox'),
                            attrs.formTitleColor,
                            function (v) { setAttr({ formTitleColor: v }); }
                        )
                    ),

                    // Panel 2: Field Labels
                    el(PanelBody, { title: __('🏷️ Field Labels', 'ttt-commentbox'), initialOpen: false },
                        el('p', {
                            style: { fontSize: '12px', color: '#999', marginTop: 0, marginBottom: '12px' },
                        }, __('Leave blank to use the defaults (English).', 'ttt-commentbox')),
                        el(TextControl, {
                            label: __('Name Label', 'ttt-commentbox'),
                            value: attrs.labelName,
                            onChange: function (v) { setAttr({ labelName: v }); },
                            placeholder: 'Name',
                        }),
                        el(TextControl, {
                            label: __('Email Label', 'ttt-commentbox'),
                            value: attrs.labelEmail,
                            onChange: function (v) { setAttr({ labelEmail: v }); },
                            placeholder: 'Email',
                        }),
                        el(TextControl, {
                            label: __('Website Label', 'ttt-commentbox'),
                            value: attrs.labelWebsite,
                            onChange: function (v) { setAttr({ labelWebsite: v }); },
                            placeholder: 'Website',
                        }),
                        el(TextControl, {
                            label: __('Comment Label', 'ttt-commentbox'),
                            value: attrs.labelComment,
                            onChange: function (v) { setAttr({ labelComment: v }); },
                            placeholder: 'Comment',
                        }),
                        el(TextControl, {
                            label: __('Submit Button Text', 'ttt-commentbox'),
                            value: attrs.labelSubmit,
                            onChange: function (v) { setAttr({ labelSubmit: v }); },
                            placeholder: 'Submit A Comment',
                        })
                    ),

                    // Panel 3: Display
                    el(PanelBody, { title: __('⚙️ Display', 'ttt-commentbox'), initialOpen: false },
                        el(ToggleControl, {
                            label: __('Show Website Field', 'ttt-commentbox'),
                            checked: attrs.showWebsite,
                            onChange: function (v) { setAttr({ showWebsite: v }); },
                        }),
                        ColorPickerControl(
                            __('Form Text Color', 'ttt-commentbox'),
                            attrs.formColor,
                            function (v) { setAttr({ formColor: v }); }
                        )
                    ),

                    // Panel 4: Submit Button
                    el(PanelBody, { title: __('🔘 Submit Button', 'ttt-commentbox'), initialOpen: false },
                        ColorPickerControl(
                            __('Button Text Color', 'ttt-commentbox'),
                            attrs.submitColor,
                            function (v) { setAttr({ submitColor: v }); }
                        ),
                        ColorPickerControl(
                            __('Button Background', 'ttt-commentbox'),
                            attrs.submitBg,
                            function (v) { setAttr({ submitBg: v }); }
                        )
                    )
                ),

                // ========== Block Preview ==========
                el('div', {
                    style: {
                        padding: '20px',
                        background: '#f9f9f9',
                        border: '1px dashed #ccc',
                        borderRadius: '4px',
                        textAlign: 'center',
                    },
                },
                    el('span', {
                        style: { fontSize: '14px', color: '#666', fontWeight: 500 },
                        className: 'dashicons-before dashicons-editor-table',
                    }, ' TTT Comments Form'),
                    el('p', {
                        style: { fontSize: '12px', color: '#999', marginTop: '8px', marginBottom: 0 },
                    }, __('The comment form will appear here on the published page.', 'ttt-commentbox')),
                    el('p', {
                        style: { fontSize: '11px', color: '#bbb', marginTop: '4px', marginBottom: 0 },
                    }, __('Settings → right sidebar ↑', 'ttt-commentbox'))
                )
            );
        },
        save: function () { return null; },
    });

})(window.wp);
