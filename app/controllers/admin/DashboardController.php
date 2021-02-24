<?php
class Dashboard extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsersCount()
    {
        $stmt = $this->conn->query("SELECT * FROM users");
        return $stmt->rowCount();
    }
    public function getCategoriesCount()
    {
        $stmt = $this->conn->query("SELECT * FROM categories");
        return $stmt->rowCount();
    }
    public function getProductsCount()
    {
        $stmt = $this->conn->query("SELECT * FROM products");
        return $stmt->rowCount();
    }
    public function getReservationsCount()
    {
        $stmt = $this->conn->query("SELECT * FROM reservations");
        return $stmt->rowCount();
    }

    private function getReservations()
    {
        $stmt = $this->conn->query("SELECT * FROM reservations");
        return $stmt->fetchAll();
    }

    public function getReservationCountByMonth()
    {
        $data = [
            'jan' => 0,
            'feb' => 0,
            'mar' => 0,
            'april' => 0,
            'may' => 0,
            'june' => 0,
            'july' => 0,
            'aug' => 0,
            'sept' => 0,
            'oct' => 0,
            'nov' => 0,
            'dec' => 0,
        ];
        $reservations = $this->getReservations();
        foreach ($reservations as $reservation) {
            $date = formatDate($reservation->date_time);
            if (strpos(strtolower($date), 'january') !== false) {
                $data['jan']++;
            } else if (strpos(strtolower($date), 'february') !== false) {
                $data['feb']++;
            } else if (strpos(strtolower($date), 'march') !== false) {
                $data['mar']++;
            } else if (strpos(strtolower($date), 'april') !== false) {
                $data['april']++;
            } else if (strpos(strtolower($date), 'may') !== false) {
                $data['may']++;
            } else if (strpos(strtolower($date), 'june') !== false) {
                $data['june']++;
            } else if (strpos(strtolower($date), 'july') !== false) {
                $data['july']++;
            } else if (strpos(strtolower($date), 'august') !== false) {
                $data['aug']++;
            } else if (strpos(strtolower($date), 'september') !== false) {
                $data['sept']++;
            } else if (strpos(strtolower($date), 'october') !== false) {
                $data['oct']++;
            } else if (strpos(strtolower($date), 'november') !== false) {
                $data['nov']++;
            } else if (strpos(strtolower($date), 'december') !== false) {
                $data['dec']++;
            }
        }
        return $data;
    }
}
