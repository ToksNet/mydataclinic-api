<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class OrganisationProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))) {
            return;
        }
    
        // Change 'email' to 'business_email'
        if (isset($credentials['email'])) {
            $credentials['business_email'] = $credentials['email'];
            unset($credentials['email']);
        }
        return parent::retrieveByCredentials($credentials);
    }
    
}
