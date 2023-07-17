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
                    Link::toRoute('dashboard.index', '<i class="fa-solid fa-gauge"></i> Tableau de bord')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('maintenance', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('maintenance.index', '<i class="fa-solid fa-screwdriver-wrench"></i> Gérer les Maintenances')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('part', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('part.index', '<i class="fa-solid fa-gear"></i> Gérer les Pièces Détachées')
                )
                ->add(
                    Menu::new()
                        ->add(
                            Link::toRoute('part-entry.index', '<i class="fa-solid fa-arrow-right-to-bracket"></i> Gérer les Entrées')
                        )
                        ->add(
                            Link::toRoute('part-exit.index', '<i class="fa-solid fa-right-from-bracket"></i> Gérer les Sorties')
                        )
                        ->setActiveFromRequest()
                        ->setActiveClassOnLink()
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('lot', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('lot.index', '<i class="fa-solid fa-seedling"></i> Gérer les Lots')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('material', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('material.index', '<i class="fa-solid fa-microchip"></i> Gérer les Matériels')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('zone', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('zone.index', '<i class="fa-solid fa-coins"></i> Gérer les Zones')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('incident', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('incident.index', '<i class="fa-solid fa-triangle-exclamation"></i> Gérer les Incidents')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('user', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('user.index', '<i class="fa-solid fa-users"></i> Gérer les Utilisateurs')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('role', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('role.role.index', '<i class="fa-solid fa-user-tie"></i> Gérer les Rôles')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->add(
                    Link::toRoute(
                        'role.permission.index',
                        '<i class="fa-solid fa-user-shield"></i> Gérer les Permissions'
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
                    Link::toRoute('setting.index', '<i class="fa-solid fa-wrench"></i> Gérer les Paramètres')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });
    }
}
