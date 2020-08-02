<?php

namespace App\Repositories\User;


use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;

    /**
     * @param string $provider
     * @param string $providerUserId
     * @return mixed
     */
    public function findByProvider(string $provider, string $providerUserId): User;

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}