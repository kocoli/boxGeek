<?php

namespace Source\Controller\Faqs;

use Source\Controller\Api;
use Source\Models\Faqs\Faq;
use Source\Models\Faqs\FaqCategory;

class Faqs extends Api {
    public function listAll(): void
    {
        $faq = new Faq();

        echo json_encode([
            "code" => 200,
            "type" => "success",
            "status" => "success",
            "message" => "Lista de FAQs",
            "data" => $faq->listAll()
        ]);
    }

    public function findById(array $data): void
    {
        if (
            !isset($data["faqId"]) ||
            filter_var($data["faqId"], FILTER_VALIDATE_INT) === false
        ) {
            http_response_code(400);
    
            echo json_encode([
                "code" => 400,
                "type" => "error",
                "status" => "bad_request",
                "message" => "ID do FAQ é obrigatório e deve ser um número inteiro",
                "data" => null
            ]);
    
            return;
        }
    
        $faq = new Faq((int)$data["faqId"]);
    
        $response = $faq->findById();
    
        if (!$response) {
            http_response_code(404);
    
            echo json_encode([
                "code" => 404,
                "type" => "error",
                "status" => "not_found",
                "message" => "FAQ não encontrado",
                "data" => null
            ]);
    
            return;
        }
    
        echo json_encode([
            "code" => 200,
            "type" => "success",
            "status" => "success",
            "message" => "FAQ encontrado",
            "data" => $response
        ]);
    }
}