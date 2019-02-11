<?php

namespace Modules\Departments\Repositories\Cache;

use Modules\Departments\Repositories\DepartmentsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDepartmentsDecorator extends BaseCacheDecorator implements DepartmentsRepository
{
    public function __construct(DepartmentsRepository $departments)
    {
        parent::__construct();
        $this->entityName = 'departments.departments';
        $this->repository = $departments;
    }
}
