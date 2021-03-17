<body>
    <div class="container">
        <div class="flex-first-column">
            <div class="adding-personal-account">
                <form action="" method="POST">
                    {DATABASE_RESPONSE_ADD}
                    <h2>Добавление лицевого счета</h2>
                    <div>
                        <label>Номер абонента</label>
                        <input type="text" name="user">
                    </div>
                    <div>
                        <label>Лицевой счет</label>
                        <input type="text" name="personalAccount">
                    </div>
                    <div>
                        <label>Стартовый баланс</label>
                        <input type="text" name="money">
                    </div>
                    <div>
                        <input type="submit" name="addUser" value="Добавить">
                    </div>
                </form>
            </div>
            <div class="editing-balance">
                <form action="" method="POST">
                    {DATABASE_RESPONSE_EDIT}
                    <h2>Редактирование баланса</h2>
                    <div>
                        <label>Номер абонента</label>
                        <input type="text" name="user">
                    </div>
                    <div>
                        <label>Баланс</label>
                        <input type="text" name="money">
                    </div>
                    <div>
                        <input type="submit" name="editBalance" value="Изменить">
                    </div>
                </form>
            </div>
        </div>
        <div class="flex-second-column">
            <div class="deleting-personal-account">
                {DATABASE_RESPONSE_REMOVE}
                <form action="" method="POST">
                    <h2>Удаление лицевого счета</h2>
                    <table border="1">
                        <tr>
                            <th class="sorting">Номер абонента</th>
                            <th class="sorting">Номер лицевого счета</th>
                            <th class="sorting">Баланс</th>
                            <th class="sorting"><input type="checkbox"></th>
                        </tr>
                        {USERS_TABLE}
                    </table>

                    <div>
                        <input type="submit" name="deleteUser" value="Удалить">
                    </div>
                </form>
            </div>
        </div>

    </div>


    <link rel="stylesheet" href="{TEMPLATE_SRC}css/main.min.css">
    <script src="{TEMPLATE_SRC}js/scripts.min.js"></script>
</body>