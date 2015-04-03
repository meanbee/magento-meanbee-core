<?php
/**
 * Class Meanbee_Core_Model_System_Config_Source_Cms_Block
 */
class Meanbee_Core_Model_System_Config_Source_Cms_Block implements Meanbee_Core_Model_System_Config_SourceModel
{
    /**
     * Return a source model array containing all static blocks defined in the system.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        $blocks = Mage::getModel('cms/block')->getCollection()
            ->addFieldToFilter('is_active', 1);

        foreach ($blocks as $block) {
            /** @var Mage_Cms_Model_Block $block */
            $options[] = array(
                'value' => $block->getIdentifier(),
                'label' => sprintf("%s (id: %s)", $block->getTitle(), $block->getIdentifier())
            );
        }

        return $options;
    }
}
