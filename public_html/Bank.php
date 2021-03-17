<?php

class Bank
{
    public function __construct()
    {
    }

    /**
     * Connecting to the database
     *
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     * @return object \PDO
     */
    private function ConnentDB()
    {
        try {
            $db = new PDO('mysql:host=' . DB_HOST .  ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            return $db;
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage();
            die();
        }
    }

    /**
     * Adding an account to the database
     *
     * @return bool
     */
    public function addPersonalAccount()
    {
        $db = $this->ConnentDB();

        $insertStatement = $db->prepare("INSERT INTO `money` (user, personal_account, money) VALUES ('" . (int)$_POST['user'] . "', '" . (int)$_POST['personalAccount'] . "', '" . (int)$_POST['money'] . "')");

        if ($insertStatement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get accounts from the database
     *
     * @return array
     */
    public function getPersonalAccounts()
    {
        $db = $this->ConnentDB();

        $sql = $db->query('SELECT `user`,`personal_account`, `money` FROM `money`');

        return $sql->fetchAll(PDO::FETCH_NUM);
    }

    /**
     * Remove account from the database
     *
     * @return bool
     */
    public function removePersonalAccount()
    {
        $db = $this->ConnentDB();

        foreach ($_POST['userId'] as $key => $value) {
            $sql = $db->query('DELETE FROM `money` WHERE `personal_account` LIKE ' . $value);
            $sql->execute();
        }

        return true;
    }

    /**
     * Editing the user's balance
     *
     * @return bool
     */
    public function editBalance()
    {
        $db = $this->ConnentDB();

        $sql = $db->query('UPDATE `money` SET `money` = ' . (int)$_POST['money'] . ' WHERE `user` LIKE '. (int)$_POST['user']);
        $sql->execute();

        return true;
    }
};
