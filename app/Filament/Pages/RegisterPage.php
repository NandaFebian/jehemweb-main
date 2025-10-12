<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\SimplePage;

class RegisterPage extends SimplePage
{
    protected static string $layout = 'jehem-meadolan.register.register';

    protected static string $view = 'jehem-meadolan.register.register';

    // protected static ?string $slug = 'register';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }
    }

    public static function getView(): string
    {
        return self::$view;
    }
}
