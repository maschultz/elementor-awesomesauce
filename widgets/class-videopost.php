<?php
/**
 * Videopost class.
 *
 * @category   Class
 * @package    ElementorVideopost
 * @subpackage WordPress
 * @author     Michael Schultz <michael@apexrush.com>
 * @copyright  2022 Michael Schultz
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.apexrush.com/)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorVideopost\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Videopost widget class.
 *
 * @since 1.0.0
 */
class Videopost extends Widget_Base {
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'videopost', plugins_url( '/assets/css/videopost.css', ELEMENTOR_VIDEOPOST ), array(), '1.0.0' );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'videopost';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'videopost', 'Video Post Slider' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-pencil';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'videopost' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-videopost' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementor-videopost' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Title', 'elementor-videopost' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'elementor-videopost' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Description', 'elementor-videopost' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'elementor-videopost' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'elementor-videopost' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses( $settings['title'], array() ); ?></h2>
		<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo wp_kses( $settings['description'], array() ); ?></div>
		<div <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo wp_kses( $settings['content'], array() ); ?></div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		view.addInlineEditingAttributes( 'description', 'basic' );
		view.addInlineEditingAttributes( 'content', 'advanced' );
		#>
		<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		<div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
		<?php
	}
}
