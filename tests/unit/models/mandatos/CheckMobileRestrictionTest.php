<?php

namespace tests\unit\models\mandatos;

use app\models\Mandatos\Mandato;
use Yii;

class CheckMobileRestrictionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    /* public function testPhoneIsFromDealership()
    {
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
        $this->tester->assertEquals(true, Mandato::checkMobileRestriction(603666666, 'nif_concesionario'));
    } */
}
