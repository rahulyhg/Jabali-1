<?php 
/**
* @class REST
* @see https://jabalicms.org/restful/
* @return mixed JSON string of requested resource
* @since 0.17.10
* @author Mauko Maunde
* @license MIT - https://opensource.org/licenses/MIT
*/

namespace Jabali\Lib;

class REST
{
  public $request;
  public $retval;

  public function __construct( array $request = [] )
  {
    $this -> request = $request;
  }

  public function render()
  {
    header('Content-Type:Application/json' );
    echo( json_encode( $this -> retval ) );
  }

  public function process( $elements )
  {
  }

  public function api()
  {
  }

  public function themes()
  {
  }
}