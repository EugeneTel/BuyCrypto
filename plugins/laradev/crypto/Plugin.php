<?php namespace Laradev\Crypto;

use Backend;
use System\Classes\PluginBase;

/**
 * Crypto Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Crypto',
            'description' => 'No description provided yet...',
            'author'      => 'Laradev',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('crypto.generateway', 'Laradev\Crypto\Console\GenerateWay');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Laradev\Crypto\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'laradev.crypto.some_permission' => [
                'tab' => 'Crypto',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'crypto' => [
                'label'       => 'Crypto',
                'url'         => Backend::url('laradev/crypto/currencycontroller'),
                'icon'        => 'icon-bitcoin',
                'permissions' => ['laradev.crypto.*'],
                'order'       => 500,
                'sideMenu' => [
                    'currency' => [
                        'label'       => 'Currency',
                        'url'         => Backend::url('laradev/crypto/currencycontroller'),
                        'icon'        => 'icon-bitcoin',
                        'permissions' => ['laradev.crypto.*'],
                        'order'       => 1,
                    ],
                    'provider' => [
                        'label'       => 'Provider',
                        'url'         => Backend::url('laradev/crypto/providercontroller'),
                        'icon'        => 'icon-cube',
                        'permissions' => ['laradev.crypto.*'],
                        'order'       => 2,
                    ],
                    'pair' => [
                        'label'       => 'Pair',
                        'url'         => Backend::url('laradev/crypto/paircontroller'),
                        'icon'        => 'icon-angellist',
                        'permissions' => ['laradev.crypto.*'],
                        'order'       => 3,
                    ],
                ]
            ],
        ];
    }
}
