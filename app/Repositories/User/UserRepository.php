<?php

namespace App\Repositories\User;


use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        return User::find($id);
    }

    /**
     * @param string $provider
     * @param string $providerUserId
     * @return mixed
     */
    public function findByProvider(string $provider, string $providerUserId): User
    {
        return User::whereProvider('google')
            ->whereProviderUserId($providerUserId)
            ->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $user = new User($data);
        $user->save();

        return $user;
    }
}