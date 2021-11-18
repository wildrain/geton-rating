<?php

namespace Marlin\Admin;

use Marlin\Traits\Test;

/**
 * Handle settings
 */
class Settings
{
    use Test;

    /**
     * Setting page template handle
     *
     * @return void
     */
    public function settings_page()
    {
        $template = __DIR__ . '/views/settings.php';

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Report handler
     *
     * @return void
     */
    public function report_page()
    {
        $template = __DIR__ . '/views/report.php';

        if (file_exists($template)) {
            include $template;
        }
    }
}
