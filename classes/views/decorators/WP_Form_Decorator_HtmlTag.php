<?php

/**
 * Wrap a form component in an HTML tag
 */
class WP_Form_Decorator_HtmlTag extends WP_Form_Decorator {
	
	/**
	 * 
	 * 
	 * @param WP_Form_Component $element
	 * @return string
	 */
	public function render( WP_Form_Component $element ) {
				
		if($element->get_type()=='radio') {
			return $this->component_view->render($element);
		} else {
			$args = wp_parse_args(
				$this->args,
				array(
					'tag' => apply_filters('wp_form_htmltag_default','div'),
					'attributes' => array(),
				)
			);
			return $this->open_tag($args['tag'], $args['attributes'], $element->get_type()) . $this->component_view->render($element) . $this->close_tag($args['tag']);
		}
	}

	private function open_tag( $tag, $attributes = array(),$type ) {
		return sprintf("<%s %s %s>", $tag, WP_Form_View::prepare_attributes($attributes),$type);
	}

	private function close_tag( $tag ) {
		return "</$tag>";
	}
}
