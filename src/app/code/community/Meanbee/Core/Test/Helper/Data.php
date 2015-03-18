<?php

class Meanbee_Core_Test_Helper_data extends EcomDev_PHPUnit_Test_Case {
    /** @var Meanbee_Core_Helper_Data */
    protected $_helper;

    public function setUp() {
        $this->_helper = new Meanbee_Core_Helper_Data();
    }

    public function tearDown() {
        $this->_helper = null;
    }

    /**
     * @test
     */
    public function testFactory() {
        $this->assertInstanceOf('Meanbee_Core_Helper_Data', Mage::helper('meanbee_core'));
    }
}
