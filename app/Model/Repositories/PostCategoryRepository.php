<?php

declare(strict_types=1);

namespace App\Model\Repositories;

final class PostCategoryRepository extends BaseRepository
{

    public static function getTableName(): string
    {
        return 'product';
    }
}
