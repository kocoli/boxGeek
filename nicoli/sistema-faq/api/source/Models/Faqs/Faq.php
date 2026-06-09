<?php

namespace Source\Models\Faqs;

use PDO;
use Source\Core\Connect;
use Source\Core\Model;

class Faq extends Model
{
    private ?int $id;
    private ?int $categoryId;
    private ?string $question;
    private ?string $answer;

    public function __construct(
        ?int $id = null,
        ?int $categoryId = null,
        ?string $question = null,
        ?string $answer = null
    )
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->question = $question;
        $this->answer = $answer;
    }

    //getters
    public function getId() : ?int {
        return $this->id;
    }

    public function getCategoryId() : ?int {
        return $this->categoryId;
    }

    public function getQuestion() : ?string {
        return $this->question;
    }

    public function getAnswer() : ?string {
        return $this->answer;
    }

    //setters
    public function setId(?int $id) : void {
        $this->id = $id;
    }

    public function setCategoryId(?int $categoryId) : void {
        $this->categoryId = $categoryId;
    }

    public function setQuestion(?string $question) : void {
        $this->question = $question;
    }

    public function setAnswer(?string $answer) : void {
        $this->answer = $answer;
    }

    public function listAll() : ?array {
        $query = "SELECT f.id, f.question, f.answer, fc.name AS category_name FROM faqs f INNER JOIN faqs_categories fc ON fc.id = f.faqs_category_id;";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function findById(): ?array
    {
        $query = "SELECT f.id, f.question, f.answer, fc.name AS category_name FROM faqs f INNER JOIN faqs_categories fc ON fc.id = f.faqs_category_id WHERE f.id = :id";

        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}