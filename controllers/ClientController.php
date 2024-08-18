<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\User;
use core\DataBase;

class ClientController extends Controller
{
public function actionAdd()
{
    $userAuth = new User();
        if ($userAuth->isLogged()) {
            return $this->redirect('/');
        }

    if ($this->Post) {
        $input = json_decode(file_get_contents('php://input'), true);
        $name = isset($input['name']) ? $input['name'] : '';
        $surname = isset($input['surname']) ? $input['surname'] : '';
        $email = isset($input['email']) ? $input['email'] : '';
        $password = isset($input['password']) ? $input['password'] : '';
        $password2 = isset($input['password2']) ? $input['password2'] : '';
        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($password2)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Всі поля повинні бути заповнені']);
            exit;
        }
        if ($password !== $password2) {
                echo json_encode(['success' => false, 'message' => 'Паролі не співпадають']);
                return;
            }
        $userModel = new User();
            $result = $userModel->addUser($name, $surname, $email, $password);
            if ($result) {
                $user = $userModel->verifyUser($email, $password);
                Core::getInstance()->session->set('user', $user);
                header('Content-Type: application/json');
              echo json_encode(['success' => true, 'message' => 'Success']);
              exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Виникла помилка при реєстрації користувача']);
                return;
            }
        }

    return [
        'Content' => $this->template->getHtml(),
        'Title' => "Register"
    ];
}
    public function actionSign()
    {
        $userAuth = new User();
        if ($userAuth->isLogged()) {
            return $this->redirect('/');
        }
        if ($this->Post) {
            $data = json_decode(file_get_contents('php://input'), true);
            $email = isset($data['email']) ? $data['email'] : '';
            $password = isset($data['password']) ? $data['password'] : '';
            $userModel = new User();
            $user = $userModel->verifyUser($email, $password);
            if (!empty($user)) {
                Core::getInstance()->session->set('user', $user);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'ок!']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Перевірте правильність введених даних']);
            }
            exit;
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Sign In"
        ];
    }
    public function actionLogout()
    {
        $userModel = new User();
        $userModel->isLogout();
        return $this->redirect('/client/sign');
    }
}