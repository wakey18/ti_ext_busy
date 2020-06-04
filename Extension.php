<?php namespace Wakey\Busy;

use Admin\Models\Orders_model;
use Igniter\Flame\Exception\ApplicationException;
use Igniter\Local\Facades\Location;
use Illuminate\Support\Facades\Event;
use wakey\Busy\Models\BusySettings;
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
            
            if ($busySetting == 1)
                throw new ApplicationException('We are currently experiencing a high volume of orders and have decided to temporarily disable the checkout. Please check back soon.');
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
                'permissions' => ['wakey.Busy.ManageSetting'],
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
            'wakey.Busy.ManageSetting' => [
                'description' => 'A way to disable the checkout temporarily',
//                'group' => 'module',
            ],
        ];
    }
}
