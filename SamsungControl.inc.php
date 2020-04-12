<?php

/*******************************************************************************
 * Class to control Samsung Smart TV
 * Written by D.Sanchez based on a work of Mike Szymaniak
 * ( http://sc0ty.pl/2012/02/samsung-tv-network-remote-control-protocol/ ).
 * This code is published under the EUPL v1.2, if you did not get a copy,
 * you can get one at
 * https://joinup.ec.europa.eu/collection/eupl/eupl-guidelines-faq-infographics
 ********************************************************************************/

class SamsungControl {

  private $cSocket=''; //Store Socket
  private $cConnection=''; // Store Connection

  function __construct( $tmpDestIP, $tmpSourceIP, $tmpSourceMac, $tmpTVModel ) { //Constructor
    //The first step is the authentication part. If this is the first time you use this code, the TV ask for permission to execute.
    //Create a socket to be user whithin the class instance
    $this->cSocket     = socket_create( AF_INET, SOCK_STREAM, 0 ) or die ( "Error creating socket! <br>" );
    //Create a connection whithin the socket
    $this->cConnection = socket_connect( $this->cSocket, $tmpDestIP, 55000 ) or die( "Error connecting to server! <br>" );
    //I'll put this on separate lines for clarity, see http://sc0ty.pl/2012/02/samsung-tv-network-remote-control-protocol/ for a detailed protocol description
    $tmpPayLoad = "\x64\x00".
      chr( strlen( base64_encode( $tmpSourceIP ) )).
      "\x00".
      base64_encode( $tmpSourceIP ).
      chr( strlen( base64_encode( $tmpSourceMac ) )).
      "\x00".
      base64_encode( $tmpSourceMac ).
      chr( strlen( base64_encode( "PHP Remote Class v1.0" ) )).
      "\x00".
      base64_encode( "PHP Remote Class v1.0" );
    $tmpMyHeader =
      "\x00".
      chr( strlen( "php.iapp.samsung" )).
      "\x00".
      "php.iapp.samsung".
      chr( strlen( $tmpPayLoad )).
      "\x00".
      $tmpPayLoad;
    //Send data to the TV set
    socket_write($this->cSocket, $tmpMyHeader, strlen($tmpMyHeader)) or die("Error: Could not send header!\n");
    //Read out Response (for now we are not doin anything with it)
    $tmpResponse = socket_read ($this->cSocket, 64) or die("Error: Could not read header response!\n");
  }

  public function send( $tmpKey ) { //Send a message to server
    //Again separate lines for clarity, same as above
    $tmpPayLoad =
      "\x00\x00\x00".
      chr( strlen( base64_encode( $tmpKey ) )).
      "\x00".
      base64_encode( $tmpKey );
    $tmpMessage =
      "\x00\x00\x00".
      chr( strlen( $tmpPayLoad ) ).
      "\x00".
      $tmpPayLoad ;
    //Send data to TV
    socket_write($this->cSocket, $tmpMessage, strlen($tmpMessage)) or die("Error: Could not send header!\n");
    //Read response
    $tmpResponse = socket_read ($this->cSocket, 64) or die("Error: Could not read header response!\n");
  }

  function __destruct() {
    socket_close( $this->cSocket );
  }
}

?>
