<?php

namespace Source\Models\Faqs;

use PDO;
use Source\Core\Connect;
use Source\Core\Model;

class FaqCategory extends Model
{
    private ?int $id;
    private ?string $name;

    public function __construct
    (
        ?int $id = null,
        ?string $name = null
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    //Getters
    function getId() : ?int {
        return $this->id;
    }

    function getName() : ?string {
        return $this->name;
    }

    //setters
    function setId(?int $id) : void {
        $this->id = $id;
    }
    
    function setName(?string $name) : void {
        $this->name = $name;
    }

    function findAll() : array {
        $query = "SELECT faqs_categories.id, faqs_categories.name FROM `faqs_categories` WHERE 1;";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(): ?array
    {
        if (filter_var($this->id, FILTER_VALIDATE_INT) === false) {
            $this->errorMessage = "Id inválido";
            return null;
        }
        $query = "SELECT id, name FROM faqs_categories WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}