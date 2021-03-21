@extends('layouts.app')

@section('header')
    Peluquería Pilar
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <span class="card-title h4">Peluquería Pilar:</span>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="statistics">
                                <div id="gastos" class="info">
                                    <div class="icon icon-primary">
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                    </div>
                                    <h2 class="info-title"></h2>
                                    <h5 class="stats-title">Gastos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="statistics">
                                <div id="ingresos" class="info">
                                    <div class="icon icon-info">
                                        <i class="now-ui-icons arrows-1_minimal-up"></i>
                                    </div>
                                    <h2 class="info-title"></h2>
                                    <h5 class="stats-title">Ingresos</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="graphic1">
                        @include('statistics.chart',['model' => $chartMovementsG, 'title'=>"Gráfico de gastos de productos"])
                    </div>
                    <div id="graphic2">
                        @include('statistics.chart',['model' => $chartMovementsI, 'title'=>"Gráfico de ingresos de productos"])
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/Chart.min.js" charset="utf-8"></script>
    <script>
          if( $( "#graphic1" ).is(":visible")){
                $("#graphic2").hide();
            }

         $( "div #gastos" ).click(function() {
             if( $( "#graphic1" ).is(":visible")){
                $("#graphic1").fadeOut();
            }
            if( $( "#graphic1" ).is(":hidden")){
                $("#graphic2").hide();
                $("#graphic1").fadeIn();
                }
            });


            $( "div #ingresos" ).click(function() {
                if( $( "#graphic2" ).is(":visible")){
                $("#graphic2").fadeOut();
            }
            if( $( "#graphic2" ).is(":hidden")){
                $("#graphic1").hide();
                $("#graphic2").fadeIn();
                }
            });

    </script>
@endpush
