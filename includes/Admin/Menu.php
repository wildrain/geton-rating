<?php

namespace Marlin\Admin;

/**
 * Admin menu class
 */
class Menu
{
    /**
     * Initialize menu
     */
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Handle plugin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'marlin-dashboard';
        $capability = 'manage_options';

        add_menu_page(__('Marlin Dashboard', 'marlin'), __('Marlin', 'marlin'), $capability, $parent_slug, [$this, 'dashboard_page'], 'dashicons-buddicons-groups');
        add_submenu_page($parent_slug, __('Settings', 'marlin'), __('Settings', 'marlin'), $capability, $parent_slug, [$this, 'dashboard_page']);
        add_submenu_page($parent_slug, __('Report', 'marlin'), __('Report', 'marlin'), $capability, 'marlin-report', [$this, 'report_page']);
    }

    /**
     * Handle menu page
     *
     * @return void
     */
    public function dashboard_page()
    {
        $settings = new Settings();
        $settings->settings_page();
    }

    /**
     * Marlin report page
     *
     * @return void
     */
    public function report_page()
    {
        $settings = new Settings();
        $settings->report_page();
    }
}
