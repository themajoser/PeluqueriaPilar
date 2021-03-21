<?php

namespace App\Http\Controllers;

use App\Movement;
use Illuminate\Http\Request;
use App\Charts\GraphicChart;
use Chartisan\PHP\Chartisan;
class HomeController extends Controller
{


    public function index()
    {
        $MovementG = Movement::DatesForGraficG();
        $MovementI = Movement::DatesForGraficI();

        $chartMovementsG = $this->createChart($MovementG, 'Movimientos', 'line', 'rgba(255, 99, 132, 0.2)', '#F96332');
        $chartMovementsI = $this->createChart($MovementI, 'Movimientos', 'line', 'rgba(50, 222, 249, 0.2)', '#3288f9');
        return view('dashboard', compact(['chartMovementsG','chartMovementsI']));
    }

    private function createChart($data, $name, $type, $backgroundColor, $color)
    {

        $valores = $this->getValuesFromArray($data);


        $chart = new GraphicChart();
        $chart->displayLegend(false);
        $chart->labels(array_reverse($valores[0]));
        $chart->dataset($name, $type, array_reverse($valores[1]))->backgroundcolor($backgroundColor)->color($color);
        return $chart;

    }

    private function getValuesFromArray($array)
    {
        $i = 0;
        $result = [];
        foreach ($array as $key => $value) {
            $result[0][$i] = $key;
            $result[1][$i] = count($value);
            $i++;
        }
        return $result;
    }

}
