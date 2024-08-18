<?php

namespace controllers;

use core\Controller;
use models\Donat;
use core\Core;
use models\User;


class DonatController extends Controller
{
    public function actionIndex()
    {
        if ($this->Post) {
            Core::getInstance()->session->set('amount', isset($_POST['amount']) ? $_POST['amount'] : '');
           return $this->redirect('/donat/send');
        }
        return [
            'Content' => $this->template->getHtml(),
            'Title' => "Donat"
        ];

    }
    public function actionSend()
    {
        $amount = Core::getInstance()->session->get('amount');
        if ($this->Post) {
            $input = json_decode(file_get_contents('php://input'), true);
            $name = isset($input['name']) ? $input['name'] : '';
            $email = isset($input['email']) ? $input['email'] : '';
            $card_number = isset($input['card_number']) ? $input['card_number'] : '';
            $date = isset($input['date']) ? $input['date'] : '';
            $cvv = isset($input['cvv']) ? $input['cvv'] : '';
            if (empty($name) || empty($email) || empty($card_number) || empty($date) || empty($cvv)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Всі поля повинні бути заповнені']);
                exit;
            }
            $donat = new Donat();
            $donat->addDonate($name, $email, $card_number, $cvv, $date, $amount);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Дякуємо за вашу пожертву!']);
            exit;
        }
        return [
            'Content' => $this->template->getHtml('views/donat/send.php', ['amount' => $amount]),
            'Title' => "Send"
        ];
    }

    public function actionReport()
    {
        $user = new User();
        if (!($user->isAdmin())) {
            return $this->redirect('/');
        }
        $donatModel = new Donat();
        $donat = $donatModel->getAllDonate();
        return [
            'Content' => $this->template->getHtml('views/donat/report.php', ['donat'=>$donat]),
            'Title' => "Report"
        ];
    }

//    public function some()
//    {
//        Core::getInstance()->session->set('amount', isset($_POST['amount']) ? $_POST['amount'] : '');
//    }

}