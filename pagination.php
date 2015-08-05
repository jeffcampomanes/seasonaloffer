<?php
class Paginator
{
    public $itemsPerPage;
    public $range;
    public $navigation;
    private $_total;
    private $_currentPage;
    private $_link;
    private $_pagingHtml;

    public function __construct()
    {
        //set default values
        $this->itemsPerPage = 10;
        $this->range = 10;
        $this->navigation = array(
            'next' => 'Next',
            'pre' => 'Prev'
        );

        //private values
        $this->_currentPage = 1;
        $this->_total = 0;
        $this->_link = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING);
        $this->_pagingHtml = '';
    }

    public function paginate($total)
    {
        // set total records
        $this->_total = $total;
        // get current page
        if (isset($_GET['current'])) {
            $this->_currentPage = $_GET['current'];
        }
        // get pagination html
        $this->_pagingHtml = $this->_getPageNav();
    }

    public function pageNav()
    {
        if (empty($this->_pagingHtml)) {
            exit('Please call function paginate() first.');
        }
        return $this->_pagingHtml;
    }

    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    private function _getPageNav()
    {
        // page nav start and end
        list($start, $end) = $this->_startEndPage();
        return '<div class="pagination"><ul>' . $this->_previousLink($start) . $this->_page($start, $end) . $this->_nextLink($end) . '</ul></div>';
    }

    private function _startEndPage()
    {
        $totalPages = $this->_totalPages();
        $result = array(1, $totalPages);
        if ($totalPages > $this->range) {
            if ($this->_currentPage > ($totalPages - $this->range + 1)) {
                $result[0] = $totalPages - $this->range + 1;
            } else {
                $result[1] = $this->range;
            }
        }
        return $result;
    }

    private function _previousLink($start)
    {
        if ($this->_currentPage > $start) {
            return '<li><a href="' . $this->_link . '?current=' . ($this->_currentPage - 1) . '">' . $this->navigation['pre'] . '</a></li>';
        }
        return '';
    }

    private function _page($start, $end)
    {
        $result = '';
        //loop through page numbers
        for ($i = $start; $i <= $end; $i++) {
            $result .= '<li ' . (($i == $this->_currentPage) ? 'class="disabled"' : "") . '><a href="' . $this->_link . '?current=' . $i . '">' . $i . '</a></li>';
        }
        return $result;
    }

    private function _nextLink($end)
    {
        //next link button
        if ($this->_currentPage < $end) {
            return '<li><a href="' . $this->_link . '?current=' . ($this->_currentPage + 1) . '">' . $this->navigation['next'] . '</a></li>';
        }
        return '';
    }

    private function _totalPages()
    {
        $totalPages = intval($this->_total / $this->itemsPerPage);
        if ($this->_total % $this->itemsPerPage != 0) {
            $totalPages++;
            return $totalPages;
        }
        return $totalPages;
    }
}