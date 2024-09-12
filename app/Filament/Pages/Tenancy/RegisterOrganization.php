<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Organization;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterOrganization extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register new restaurant';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                TextInput::make('ein')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    protected function handleRegistration(array $data): Organization
    {
        $organization = Organization::query()->create($data);
        $organization->members()->attach(auth()->user());

        return $organization;
    }
}
