<?php
	
// This class for designing form elemants.
// Design by "Niroshan"
// Website : [https://uxpython.com]


class Form{

	// FORM UI FUNCTIONS

	/*
	* Create Hidden Input Field.
	*/
	public static function form_hidden($name, $value = ''){

		static $form;
		$form .= '<input type="hidden" name="'.$name.'" value="'.self::html_escape($value)."\" />\n";

		return $form;

	} // form_hidden()

	// ------------------------------------------------------------------------

	/*
	* Create Text Input Field.
	*/

	public static function form_input($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'text',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra)." />\n";

	} // form_input()

	// ------------------------------------------------------------------------

	/**
	 * Create Password Field
	 */
	public static function form_password($data = '', $value = '', $extra = '')
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'password';
		return self::form_input($data, $value, $extra);

	} // form_password()

	// ------------------------------------------------------------------------

	/**
	 * Create Upload Field
	 */
	public static function form_upload($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'file', 'name' => '');
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'file';

		return '<input '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra)." />\n";

	} // form_upload()

	// ------------------------------------------------------------------------

	/**
	 * Create Textarea field
	 */
	public static function form_textarea($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
			'cols' => '40',
			'rows' => '10'
		);

		if ( ! is_array($data) OR ! isset($data['value']))
		{
			$val = $value;
		}
		else
		{
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		return '<textarea '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra).'>'
			.self::html_escape($val)
			."</textarea>\n";

	} // form_textarea()

	// ------------------------------------------------------------------------


	/**
	 * Create Multi-select menu
	 */
	public static function form_multiselect($name = '', $options = array(), $selected = array(), $extra = '')
	{
		$extra = self::_attributes_to_string($extra);
		if (stripos($extra, 'multiple') === FALSE)
		{
			$extra .= ' multiple="multiple"';
		}

		return self::form_dropdown($name, $options, $selected, $extra);

	} // form_multiselect()

	// ------------------------------------------------------------------------

	/**
	 * Create Drop-down Menu
	 */
	public static function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
	{
		$defaults = array();

		if (is_array($data))
		{
			if (isset($data['selected']))
			{
				$selected = $data['selected'];
				unset($data['selected']); // select tags don't have a selected attribute
			}

			if (isset($data['options']))
			{
				$options = $data['options'];
				unset($data['options']); // select tags don't use an options attribute
			}
		}
		else
		{
			$defaults = array('name' => $data);
		}

		is_array($selected) OR $selected = array($selected);
		is_array($options) OR $options = array($options);

		// If no selected state was submitted we will attempt to set it automatically
		if (empty($selected))
		{
			if (is_array($data))
			{
				if (isset($data['name'], $_POST[$data['name']]))
				{
					$selected = array($_POST[$data['name']]);
				}
			}
			elseif (isset($_POST[$data]))
			{
				$selected = array($_POST[$data]);
			}
		}

		$extra = self::_attributes_to_string($extra);

		$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select '.rtrim(self::_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.self::html_escape($optgroup_key).'"'.$sel.'>'
						.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.self::html_escape($key).'"'
					.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
					.(string) $val."</option>\n";
			}
		}

		return $form."</select>\n";

	} // form_dropdown()

	// ------------------------------------------------------------------------

	/**
	 * Design Checkbox Field
	 */
	public static function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		$defaults = array('type' => 'checkbox', 'name' => ( ! is_array($data) ? $data : ''), 'value' => $value);

		if (is_array($data) && array_key_exists('checked', $data))
		{
			$checked = $data['checked'];

			if ($checked == FALSE)
			{
				unset($data['checked']);
			}
			else
			{
				$data['checked'] = 'checked';
			}
		}

		if ($checked == TRUE)
		{
			$defaults['checked'] = 'checked';
		}
		else
		{
			unset($defaults['checked']);
		}

		return '<input '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra)." />\n";

	} // form_checkbox()

	// ------------------------------------------------------------------------

	/**
	 * Design Radio Button
	 */
	public static function form_radio($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		is_array($data) OR $data = array('name' => $data);
		$data['type'] = 'radio';

		return self::form_checkbox($data, $value, $checked, $extra);

	} // form_radio()

	// ------------------------------------------------------------------------

	/**
	 * Design Submit Button
	 */
	public static function form_submit($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'submit',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra)." />\n";

	} // form_submit()

	// ------------------------------------------------------------------------

	/**
	 * Design Reset Button
	 */
	public static function form_reset($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'reset',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra)." />\n";

	} // form_reset()

	// ------------------------------------------------------------------------

	/**
	 * Design Form Button
	 */
	public static function form_button($data = '', $content = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
			'type' => 'button'
		);

		if (is_array($data) && isset($data['content']))
		{
			$content = $data['content'];
			unset($data['content']); // content is not an attribute
		}

		return '<button '.self::_parse_form_attributes($data, $defaults).self::_attributes_to_string($extra).'>'
			.$content
			."</button>\n";

	} // form_button()

	// ------------------------------------------------------------------------


	/**
	 * Design Form Label Tag
	 */
	public static function form_label($label_text = '', $id = '', $attributes = array())
	{

		$label = '<label';

		if ($id !== '')
		{
			$label .= ' id="label_'.$id.'" for="'.$id.'"';
		}

		$label .= self::_attributes_to_string($attributes);

		return $label.'>'.$label_text.'</label>';

	} // form_label()

	// ------------------------------------------------------------------------


	// HELPER FUNCTIONS

	/**
	 * Attributes To String
	 *
	 * Helper function
	 *
	 */
	private static function _attributes_to_string($attributes)
	{
		if (empty($attributes))
		{
			return '';
		}

		if (is_object($attributes))
		{
			$attributes = (array) $attributes;
		}

		if (is_array($attributes))
		{
			$atts = '';

			foreach ($attributes as $key => $val)
			{
				$atts .= ' '.$key.'="'.$val.'"';
			}

			return $atts;
		}

		if (is_string($attributes))
		{
			return ' '.$attributes;
		}

		return FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Parse the form attributes
	 *
	 * Helper function
	 */
	private static function _parse_form_attributes($attributes, $default)
	{
		if (is_array($attributes))
		{
			foreach ($default as $key => $val)
			{
				if (isset($attributes[$key]))
				{
					$default[$key] = $attributes[$key];
					unset($attributes[$key]);
				}
			}

			if (count($attributes) > 0)
			{
				$default = array_merge($default, $attributes);
			}
		}

		$att = '';

		foreach ($default as $key => $val)
		{
			if ($key === 'value')
			{
				$val = self::html_escape($val);
			}
			elseif ($key === 'name' && ! strlen($default['name']))
			{
				continue;
			}

			$att .= $key.'="'.$val.'" ';
		}

		return $att;
	}


	// ------------------------------------------------------------------------

	// Escape function will ensure that all data coming from our Database tables are in UTF-8 format.
	private static function html_escape($string){
	  return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}


}



