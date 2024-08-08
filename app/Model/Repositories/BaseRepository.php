<?php
declare(strict_types=1);


namespace App\Model\Repositories;

use mysql_xdevapi\Exception;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\SmartObject;

abstract class BaseRepository
{
    use SmartObject;


    public function __construct(
        protected Explorer $explorer,
    ) { }

    public static abstract function getTableName(): string;

    public function findAll(): Selection
    {
        return $this->explorer
            ->table(static::getTableName());
    }

    public function insert(array $data): ActiveRow
    {
        return $this->findAll()
            ->insert($data);
    }

    public function update(array $data): int
    {
        if (!(isset($data['id']) && is_int($data['id']))){
                throw new Exception('Must in data use intiger - key id');
        }

        return (int) $this->getById($data['id'])
            ->update($data);
    }

    public function delete(int|ActiveRow $id): int
    {
        if (is_int($id)) {
            $id = $this->getById($id);
        }

        return $id->delete();
    }

    public function getById(int $id): ?ActiveRow
    {
        return $this->findAll()
            ->get($id);
    }

}

