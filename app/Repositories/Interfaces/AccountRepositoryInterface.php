<?php

namespace App\Repositories\Interfaces;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create(array $data);
    public function update(Account $account, array $data);
    public function delete(Account $account);
}
