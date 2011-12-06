<?php
/**
 * The contentStagingBase class is used to provide common methods to other models.
 *
 * Methods named encodeSomething go from php raw values to json values
 * Methods named decodeSomething go from json values to php raw values
 *
 * @package ezcontentstaging
 *
 * @version $Id$;
 *
 * @author
 * @copyright
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 */

class contentStagingBase
{
    public static function encodeDateTime( $time )
    {
        return gmdate( DATE_ISO8601, $time );
    }

    protected static function decodeDatetIme( $timestring )
    {
        // @todo throw an exception / log a warning ?
        return strtotime( $timestring );
    }

    /**
     * Returns the eZContentObjectTreeNode::SORT_ORDER_* constant corresponding
     * to the $stringSortOrder
     *
     * @param string $stringSortOrder
     * @return int
     */
    protected static function decodeSortOrder( $stringSortOrder )
    {
        // @todo throw an exception if $stringSortOrder is not ASC or DESC ?
        $sortOrder = eZContentObjectTreeNode::SORT_ORDER_ASC;
        if ( $stringSortOrder != 'ASC' )
        {
            $sortOrder = eZContentObjectTreeNode::SORT_ORDER_DESC;
        }
        return $sortOrder;
    }

    /**
     * Returns the eZContentObjectTreeNode::SORT_FIELD_* constant corresponding
     * to the $stringSortField
     *
     * @param string $stringSortField
     * @return int
     */
    protected static function decodeSortField( $stringSortField )
    {
        $field = eZContentObjectTreeNode::sortFieldID( strtolower( $stringSortField ) );
        if ( $field === null )
        {
            // field might be null if sortFieldID does not recognize its
            // parameter
            // @todo throw an exception instead ?
            $field = eZContentObjectTreeNode::SORT_FIELD_PATH;
        }
        return $field;
    }

    static protected function encodeSortOrder( $value )
    {
        return $value == eZContentObjectTreeNode::SORT_ORDER_DESC ? "DESC" : "ASC";
    }

    static protected function encodeSortField( $value )
    {
        $value = strtoupper( eZContentObjectTreeNode::sortFieldName( $value ) );
        return $value;
    }
}
