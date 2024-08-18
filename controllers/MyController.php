<?php

namespace controllers;

use core\Core;
use models\Pet;
use models\User;
use models\UsersPets;

class MyController extends \core\Controller
{

    public function actionView()
    {
        $user = new User();
        if (!($user->isLogged())) {
            return $this->redirect('/');
        }
        $userId = Core::getInstance()->session->get('user')['id'];
        if ($userId) {
            $petModel = new UsersPets();
            $favoritePets = $petModel->getAll($userId);
        } else {
            $favoritePets = [];
        }
        return [
            'Content' => $this->template->getHtml('views/my/view.php', ['favoritePets' => $favoritePets]),
            'Title' => "Favorite Pets"
        ];
    }
    public function actionPet($params)
    {
        $id = isset($params[0]) ? intval($params[0]) : null;
        $user = new User();
        if ($user->isLogged()) {
            $userId = Core::getInstance()->session->get('user')['id'];
            if ($id && $userId) {
                $petModel = new UsersPets();
                $pet = new Pet();
                if (!$petModel->isFavourite($userId, $id)) {
                    $petData = $pet->getPetById($id);
                    if ($petData) {
                        $petModel->addFavouritePet($userId, $id, $petData['image'], $petData['name'], $petData['description'], $petData['category_id']);
                        $pet->deletePet($id);
                    }
                }
                return $this->redirect('/my/view');
            }
        }
        return $this->redirect('/');
    }

    public function actionDelete($params)
    {
        $user = new User();
        if ($user->isLogged()) {
            $userId = Core::getInstance()->session->get('user')['id'];
            $petId = isset($params[0]) ? intval($params[0]) : null;
            if ($petId && $userId) {
                $petFavourite = new UsersPets();
                $petDataArray = $petFavourite->getPetById($petId);
                if (!empty($petDataArray) && isset($petDataArray[0])) {
                    $petData = $petDataArray[0];
                    $pet = new Pet();
                    $pet->addPet($petData['image'], $petData['name'], $petData['description'], $petData['category_id']);
                    $petFavourite->deleteFavouritePet($userId, $petId);
                }
            }
        }
        return $this->redirect('/my/view');
    }
    public function actionReport()
 {
    $user = new User();
    if (!($user->isAdmin())) {
        return $this->redirect('/');
    }
        $petModel = new UsersPets();
        $favoritePets = $petModel->getAdoptedPetsWithUsers();

    return [
        'Content' => $this->template->getHtml('views/my/report.php', ['favoritePets' => $favoritePets]),
        'Title' => "Adoption Report"
    ];
 }

}
