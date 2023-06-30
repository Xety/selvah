<?php

namespace Selvah\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Link;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Dashboard
        Menu::macro('dashboard', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('dashboard.index', '<i class="fa-solid fa-gauge"></i> Dashboard')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest('/admin')
                ->setActiveClassOnLink();
        });

        Menu::macro('user', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('user.user.index', '<i class="fa-solid fa-users"></i> Manage Users')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('role', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('role.role.index', '<i class="fa-solid fa-user-tie"></i> Manage Roles')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->add(
                    Link::toRoute(
                        'role.permission.index',
                        '<i class="fa-solid fa-user-shield"></i> Manage Permissions'
                    )
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('setting', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('setting.index', '<i class="fa-solid fa-wrench"></i> Manage Settings')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });
    }
}
