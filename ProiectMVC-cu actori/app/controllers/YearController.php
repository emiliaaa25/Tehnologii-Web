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

}
