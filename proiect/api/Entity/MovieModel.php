<?php
require_once './Database/config.php';

class MovieModel {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->tmdbApiKey = require_once './Database/config.php';
    }

    public function getAllMovies() {
        $query = "SELECT DISTINCT `show` FROM screen_actor_guild_awards";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMovieByName($name) {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE `show` = :name";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

   
    public function getDetails($url){
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

    public function getMovieDetailsFromTmdb($name) {
        // Obține ID-ul filmului
        $url = "https://api.themoviedb.org/3/search/movie?query=" . urlencode($name) . "&include_adult=false&language=en-US";
        $response = $this->getDetails($url);
        
        // Debugging: Afișează răspunsul de la cererea de căutare
        var_dump($response); // Afișează răspunsul de la TMDB
    
        if (isset($response['results']) && count($response['results']) > 0) {
            $movieId = $response['results'][0]['id'];
            
            // Obține detaliile complete ale filmului
            $detailsUrl = "https://api.themoviedb.org/3/movie/{$movieId}";
            $detailsResponse = $this->getDetails($detailsUrl);
    
            // Debugging: Afișează răspunsul de la cererea de detalii
            var_dump($detailsResponse); // Afișează răspunsul de la TMDB pentru detalii
    
            if (isset($detailsResponse['id'])) {
                $movieDetails = [
                    'title' => $detailsResponse['title'],
                    'poster_path' => $detailsResponse['poster_path'],
                    'release_date' => $detailsResponse['release_date'],
                    'genres' => array_column($detailsResponse['genres'], 'name'), // Extragere nume genuri
                    'duration' => $detailsResponse['runtime'], // Durata în minute
                    'overview' => $detailsResponse['overview'], // Descriere film
                    'crew' => [
                        'director' => $this->getDirector($movieId), // Obține regizorul
                        'screenplay' => $this->getScreenplay($movieId) // Obține scenariștii
                    ]
                ];
                return $movieDetails;
            }
        }
    }
        private function getDirector($movieId) {
        // Obține lista de persoane implicat în film (ex: regizori)
        $url = "https://api.themoviedb.org/3/movie/{$movieId}/credits?language=en-US";
        $response = $this->getDetails($url);

        $directors = [];
        foreach ($response['crew'] as $crewMember) {
            if ($crewMember['job'] == 'Director') {
                $directors[] = $crewMember['name'];
            }
        }

        return implode(', ', $directors);
    }

    private function getScreenplay($movieId) {
        // Obține lista de persoane implicat în film (ex: scenariști)
        $url = "https://api.themoviedb.org/3/movie/{$movieId}/credits?language=en-US";
        $response = $this->getDetails($url);

        $screenplayWriters = [];
        foreach ($response['crew'] as $crewMember) {
            if ($crewMember['job'] == 'Screenplay') {
                $screenplayWriters[] = $crewMember['name'];
            }
        }

        return $screenplayWriters;
    }
}
