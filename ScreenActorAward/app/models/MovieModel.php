<?php
require_once 'C:\xampp\htdocs\ScreenActorAward\public\Database\config.php';

class MovieModel
{
    private $connection;
    private $tmdbApiKey;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllMovies()
    {
        $query = "SELECT DISTINCT `show` FROM screen_actor_guild_awards";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function getMovieDetailsFromTmdb($name)
    {
        $url = "https://api.themoviedb.org/3/search/movie?query=" . urlencode($name) . "&include_adult=false&language=en-US";
        $response = $this->getDetails($url);

        if (isset($response['results']) && count($response['results']) > 0) {
            $movieId = $response['results'][0]['id'];
            $detailsUrl = "https://api.themoviedb.org/3/movie/{$movieId}?language=en-US";
            $detailsResponse = $this->getDetails($detailsUrl);

            if (isset($detailsResponse['id'])) {
                $videoUrl = "https://api.themoviedb.org/3/movie/{$movieId}/videos?language=en-US";
                $videoResponse = $this->getDetails($videoUrl);

                $creditsUrl = "https://api.themoviedb.org/3/movie/{$movieId}/credits?language=en-US";
                $creditsResponse = $this->getDetails($creditsUrl);

                if (isset($videoResponse['results']) && count($videoResponse['results']) > 0) {
                    foreach ($videoResponse['results'] as $video) {
                        if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                            $videokey = $video['key'];
                            break;
                        }
                    }
                }
                $director = [];
                $writer = [];
                $screenplay = [];
                $cast = [];
                if (isset($creditsResponse['crew']) && count($creditsResponse['crew']) > 0) {
                    foreach ($creditsResponse['crew'] as $crew) {
                        if ($crew['department'] === 'Directing' && count($director) < 2) {
                            $director[] = $crew['name'];
                        }
                        if ($crew['department'] === 'Writing' && count($writer) < 2) {
                            $writer[] = $crew['name'];
                        }
                        if ($crew['job'] === 'Screenplay' && count($screenplay) < 2) {
                            $screenplay[] = $crew['name'];
                        }

                    }
                }

                if (isset($creditsResponse['cast']) && count($creditsResponse['cast']) > 0) {
                    foreach ($creditsResponse['cast'] as $actor) {
                        $cast[] = [
                            'name' => $actor['name'],
                            'character' => $actor['character'],
                            'profile_path' => isset($actor['profile_path']) ? 'https://image.tmdb.org/t/p/w185' . $actor['profile_path'] : null,
                        ];
                    }
                }

                $movieDetails = [
                    'title' => isset($detailsResponse['title']) ? $detailsResponse['title'] : null,
                    'tagline' => isset($detailsResponse['tagline']) ? $detailsResponse['tagline'] : null,
                    'backdrop_path' => isset($detailsResponse['backdrop_path']) ? $detailsResponse['backdrop_path'] : null,
                    'poster_path' => isset($detailsResponse['poster_path']) ? $detailsResponse['poster_path'] : null,
                    'release_date' => isset($detailsResponse['release_date']) ? $detailsResponse['release_date'] : null,
                    'genres' => isset($detailsResponse['genres']) ? array_column($detailsResponse['genres'], 'name') : null,
                    'origin_country' => isset($detailsResponse['production_countries']) ? array_column($detailsResponse['production_countries'], 'name') : null,
                    'duration' => isset($detailsResponse['runtime']) ? $detailsResponse['runtime'] : null,
                    'overview' => isset($detailsResponse['overview']) ? $detailsResponse['overview'] : null,
                    'video_key' => isset($videokey) ? $videokey : null,
                    'director' => isset($director) ? $director : null,
                    'writer' => isset($writer) ? $writer : null,
                    'cast' => isset($cast) ? $cast : null,
                ];
                return ['status' => 'success', 'movie' => $movieDetails];
            }
        }

        return null;
    }


}
