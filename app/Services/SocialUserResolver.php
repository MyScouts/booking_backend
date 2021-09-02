<?php

namespace App\Services;

use App\Domains\Auth\Models\User;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class SocialUserResolver implements SocialUserResolverInterface
{
    /**
     * Resolve user by provider credentials.
     *
     * @param string $provider
     * @param string $accessToken
     *
     * @return Authenticatable|null
     */

    public function resolveUserByProviderCredentials(string $provider, string $accessToken): ?User
    {
        $providerUser = null;

        try {
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);
        } catch (Exception $exception) {
        }

        if ($providerUser) {
            return (new SocialAccountsService())->findOrCreate($providerUser, $provider);
        }
        return null;
    }
}
