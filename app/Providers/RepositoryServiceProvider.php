<?php

namespace App\Providers;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\PlanoSaudeRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VinculoRepositoryInterface;
use App\Repositories\Core\Eloquent\EloquentPacienteRepository;
use App\Repositories\Core\Eloquent\EloquentPlanoSaudeRepository;
use App\Repositories\Core\Eloquent\EloquentUserRepository;
use App\Repositories\Core\Eloquent\EloquentVinculoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //ORM Eloquent
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );
        $this->app->bind(
            PlanoSaudeRepositoryInterface::class,
            EloquentPlanoSaudeRepository::class
        );
        $this->app->bind(
            PacienteRepositoryInterface::class,
            EloquentPacienteRepository::class
        );
        $this->app->bind(
            VinculoRepositoryInterface::class,
            EloquentVinculoRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
