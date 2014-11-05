<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes as BaseAttributes;

/**
 * Class Attributes
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 *
 * @Annotation
 */
class Attributes extends BaseAttributes {
    const TABLE_LABELS_MODE_TOP    = 1;
    const TABLE_LABELS_MODE_BOTTOM = 2;
    const TABLE_LABELS_MODE_BOTH   = 3;
    const SHOW_RESULTS_MODE_ALWAYS = 4;
    const SHOW_RESULTS_MODE_AFTER_SEARCH = 5;
    const SHOW_RESULTS_MODE_NEVER  = 6;

    const SHWO_FILTERS_TYPE = 'gridbuilder.show_filters_type';
    const SHOW_RESULTS_INFO = 'gridbuilder.show_results_info';
    const SHOW_TABLE_LABELS = 'gridbuilder.show_table_labels';
    const TABLE_LABELS_MODE = 'gridbuilder.table_labels_mode';
    const SHOW_RESULTS_MODE = 'gridbuilder.show_results_mode';

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->showFiltersType();
        $this->showResultsInfo();
        $this->showTableLabels();
        $this->setTableLabelsMode(self::TABLE_LABELS_MODE_BOTH);
        $this->setResultsMode(self::SHOW_RESULTS_MODE_ALWAYS);
    }

    public function showTableLabels() {
        $this->set(self::SHOW_TABLE_LABELS, true);
    }

    public function hideTableLabels() {
        $this->set(self::SHOW_TABLE_LABELS, false);
    }

    public function showFiltersType() {
        $this->set(self::SHWO_FILTERS_TYPE, true);
    }

    public function hideFiltersType() {
        $this->set(self::SHWO_FILTERS_TYPE, false);
    }

    public function showResultsInfo() {
        $this->set(self::SHOW_RESULTS_INFO, true);
    }

    public function hideResultsInfo() {
        $this->set(self::SHOW_RESULTS_INFO, false);
    }

    /**
     * @return boolean
     */
    public function isVisibleFiltersType() {
        return $this->get(self::SHWO_FILTERS_TYPE);
    }

    /**
     * @return boolean
     */
    public function isVisibleResultsInfo() {
        return $this->get(self::SHOW_RESULTS_INFO);
    }

    /**
     * @return boolean
     */
    public function isVisibleTableLabels() {
        return $this->get(self::SHOW_TABLE_LABELS);
    }

    /**
     * @param int $mode
     */
    public function setTableLabelsMode($mode = self::TABLE_LABELS_MODE_BOTH) {
        $this->set(self::TABLE_LABELS_MODE, (int) $mode);
    }

    /**
     * @return int
     */
    public function getTableLabelsMode() {
        return $this->get(self::TABLE_LABELS_MODE);
    }

    /**
     * @param int $mode
     */
    public function setResultsMode($mode = self::SHOW_RESULTS_MODE_ALWAYS) {
        $this->set(self::SHOW_RESULTS_MODE, (int) $mode);
    }

    /**
     * @return int
     */
    public function getShowResultsMode() {
        return $this->get(self::SHOW_RESULTS_MODE);
    }
}