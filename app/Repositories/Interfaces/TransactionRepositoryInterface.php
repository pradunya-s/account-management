<?php
namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function getAllByAccountId(int $accountId);
}
