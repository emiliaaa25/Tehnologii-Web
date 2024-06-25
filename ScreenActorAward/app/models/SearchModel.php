<?php
require_once 'C:\xampp\htdocs\ScreenActorAward\public\Database\config.php';
class SearchModel
{

    public function getDetails($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI3NDA1ZjJlYWE5NzRjYmRmOThmYzBkZWU4YzYyZTNmZCIsInN1YiI6IjVkNjAwMmVkYTg5NGQ2NmZmOTlhYjY3MyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.5PZuPsNJ0tMAyp9hyhUN6Yv3W_EryL2UMKAyecJxoEU",
                "accept: application/json"
            ],
        ]);


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }

    }

    public function getSearch($query)
    {
        $url = "https://api.themoviedb.org/3/search/multi?query=" . urlencode($query) . "&language=en-US";
        $response = $this->getDetails($url);
        if (isset($response['results']) && count($response['results']) > 0) {
            return ['status' => 'success', 'search' => $response['results']];

        }

        return json_encode(['status' => 'error', 'message' => 'Season details not found.']);
    }


}