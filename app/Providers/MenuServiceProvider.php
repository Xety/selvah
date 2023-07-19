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
                    Link::toRoute('maintenances.index', '<i class="fa-solid fa-screwdriver-wrench"></i> Gérer les Maintenances')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->add(
                    Menu::new()
                        ->add(
                            Link::toRoute('companies.index', '<i class="fa-solid fa-briefcase"></i> Gérer les Entreprises')
                        )
                        ->setActiveFromRequest()
                        ->setActiveClassOnLink()
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('part', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('parts.index', '<i class="fa-solid fa-gear"></i> Gérer les Pièces Détachées')
                )
                ->add(
                    Menu::new()
                        ->add(
                            Link::toRoute('part-entries.index', '<i class="fa-solid fa-arrow-right-to-bracket"></i> Gérer les Entrées')
                        )
                        ->add(
                            Link::toRoute('part-exits.index', '<i class="fa-solid fa-right-from-bracket"></i> Gérer les Sorties')
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
                    Link::toRoute('lots.index', '<i class="fa-solid fa-seedling"></i> Gérer les Lots')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('material', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('materials.index', '<i class="fa-solid fa-microchip"></i> Gérer les Matériels')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('zone', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('zones.index', '<i class="fa-solid fa-coins"></i> Gérer les Zones')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('incident', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('incidents.index', '<i class="fa-solid fa-triangle-exclamation"></i> Gérer les Incidents')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('user', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('users.index', '<i class="fa-solid fa-users"></i> Gérer les Utilisateurs')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });

        Menu::macro('role', function () {
            return Menu::new()
                ->addClass('menu')
                ->add(
                    Link::toRoute('roles.roles.index', '<i class="fa-solid fa-user-tie"></i> Gérer les Rôles')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->add(
                    Link::toRoute(
                        'roles.permissions.index',
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
                    Link::toRoute('settings.index', '<i class="fa-solid fa-wrench"></i> Gérer les Paramètres')
                        ->addClass('rounded-[var(--rounded-btn)]')
                )
                ->setActiveFromRequest()
                ->setActiveClassOnLink();
        });
    }
}
