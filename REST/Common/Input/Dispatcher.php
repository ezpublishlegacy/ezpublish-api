<?php
/**
 * File containing the Input Dispatcher class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\API\REST\Common\Input;
use eZ\Publish\API\REST\Common\Message;

/**
 * Input dispatcher
 */
class Dispatcher
{
    /**
     * Array of handlers
     *
     * Structure:
     *
     * <code>
     *  array(
     *      <type> => <handler>,
     *      …
     *  )
     * </code>
     *
     * @var array
     */
    protected $handlers = array();

    /**
     * @var ParsingDispatcher
     */
    protected $parsingDispatcher;

    /**
     * Construct from optional parsers array
     *
     * @param ParsingDispatcher $parsingDispatcher
     * @param array $parsers
     * @return void
     */
    public function __construct( ParsingDispatcher $parsingDispatcher, array $handlers = array() )
    {
        $this->parsingDispatcher = $parsingDispatcher;
        foreach ( $handlers as $type => $handler )
        {
            $this->addHandler( $type, $handler );
        }
    }

    /**
     * Add another handler for the given Content Type
     *
     * @param string $type
     * @param Handler $handler
     * @return void
     */
    public function addHandler( $type, Handler $handler )
    {
        $this->handlers[$type] = $handler;
    }

    /**
     * Parse provided request
     *
     * @param Message $message
     * @return mixed
     */
    public function parse( Message $message )
    {
        if ( !isset( $message->headers['Content-Type'] ) )
        {
            throw new \RuntimeException( 'Missing Content-Type header in message.' );
        }

        $contentTypeParts = explode( '+', $message->headers['Content-Type'] );
        if ( count( $contentTypeParts ) !== 2 )
        {
            throw new \RuntimeException( "No format specification in content type. Missing '+(json|xml|…)' in '{$contentType}'." );
        }

        $media  = $contentTypeParts[0];
        $format = $contentTypeParts[1];

        if ( !isset( $this->handlers[$format] ) )
        {
            throw new \RuntimeException( "Unknown format specification: '{$format}'." );
        }

        $rawArray = $this->handlers[$format]->convert( $message->body );
        return $this->parsingDispatcher->parse(
            // Only 1 XML root node
            reset( $rawArray ), $media
        );
    }
}

