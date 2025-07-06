<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Contracts\Repositories\SchoolRepositoryInterface;
use App\Models\School;

class SchoolRepository implements SchoolRepositoryInterface
{
    public function getAll(): array
    {
        return School::all()->toArray();
    }

    public function getById(string $id): array
    {
        return School::with('products')->find($id)->toArray();
    }

    public function create(array $data): array
    {
        $createdSchool = School::create($data);
        $id = $createdSchool->school_id;

        return $this->getById($id);
    }

    public function update(string $id, array $data): bool
    {
        return School::find($id)->update($data);
    }

    public function delete(string $id): bool
    {
        return School::find($id)->delete();
    }
}
