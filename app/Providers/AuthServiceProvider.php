<?php

namespace App\Providers;

use App\Box;
use App\Contact;
use App\Policies\BoxPolicy;
use App\Policies\ContactPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        Box::class => BoxPolicy::class,
        Contact::class => ContactPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate) {
        $this->registerPolicies($gate);
        //
    }
}
