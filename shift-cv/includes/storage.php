<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'shift_cv_storage_get' ) ) {
	function shift_cv_storage_get( $var_name, $default = '' ) {
		global $SHIFT_CV_STORAGE;
		return isset( $SHIFT_CV_STORAGE[ $var_name ] ) ? $SHIFT_CV_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'shift_cv_storage_set' ) ) {
	function shift_cv_storage_set( $var_name, $value ) {
		global $SHIFT_CV_STORAGE;
		$SHIFT_CV_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'shift_cv_storage_empty' ) ) {
	function shift_cv_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $SHIFT_CV_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $SHIFT_CV_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $SHIFT_CV_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $SHIFT_CV_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'shift_cv_storage_isset' ) ) {
	function shift_cv_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $SHIFT_CV_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $SHIFT_CV_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'shift_cv_storage_inc' ) ) {
	function shift_cv_storage_inc( $var_name, $value = 1 ) {
		global $SHIFT_CV_STORAGE;
		if ( empty( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = 0;
		}
		$SHIFT_CV_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'shift_cv_storage_concat' ) ) {
	function shift_cv_storage_concat( $var_name, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( empty( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = '';
		}
		$SHIFT_CV_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'shift_cv_storage_get_array' ) ) {
	function shift_cv_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $SHIFT_CV_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) ? $SHIFT_CV_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $SHIFT_CV_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'shift_cv_storage_set_array' ) ) {
	function shift_cv_storage_set_array( $var_name, $key, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$SHIFT_CV_STORAGE[ $var_name ][] = $value;
		} else {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'shift_cv_storage_set_array2' ) ) {
	function shift_cv_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'shift_cv_storage_merge_array' ) ) {
	function shift_cv_storage_merge_array( $var_name, $key, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array_merge( $SHIFT_CV_STORAGE[ $var_name ], $value );
		} else {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ] = array_merge( $SHIFT_CV_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'shift_cv_storage_set_array_after' ) ) {
	function shift_cv_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			shift_cv_array_insert_after( $SHIFT_CV_STORAGE[ $var_name ], $after, $key );
		} else {
			shift_cv_array_insert_after( $SHIFT_CV_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'shift_cv_storage_set_array_before' ) ) {
	function shift_cv_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			shift_cv_array_insert_before( $SHIFT_CV_STORAGE[ $var_name ], $before, $key );
		} else {
			shift_cv_array_insert_before( $SHIFT_CV_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'shift_cv_storage_push_array' ) ) {
	function shift_cv_storage_push_array( $var_name, $key, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $SHIFT_CV_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) ) {
				$SHIFT_CV_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $SHIFT_CV_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'shift_cv_storage_pop_array' ) ) {
	function shift_cv_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $SHIFT_CV_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $SHIFT_CV_STORAGE[ $var_name ] ) && is_array( $SHIFT_CV_STORAGE[ $var_name ] ) && count( $SHIFT_CV_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $SHIFT_CV_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) && is_array( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) && count( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $SHIFT_CV_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'shift_cv_storage_inc_array' ) ) {
	function shift_cv_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( empty( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ] = 0;
		}
		$SHIFT_CV_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'shift_cv_storage_concat_array' ) ) {
	function shift_cv_storage_concat_array( $var_name, $key, $value ) {
		global $SHIFT_CV_STORAGE;
		if ( ! isset( $SHIFT_CV_STORAGE[ $var_name ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ] = array();
		}
		if ( empty( $SHIFT_CV_STORAGE[ $var_name ][ $key ] ) ) {
			$SHIFT_CV_STORAGE[ $var_name ][ $key ] = '';
		}
		$SHIFT_CV_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'shift_cv_storage_call_obj_method' ) ) {
	function shift_cv_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $SHIFT_CV_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $SHIFT_CV_STORAGE[ $var_name ] ) ? $SHIFT_CV_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $SHIFT_CV_STORAGE[ $var_name ] ) ? $SHIFT_CV_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'shift_cv_storage_get_obj_property' ) ) {
	function shift_cv_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $SHIFT_CV_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $SHIFT_CV_STORAGE[ $var_name ]->$prop ) ? $SHIFT_CV_STORAGE[ $var_name ]->$prop : $default;
	}
}
