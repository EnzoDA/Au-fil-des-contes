@extends('template')

@section('content')
<!-- // LOGIN // -->
<section class="container-login-page">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 t" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="mb-5">Connexion</h2>

                            <!-- // EMAIL // -->
                            <div class="form-outline mb-4">
                                <input id="typeEmailX-2" for="email" :value="__('Email')" type="email" name="email" class="form-control form-control-lg" required autofocus autocomplete="username" placeholder="votre e-mail" />
                                @error('email')
                                <span class="text-red-500 text-sm">Identifiants incorrects</span>
                                @enderror
                            </div>

                            <!-- // MOT DE PASSE // -->
                            <div class="form-outline mb-4">
                                <input id="typePasswordX-2" for="password" :value="__('Mot de passe')" type="password" name="password" class="form-control form-control-lg" required autocomplete="current-password" placeholder="mot de passe" />
                                @error('password')
                                <span class="text-red-500 text-sm">Identifiants incorrects</span>
                                @enderror
                            </div>


                            <div class="log-down">
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <!-- // SOUVENIR DE MOI // -->
                                    <input id="form1Example3" type="checkbox" class="form-check-input" name="remember">
                                    <label class="form-check-label" for="form1Example3">Se souvenir de moi</label>
                                </div>

                                <!-- // BUTTON CONNEXION// -->
                                <button class="btn btn-primary btn-lg btn-block">
                                    {{ __('Connexion') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop