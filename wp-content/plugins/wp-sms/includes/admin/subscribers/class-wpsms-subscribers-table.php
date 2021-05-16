<?php

namespace WP_SMS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Subscribers_List_Table extends \WP_List_Table {

	protected $db;
	protected $tb_prefix;
	protected $limit;
	protected $count;
	var $data;

	function __construct() {
		global $wpdb;

		//Set parent defaults
		parent::__construct( array(
			'singular' => 'ID',     //singular name of the listed records
			'plural'   => 'ID',    //plural name of the listed records
			'ajax'     => false        //does this table support ajax?
		) );

		$this->db        = $wpdb;
		$this->tb_prefix = $wpdb->prefix;
		$this->count     = $this->get_total();
		$this->limit     = 50;
		$this->data      = $this->get_data();
	}

	function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'name':
			case 'mobile':
				return $item[ $column_name ];

			case 'group_ID':
				$group = Newsletter::getGroup( $item[ $column_name ] );
				if ( $group ) {
					return $group->name;
				} else {
					return '-';
				}

			case 'date':
				return sprintf( __( '%s <span class="wpsms-time">Time: %s</span>', 'wp-sms' ), date_i18n( 'Y-m-d', strtotime( $item[ $column_name ] ) ), date_i18n( 'H:i:s', strtotime( $item[ $column_name ] ) ) );

			case 'status':
				return ( $item[ $column_name ] == '1' ? '<span class="dashicons dashicons-yes wpsms-color-green"></span>' : '<span class="dashicons dashicons-no-alt wpsms-color-red"></span>' );

			case 'activate_key':
				return '<code>' . $item[ $column_name ] . '</code>';

			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	function column_name( $item ) {

		//Build row actions
		$actions = array(
			'edit'   => sprintf( '<a href="#" onclick="wp_sms_edit_subscriber(%s)">' . __( 'Edit', 'wp-sms' ) . '</a>', $item['ID'] ),
			'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s">' . __( 'Delete', 'wp-sms' ) . '</a>', $_REQUEST['page'], 'delete', $item['ID'] ),
		);

		//Return the title contents
		return sprintf( '%1$s %3$s',
			/*$1%s*/
			$item['name'],
			/*$2%s*/
			$item['ID'],
			/*$2%s*/
			$this->row_actions( $actions )
		);
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			/*$1%s*/
			$this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
			/*$2%s*/
			$item['ID']                //The value of the checkbox should be the record's id
		);
	}

	function get_columns() {
		$columns = array(
			'cb'           => '<input type="checkbox" />', //Render a checkbox instead of text
			'name'         => __( 'Name', 'wp-sms' ),
			'mobile'       => __( 'Mobile', 'wp-sms' ),
			'group_ID'     => __( 'Group', 'wp-sms' ),
			'date'         => __( 'Date', 'wp-sms' ),
			'status'       => __( 'Status', 'wp-sms' ),
			'activate_key' => __( 'Activate code', 'wp-sms' ),
		);

		return $columns;
	}

	function get_sortable_columns() {
		$sortable_columns = array(
			'ID'           => array( 'ID', true ),     //true means it's already sorted
			'name'         => array( 'name', false ),     //true means it's already sorted
			'mobile'       => array( 'mobile', false ),     //true means it's already sorted
			'group_ID'     => array( 'group_ID', false ),     //true means it's already sorted
			'date'         => array( 'date', false ),   //true means it's already sorted
			'status'       => array( 'status', false ), //true means it's already sorted
			'activate_key' => array( 'activate_key', false )    //true means it's already sorted
		);

		return $sortable_columns;
	}

	function get_bulk_actions() {
		$actions = array(
			'bulk_delete' => __( 'Delete', 'wp-sms' )
		);

		return $actions;
	}

	function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		// Search action
		if ( isset( $_GET['s'] ) ) {
			$prepare     = $this->db->prepare( "SELECT * from `{$this->tb_prefix}sms_subscribes` WHERE name LIKE %s OR mobile LIKE %s", '%' . $this->db->esc_like( $_GET['s'] ) . '%', '%' . $this->db->esc_like( $_GET['s'] ) . '%' );
			$this->data  = $this->get_data( $prepare );
			$this->count = $this->get_total( $prepare );
		}

		// Bulk delete action
		if ( 'bulk_delete' == $this->current_action() ) {
			foreach ( $_GET['id'] as $id ) {
				$this->db->delete( $this->tb_prefix . "sms_subscribes", array( 'ID' => $id ) );
			}
			$this->data  = $this->get_data();
			$this->count = $this->get_total();
			echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Items removed.', 'wp-sms' ) . '</p></div>';
		}

		// Single delete action
		if ( 'delete' == $this->current_action() ) {
			$this->db->delete( $this->tb_prefix . "sms_subscribes", array( 'ID' => $_GET['ID'] ) );
			$this->data  = $this->get_data();
			$this->count = $this->get_total();
			echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Item removed.', 'wp-sms' ) . '</p></div>';
		}
	}

	function prepare_items() {
		/**
		 * First, lets decide how many records per page to show
		 */
		$per_page = $this->limit;

		/**
		 * REQUIRED. Now we need to define our column headers. This includes a complete
		 * array of columns to be displayed (slugs & titles), a list of columns
		 * to keep hidden, and a list of columns that are sortable. Each of these
		 * can be defined in another method (as we've done here) before being
		 * used to build the value for our _column_headers property.
		 */
		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();

		/**
		 * REQUIRED. Finally, we build an array to be used by the class for column
		 * headers. The $this->_column_headers property takes an array which contains
		 * 3 other arrays. One for all columns, one for hidden columns, and one
		 * for sortable columns.
		 */
		$this->_column_headers = array( $columns, $hidden, $sortable );

		/**
		 * Optional. You can handle your bulk actions however you see fit. In this
		 * case, we'll handle them within our package just to keep things clean.
		 */
		$this->process_bulk_action();

		/**
		 * Instead of querying a database, we're going to fetch the example data
		 * property we created for use in this plugin. This makes this example
		 * package slightly different than one you might build on your own. In
		 * this example, we'll be using array manipulation to sort and paginate
		 * our data. In a real-world implementation, you will probably want to
		 * use sort and pagination data to build a custom query instead, as you'll
		 * be able to use your precisely-queried data immediately.
		 */
		$data = $this->data;

		/**
		 * This checks for sorting input and sorts the data in our array accordingly.
		 *
		 * In a real-world situation involving a database, you would probably want
		 * to handle sorting by passing the 'orderby' and 'order' values directly
		 * to a custom query. The returned data will be pre-sorted, and this array
		 * sorting technique would be unnecessary.
		 */

		usort( $data, '\WP_SMS\Subscribers_List_Table::usort_reorder' );

		/**
		 * REQUIRED for pagination. Let's check how many items are in our data array.
		 * In real-world use, this would be the total number of items in your database,
		 * without filtering. We'll need this later, so you should always include it
		 * in your own package classes.
		 */
		$total_items = $this->count;

		/**
		 * REQUIRED. Now we can add our *sorted* data to the items property, where
		 * it can be used by the rest of the class.
		 */
		$this->items = $data;

		/**
		 * REQUIRED. We also have to register our pagination options & calculations.
		 */
		$this->set_pagination_args( array(
			'total_items' => $total_items,                  //WE have to calculate the total number of items
			'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
			'total_pages' => ceil( $total_items / $per_page )   //WE have to calculate the total number of pages
		) );
	}

	/**
	 * Usort Function
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return array
	 */
	function usort_reorder( $a, $b ) {
		$orderby = ( ! empty( $_REQUEST['orderby'] ) ) ? $_REQUEST['orderby'] : 'date'; //If no sort, default to sender
		$order   = ( ! empty( $_REQUEST['order'] ) ) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
		$result  = strcmp( $a[ $orderby ], $b[ $orderby ] ); //Determine sort order

		return ( $order === 'asc' ) ? $result : - $result; //Send final sort direction to usort
	}

	//set $per_page item as int number
	function get_data( $query = '' ) {
		$page_number = ( $this->get_pagenum() - 1 ) * $this->limit;
		if ( ! $query ) {
			$query = 'SELECT * FROM `' . $this->tb_prefix . 'sms_subscribes` LIMIT ' . $this->limit . ' OFFSET ' . $page_number;
		} else {
			$query .= ' LIMIT ' . $this->limit . ' OFFSET ' . $page_number;
		}
		$result = $this->db->get_results( $query, ARRAY_A );

		return $result;
	}

	//get total items on different Queries
	function get_total( $query = '' ) {
		if ( ! $query ) {
			$query = 'SELECT * FROM `' . $this->tb_prefix . 'sms_subscribes`';
		}
		$result = $this->db->get_results( $query, ARRAY_A );
		$result = count( $result );

		return $result;
	}

}