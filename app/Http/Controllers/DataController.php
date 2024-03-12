<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function insertData()
    {
        $endpoint1 = 'https://submitter.tech/test-task/endpoint1.json';
        $endpoint2 = 'https://submitter.tech/test-task/endpoint2.json';

        $data1 = json_decode(file_get_contents($endpoint1), true);
        $data2 = json_decode(file_get_contents($endpoint2), true);
        $data2 = $data2['data']['list'];

        foreach ($data1 as $d1) {
            foreach ($data2 as $d2) if ($d1['name'] == $d2['dimensions']['ad_id']) {

                $dataValidation = [
                    'ad_id' => $d2['dimensions']['ad_id'],
                    'impressions' => $d2['metrics']['impressions'],
                    'clicks' => $d1['clicks'],
                    'unique_clicks' => $d1['unique_clicks'],
                    'leads' => $d1['leads'],
                    'conversion' => $d2['metrics']['conversion'],
                    'roi' => $d1['roi'],
                ];

                $rules = [
                    'ad_id' => 'required|string',
                    'impressions' => 'required|integer',
                    'clicks' => 'required|integer',
                    'unique_clicks' => 'required|integer',
                    'leads' => 'required|integer',
                    'conversion' => 'required|numeric',
                    'roi' => 'required|numeric',
                ];

                $validator = Validator::make($dataValidation, $rules);

                if (!$validator->fails()){
                    Data::updateOrCreate([
                        'ad_id' => $dataValidation['ad_id']],[
                        'impressions' => $dataValidation['impressions'],
                        'clicks' => $dataValidation['clicks'],
                        'unique_clicks' => $dataValidation['unique_clicks'],
                        'leads' => $dataValidation['leads'],
                        'conversion' => $dataValidation['conversion'],
                        'roi' => $dataValidation['roi'],
                    ]);
                }
            }
        }
    }

}
