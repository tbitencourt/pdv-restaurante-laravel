<?php

namespace App\Enums;

enum OrganizationStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function options(): array
    {
        return [
            self::DRAFT->value => __('enums.draft'),
            self::ACTIVE->value => __('enums.active'),
            self::INACTIVE->value => __('enums.inactive'),
        ];
    }

    public function getText(): string
    {
        return self::options()[$this->value];
    }
}
