<?php

namespace Selvah\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Selvah\Models\Material;
use Selvah\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Builder
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });

        // Pagination
        Paginator::defaultView('vendor.pagination.tailwind');

        if (App::environment() !== 'testing' && Schema::hasTable('settings')) {
            // Set the all Settings in the config array.
            $settings = Setting::all([
                'name',
                'value_int',
                'value_str',
                'value_bool',
            ])
            ->keyBy('name') // key every setting by its name
            ->transform(function ($setting) {
                return $setting->value; // return only the value
            })
            ->toArray();

            $array = [];
            // Convert the `dot` syntax to array.
            foreach ($settings as $setting => $value) {
                data_set($array, $setting, $value);
            }
            config(['settings' => $array]);
        }
    }
}
