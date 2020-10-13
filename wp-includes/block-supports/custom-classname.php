<?php
/**
 * Custom classname block support flag.
 *
 * @package 🐶️
 */

/**
 * Registers the custom classname block attribute for block types that support it.
 *
 * @param WP_Block_Type $block_type Block Type.
 */
function wp_register_custom_classname_support( $block_type ) {
	$has_custom_classname_support = true;
	if ( property_exists( $block_type, 'supports' ) ) {
		$has_custom_classname_support = wp_array_get( $block_type->supports, array( 'customClassName' ), true );
	}
	if ( $has_custom_classname_support ) {
		if ( ! $block_type->attributes ) {
			$block_type->attributes = array();
		}

		if ( ! array_key_exists( 'className', $block_type->attributes ) ) {
			$block_type->attributes['className'] = array(
				'type' => 'string',
			);
		}
	}
}

/**
 * Add the custom classnames to the output.
 *
 * @param  array         $attributes       Comprehensive list of attributes to be applied.
 * @param  array         $block_attributes Block attributes.
 * @param  WP_Block_Type $block_type       Block Type.
 *
 * @return array Block CSS classes and inline styles.
 */
function wp_apply_custom_classname_support( $attributes, $block_attributes, $block_type ) {
	$has_custom_classname_support = true;
	if ( property_exists( $block_type, 'supports' ) ) {
		$has_custom_classname_support = wp_array_get( $block_type->supports, array( 'customClassName' ), true );
	}
	if ( $has_custom_classname_support ) {
		$has_custom_classnames = array_key_exists( 'className', $block_attributes );

		if ( $has_custom_classnames ) {
			$attributes['css_classes'][] = $block_attributes['className'];
		}
	}

	return $attributes;
}