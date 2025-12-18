<?php

namespace atikullahnasar\setting\Services\CustomPages;

interface CustomPageServiceInterface
{
    public function getAllWithRelations(array $relations = []);
    public function findById(int $id, array $relations = []);
    public function findWhere($where);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function toggleStatus(int $id);
}
