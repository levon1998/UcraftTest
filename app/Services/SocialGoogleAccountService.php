<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\SocialGoogleAccount;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialGoogleAccountService
{
    /**
     * @var
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createOrGetUser(ProviderUser $providerUser)
    {
        $user = $this->userRepository->findByProvider('google', $providerUser->getId());

        if (is_null($user)) {
            $user = $this->userRepository->store([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'google',
                'email_verified_at' => Carbon::now(),
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => md5(rand(1,10000)),
            ]);
        }

        return $user;
    }
}