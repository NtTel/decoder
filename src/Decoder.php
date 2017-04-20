<?php
namespace Sourcecop;

/**
*  DecoderException
*
*  SourceCop Decoder Exception object.
*
*  @author Gary MacDougall
*/
class DecoderException extends \Exception { }

/**
*  Decoder
*
*  SourceCop Decoder object.
*
*  @author Gary MacDougall
*/
class Decoder {

    private $m_publicKey;  // Public key that you used to encode your project.
    
    /*
     *
     *
     */
    public function __construct ($publicKey)
    {
        // need a public key to operate.
        if ($publicKey != '') {
            // now let's check to see if there's a valid public key
            $m_publicKey = $publicKey;
        } else {
            throw new DecoderException ('Public key is empty.');
        }        
    }

    /*
     *
     *
     */
    public function getEncodedEntityByID ($EntityID)
    {
        print (__DIR__);
    }

    /*
     *
     *
     */
    public function decodeEntityData ($entityData)
    {
            
    }
}
