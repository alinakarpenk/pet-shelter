<?php

namespace controllers;

use core\Controller;
use models\Category;
use models\Pet;
use models\User;

class CategoryController extends Controller
{

    public function actionAdd()
    {
        $user = new User();
        if (!$user->isAdmin()) {
            return $this->redirect('/');
        }
        if ($this->Post) {
            $image = $_FILES['image'];
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'categories/';
                $photo = $uploadDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $photo)) {
                    $categoryModel = new Category();
                    if ($categoryModel->addCategory($title, $photo)) {
                        return $this->redirect('get');
                    }
                }
                return [
                    'Content' => $this->template->getHtml(),
                    'Title' => "Add Category"
                ];
            }
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Add Category"
        ];
    }
    public function actionGet()
    {
        $showAllButton = true;
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategory();
        return [
            'Content' => $this->template->getHtml("views/category/get.php",['categories' => $categories]),
            'Title' => "Category",
            'ShowButtons' => [
                ['content' => "Додати нову категорію", 'URL' => "/category/add"]
            ],
            'showAllButton' => $showAllButton

        ];
    }

    public function actionView($params)
    {
        $categoryId = isset($params[0]) ? intval($params[0]) : null;
        if ($categoryId) {
            $petModel = new Pet();
            $categoryModel = new Category();
            $pets = $petModel->getPetsByCategory($categoryId);
            $category = $categoryModel->getCategoryById($categoryId);
            return [
                'Content' => $this->template->getHtml("views/category/view.php", ['pets' => $pets, 'category' => $category]),
                'Title' => "Pets by Category"
            ];
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Pets by Category"
        ];
    }
    public function actionUpdate($params)
    {
        $id = isset($params[0]) ? intval($params[0]) : null;
        $user = new User();
        if (!$user->isAdmin()) {
            return $this->redirect('/');
        }
        $categoryModel = new Category();
        $categoryModel->getCategoryById($id);
        if ($this->Post) {
            $image = $_FILES['image'];
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $updateData = [];
            if ($title !== '') {
                $updateData['title'] = $title;
            }
            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'categories/';
                $photo = $uploadDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $photo)) {
                    $updateData['image'] = $photo;
                }
            }
            if (!empty($updateData)) {
                if ($categoryModel->updateCategory($id, $updateData)) {
                    return $this->redirect('/category/get');
                }
            }
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Edit Category"
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
            $categoryModel = new Category();
            $categoryModel->getCategoryById($id);
            $categoryModel->deleteCategory($id);
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Delete",
        ];
    }

}