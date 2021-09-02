<?php

namespace App\Providers;

use App\Services\SocialUserResolver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blueprint::macro('fullAudited', function () {
            $this->timestamp('deleted_at')->nullable();
            $this->string('create_user_id')->nullable();
            $this->string('update_user_id')->nullable();
            $this->timestamps();
        });
        // Raw sql debug
        if (config('app.env') === 'local') {
            DB::listen(function ($query) {
                logger()->info($query->sql . print_r($query->bindings, true));
            });
        }
    }
}
