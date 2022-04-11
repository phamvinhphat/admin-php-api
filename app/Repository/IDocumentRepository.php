<?php

namespace App\Repository;

interface IDocumentRepository
{
    public function getAllDocument();
    public function getAllDocumentAndStatus();
    public function createDocument($data);
    public function findDocumentById($id);
    public function deleteDocumentById($id);
    public function findDocumentByIdUser($id);
    public function checkIdDocument($id);
    public function updateDocumentById($id, array $data);
    public function findStatusByIdDocument($id);
}
