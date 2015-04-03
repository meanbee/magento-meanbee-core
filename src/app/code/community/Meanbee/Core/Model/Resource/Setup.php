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
        return $this;
    }

    /**
     * Update an existing CMS block.
     *
     * @param string $identifier
     * @param array  $data A key => value list of new data to assign to the block.
     *
     * @return $this
     */
    public function updateCmsBlock($identifier, $data)
    {
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
        return $this;
    }

    /**
     * Update an existing CMS page.
     *
     * @param string $identifier
     * @param array  $data A key => value list of new data to assign to the page.
     *
     * @return $this
     */
    public function updateCmsPage($identifier, $data)
    {
        return $this;
    }

    /**
     * Create a new transactional email template.
     *
     * @param string $templateCode
     * @param string $templateSubject
     * @param string $templateText
     * @param string $templateStyles
     * @param string $originalTemplateCode
     *
     * @return $this
     */
    public function createTransactionalEmail(
        $templateCode,
        $templateSubject,
        $templateText,
        $templateStyles = "",
        $originalTemplateCode = ""
    ) {
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
        return $this;
    }
}