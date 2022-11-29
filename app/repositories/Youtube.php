<?php

namespace App\Repositories;

class Youtube
{

    public function getListYoutube()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.googleapis.com/youtube/v3/playlistItems?part=contentDetails%2Csnippet%2Cstatus&playlistId=PLvhdCgCoHXAIGIX3IpDuhkk7q5krtpgG1&key=AIzaSyA1dXY9lPe9zi264_4TzJ6D_DQu344xV8k&maxResults=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "User-Agent: Thunder Client (https://www.thunderclient.com)",
                "content-type: multipart/form-data; boundary=---011000010111000001101001"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
           $decode = json_decode($response,true);
           $items = $decode['items'];
        }
        return $items;
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
}
