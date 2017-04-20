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
    private $m_entityPath; // the path to the entity folder
    /*
     *
     *
     */
    public function __construct ($publicKey)
    {
        // need a public key to operate.
        if ($publicKey != '') {
            // now let's check to see if there's a valid public key
            $this->m_publicKey = $publicKey;
        } else {
            throw new DecoderException ('Error: Public key is empty.');
        }        
    }
    public function setEntityPath ($EntityPath)
    {
        if (is_dir($EntityPath))
        {   
            $this->m_entityPath = $EntityPath;
        } else {
            throw new DecoderException ('Error: SCOPBIN does not exist. You do not have any encoded files.');
        }
    }
    /*
     *
     *
     */
    public function getEncodedEntityByID ($EntityID)
    {
        return file_get_contents($this->m_entityPath . "/" . $EntityID);
    }

    /*
     *
     *
     */
    public function decodeEntityData ($entityData)
    {
        return $entityData;
    }
}
