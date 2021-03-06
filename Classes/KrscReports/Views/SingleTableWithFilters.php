<?php
namespace KrscReports\Views;

/**
 * This file is part of KrscReports.
 *
 * Copyright (c) 2017 Krzysztof Ruszczyński
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
 * @package KrscReports
 * @copyright Copyright (c) 2017 Krzysztof Ruszczyński
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version 1.2.0, 2017-10-13
 */

/**
 * Report consisting of table and another table with filters used for the first one.
 * 
 * @category KrscReports
 * @package KrscReports
 * @author Krzysztof Ruszczyński <http://www.ruszczynski.eu>
 */
class SingleTableWithFilters extends SingleTable
{
    /**
     * compatible with value 
     */
    const KEY_FILTERS = 'filters';
    
    /**
     * key in options for array with selected filters values
     */
    const KEY_FILTERS_VALUES = 'filters_values';
    
    /**
     * key in options for filter table title
     */
    const KEY_FILTER_TABLE_TITLE = 'title_filter_table';
    
    protected function getFilterTableBuilder()
    {
        $translatedColumns = $this->columnTranslator->translateColumns( $this->options[self::KEY_FILTERS], $this->options[self::KEY_TRANSLATOR_DOMAIN] );
        $legendRowFilterValues = $this->options[self::KEY_FILTERS_VALUES];
        
        $filterData = $this->addColumnNames( array( $legendRowFilterValues ), $translatedColumns );
        
        $builder = new \KrscReports_Builder_Excel_PHPExcel_TableTitle();
        $builder->setTitle( ( isset( $this->options[self::KEY_SINGLE_TABLE_TITLE] ) ? $this->options[self::KEY_SINGLE_TABLE_TITLE] : 'Filters' ) );
        $builder->setCellObject( $this->getCell() );        
        $builder->setData( $filterData );
        
        return $builder;
    }
    
    public function getDocumentElement( $spreadsheetName = 'Results with filters' )
    {
        $builderLegend = $this->getFilterTableBuilder();
        $builder = $this->getSingleTableBuilder( $spreadsheetName );
        
        $this->options[self::KEY_COLUMN_LINES_BETWEEN_ELEMENTS] = 1;
        
        $this->setTableElement($builderLegend, $spreadsheetName);
        $this->setTableElement($builder, $spreadsheetName);
        
        return $this->documentElement; 
    }
}

