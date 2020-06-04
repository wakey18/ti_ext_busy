<?php namespace Wakey\Busy\Models;

use Model;

class BusySettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    // A unique code
    public $settingsCode = 'wakey_busy_settings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'busysettings';
}
