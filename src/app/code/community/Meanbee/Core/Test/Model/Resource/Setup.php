<?php

class Meanbee_Core_Test_Model_Resource_Setup extends EcomDev_PHPUnit_Test_Case
{

    /** @var Meanbee_Core_Model_Resource_Setup $model */
    protected $model;

    protected function setUp()
    {
        parent::setUp();

        $this->model = new Meanbee_Core_Model_Resource_Setup("meanbee_core_setup");
    }

    protected function tearDown()
    {
        unset($this->model);

        parent::tearDown();
    }

    /**
     * @test
     * @loadFixture
     */
    public function testCreateCmsBlock()
    {
        $this->model->createCmsBlock(
            "test-cms-block",
            "Test Title",
            "Test content"
        );

        $block = Mage::getModel("cms/block")->load("test-cms-block");

        $this->assertNotNull($block->getId(), "Failed to load the newly created CMS block.");

        $this->assertEquals("Test Title", $block->getTitle(), "Created CMS block has incorrect title.");
        $this->assertEquals("Test content", $block->getContent(), "Created CMS block has incorrect content.");
    }

    /**
     * @test
     * @loadFixture
     */
    public function testUpdateCmsBlock()
    {
        $block = Mage::getModel("cms/block")->load("test-cms-block");

        $this->assertNotEquals("New content", $block->getContent(), "CMS block contains incorrect content before update.");

        $this->model->updateCmsBlock("test-cms-block", array("content" => "New content"));

        $block = Mage::getModel("cms/block")->load("test-cms-block");

        $this->assertEquals("New content", $block->getContent(), "CMS block contains incorrect content after update.");
    }

    /**
     * @test
     * @loadFixture
     */
    public function testCreateCmsPage()
    {
        $this->model->createCmsPage(
            "test-cms-page",
            "Test Title",
            "Test content",
            "one_column"
        );

        $page = Mage::getModel("cms/page")->load("test-cms-page");

        $this->assertNotNull($page->getId(), "Failed to load the newly created CMS page.");

        $this->assertEquals("Test Title", $page->getTitle(), "Created CMS page has incorrect title.");
        $this->assertEquals("Test content", $page->getContent(), "Created CMS page has incorrect content.");
    }

    /**
     * @test
     * @loadFixture
     */
    public function testUpdateCmsPage()
    {
        $page = Mage::getModel("cms/page")->load("test-cms-page");

        $this->assertEquals("Test content", $page->getContent(), "CMS page contains incorrect content before update.");
        $this->assertEquals("one_column", $page->getRootTemplate(), "CMS page contains incorrect root template before update.");

        $this->model->updateCmsPage("test-cms-page", array(
            "content" => "New content",
            "root_template" => "two_columns_right"
        ));

        $page = Mage::getModel("cms/page")->load("test-cms-page");

        $this->assertEquals("New content", $page->getContent(), "CMS page contains incorrect content after update.");
        $this->assertEquals("two_columns_right", $page->getRootTemplate(), "CMS page contains incorrect root template after update.");
    }

    /**
     * @test
     * @loadFixture
     */
    public function testCreateTransactionalEmail()
    {
        $this->model->createTransactionalEmail(
            "Test Email",
            "Test Subject",
            "Test content",
            "",
            null,
            "sales_email_order_template"
        );

        $email = Mage::getModel("core/email_template")->loadByCode("Test Email");

        $this->assertNotNull($email->getId(), "Failed to load newly created email.");

        $this->assertEquals("Test Subject", $email->getTemplateSubject(), "Email contains incorrect subject.");
        $this->assertEquals("Test content", $email->getTemplateText(), "Email contains incorrect content.");
        $this->assertEquals("sales_email_order_template", $email->getOrigTemplateCode(), "Email contains incorrect original template code.");
        $this->assertNotNull($email->getOrigTemplateVariables(), "Email is missing original template variables.");
    }

    /**
     * @test
     * @loadFixture
     */
    public function testUpdateTransactionalEmail()
    {
        $email = Mage::getModel("core/email_template")->loadByCode("Test Email");

        $this->assertEquals("Test content", $email->getTemplateText(), "Email contains incorrect content before update.");

        $this->model->updateTransactionalEmail("Test Email", array(
            "template_text" => "New content"
        ));

        $email = Mage::getModel("core/email_template")->loadByCode("Test Email");

        $this->assertEquals("New content", $email->getTemplateText(), "Email contains incorrect content after update.");
    }
}
