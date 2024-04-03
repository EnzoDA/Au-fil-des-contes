<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_token')->unique(); // Token de l'application
            $table->string('deploy_token')->unique(); // Token de déploiement
            $table->string('app_version'); // Version de l'application
            $table->boolean('deploy')->default(true);// Déployer ou non les mises à jour
            $table->timestamps();
        });
        //Insertion des données
        DB::table('app_settings')->insert([
            'app_token' => '9swj3wrdyxj8goiksdepjah5s3isppbe4muwjjrtxge9iyqf01j9rjt20wv7et',
            'deploy_token' => '5ohta9c72xrxbsavosthoxikev1udhifal7xdssjlkm5di8w6h2iz9mmea6s',
            'app_version' => '1.0',
            'deploy' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appsettings');
    }
};
