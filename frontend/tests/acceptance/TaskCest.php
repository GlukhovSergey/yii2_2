<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TaskCest
{
    public function checkTask(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->seeLink('Login');
        $I->click('Login');
        $I->wait(2); // wait for page to be opened

        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '123456');
        $I->click('Login', '.btn');
        $I->wait(2);

        $I->amOnPage(Url::toRoute('/tasks/index'));
        $I->see('Tasks');

        $I->seeLink('Новая задача');
        $I->click('Новая задача');
        $I->wait(2); // wait for page to be opened

        $I->see('Description');

        $I->fillField('Tasks[name]', 'Тестовая задача');
        $I->fillField('Tasks[status_id]', 'Новая');
        $I->fillField('Tasks[responsible_id]', 'admin');
        $I->fillField('Tasks[description]', 'Создать тестовую задачу через приемочный автотест');

        $I->click('Сохранить');
    }
}
