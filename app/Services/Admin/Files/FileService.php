<?php

namespace App\Services\Admin\Files;

use App\Interfaces\Repositories\FileRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class FileService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'file';
    const ENTITY_PLURAL = 'media';
    const ROUTE = 'admin.media';

    public function __construct(FileRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
