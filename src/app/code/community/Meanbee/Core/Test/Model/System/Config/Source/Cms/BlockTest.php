<?php

class Meanbee_Core_Test_Model_System_Config_Source_Cms_BlockTest extends EcomDev_PHPUnit_Test_Case
{
    /** @var Meanbee_Core_Model_System_Config_Source_Cms_Block */
    protected $model;

    public function setUp()
    {
        $this->model = new Meanbee_Core_Model_System_Config_Source_Cms_Block();
    }

    public function tearDown()
    {
        $this->model = null;
        $this->deleteAllStaticBlocks();
    }

    /**
     * @test
     */
    public function testOnlyDefaultValueWhenNoStaticBlocks()
    {
        $this->deleteAllStaticBlocks();

        $static_blocks = $this->model->toOptionArray();

        $this->assertInternalType('array', $static_blocks);
        $this->assertCount(1, $this->model->toOptionArray());
    }

    /**
     * @test
     */
    public function testDefaultValueHasNoValue()
    {
        $this->deleteAllStaticBlocks();

        $static_blocks = $this->model->toOptionArray();

        $static_block = $static_blocks[0];

        $this->assertArrayHasKey('label', $static_block);
        $this->assertArrayHasKey('value', $static_block);

        $this->assertEquals("", $static_block['value']);
    }

    /**
     * @test
     * @loadFixture
     */
    public function testMultipleCmsBlocksReturned()
    {
        $static_blocks = $this->model->toOptionArray();

        $this->assertInternalType('array', $static_blocks);
        $this->assertCount(4, $this->model->toOptionArray());
    }

    /**
     * @test
     * @loadFixture
     */
    public function testReturnsKeyValues()
    {
        $static_blocks = $this->model->toOptionArray();

        $this->assertInternalType('array', $static_blocks);
        $this->assertCount(2, $this->model->toOptionArray());

        $static_block = $static_blocks[1];

        $this->assertArrayHasKey('label', $static_block);
        $this->assertArrayHasKey('value', $static_block);

        $this->assertEquals("Test CMS Block (id: test_block)", $static_block['label']);
        $this->assertEquals("test_block", $static_block['value']);
    }

    /**
     * @test
     * @loadFixture
     */
    public function testDoesNotReturnDisabledBlocks()
    {
        $static_blocks = $this->model->toOptionArray();

        $this->assertInternalType('array', $static_blocks);
        $this->assertCount(3, $this->model->toOptionArray());
    }

    protected function deleteAllStaticBlocks()
    {
        foreach (Mage::getModel('cms/block')->getCollection() as $block) {
            /** @var Mage_Cms_Model_Block $block */
            $block->delete();
        }
    }
}
