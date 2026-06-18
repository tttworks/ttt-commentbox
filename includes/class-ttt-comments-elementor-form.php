<?php
/**
 * TTT CommentBox — Elementor Comments Form Widget
 *
 * @package TTTWorks/CommentBox
 * @since   1.0.0
 */

namespace TTTWorks\CommentBox\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    return;
}

/**
 * TTT Comments Form Elementor Widget.
 *
 * @since 1.0.0
 */
class TTT_Comments_Form_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function get_name() {
        return 'ttt-comments-form';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function get_title() {
        return __( 'TTT Comments Form', 'ttt-commentbox' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    /**
     * Get widget categories.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_categories() {
        return array( 'general' );
    }

    /**
     * Get widget keywords.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_keywords() {
        return array( 'comment', 'form', 'ttt', 'review', 'feedback' );
    }

    /**
     * Register widget controls.
     *
     * @since 1.0.0
     */
    protected function register_controls() {

        // ===== Section: Form Title =====
        $this->start_controls_section(
            'section_form_title',
            array(
                'label' => __( 'Form Title', 'ttt-commentbox' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'form_title_text',
            array(
                'label'       => __( 'Title Text', 'ttt-commentbox' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Share your opinion', 'ttt-commentbox' ),
                'placeholder' => __( 'Enter form title', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'form_title_show',
            array(
                'label'        => __( 'Show Title', 'ttt-commentbox' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ttt-commentbox' ),
                'label_off'    => __( 'No', 'ttt-commentbox' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'form_title_color',
            array(
                'label'     => __( 'Title Color', 'ttt-commentbox' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'condition' => array( 'form_title_show' => 'yes' ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'form_title_typography',
                'label'     => __( 'Title Typography', 'ttt-commentbox' ),
                'selector'  => '{{WRAPPER}} .ttt-comment-form-title',
                'condition' => array( 'form_title_show' => 'yes' ),
            )
        );

        $this->end_controls_section();

        // ===== Section: Field Labels =====
        $this->start_controls_section(
            'section_labels',
            array(
                'label' => __( 'Field Labels', 'ttt-commentbox' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'label_name',
            array(
                'label'   => __( 'Name Label', 'ttt-commentbox' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Name', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'label_email',
            array(
                'label'   => __( 'Email Label', 'ttt-commentbox' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Email', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'label_website',
            array(
                'label'   => __( 'Website Label', 'ttt-commentbox' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Website', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'label_comment',
            array(
                'label'   => __( 'Comment Label', 'ttt-commentbox' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Comment', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'label_submit',
            array(
                'label'   => __( 'Submit Button Text', 'ttt-commentbox' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Submit A Comment', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'label_save_info',
            array(
                'label'       => __( 'Save Info Text', 'ttt-commentbox' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Save my name, email, and website in this browser for the next time I comment.', 'ttt-commentbox' ),
                'description' => __( 'The GDPR cookie consent text.', 'ttt-commentbox' ),
            )
        );

        $this->end_controls_section();

        // ===== Section: Display Settings =====
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __( 'Display Settings', 'ttt-commentbox' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_website',
            array(
                'label'        => __( 'Show Website Field', 'ttt-commentbox' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ttt-commentbox' ),
                'label_off'    => __( 'No', 'ttt-commentbox' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        // ===== Section: Form Style =====
        $this->start_controls_section(
            'section_style_form',
            array(
                'label' => __( 'Form Style', 'ttt-commentbox' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'form_text_color',
            array(
                'label'   => __( 'Text Color', 'ttt-commentbox' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => array(
                    '{{WRAPPER}} .ttt-comment-form' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'form_typography',
                'label'    => __( 'Form Typography', 'ttt-commentbox' ),
                'selector' => '{{WRAPPER}} .ttt-comment-form input, {{WRAPPER}} .ttt-comment-form textarea, {{WRAPPER}} .ttt-comment-form label',
            )
        );

        $this->add_responsive_control(
            'form_padding',
            array(
                'label'      => __( 'Field Padding', 'ttt-commentbox' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ttt-input, {{WRAPPER}} .ttt-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'form_border',
                'label'    => __( 'Field Border', 'ttt-commentbox' ),
                'selector' => '{{WRAPPER}} .ttt-input, {{WRAPPER}} .ttt-textarea',
            )
        );

        $this->add_control(
            'form_border_radius',
            array(
                'label'      => __( 'Border Radius', 'ttt-commentbox' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ttt-input, {{WRAPPER}} .ttt-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // ===== Section: Submit Button Style =====
        $this->start_controls_section(
            'section_style_submit',
            array(
                'label' => __( 'Submit Button', 'ttt-commentbox' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'submit_text_color',
            array(
                'label'   => __( 'Button Text Color', 'ttt-commentbox' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .ttt-submit-btn' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'submit_bg',
            array(
                'label'   => __( 'Button Background', 'ttt-commentbox' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#007bff',
                'selectors' => array(
                    '{{WRAPPER}} .ttt-submit-btn' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'submit_typography',
                'label'    => __( 'Button Typography', 'ttt-commentbox' ),
                'selector' => '{{WRAPPER}} .ttt-submit-btn',
            )
        );

        $this->add_responsive_control(
            'submit_padding',
            array(
                'label'      => __( 'Button Padding', 'ttt-commentbox' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ttt-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'submit_border',
                'label'    => __( 'Button Border', 'ttt-commentbox' ),
                'selector' => '{{WRAPPER}} .ttt-submit-btn',
            )
        );

        $this->add_control(
            'submit_border_radius',
            array(
                'label'      => __( 'Button Border Radius', 'ttt-commentbox' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ttt-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->start_controls_tabs( 'submit_tabs' );

        $this->start_controls_tab(
            'submit_tab_normal',
            array(
                'label' => __( 'Normal', 'ttt-commentbox' ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'submit_tab_hover',
            array(
                'label' => __( 'Hover', 'ttt-commentbox' ),
            )
        );

        $this->add_control(
            'submit_bg_hover',
            array(
                'label'   => __( 'Hover Background', 'ttt-commentbox' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#0056b3',
                'selectors' => array(
                    '{{WRAPPER}} .ttt-submit-btn:hover' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * @since 1.0.0
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Ensure we are on a singular page
        if ( ! is_singular() ) {
            echo '<div class="ttt-commentbox-notice">';
            echo esc_html__( 'TTT Comments Form widget only works on singular pages (posts, pages, custom post types).', 'ttt-commentbox' );
            echo '</div>';
            return;
        }

        $form_settings = array(
            'form_title_text'  => isset( $settings['form_title_text'] ) ? sanitize_text_field( $settings['form_title_text'] ) : __( 'Share your opinion', 'ttt-commentbox' ),
            'form_title_show'  => 'yes' === ( $settings['form_title_show'] ?? '' ),
            'form_title_color' => isset( $settings['form_title_color'] ) ? sanitize_hex_color( $settings['form_title_color'] ) : '#333333',
            'form_color'       => isset( $settings['form_text_color'] ) ? sanitize_hex_color( $settings['form_text_color'] ) : '#333333',
            'submit_color'     => isset( $settings['submit_text_color'] ) ? sanitize_hex_color( $settings['submit_text_color'] ) : '#ffffff',
            'submit_bg'        => isset( $settings['submit_bg'] ) ? sanitize_hex_color( $settings['submit_bg'] ) : '#007bff',
            'label_name'      => isset( $settings['label_name'] ) ? sanitize_text_field( $settings['label_name'] ) : __( 'Name', 'ttt-commentbox' ),
            'label_email'     => isset( $settings['label_email'] ) ? sanitize_text_field( $settings['label_email'] ) : __( 'Email', 'ttt-commentbox' ),
            'label_website'   => isset( $settings['label_website'] ) ? sanitize_text_field( $settings['label_website'] ) : __( 'Website', 'ttt-commentbox' ),
            'label_comment'   => isset( $settings['label_comment'] ) ? sanitize_text_field( $settings['label_comment'] ) : __( 'Comment', 'ttt-commentbox' ),
            'label_submit'   => isset( $settings['label_submit'] ) ? sanitize_text_field( $settings['label_submit'] ) : __( 'Submit A Comment', 'ttt-commentbox' ),
            'label_save_info' => isset( $settings['label_save_info'] ) ? sanitize_text_field( $settings['label_save_info'] ) : __( 'Save my name, email, and website in this browser for the next time I comment.', 'ttt-commentbox' ),
            'show_website'   => 'yes' === ( $settings['show_website'] ?? '' ),
            'widget_id'       => 'ttt-comments-el-form-' . $this->get_id(),
        );

        echo wp_kses_post( TTT_Comments_Core::render_form( $form_settings ) );
    }
}
