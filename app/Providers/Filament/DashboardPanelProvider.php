<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use App\Filament\Pages\Auth\LoginCustom;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Pages\Auth\RegisterCustom;
use App\Filament\Widgets\AccountWidget;
use App\Filament\Widgets\DashboardStatsAdmin;
use App\Filament\Widgets\DashboardStatsUser;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;


class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login(LoginCustom::class)
            ->registration(RegisterCustom::class)
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->colors([
                'primary' => Color::hex('#00923F'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                AccountWidget::class,
                DashboardStatsUser::class,
                DashboardStatsAdmin::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->slug('profile')
                    ->setTitle('Profile')
                    ->setNavigationLabel('Profile')
                    ->setIcon('heroicon-o-user-circle')
                    ->setSort(10)
                    // ->canAccess(fn () => Auth::user()->id === 1)
                    ->shouldRegisterNavigation(true)
                    ->shouldShowEmailForm(true)
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowSanctumTokens(false)
                    ->shouldShowBrowserSessionsForm(true)
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'profile-photos', // image will be stored in 'storage/app/public/avatars
                        rules: 'mimes:jpeg,png|max:1024'
                    )
                    ->shouldShowEditProfileForm(false)
                    ->customProfileComponents([
                        \App\Livewire\CustomEditProfileInformationComponent::class,
                    ])

            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    // ->label(fn() => auth()->user()->name)
                    ->label(fn() => Auth::user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ]);
    }
}
