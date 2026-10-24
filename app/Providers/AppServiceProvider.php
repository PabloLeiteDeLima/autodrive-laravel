namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- CERTIFIQUE-SE DE TER ESTA LINHA IMPORTADA NO TOPO

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Força o uso de HTTPS em todas as URLs e Assets quando estiver rodando no Render
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
