<?php

namespace tests\unit\models\mandatos;

use app\models\Mandatos\Mandato;
use app\tests\fixtures\LimitPhoneFixture;
use app\tests\fixtures\MandatosFixture;
use app\tests\fixtures\UserFixture;
use Yii;

class CheckMobileRestrictionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;
    
    public function testPhoneIsFromDealership()
    {
        Yii::$app->user->loginByAccessToken('B-D28eL7zz6-BSx8Gx-E2GGdT3vEmhsy'); //authkey
        sleep(1);
        $this->tester->assertEquals(287, Yii::$app->user->id);
        $this->tester->assertEquals(true, Mandato::checkMobileRestriction(699276879, '71300615V'));
    }

    public function testPhoneRegisteredAsInfinity()
    {
        $this->tester->assertEquals(true, Mandato::checkMobileRestriction(666555666, 'nif_concesionario'));
    }

    public function testPhoneWithAnEstablishedLimit()
    {
        $this->tester->assertEquals(true, Mandato::checkMobileRestriction(678325575, 'nif_concesionario'));
    }

    public function testPhoneNotRegistered()
    {
        $this->tester->assertEquals(true, Mandato::checkMobileRestriction(678325577, 'nif_concesionario'));
    }

    public function testPhoneWithThreeMandatesInOkStatus()
    {
        $this->tester->assertEquals(false, Mandato::checkMobileRestriction(603666666, 'nif_concesionario'));
    }
}
