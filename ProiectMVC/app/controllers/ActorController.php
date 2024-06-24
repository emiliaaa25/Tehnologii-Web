<?php
require_once('C:\xampp\htdocs\ProiectMVC\app\models\ActorModel.php');
class ActorController {
    public function getAllActors() {
        $actorModel = new ActorModel();
        $actors = $actorModel->getAllActors();
        return json_encode($actors);
    }

    public function getActorByName($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorByName($name);
            return json_encode($actors);
        }
        return json_encode([]);
    }

    public function getAllActorsNames() {
        $actorModel = new ActorModel();
        $names = $actorModel->getAllActorsNames();
        return json_encode($names);
    }
    public function getActorDetails($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
        $actors = $actorModel->getActorDetailsFromTmdb($name);
        return json_encode($actors);
        }
    }

    public function getActorPhotos($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorPhoto($name);
            return json_encode($actors);
        }
        return json_encode([]);
    }

    
function fetchNewsForActor($actorName)
{
    // Load the configuration
    $config = include('C:/xampp/htdocs/ProiectMVC/public/Database/configNews.php');
    
    $apiKey = $config['news_api']['api_key'];
    $baseUrl = $config['news_api']['base_url'];

    // Construct the API request URL
    $url = $baseUrl . urlencode($actorName) . '&apiKey=' . $apiKey;


    // Use cURL to fetch the data
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set the User-Agent header
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: MyNewsApp/1.0',
    ]);

    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        die('Error fetching the data: ' . curl_error($ch));
    }

    // Get the HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    // Check if the HTTP status code is not 200 (OK)
    if ($httpCode !== 200) {
        die('Error fetching the data: HTTP status code ' . $httpCode);
    }

    // Decode the JSON response into an associative array
    $newsData = json_decode($response, true);

    // Check if decoding was successful
    if ($newsData === null) {
        die('Error decoding the JSON data.');
    }

    return $newsData['articles'];
}

public function getActorsPaginated($page, $pageSize) {
    $actorModel = new ActorModel();
    return $actorModel->getActorsPaginated($page, $pageSize);
}

public function getTotalActors() {
    $actorModel = new ActorModel();
    return $actorModel->getTotalActors();
}
}
