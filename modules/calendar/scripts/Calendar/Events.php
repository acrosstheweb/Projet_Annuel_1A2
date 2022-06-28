<?php

namespace Calendar;

require_once '../../../functions.php';


class Events{

    private $pdo;

    public function __construc(){
        $pdo = database();
        $this->pdo = $pdo;
    }

    /**
     * Retourne un tableau comportant les évènements commençant entre 2 dates
     * @param \Datetime $start
     * @param \Datetime $end
     * @return array
     */
    public function getEventsBetween(\Datetime $start, \Datetime $end): array {
        require_once '../../../functions.php';
        $this->pdo = database();

        $req = $this->pdo->query("SELECT * FROM RkU_BOOKING WHERE startDate 
                            BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY startDate ASC");

        $results = $req->fetchAll();

        return $results;
    }


    /**
     * Retourne un tableau comportant les évènements commençant entre 2 dates indexé par jour
     * @param \Datetime $start
     * @param \Datetime $end
     * @return array
     */
    public function getEventsBetweenByDay(\Datetime $start, \Datetime $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event){
            $date = explode(' ', $event['startDate'])[0];
            if(!isset($days[$date])){
                $days[$date] = [$event];
            }
            else{
                $days[$date][] = $event;
            } 
        }

        return $days;
    }



}