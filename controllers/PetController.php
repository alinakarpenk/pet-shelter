<?php

namespace controllers;
use models\User;
use models\Pet;
use core\Controller;
use models\Category;
use models\UsersPets;

class PetController extends Controller
{
    public function actionAdd()
    {
        $user = new User();
        if (!$user->isAdmin()) {
            return $this->redirect('/');
        }
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategory();
        if ($this->Post) {
            $image = $_FILES['image'];
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $categoryId = isset($_POST['category']) ? intval($_POST['category']) : null;
            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $photo = $uploadDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $photo)) {
                    $petModel = new Pet();
                    if ($petModel->addPet($photo, $name, $description,  $categoryId)) {
                        return $this->redirect('get');
                    }
                }
                return [
                    'Content' => $this->template->getHtml('views/pet/add.php', ['categories' => $categories]),
                    'Title' => "Add Pet"

                ];
            }

        }
        return [
            'Content' => $this->template->getHtml('views/pet/add.php', ['categories' => $categories]),
            'Title' => "Add Pet"
        ];
    }
    public function actionUpdate($params)
    {
        $id = isset($params[0]) ? intval($params[0]) : null;
        $user = new User();
        if (!$user->isAdmin()) {
            return $this->redirect('/');
        }
        $petModel = new Pet();
        $pet = $petModel->getPetById($id);
        if ($this->Post) {
            $image = $_FILES['image'];
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $categoryId = isset($_POST['category']) ? intval($_POST['category']) : null;
            $updateData = [];
            if ($name !== '') {
                $updateData['name'] = $name;
            }
            if ($description !== '') {
                $updateData['description'] = $description;
            }
            if ($categoryId !== null) {
                $updateData['category_id'] = $categoryId;
            }
            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
            }
            if (!empty($updateData)) {
                if ($petModel->updatePet($id, $updateData)) {
                    return $this->redirect('/pet/get');
                }
            }
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Edit Pet"
        ];
    }

    public function actionGet()
    {
        $petsModel = new Pet();
        $pets = $petsModel->getAllPets();
        return [
            'Content' => $this->template->getHtml('views/pet/get.php', ['pets' => $pets]),
            'Title' => "Pets",
            'ShowButtons' => [
                ['content' => "Додати тварину", 'URL' => "/pet/add"]
            ],
        ];
    }
    public function actionDelete($params)
    {
        $id = isset($params[0]) ? intval($params[0]) : null;
        $user = new User();
        if (!$user->isAdmin()) {
            return $this->redirect('/');
        }
        if ($id) {
            $petModel = new Pet();
            $petModel->getPetById($id);
            $petModel->deletePet($id);
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Delete",
        ];
    }

}