<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->user()) {
                $id = auth()->user()->id;
                $doctor_id = DB::table('doctors')->where('user_id', $id)->get('id')->first();
                if ($doctor_id != null)
                    $view->with('doctor_id', $doctor_id->id);
            }
        });
    }

    public function register()
    {
        //
    }
}
