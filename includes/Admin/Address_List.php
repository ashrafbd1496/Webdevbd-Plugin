<?php
namespace Ashraf\Webdevbd\Admin;

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
/**
 * List table class
 */
class Address_List extends \WP_List_Table
{
    public function __construct()
    {
        parent::__construct([
            'singular' => 'contact',
            'plural' => 'contacts',
            'ajax' => false,
        ]);
    }

/**
 * to define the columns
 *
 * @return void
 */
    public function get_columns()
    {
        return [
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'webdevbd'),
            'address' => __('Address', 'webdevbd'),
            'phone' => __('phone', 'webdevbd'),
            'created_at' => __('Date', 'webdevbd'),
        ];
    }

    /**
     * get sortable column
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        $sortable_columns = [
            'name' => ['name', true],
            'created_at' => ['created_at', true],
        ];
        return $sortable_columns;
    }

    /**
     * Set the bulk action
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = [
            'trash' => __('Move to trash', 'webdevbd'),
        ];
        return $actions;
    }

    /**
     * to render the default output for a column
     *
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    protected function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'name':
            case 'address':
            case 'phone':
                return $item->$column_name;
            default:
                return isset($item->$column_name) ? $item->$column_name : '';
        }
    }

    /**
     * Render the "name" column
     *
     * @param [object] $item
     * @return string
     */
    public function column_name($item)
    {
        $actions = [];

        $actions['edit'] = sprintf('<a href="%s" title="%s">%s</a>', admin_url('admin.php?page=webdevbd-options&action=edit&id=' . $item->id), $item->id, __('Edit', 'webdevbd'), __('Edit', 'webdevbd'));

        $actions['delete'] = sprintf('<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url(admin_url('admin-post.php?action=webdevbd-delete-address&id=' . $item->id), 'webdevbd-delete-address'), $item->id, __('Delete', 'webdevbd'), __('Delete', 'webdevbd'));

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url('admin.php?page=webdevbd-options&action=view&id' . $item->id), $item->name, $this->row_actions($actions)
        );
    }

    protected function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name ="address_id[]" value="%d"/>', $item->id
        );
    }

    /**
     * for retrieving data, handling pagination, and defining the column headers.
     *
     * @return void
     */

    public function prepare_items()
    {
        $column = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $per_page = 20;

        $this->_column_headers = [$column, $hidden, $sortable];

        $per_page = 2;
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if (isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order'] = $_REQUEST['order'];
        }

        $this->items = webdevbd_get_addresses($args);

        $this->set_pagination_args([
            'total_items' => webdevbd_address_count(),
            'per_page' => $per_page,

        ]);

    }
}
