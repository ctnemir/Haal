<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function dashchart(Request $request)
    {

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'datasests' => [
                    [
                        'label' => 'Shoes',
                        'backgroundColor' => '#0694a2',
                        // borderColor: window.chartColors.red,
                        'borderWidth' => 1,
                        'data' => [-3, 14, 52, 74, 33, 90, 70],
                    ]
                ]
            ]
        ];
        return response()->json($data);
    }
}
