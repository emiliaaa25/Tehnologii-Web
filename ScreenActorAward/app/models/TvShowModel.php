<?php
require_once '../../public/Database/config.php';

class TvShowModel
{
    private $connection;
    private $tmdbApiKey;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAlltvShows()
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

    public function gettvShowDetailsFromTmdb($name)
    {
        $url = "https://api.themoviedb.org/3/search/tv?query=" . urlencode($name) . "&language=en-US";
        $response = $this->getDetails($url);

        if (isset($response['results']) && count($response['results']) > 0) {
            $tvShowId = $response['results'][0]['id'];
            $detailsUrl = "https://api.themoviedb.org/3/tv/{$tvShowId}?language=en-US";
            $detailsResponse = $this->getDetails($detailsUrl);

            if (isset($detailsResponse['id'])) {
                $videoUrl = "https://api.themoviedb.org/3/tv/{$tvShowId}/videos?language=en-US";
                $videoResponse = $this->getDetails($videoUrl);

                $creditsUrl = "https://api.themoviedb.org/3/tv/{$tvShowId}/credits?language=en-US";
                $creditsResponse = $this->getDetails($creditsUrl);
                $videokey = null;
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
                $cast = [];
                if (isset($creditsResponse['crew']) && count($creditsResponse['crew']) > 0) {
                    foreach ($creditsResponse['crew'] as $crew) {
                        if ($crew['department'] === 'Production' && count($director) < 2) {
                            $director[] = $crew['name'];
                        }
                        if ($crew['department'] === 'Writing' && count($writer) < 2) {
                            $writer[] = $crew['name'];
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
                $lastSeasonNumber = $detailsResponse['last_episode_to_air']['season_number'];
                $lastSeason = array_filter($detailsResponse['seasons'], function ($season) use ($lastSeasonNumber) {
                    return $season['season_number'] === $lastSeasonNumber;
                });
                $lastSeason = reset($lastSeason);
                $tvShowDetails = [
                    'name' => $detailsResponse['name'],
                    'tagline' => isset($detailsResponse['tagline']) ? $detailsResponse['tagline'] : 'daaa',
                    'backdrop_path' => $detailsResponse['backdrop_path'],
                    'poster_path' => $detailsResponse['poster_path'],
                    'first_air_date' => $detailsResponse['first_air_date'],
                    'genres' => array_column($detailsResponse['genres'], 'name'),
                    'origin_country' => array_column($detailsResponse['production_countries'], 'name'),
                    'last_season' => $lastSeason,
                    'overview' => $detailsResponse['overview'],
                    'video_key' => $videokey,
                    'director' => $director,
                    'seasons' => $detailsResponse['seasons'],
                    'writer' => $writer,
                    'id' => $detailsResponse['id'],
                    'cast' => $cast,
                ];
                return ['status' => 'success', 'tvShow' => $tvShowDetails];
            }
        }

        return null;
    }


    public function getAllSeasonsFromTmdb($showId)
    {
        $url = "https://api.themoviedb.org/3/tv/{$showId}?language=en-US";
        $response = $this->getDetails($url);


        if (isset($response['seasons']) && count($response['seasons']) > 0) {
            $allSeasons = $response['seasons'];
            return ['status' => 'success', 'seasons' => $allSeasons];
        }

        return json_encode(['status' => 'error', 'message' => 'Seasons not found.']);
    }

    public function getEpisodes($showId, $seasonNumber)
    {
        $url = "https://api.themoviedb.org/3/tv/{$showId}/season/{$seasonNumber}?language=en-US";
        $response = $this->getDetails($url);

        if (isset($response['id'])) {
            $episodes = [];
            foreach ($response['episodes'] as $episode) {
                $crewMembers = [];
                foreach ($episode['crew'] as $crewMember) {
                    $crewMembers[] = [
                        'name' => $crewMember['name'],
                        'job' => $crewMember['job'],
                        'profile_path' => isset($crewMember['profile_path']) ? 'https://image.tmdb.org/t/p/w200' . $crewMember['profile_path'] : null,
                    ];
                }

                $guestStars = [];
                foreach ($episode['guest_stars'] as $guestStar) {
                    $guestStars[] = [
                        'name' => $guestStar['name'],
                        'character' => $guestStar['character'],
                        'profile_path' => isset($guestStar['profile_path']) ? 'https://image.tmdb.org/t/p/w200' . $guestStar['profile_path'] : null,
                    ];
                }

                $episodeDetails = [
                    'episode_number' => $episode['episode_number'],
                    'name' => $episode['name'],
                    'overview' => $episode['overview'],
                    'air_date' => $episode['air_date'],
                    'runtime' => $episode['runtime'],
                    'still_path' => isset($episode['still_path']) ? 'https://image.tmdb.org/t/p/w300' . $episode['still_path'] : null,
                    'vote_average' => $episode['vote_average'],
                    'crew' => $crewMembers,
                    'guest_stars' => $guestStars,
                ];

                $episodes[] = $episodeDetails;
            }

            return ['status' => 'success', 'episodes' => $episodes];
        }

        return json_encode(['status' => 'error', 'message' => 'Season details not found.']);
    }


}

