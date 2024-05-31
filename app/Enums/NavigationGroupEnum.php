<?php

namespace App\Enums;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum NavigationGroupEnum: string
{
    //TODO check usage -- different panels
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasSelectArrayOptions;

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
