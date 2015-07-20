<?php

/**
 * File containing the eZ\Publish\API\Repository\Values\Content\LocationList class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */

namespace eZ\Publish\API\Repository\Values\Content;

use eZ\Publish\API\Repository\Values\ValueObject;

/**
 * This class represents a queried location list holding a totalCount and a partial list of locations
 * (by offset/limit parameters and permission filters).
 *
 * @property-read int $totalCount - the total count of found locations (filtered by permissions)
 * @property-read \eZ\Publish\API\Repository\Values\Content\Location[] $locations - the partial list of locations controlled by offset/limit
 **/
class LocationList extends ValueObject
{
    /**
     * the total count of found locations (filtered by permissions).
     *
     * @var int
     */
    protected $totalCount;

    /**
     * the partial list of locations controlled by offset/limit.
     *
     * @var \eZ\Publish\API\Repository\Values\Content\Location[]
     */
    protected $locations;
}
