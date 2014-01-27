<?php
/**
 * File containing the eZ\Publish\API\Repository\Values\Content\Query\SortClause\LocationPathString class.
 *
 * @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\API\Repository\Values\Content\Query\SortClause;

use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause;

/**
 * Sets sort direction on the location path string for a content query
 *
 * @deprecated Since 5.3, use Location search instead
 */
class LocationPathString extends SortClause
{
    /**
     * Constructs a new LocationPathString SortClause
     * @param string $sortDirection
     *
     * @deprecated Since 5.3, use Location search instead
     */
    public function __construct( $sortDirection = Query::SORT_ASC )
    {
        parent::__construct( 'location_path_string', $sortDirection );
    }
}
