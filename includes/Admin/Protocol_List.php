<?php

namespace Sponsor\Portal\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Protocol_List extends \WP_List_Table {

	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'contact',
				'plural'   => 'contacts',
				'ajax'     => false,
			)
		);
	}

	public function get_columns() {
		return array(
			'cb'         => '<input type="checkbox">',
			'name'       => __( 'Name', 'sponsor' ),
			'address'    => __( 'Address', 'sponsor' ),
			'phone'      => __( 'Phone', 'sponsor' ),
			'created_at' => __( 'Date', 'sponsor' ),
		);

	}

	public function get_sortable_columns() {
		$sortable_columns = array(
			'name'       => array( 'name', true ),
			'created_at' => array( 'created_at', true ),
		);
		return $sortable_columns;
	}

	protected function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'value':
				break;

			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}

	public function column_name( $item ) {
		$actions           = array();
		$actions['edit']   = sprintf(
			'<a href="%s" title="%s">%s</a>',
			add_query_arg(
				array(
					'page'   => 'biodrop-portal',
					'action' => 'edit',
					'id'     => $item->id,
				),
				admin_url( 'admin.php' )
			),
			__( 'Edit', 'sponsor' ),
			__( 'Edit', 'sponsor' ),
		);
		$actions['delete'] = sprintf(
			'<a class="submitdelete" onclick="return confirm(\'Are you confirm?\');" href="%s" title="%s">%s</a>',
			wp_nonce_url(
				add_query_arg(
					array(
						'page'   => 'biodrop-portal',
						'action' => 'sp-po-delete-action',
						'id'     => $item->id,
					),
					admin_url( 'admin-post.php' )
				)
			),
			__( 'Delete', 'sponsor' ),
			__( 'Delete', 'sponsor' ),
		);

		return sprintf(
			'<a href="%1$s"><strong>%2$s</strong></a> %3$s',
			add_query_arg(
				array(
					'page'   => 'biodrop-portal',
					'action' => 'view',
					'id'     => $item->id,
				),
				admin_url( 'admin.php' )
			),
			$item->name,
			$this->row_actions( $actions )
		);

	}

	protected function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="protocol_id[]" value="$d">',
			$item->id
		);

	}


	public function prepare_items() {
		$column   = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$per_page = 20;

		$this->_column_headers = array( $column, $hidden, $sortable );
		$current_page          = $this->get_pagenum();
		$offset                = ( $current_page - 1 ) * $per_page;

		$args = array(
			'number' => $per_page,
			'offset' => $offset,
		);
		if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
			$args['orderby'] = $_REQUEST['orderby'];
			$args['order']   = $_REQUEST['order'];
		}

		$this->items = sp_po_get_protocols( $args );
		$this->set_pagination_args(
			array(
				'total_items' => sp_po_protocol_count(),
				'per_page'    => $per_page,
			)
		);
	}

}
