<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Repositories\MiRepository;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    //se inyecta el repositorio en el constructor para hacer uso de sus métodos
    public function __construct(){
        $this->repositorio = new MiRepository();
    }
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
        /**Muestra la vista de iniciar sesión */
        Fortify::loginView(function () {
            return view('auth.login');
        });

        /**Muestra la vista para registrar usuarios*/
        Fortify::registerView(function () {
            //se usa los métodos del reporitorio para cargar los datos del formulario
            $generos = $this->repositorio->getGeneros();
            $idiomas = $this->repositorio->getIdiomas();
            $paises = $this->repositorio->getPaises();
            
            return view('auth.register',compact('generos','idiomas','paises'));
        });
        
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
        
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
