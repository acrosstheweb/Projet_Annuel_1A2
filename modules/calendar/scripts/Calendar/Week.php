<?php

namespace Calendar;

class Week{

    private $months =  ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
    'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; // Je déclare la liste des mois de l'année en français
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    // Je déclare mes variables $month et $year pour pouvoir les utiliser dans plusieurs fonctions
    public $day;
    public $month;
    public $year;

    /**
     * Permet de récupérer le nombre de jours dans le mois
     * @param int $month
     * @param int $year
     * @return int
     */
    public function daysInMonth(int $month, int $year): int{
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            return 31;
        }

        if($month == 4 || $month == 6 || $month == 9 || $month == 11){
            return 30;
        }

        if($month == 2){
            if($year % 4 == 0 && $year % 100 != 0)
                return 29;
            
            return 28;
        }

        return -1;
    }

    /**
     * Month constructor
     * @param int $day      Le jour compris entre 1 et le nombre de jours dans le mois
     * @param int $month    Le mois compris entre 1 et 12
     * @param int $year     L'année
     * @throws \Exception 
     */
    public function __construct(?int $day = null, ?int $month = null, ?int $year = null){
        if($year === null){
            $year = intval(date('Y')); 
        }

        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m')); // par défaut la méthode date renvoie une chaîne de caractère. intval permet de retourner un entier
        }

        if($day === null || $this->daysInMonth($month, $year) == -1 || $day < 1 || $day > $this->daysInMonth($month, $year)){
            $day = intval(date('d'));
        }
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Permet de récupérer le premier jour du mois
     * @return \Datetime
     */
    public function getStartingDay(): \Datetime{
        return new \Datetime("{$this->year}-{$this->month}-{$this->day}");
    }

    /**
     * Retourne le mois en toutes lettres
     * @return string
     */
    public function toString(): string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Renvoie si le jour est dans le mois en cours
     * @param \Datetime $date
     * @return bool
     */
    public function withinMonth(\Datetime $date) : bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Retourne le mois suivant
     * @return Week
     */
    public function nextWeek(): Week {

        $day = $this->day + 7;
        $month = $this->month;
        $year = $this->year;

        if($this->daysInMonth($month, $year) < $day){
            $month++;
            $day = $day % $this->daysInMonth($month - 1, $year);
        }

        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Week($day, $month, $year);
    }

    /**
     * Retourne le mois précédent
     * @return Week
     */
    public function previousWeek(): Week {


        $day = $this->day - 7;
        $month = $this->month;
        $year = $this->year;

        if($day < 1){
            $month--;
            $day = $this->daysInMonth($month, $year) + $day;
        }

        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Week($day, $month, $year);
    }


}