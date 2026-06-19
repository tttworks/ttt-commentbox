<?php
/**
 * TTT CommentBox — Elementor Comments List Widget
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox\Widgets;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\{Widget_Base, Controls_Manager, Group_Control_Typography, Group_Control_Border};
use TTTWorks\CommentBox\TTT_Comments_Core;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) { return; }

class TTT_Comments_List_Widget extends Widget_Base {

    public function get_name() { return 'ttt-comments-list'; }
    public function get_title() { return __( 'TTT Comments List', 'ttt-commentbox' ); }
    public function get_icon() { return 'eicon-comments'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'comment', 'ttt', 'comments', 'review', 'testimonial' ]; }

    protected function register_controls() {
        // ===== Section: List Title =====
        $this->start_controls_section( 'section_list_title', [
            'label' => __( 'List Title', 'ttt-commentbox' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control( 'list_title_text', [ 'label' => __( 'Title Text', 'ttt-commentbox' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'TTTWorks Discuss', 'ttt-commentbox' ), 'placeholder' => __( 'Enter title text', 'ttt-commentbox' ) ]);
        $this->add_control( 'list_title_show', [ 'label' => __( 'Show Title', 'ttt-commentbox' ), 'type' => Controls_Manager::SWITCHER, 'label_on' => __( 'Yes', 'ttt-commentbox' ), 'label_off' => __( 'No', 'ttt-commentbox' ), 'return_value' => 'yes', 'default' => 'yes' ]);
        $this->add_control( 'list_title_color', [ 'label' => __( 'Title Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => '#333333', 'condition' => [ 'list_title_show' => 'yes' ] ]);
        $this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'list_title_typography', 'label' => __( 'Title Typography', 'ttt-commentbox' ), 'selector' => '{{WRAPPER}} .ttt-comments-title', 'condition' => [ 'list_title_show' => 'yes' ] ]);
        $this->add_responsive_control( 'list_title_padding', [ 'label' => __( 'Title Padding', 'ttt-commentbox' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px','em','%' ], 'selectors' => [ '{{WRAPPER}} .ttt-comments-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ], 'condition' => [ 'list_title_show' => 'yes' ] ]);
        $this->end_controls_section();

        // ===== Section: Avatar & Text Avatar =====
        $this->start_controls_section( 'section_avatar', [
            'label' => __( 'Avatar', 'ttt-commentbox' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control( 'avatar_size', [ 'label' => __( 'Size (px)', 'ttt-commentbox' ), 'type' => Controls_Manager::SLIDER, 'range' => [ 'px' => [ 'min'=>16,'max'=>128 ] ], 'default' => [ 'size'=>32 ] ]);
        $this->add_control( 'text_avatar', [
            'label'        => __( '游客文字头像', 'ttt-commentbox' ),
            'description'  => __( '游客评论使用名字首字母作为头像（不请求 Gravatar，适合大陆站点）。注册用户头像不受影响。', 'ttt-commentbox' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => __( '字母', 'ttt-commentbox' ),
            'label_off'    => __( 'Gravatar', 'ttt-commentbox' ),
            'return_value' => 'yes',
            'default'      => '',
        ]);
        $this->end_controls_section();

        // ===== Section: Display Settings =====
        $this->start_controls_section( 'section_display', [ 'label' => __( 'Display Settings', 'ttt-commentbox' ), 'tab' => Controls_Manager::TAB_CONTENT ]);
        $this->add_control( 'show_like', [ 'label' => __( 'Show Like Button', 'ttt-commentbox' ), 'type' => Controls_Manager::SWITCHER, 'label_on' => __( 'Yes', 'ttt-commentbox' ), 'label_off' => __( 'No', 'ttt-commentbox' ), 'return_value' => 'yes', 'default' => 'yes' ]);
        $this->add_control( 'show_like_image', [ 'label' => __( 'Use Custom Like Icon', 'ttt-commentbox' ), 'type' => Controls_Manager::SWITCHER, 'label_on' => __( 'Yes', 'ttt-commentbox' ), 'label_off' => __( 'No', 'ttt-commentbox' ), 'return_value' => 'yes', 'default' => '', 'condition' => [ 'show_like' => 'yes' ] ]);
        $this->add_control( 'like_image_url', [ 'label' => __( 'Custom Like Icon', 'ttt-commentbox' ), 'type' => Controls_Manager::MEDIA, 'default' => [ 'url' => '' ], 'condition' => [ 'show_like' => 'yes', 'show_like_image' => 'yes' ] ]);
        $this->add_control( 'like_text', [ 'label' => __( 'Like Button Text', 'ttt-commentbox' ), 'type' => Controls_Manager::TEXT, 'default' => '', 'placeholder' => __( 'e.g. Helpful', 'ttt-commentbox' ), 'condition' => [ 'show_like' => 'yes' ] ]);
        $this->end_controls_section();

        // ===== Style: Comments =====
        $this->start_controls_section( 'section_style_comments', [ 'label' => __( 'Comment List Style', 'ttt-commentbox' ), 'tab' => Controls_Manager::TAB_STYLE ]);
        $this->add_control( 'comments_text_color', [ 'label' => __( 'Text Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => '#333333' ]);
        $this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'comments_typography', 'label' => __( 'Comment Text Typography', 'ttt-commentbox' ), 'selector' => '{{WRAPPER}} .ttt-comment-content' ]);
        $this->add_responsive_control( 'comments_padding', [ 'label' => __( 'Comment Padding', 'ttt-commentbox' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px','em','%' ], 'selectors' => [ '{{WRAPPER}} .ttt-comment-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ]);
        $this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'comments_border', 'label' => __( 'Comment Border', 'ttt-commentbox' ), 'selector' => '{{WRAPPER}} .ttt-comment-item' ]);
        $this->add_control( 'comments_border_radius', [ 'label' => __( 'Border Radius', 'ttt-commentbox' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px','%' ], 'selectors' => [ '{{WRAPPER}} .ttt-comment-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ]);
        $this->end_controls_section();

        // ===== Style: Children =====
        $this->start_controls_section( 'section_style_children', [ 'label' => __( 'Replies Style', 'ttt-commentbox' ), 'tab' => Controls_Manager::TAB_STYLE ]);
        $this->add_control( 'children_background', [ 'label' => __( 'Background Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(247,249,251,1)' ]);
        $this->add_responsive_control( 'children_padding', [ 'label' => __( 'Padding', 'ttt-commentbox' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px','em','%' ], 'default' => [ 'top'=>20,'right'=>20,'bottom'=>20,'left'=>20,'unit'=>'px' ], 'selectors' => [ '{{WRAPPER}} .ttt-children' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; background-color: {{VALUE}};' ] ]);
        $this->add_control( 'children_border_radius', [ 'label' => __( 'Border Radius', 'ttt-commentbox' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px','%' ], 'default' => [ 'top'=>10,'right'=>10,'bottom'=>10,'left'=>10,'unit'=>'px' ], 'selectors' => [ '{{WRAPPER}} .ttt-children' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ]);
        $this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'children_border', 'label' => __( 'Border', 'ttt-commentbox' ), 'selector' => '{{WRAPPER}} .ttt-children' ]);
        $this->end_controls_section();

        // ===== Style: Like Button =====
        $this->start_controls_section( 'section_style_like', [ 'label' => __( 'Like Button Style', 'ttt-commentbox' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => [ 'show_like' => 'yes' ] ]);
        $this->add_control( 'like_color', [ 'label' => __( 'Like Text Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => '#666', 'selectors' => [ '{{WRAPPER}} .ttt-comment-like' => 'color: {{VALUE}};' ] ]);
        $this->add_control( 'like_hover_color', [ 'label' => __( 'Like Hover Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => '#007bff', 'selectors' => [ '{{WRAPPER}} .ttt-comment-like:hover' => 'color: {{VALUE}};' ] ]);
        $this->add_control( 'liked_color', [ 'label' => __( 'Liked Color', 'ttt-commentbox' ), 'type' => Controls_Manager::COLOR, 'default' => '#e74c3c', 'selectors' => [ '{{WRAPPER}} .ttt-comment-like.ttt-liked' => 'color: {{VALUE}};' ] ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( ! is_singular() ) { echo '<div class="ttt-commentbox-notice">' . esc_html__( 'TTT Comments List widget only works on singular pages.', 'ttt-commentbox' ) . '</div>'; return; }

        echo TTT_Comments_Core::render_list( [
            'avatar_size'       => isset($settings['avatar_size']['size']) ? (int)$settings['avatar_size']['size'] : 32,
            'show_like'         => 'yes' === ($settings['show_like'] ?? ''),
            'show_like_image'   => 'yes' === ($settings['show_like_image'] ?? ''),
            'like_image_url'    => isset($settings['like_image_url']['url']) ? esc_url_raw($settings['like_image_url']['url']) : '',
            'like_text'         => isset($settings['like_text']) ? sanitize_text_field($settings['like_text']) : '',
            'comments_color'    => isset($settings['comments_text_color']) ? sanitize_hex_color($settings['comments_text_color']) : '#333333',
            'list_title_text'   => isset($settings['list_title_text']) ? sanitize_text_field($settings['list_title_text']) : __( 'TTTWorks Discuss', 'ttt-commentbox' ),
            'list_title_show'   => 'yes' === ($settings['list_title_show'] ?? ''),
            'list_title_color'  => isset($settings['list_title_color']) ? sanitize_hex_color($settings['list_title_color']) : '#333333',
            'children_bg'       => isset($settings['children_background']) ? sanitize_text_field($settings['children_background']) : 'rgba(247,249,251,1)',
            'text_avatar'       => 'yes' === ($settings['text_avatar'] ?? ''),
            'widget_id'         => 'ttt-el-list-' . $this->get_id(),
        ]);
    }
}
