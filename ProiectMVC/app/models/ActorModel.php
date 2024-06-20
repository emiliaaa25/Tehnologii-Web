<?php
// models/ActorModel.php
require_once ('D:/xampp/htdocs/ProiectMVC/public/Database/config.php');
class ActorModel {
    private $connection;
    private $tmdbApiKey;


    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->tmdbApiKey = require_once './Database/config.php';

    }

    public function getAllActors() {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE category LIKE '%ACTOR%'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetails($url){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
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

    public function getActorDetailsFromTmdb($name) {
        // Obține ID-ul actorului
        $url = "https://api.themoviedb.org/3/search/person?query=" . urlencode($name) . "&include_adult=false&language=en-US";
        $response = $this->getDetails($url);
        
        if (isset($response['results']) && count($response['results']) > 0) {
            $actorId = $response['results'][0]['id'];
            
            // Obține detaliile complete ale actorului
            $detailsUrl = "https://api.themoviedb.org/3/person/{$actorId}?language=en-US";
            $detailsResponse = $this->getDetails($detailsUrl);
    
            if (isset($detailsResponse['id'])) {
                // Obține filmele în care a jucat actorul (known_for)
                $creditsUrl = "https://api.themoviedb.org/3/person/{$actorId}/combined_credits?language=en-US";
                $creditsResponse = $this->getDetails($creditsUrl);
                // Obține toate creditele (filmografia completă)
                $filmographyUrl = "https://api.themoviedb.org/3/person/{$actorId}/combined_credits?language=en-US";
                $filmographyResponse = $this->getDetails($filmographyUrl);
                $externalIdsUrl = "https://api.themoviedb.org/3/person/{$actorId}/external_ids?language=en-US";
                $externalIdsResponse = $this->getDetails($externalIdsUrl);

                // Initializează un vector pentru stocarea ID-urilor externe
                $externalIds = [
                    'imdb_id' => isset($externalIdsResponse['imdb_id']) ? $externalIdsResponse['imdb_id'] : null
                    // Adaugă aici alte ID-uri externe cum ar fi Facebook, Instagram, etc., dacă sunt necesare
                ];
    
                // Initialize an empty array to store actor details
                $actorDetails = [
                    'name' => $detailsResponse['name'],
                    'biography' => $detailsResponse['biography'],
                    'birthday' => $detailsResponse['birthday'],
                    'place_of_birth' => $detailsResponse['place_of_birth'],
                    'deathday' => $detailsResponse['deathday'],
                    'gender' => $detailsResponse['gender'] == 1 ? 'Female' : 'Male',
                    'profile_path' => isset($detailsResponse['profile_path']) ? 'https://image.tmdb.org/t/p/w500' . $detailsResponse['profile_path'] : null,
                    'known_for' => [],
                    'filmography' => []
                ];
    
                // Process known_for
                if (isset($creditsResponse['cast']) && is_array($creditsResponse['cast'])) {
                    foreach ($creditsResponse['cast'] as $movie) {
                        $title = isset($movie['title']) ? $movie['title'] : (isset($movie['original_name']) ? $movie['original_name'] : 'Unknown Title');
                        $posterPath = isset($movie['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : null;
                        $popularity = isset($movie['popularity']) ? $movie['popularity'] : null;
                        $vote_count = isset($movie['vote_count']) ? $movie['vote_count'] : null;
                                $actorDetails['known_for'][] = [
                                'title' => $title,
                                'overview' => isset($movie['overview']) ? $movie['overview'] : '',
                                'poster_path' => $posterPath,
                                'popularity' => $popularity,
                                'vote_count' => $vote_count
                            ];
                    
                }
            }
    
                if (isset($filmographyResponse['cast']) && is_array($filmographyResponse['cast'])) {
                    foreach ($filmographyResponse['cast'] as $movie) {
                        $title = isset($movie['title']) ? $movie['title'] : (isset($movie['original_name']) ? $movie['original_name'] : 'Unknown Title');
                        $releaseDate = isset($movie['release_date']) ? $movie['release_date'] : (isset($movie['first_air_date']) ? $movie['first_air_date'] : 'Unknown Release Date');
                        $posterPath = isset($movie['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : null;
                        $type = isset($movie['media_type']) ? $movie['media_type'] : 'yes';
                        $character = isset($movie['character']) ? $movie['character'] : '';
                        $actorDetails['filmography'][] = [
                            'title' => $title,
                            'release_date' => $releaseDate,
                            'media_type' => $type,
                            'poster_path' => $posterPath,
                            'character' => $character

                        ];
                    }
                }
    
                return ['status' => 'success', 'actor' => $actorDetails];
            } else {
                return ['status' => 'error', 'message' => 'Actor details not found'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Actor not found'];
        }
    }
    
    public function getAllActorsNames() {
        $query = "SELECT full_name FROM screen_actor_guild_awards WHERE category LIKE '%ACTOR%'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getActorsStartingWith($letter) {
        $letter = $letter . '%'; // append '%' to the letter
        $query = "SELECT full_name FROM screen_actor_guild_awards WHERE full_name LIKE :letter";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':letter', $letter);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getActorByName($name) {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE full_name = :name";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
