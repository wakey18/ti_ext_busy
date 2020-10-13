<?php namespace Wakey\Busy;

use Admin\Models\Orders_model;
use Igniter\Flame\Exception\ApplicationException;
use Igniter\Local\Facades\Location;
use Illuminate\Support\Facades\Event;
use Wakey\Busy\Models\BusySettings;
use System\Classes\BaseExtension;


class Extension extends BaseExtension
{
    /**
     * Register method, called when the extension is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('igniter.checkout.beforeSaveOrder', function ($order, $data) {
            $busySetting = BusySettings::get('busy');
            $busyMessage = BusySettings::get('busy_message');
            if ($busySetting == 1)

                throw new ApplicationException($busyMessage);
		  });
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Busy?',
                'description' => 'If you need to suspend the checkout turn on this setting.',
                'icon' => 'fas fa-poo-storm',
                'model' => 'wakey\Busy\Models\BusySettings',
                'permissions' => ['Wakey.Busy.ManageSetting'],
            ],
        ];
    }

    /**
     * Registers any admin permissions used by this extension.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'Wakey.Busy.ManageSetting' => [
                'description' => 'A way to disable the checkout temporarily',
                'group' => 'module',
            ],
        ];
    }
}
