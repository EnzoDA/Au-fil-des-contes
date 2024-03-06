@extends('template')

@section('content')

<!-- // LIEN CREATION CAVERNE // -->
<a href="{{route ('question.create')}}" class="btn btn-primary" style="margin-top: 10px">Créer une
    Caverne</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="myTable">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Intro</th>
                <th>Voir les questionnaires</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cavernes as $caverne)
            <tr>
                <td>{{ $manif['titre'] }} </td>
                <td>{{ date('d/m/Y', strtotime($manif['date'])) }}</td>
                <td>{{ date('H:i', strtotime($manif['heure'])) }}</td>
                <td>{{ $manif['lieu'] }} </td>
                <td>@if($manif['code'] == null)
                <span style="color: red;">AUCUN CODE</span>
                    @else{{ $manif['code'] }}
                @endif </td>
                <td>{{ $manif['nb_personne'] }}</td>
                <td>{{ $manif['description'] }} </td>
                <td>{{ $manif->users->name }} {{ $manif->users->first_name }}</td> <!--users = index dans Controller Manif-->
                <td>
                    <img style="cursor: pointer;" onclick="showQrCode('quantitatif', {{$manif->id}})" class="img-anim"
                    src="{{ url('/qrcodes/'.$manif->id.'_quantitatif.svg') }}" id="quantitatif" alt="QR Code Quantitatif">
                </td>
                <td>
                    <img style="cursor: pointer;" onclick="showQrCode('qualitatif', {{$manif->id}})" class="img-anim"
                    src="{{ url('/qrcodes/'.$manif->id.'_qualitatif.svg') }}" id="qualitatif" alt="QR Code Qualitatif">
                </td>
                <td>
                    <a href="https://stats.la-sequanaise.com/v2/questionnaire/public/questionnaire/backOffice-redirect/{{$manif->id}}" target="_blank" class="btn btn-primary">Accéder à la manif</a>
                </td>
                <td>
                        @if(strtotime($manif['date']) >= strtotime(date('Y-m-d')))
                    <form action="{{ route('manifestation.edit', [$manif['id']]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                    @endif
                </td>
                <td>
                    <!-- // BTN ARCHIVER // -->
                    <form action="{{ route('manifestation.archive', ['id' => $manif->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Archiver</button>
                    </form>
                    <!---->
                </td>
                <td>
                    @if(strtotime($manif['date']) >= strtotime(date('Y-m-d')))
                    <form action="{{ route('manifestation.voirQuestion', ['id' => $manif->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary">Voir les questions</button>
                    </form>
                    @endif
                </td>
                <td>
                    <form action="{{ route('statistiques.afficherstat') }}" method="GET">
                        @csrf
                        <input type="hidden" name="selected" value="{{ $manif->id }}">
                        <button type="submit" class="btn btn-primary">Voir les statistiques</button>
                    </form>
                </td>
                <td>
                <form action="{{ route('questionnaires-show',  ['id' => $manif->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary">Voir les questionnaires</button>
                    </form>
                </td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modale d'affichage de qr-code -->
<div class="modal fade" id="showQrCodeModal" tabindex="-1" role="dialog" aria-labelledby="showQrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="qrCodeType"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="qrCodeImage" alt="QR Code">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@stop