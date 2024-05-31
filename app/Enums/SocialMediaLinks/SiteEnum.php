<?php

namespace App\Enums\SocialMediaLinks;

use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum SiteEnum: int implements HasLabel
{
    use HasDefaultFilamentLabels;
    case FACEBOOK = 1;
    case TWITTER = 2;
    case LINKEDIN = 3;
}
