<?php
/**
  @author Krzysztof Ruszczyński <http://www.ruszczynski.eu>
 */
interface KrscReports_Type_Excel_PHPExcel_Style_Iterator_IIterator
{
    public function hasNextElement();
    
    public function getStyleElement();
    
    public function resetIterator();
}
