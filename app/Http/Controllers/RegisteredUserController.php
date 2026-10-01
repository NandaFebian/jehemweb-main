<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Services\AuthService;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Filament::auth()->check()) {
            return redirect()->to(Filament::getUrl());
        }

        return view('pages.register');
    }

    public function store(UserRegistrationRequest $request, AuthService $service): RedirectResponse
    {
        $service->register($request->validated());

        return redirect()->route('register')->with('registered', true);
    }
}
