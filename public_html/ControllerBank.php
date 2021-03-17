<?php

class ControllerBank
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new Bank();
        $this->view = new View();
    }

    public function bankAction()
    {
        $this->data['{TITLE}'] = 'Банк Петрушина';

        $users = $this->model->getPersonalAccounts();
        $usersTable = "";

        foreach ($users as $key => $value) {
            $usersTable .= '<tr>';

            foreach ($value as $keys => $values) {
                $usersTable .= '<td>' . $values . '</td>';
            }

            $usersTable .= '<td><input type="checkbox" name="userId[]" value="' . $value[1] . '"></td></tr>';
        }

        $this->data['{USERS_TABLE}'] = $usersTable;

        if (isset($_POST['addUser'])) {
            $this->addPersonalAccount();
        }

        if (isset($_POST['deleteUser'])) {
            $this->removePersonalAccount();
        }

        if (isset($_POST['editBalance'])) {
            $this->editBalance();
        }

        $this->view->render('body', $this->data);
    }

    private function addPersonalAccount()
    {
        if ($this->model->addPersonalAccount()) {
            header('Location: /');
            // $this->data['{DATABASE_RESPONSE_ADD}'] = '<p>Запись успешно добавлена в базу данных</p>';
        } else {
            $this->data['{DATABASE_RESPONSE_ADD}'] = '<p>Невозможно создать запись</p>';
        }
    }

    private function removePersonalAccount()
    {
        if (!empty($_POST['userId'])) {
            if ($this->model->removePersonalAccount()) {
                header('Location: /');
                // $this->data['{DATABASE_RESPONSE_REMOVE}'] = '<p>Запись успешна удалена</p>';
            } else {
                $this->data['{DATABASE_RESPONSE_REMOVE}'] = '<p>Невозможно удалить запись</p>';
            }
        } else
        {
            $this->data['{DATABASE_RESPONSE_REMOVE}'] = '<p>Не выбрана ни одна запись</p>';
        }
    }

    private function editBalance(){
        if ($this->model->editBalance()) {
            header('Location: /');
            // $this->data['{DATABASE_RESPONSE_ADD}'] = '<p>Запись успешно добавлена в базу данных</p>';
        } else {
            $this->data['{DATABASE_RESPONSE_ADD}'] = '<p>Произошла ошибка при обновлении баланса</p>';
        }
    }
}
