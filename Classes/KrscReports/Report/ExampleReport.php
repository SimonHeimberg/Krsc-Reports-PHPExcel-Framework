<?php
use KrscReports\Report;

/**
 * This file is part of KrscReports.
 *
 * Copyright (c) 2020 Krzysztof Ruszczyński
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @category KrscReports
 * @package KrscReports_Report
 * @copyright Copyright (c) 2020 Krzysztof Ruszczyński
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version 2.1.0, 2020-02-24
 */

/**
 * Abstract class for creation of example reports.
 * 
 * @category KrscReports
 * @package KrscReports_Report
 * @author Krzysztof Ruszczyński <http://www.ruszczynski.eu>
 */
abstract class KrscReports_Report_ExampleReport
{
    /**
     * name of input field, with report id to generate
     */
    const INPUT_REPORT_ID = 'report_id';

    /**
     * name of optional input field, decides which settings (vendor) are used to generate report
     */
    const INPUT_SETTINGS_NAME = 'vendor_name';

    /**
     * @var array numeric table with instances of KrscReports_Report_ExampleReport
     */
    static protected $_aReports;

    static public function createObjects()
    {
        new KrscReports_Report_ExampleReportNoStyles();
        new KrscReports_Report_ExampleReportBasicStyles();
        new KrscReports_Report_ExampleReportManyStyles();
        new KrscReports_Report_ExampleReportManyTables();
        new KrscReports_Report_ExampleReportTableWithSums();
        new KrscReports_Report_ExampleReportVariousPlaces();
        new KrscReports_Report_ExampleReportDifferentStyles();
        new KrscReports_Report_ExampleReportDifferentCellStyles();
        new KrscReports_Report_ExampleReportChartPie();
        new KrscReports_Report_ExampleReportDifferentSizes();
        new Report\ExampleReportManyRows();
        new Report\ExampleReportPassFailTests();
        new Report\ExampleReportTableWithFiltering();
        new Report\ExampleReportTableWithGraph();
        new Report\ExampleReportComposite();
    }

    /**
     * Method returning array with report objects.
     * @return array numeric table with instances of KrscReports_Report_ExampleReport
     */
    static public function getReportArray()
    {
        return self::$_aReports;
    }

    /**
     * Method creates report from object which was stored with given on input position.
     * @param integer $iPosition position of object for generating report
     * @throws Exception thrown when requested object doesn't exist
     */
    static public function generateReport( $iPosition )
    {
        if( isset( self::$_aReports[$iPosition] ) )
        {
            self::$_aReports[$iPosition]->generate();
        }
        else
        {
            throw new Exception( 'Requested report doesn\'t exist!' );
        }
    }

    /**
     * Add newly constructed object to list of objects with reports
     * @return void
     */
    public function __construct()
    {
        self::$_aReports[] = $this;
    }

    /**
     * Method returns description of generated by that object worksheet.
     * @return string description of report
     */
    abstract public function getDescription();

    /**
     * Method responsible for creating object with generated report.
     * @return void
     */
    abstract public function generate();
}
