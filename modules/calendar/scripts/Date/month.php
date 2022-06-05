<?php

namespace App\Date;

class Month {

    private $months =  ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
    'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; // Je déclare la liste des mois de l'année en français
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    // Je déclare mes variables $month et $year pour pouvoir les utiliser dans plusieurs fonctions
    public $month;
    public $year;

    /**
     * Month constructor
     * @param int $month    Le mois compris entre 1 et 12
     * @param int $year     L'année
     * @throws \Exception 
     */
    public function __construct(?int $month = null, ?int $year = null ){
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m')); // par défaut la méthode date renvoie une chaîne de caractère. intval permet de retourner un entier
        }
        if($year === null){
            $year = intval(date('Y')); 
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Permet de récupérer le premier jour du mois
     * @return \Datetime
     */
    public function getStartingDay(): \Datetime{
        return new \Datetime("{$this->year}-{$this->month}-01");
    }

    /**
     * Retourne le mois en toutes lettres
     * @return string
     */
    public function toString(): string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }


    /**
     * Retourne le nombre de semaines dans le mois
     * @return int
     */
    public function getWeeks(): int{
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W')) + 1 ; // +1 car la numérotation des semaines ne commencent pas à 0

        /* Pour le mois de janvier, si la semaine ne commence pas un lundi,
        la semaine de début est la dernière semaine de l'année précédente,
        ce qui donne un résultat négatif avec le calcul du dessus */
        
        if($weeks < 0){ 
            $weeks = intval($end->format('W'));
        }
        return $weeks;
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
     * @return Month
     */
    public function nextMonth(): Month {
        $month = $this->month + 1;
        $year = $this->year;
        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**
     * Retourne le mois précédent
     * @return Month
     */
    public function previousMonth(): Month {
        $month = $this->month - 1;
        $year = $this->year;
        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }


}