<?php

namespace Repositories;

use Illuminate\Support\Facades\Http;

class Youtube
{
    private $var;


    private function initialize()
    {
        $userSession = session('user');
        if ($userSession && isset($userSession['tokenuath'])) {
            $this->var = json_decode($userSession['tokenuath']);
        } else {
            // Handle case where session is not set or does not contain 'tokenuath'
            $this->var = null;
        }
    }
    public function getListYoutube($request)
    {
        $response =Http::withHeaders([
            'Accept'=>'appplication/json',
        ])
        ->get('https://www.googleapis.com/youtube/v3/playlistItems',[
            'part'=>'contentDetails,snippet,status',
            'playlistId'=>$request,
            'key'=>'AIzaSyA1dXY9lPe9zi264_4TzJ6D_DQu344xV8k',
            'maxResults'=>5

        ]);
        if($response->successful()){
            return $response->collect(['items']);
        }else{
            return $response->failed();
        }
    }
    public function getDetailEvent () {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube.googleapis.com/youtube/v3/playlists?part=snippet%2CcontentDetails%2Cplayer&channelId=UCx7pLb6J505797Rr63Li02A&key=AIzaSyA1dXY9lPe9zi264_4TzJ6D_DQu344xV8k",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "User-Agent: Thunder Client (https://www.thunderclient.com)"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $decode = json_decode($response, true);
            $items = $decode['items'];

            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'title' => $item['snippet']['title'],
                    'description' => $item['snippet']['description'],
                    'thumbnail' => $item['snippet']['thumbnails']['medium']['url'],
                    'playlistId' => $item['id'],
                    'embed' => $item['player']['embedHtml'],
                ];
            }
            return $data;

        }
    }
    public function getListItemsYoutube($slug)
    {
        /* $response =Http::withHeaders([
            'Accept'=>'appplication/json',
        ])
        ->get('https://www.googleapis.com/youtube/v3/playlistItems',[
            'part'=>'contentDetails,snippet,status',
            'playlistId'=>'PLvhdCgCoHXAKwdfrpmYzlG8ojuGr14FzI',
            'key'=>'AIzaSyA1dXY9lPe9zi264_4TzJ6D_DQu344xV8k',
            'maxResults'=>5

        ]); */
        $this->initialize();
        if ($this->var === null) {
            return response()->json(['error' => 'Token not found'], 401);
        }
        $accessToken =json_decode(session('user')['tokenuath']);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->var->access_token,
        ])->get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'contentDetails,snippet,status',
            'playlistId' => $slug,  // Ganti dengan ID playlist yang sesuai
            'maxResults' => 5
        ]);
        if($response->successful()){
            return $response->collect(['items']);
        }else{
            return $response->failed();
        }
    }

    public function playVideos ($request)
    {
        $this->initialize();
        if ($this->var === null) {
            return response()->json(['error' => 'Token not found'], 401);
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->var->access_token,
        ])->get('https://www.googleapis.com/youtube/v3/videos',[
                'part'=>'snippet,contentDetails,statistics,player',
                'id'=>$request,
            ]);

        if($response->successful()){
            return $response->collect('items');
        }else{
            return $response->failed();
        }
    }

    public function playVideo($request)
{
    // Inisialisasi
    $this->initialize();

    // Periksa apakah token ada
    if ($this->var === null) {
        return response()->json(['error' => 'Token not found'], 401);
    }

    // Kirim permintaan ke API YouTube
    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $this->var->access_token,
    ])->get('https://www.googleapis.com/youtube/v3/videos', [
        'part' => 'player',
        'id' => $request,
    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        $items = $response->collect('items');
        if ($items->isEmpty()) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        $player = $items[0]['player']['embedHtml'];

        return response()->json(['html' => $player]);
    } else {
        return response()->json(['error' => 'Failed to retrieve video data'], $response->status());
    }
}


}
