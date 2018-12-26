<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Policies\ReplyPolicy;
use App\Policies\TopicPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Reply::class => ReplyPolicy::class,
        Topic::class => TopicPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addHours(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(1));

        \Horizon::auth(function ($request) {
            return \Auth::user()->hasRole('Founder');
        });
        //
    }
}
