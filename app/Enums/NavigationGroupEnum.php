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
	case ADMIN = 'Admin';
	case DASHBOARDS = 'Dashboards';
	case PERSONAL = 'Personal';
	case CRM = 'CRM';
	case CONSULTATION = 'Consultation';
	case TESTS = 'Tests';
	case FINANCE = 'Finance';
	case PRODUCTS = 'Products';
	case BLOG = 'Blog';
	case MARKETING = 'Marketing';
	case LOCATIONS = 'Locations';
	case ROLES_AND_PERMISSIONS = 'Roles and Permissions';

}
