<?php

namespace atikullahnasar\setting\Services\CustomPages;

use atikullahnasar\setting\Repositories\CustomPages\CustomPageRepositoryInterface;

class CustomPageService implements CustomPageServiceInterface
{
    protected $customPageRepository;

    public function __construct(CustomPageRepositoryInterface $customPageRepository)
    {
        $this->customPageRepository = $customPageRepository;
    }

    public function findWhere($where)
    {
        return $this->customPageRepository->findWhere($where);
    }

    public function getAllWithRelations(array $relations = [])
    {
        return $this->customPageRepository->all(['*'], $relations);
    }

    public function findById(int $id, array $relations = [])
    {
        return $this->customPageRepository->find($id, ['*'], $relations);
    }

    public function create(array $data)
    {
        return $this->customPageRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->customPageRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->customPageRepository->delete($id);
    }

    public function toggleStatus(int $id)
    {
        $customPage = $this->customPageRepository->find($id);
        $customPage->toggleStatus();
        return $customPage;
    }
}
