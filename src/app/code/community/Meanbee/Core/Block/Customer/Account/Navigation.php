<?php

class Meanbee_Core_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation {

    /**
     * @param $name
     */
    public function removeLink($name) {
        if (isset($this->_links[$name])) {
            unset($this->_links[$name]);
        }
    }

    /**
     * The normal `addLink` method on this class does not allow us to place offsite links into the customer
     * navigation menu.  This method allows us to specify a $url instead of a $path to a page.
     *
     * @param $name
     * @param $url
     * @param $label
     *
     * @return $this
     */
    public function addAbsoluteLink($name, $url, $label) {
        $this->_links[$name] = new Varien_Object(array(
            'name'  => $name,
            'path'  => $url,
            'label' => $label,
            'url'   => $url,
        ));
        return $this;
    }

    /**
     * Add a link to a cms page with the given ID.
     *
     * @param $name
     * @param $id
     * @param $label
     *
     * @return $this
     */
    public function addCmsLink($name, $id, $label) {
        $page_url = Mage::helper("cms/page")->getPageUrl($id);

        if ($page_url) {
            $this->addAbsoluteLink($name, $page_url, $label);
        }

        return $this;
    }

    /**
     * Add a navigation link as usual, but only if the $if parameter is set to true.
     * This is normally used in layout.xml files with the conditional parameter set
     * to <if helper="helper/name/method" /> to retrieve the condition result from
     * a helper method call.
     *
     * @param $name
     * @param $path
     * @param $label
     * @param $if
     *
     * @return $this
     */
    public function addConditionalLink($name, $path, $label, $if) {
        if ($if) {
            $this->addLink($name, $path, $label);
        }

        return $this;
    }
}
