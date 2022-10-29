<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AntiPhishingRequest;
use App\Models\Phishing;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class AntiPhishingController extends Controller
{

    public function check(AntiPhishingRequest $request)
    {

        $url = $request->url;
        $phishing = Phishing::where('url', 'LIKE', $url)->where('status', 'DONE')->exists();

        if ($phishing == false) {
            $data = [
                'apiKey' => 'k1q2ayt7lh61c3zhz7sfa59d3k0m6akjnlb6ml3ywa2islca73v0nxonzkcncywc',
                "urlInfo" => ["url" => "$url"]
            ];
            $response = Http::acceptJson()
                ->post('https://developers.checkphish.ai/api/neo/scan', $data);
            if ($response->getStatusCode() != 200) {
                return redirect('/')->with('error', 'can not connect to https://developers.checkphish.ai');
            }
            $res = json_decode($response->getBody(), true);
            if (isset($request->vip_mod)) {

                if (!isset($res['errorMessage'])) {

                    $id = $response->json()['jobID'];
                    $data2 = [
                        'apiKey' => 'k1q2ayt7lh61c3zhz7sfa59d3k0m6akjnlb6ml3ywa2islca73v0nxonzkcncywc',
                        "jobID" => $id,
                        "insights" => true
                    ];


                    $response2 = Http::acceptJson()
                        ->post('https://developers.checkphish.ai/api/neo/scan/status', $data2);

                   
                    // example output from api ------------
                    //     "job_id" => "2d7615fa-6e6e-47f8-9c27-2a125ed45eb7",
                    //     "status" => "DONE",
                    //     "url" => "http://webidlogin101997.5gbfree.com/",
                    //     "url_sha256" => "a395e2130500750d34703f66c62c50ce99be0c7272b6763f6508c6bd473f1d74",
                    //     "disposition" => "clean",
                    //     "brand" => "unknown",
                    //     "insights" => "https://checkphish.ai/insights/url/1667039497775/a395e2130500750d34703f66c62c50ce99be0c7272b6763f6508c6bd473f1d74",
                    //     "resolved" => false,
                    //     "screenshot_path" => "https://bst-prod-screenshots.s3-us-west-2.amazonaws.com/20221029/a395e2130500750d34703f66c62c50ce99be0c7272b6763f6508c6bd473f1d74_1667039497775.png",
                    //     "scan_start_ts" => 1667039497775,
                    //     "scan_end_ts" => 1667039497916,
                    //     "error" => false,
                    
                    $apiResponse = $response2->json();

                    $this->store($apiResponse, 'api');
                } else {
                    return redirect('/')->with('error', $res['errorMessage'] ?? 'vip server expired');
                }
            } else {
                $data = $this->serverCheck($url);
                $this->store($data, 'server');
                return redirect('/')->with('success', "this url is {$data['disposition']}");
            }
        } else {


            $data = Phishing::where('url', 'LIKE', $url)->get()->toArray();
            $re = $data[0]['disposition'];
            return redirect('/')->with('success', "this url is  $re   !");
        }
    }
    public function store($data, $status = 'admin')
    {
        if ($status == 'api') {
            $phishing = Phishing::create(
                [
                    'url' => $data['url'],
                    'disposition' => $data['disposition'],
                    'status' => $data['status'],
                ]

            );
            $phishing->save();
        }
        if ($status == 'server') {
            $phishing =   Phishing::create(
                [
                    'url' => $data['url'],
                    'disposition' => $data['disposition'],

                ]

            );
            $phishing->save();
        }
    }
    public function serverCheck($url)
    {

        $pattern = "/^https:\/\/?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/m";
        $disposition = null;
        if (preg_match($pattern, $url) == 1) {
            $disposition = "clean";
        } else {
            $disposition = "phish";
        }

        
        return [
            'url' => $url,
            'disposition' => $disposition,

        ];
    }
}
