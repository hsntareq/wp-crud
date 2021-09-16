<?php
namespace Sponsor\Portal\Traits;

trait Form_Error {

	/**
	 * has_error
	 *
	 * @param  mixed $key
	 * @return void
	 */
	public function has_error( $key ) {
		return isset( $this->errors[ $key ] ) ? true : false;
	}

	/**
	 * get_error
	 *
	 * @param  mixed $key
	 * @return void
	 */
	public function get_error( $key ) {
		return isset( $this->errors[ $key ] ) ? $this->errors[ $key ] : false;
	}
}

