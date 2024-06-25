<?php
require_once ('C:\xampp\htdocs\ScreenActorAward\app\models\ActorModel.php');
class ActorController
{
    public function index()
    {
        require_once '../app/views/Actori.php';
    }
    public function actorDetail($params)
    {
        if (!empty($params)) {
            $param = $params[0];
            $decodedParam = urldecode($param);
            $viewFilePath = '../app/views/Actor.php';
            if (file_exists($viewFilePath)) {
                $_GET['name'] = $decodedParam;
                require_once $viewFilePath;
            } else {
                echo "View file not found.";
            }
        } else {
            echo "No year or category specified.";
        }
    }

    public function getAllActors()
    {
        $actorModel = new ActorModel();
        $actors = $actorModel->getAllActors();
        return json_encode($actors);
    }

    public function getActorByName($params)
    {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorByName($name);
            return json_encode($actors);
        }
        return json_encode([]);
    }

    public function getAllActorsNames()
    {
        $actorModel = new ActorModel();
        $names = $actorModel->getAllActorsNames();
        return json_encode($names);
    }
    public function getActorDetails($params)
    {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorDetailsFromTmdb($name);
            return json_encode($actors);
        }
    }

    public function getActorPhotos($params)
    {
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
        $config = include ('C:/xampp/htdocs/ScreenActorAward/public/Database/configNews.php');

        $apiKey = $config['news_api']['api_key'];
        $baseUrl = $config['news_api']['base_url'];

        $url = $baseUrl . urlencode($actorName) . '&apiKey=' . $apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: MyNewsApp/1.0',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            die('Error fetching the data: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode !== 200) {
            die('Error fetching the data: HTTP status code ' . $httpCode);
        }

        $newsData = json_decode($response, true);

        if ($newsData === null) {
            die('Error decoding the JSON data.');
        }

        return $newsData['articles'];
    }

    public function getActorsPaginated($page, $pageSize)
    {
        $actorModel = new ActorModel();
        return $actorModel->getActorsPaginated($page, $pageSize);
    }

    public function getTotalActors()
    {
        $actorModel = new ActorModel();
        return $actorModel->getTotalActors();
    }
}
