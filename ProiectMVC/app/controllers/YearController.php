<?php
require_once('C:\xampp\htdocs\ProiectMVC\app\models\YearModel.php');

class YearController {
    public function getAllYears() {
        $yearModel = new YearModel();
        $years = $yearModel->getAllYears();
        return $years;
    }

    public function getAllFromSpecificYear($params) {
        if (isset($params['year']) && !empty($params['year']) && is_string($params['year'])) {
        $year = $params['year'];
        $yearModel = new YearModel();
        $years = $yearModel->getAllFromSpecificYear($year);
        return json_encode($years);
    }}

    public function getYearDetails($params) {
        if (isset($params['year']) && !empty($params['year']) && is_string($params['year'])) {
        $year = $params['year'];
        $yearModel = new YearModel();
        $years = $yearModel->getCategoriesAndNomineesForYear($year);
        return json_encode($years);
    }}

    public function fetchImageUrl($name, $type) {
      
        if (isset($_GET['name']) && isset($_GET['type'])) {
            $name = $_GET['name'];
            $type = $_GET['type'];
        
            $yearController = new YearController();
            $imageUrl = $yearController->fetchImageUrl($name, $type);
            return json_encode(['imageUrl' => $imageUrl]);
        } else {
            return json_encode(['error' => 'Invalid parameters.']);
        }
    }

}
