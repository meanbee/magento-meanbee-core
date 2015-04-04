<?php

class Meanbee_Core_Model_Resource_Setup extends Mage_Catalog_Model_Resource_Setup
{

    /**
     * Create a new CMS static block.
     *
     * @param string $identifier
     * @param string $title
     * @param string $content
     * @param int[]  $stores
     *
     * @return $this
     */
    public function createCmsBlock($identifier, $title, $content, $stores = array(0))
    {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        Mage::getModel("cms/block")
            ->setData(array(
                "identifier" => $identifier,
                "title"      => $title,
                "content"    => $content,
                "is_active"  => 1,
                "stores"     => $stores
            ))
            ->save();

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }

    /**
     * Update an existing CMS block.
     *
     * @param string   $identifier
     * @param array    $data     A key => value list of new data to assign to the block.
     * @param int|null $storeId  Store the block is currently assigned to
     *
     * @return $this
     */
    public function updateCmsBlock($identifier, $data, $storeId = null)
    {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $block = Mage::getModel("cms/block");
        if ($storeId) {
            $block->setStoreId($storeId);
        }
        $block->load($identifier);

        if ($block->getId()) {
            $block
                ->addData($data)
                ->save();
        } else {
            Mage::throwException(sprintf("Can not update CMS block: CMS block '%s' does not exist.", $identifier));
        }

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }

    /**
     * Create a new CMS page.
     *
     * @param string $identifier
     * @param string $title
     * @param string $content
     * @param string $rootTemplate
     * @param string $contentHeading
     * @param string $metaKeywords
     * @param string $metaDescription
     * @param string $layoutUpdateXml
     * @param int[]  $stores
     *
     * @return $this
     */
    public function createCmsPage(
        $identifier,
        $title,
        $content,
        $rootTemplate,
        $contentHeading = "",
        $metaKeywords = "",
        $metaDescription = "",
        $layoutUpdateXml = "",
        $stores = array(0)
    ) {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        Mage::getModel("cms/page")
            ->setData(array(
                "identifier"        => $identifier,
                "title"             => $title,
                "content"           => $content,
                "root_template"     => $rootTemplate,
                "content_heading"   => $contentHeading,
                "meta_keywords"     => $metaKeywords,
                "meta_description"  => $metaDescription,
                "layout_update_xml" => $layoutUpdateXml,
                "is_active"         => 1,
                "stores"            => $stores
            ))
            ->save();

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }

    /**
     * Update an existing CMS page.
     *
     * @param string   $identifier
     * @param array    $data    A key => value list of new data to assign to the page.
     * @param int|null $storeId Store ID the page is currently assigned to.
     *
     * @return $this
     */
    public function updateCmsPage($identifier, $data, $storeId = null)
    {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $page = Mage::getModel("cms/page");
        if ($storeId) {
            $page->getStoreId($storeId);
        }
        $page->load($identifier);

        if ($page->getId()) {
            $page
                ->addData($data)
                ->save();
        } else {
            Mage::throwException(sprintf("Unable to update CMS page: CMS page '%s' does not exist.", $identifier));
        }

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }

    /**
     * Create a new transactional email template.
     *
     * @param string   $templateCode
     * @param string   $templateSubject
     * @param string   $templateText
     * @param int|null $templateType If null when original template is specified,
     *                               will use the same type as original template.
     * @param string   $templateStyles
     * @param string   $originalTemplateCode
     *
     * @return $this
     */
    public function createTransactionalEmail(
        $templateCode,
        $templateSubject,
        $templateText,
        $templateType = Mage_Core_Model_Email_Template::TYPE_HTML,
        $templateStyles = "",
        $originalTemplateCode = ""
    ) {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $template = Mage::getModel("core/email_template");

        $template->setData(array(
            "template_code" => $templateCode,
            "template_subject" => $templateSubject,
            "template_text" => $templateText,
            "template_type" => $templateType,
            "template_styles" => $templateStyles
        ));

        if ($originalTemplateCode) {
            $template->setOrigTemplateCode($originalTemplateCode);

            $originalTemplate = Mage::getModel("core/email_template")->loadDefault($originalTemplateCode);

            if ($originalTemplate->getId()) {
                if (!$templateType) {
                    $template->setTemplateType($originalTemplate->getTemplateType());
                }
                $template->setOrigTemplateVariables($originalTemplate->getOrigTemplateVariables());
            } else {
                Mage::throwException(sprintf("Unable to create transactional email: Original email template '%s' does not exist", $originalTemplateCode));
            }
        }

        $template->save();

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }

    /**
     * Update an existing transactional email template.
     *
     * @param string $code
     * @param array  $data A key => value list of new data to assign to the template.
     *
     * @return $this
     */
    public function updateTransactionalEmail($code, $data)
    {
        $current_store = Mage::app()->getStore();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $template = Mage::getModel("core/email_template")->loadByCode($code);

        if ($template->getId()) {
            $template
                ->addData($data)
                ->save();
        } else {
            Mage::throwException(sprintf("Unable to update transactional email: Email template '%s' does not exist.", $code));
        }

        Mage::app()->setCurrentStore($current_store);
        return $this;
    }
}
