<?php

class Event {

    private $id;

    private $name;

    private $description;

    private $startDate;

    private $endDate;

    // private "le reste des attributs de la classe BOOKING"

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }
    
    public function getDescription(): string{
        return $this->description;
    }

    public function getStartDate(): \DateTime{
        return new \DateTime($this->startDate);
    }

    public function getEndDate(): \DateTime{
        return new \DateTime($this->endDate);
    }

}