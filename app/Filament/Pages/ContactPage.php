<?php

namespace App\Filament\Pages;

use Filament\Pages\SimplePage;

class ContactPage extends SimplePage
{
    protected static string $layout = 'jehem-meadolan.kontak.kontak';

    protected static string $view = 'jehem-meadolan.kontak.kontak';

    public function mount(): void
    {
    }

    protected function getData(): array
    {
        $user = auth()->user() === null ? null : auth()->user()->toArray();

        return [

            'user' => $user,
        ];
    }

    public static function getView(): string
    {
        return self::$view;
    }

    protected function getViewData(): array
    {
        return $this->getData();
    }

    protected function getLayoutData(): array
    {
        return $this->getData();
    }
}
