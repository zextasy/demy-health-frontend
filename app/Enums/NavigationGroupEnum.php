<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum NavigationGroupEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case NONE = '';
	case ADMIN = 'ADMIN';
	case DASHBOARDS = 'DASHBOARDS';
	case PERSONAL = 'PERSONAL';
	case CRM = 'CRM';
	case CONSULTATION = 'CONSULTATION';
	case TESTS = 'TESTS';
	case FINANCE = 'FINANCE';
	case PRODUCTS = 'PRODUCTS';
	case BLOG = 'BLOG';
	case MARKETING = 'MARKETING';
	case LOCATIONS = 'LOCATIONS';
	case ROLES_AND_PERMISSIONS = 'ROLES AND PERMISSIONS';

}
