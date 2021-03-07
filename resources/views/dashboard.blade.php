@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title h4">Tus archivos subidos:</span>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-primary">
                                                        <i class="now-ui-icons design_image"></i>
                                                    </div>
                                                    <h2 class="info-title"></h2>
                                                    <h5 class="stats-title">Fotos</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-info">
                                                        <i class="now-ui-icons media-1_camera-compact"></i>
                                                    </div>
                                                    <h2 class="info-title"></h2>
                                                    <h5 class="stats-title">Vídeos</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush


