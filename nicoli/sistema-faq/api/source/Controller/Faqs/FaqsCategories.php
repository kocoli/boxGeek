<?php

namespace Source\Controller\Faqs;

use Source\Controller\Api;
use Source\Models\Faqs\FaqCategory;

class FaqsCategories extends Api{

    public function listAll() : void {
        $faqCategory = new FaqCategory();
        $response = $faqCategory->findAll();

        echo json_encode([
            "code" => 200,
            "type" => "success",
            "status" => "success",
            "message" => "Lista de Categorias da FAQ.",
            "data" => $response
        ]);
    }

    public function findById(array $data) : void {
        $faqCategory = new FaqCategory($data["categoryId"]);
        $response = $faqCategory->findById();

        if (!$response) {
            http_response_code(404);

            echo json_encode([
                "code" => 404,
                "type" => "error",
                "status" => "not_found",
                "message" => "Categoria não encontrada",
                "data" => null
            ]);

            return;
        }

        echo json_encode([
            "code" => 200,
            "type" => "success",
            "status" => "success",
            "message" => "Categoria encontrada!",
            "data" => $response
        ]);
    }

}
