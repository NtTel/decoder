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
    public function __construct ($publicKey, $homeDir = '')
    {
        // let's set the entity path.
        if ($homeDir != '')
        {
            if ($homeDir == "tests")
            {
                $this->m_entityPath = "./tests/scopbin";
            } else {
                $this->m_entityPath = $homeDir . "/vendor/sourcecop/scopbin";
            }
        } else {
            throw new DecoderException ('Error: HOMEDIR is not set.');
        }

        if (!is_dir($this->m_entityPath))
        {   
            throw new DecoderException ('Error: `' . $this->m_entityPath . '` does not exist.');
        }

        // need a public key to operate.
        if ($publicKey != '') {
            // now let's check to see if there's a valid public key
            $this->m_publicKey = $publicKey;
        } else {
            throw new DecoderException ('Error: Public key is empty.');
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
        $entityData = base64_decode ($entityData);
        $entityData = hex2bin ($entityData);
        $entityData = gzuncompress($entityData);
        $td         = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, '');
        $ivsize     = mcrypt_enc_get_iv_size($td);
        $iv         = substr($entityData, 0, $ivsize);
        $entityData = substr($entityData, $ivsize);
        if ($iv)
        {
            mcrypt_generic_init($td, $this->m_publicKey, $iv);
            $entityData = trim(mdecrypt_generic($td, $entityData));
        } else {
            throw new DecoderException ('Error: Decoder failed to decocde SCOPBIN file. Possible corruption or public key failure.');
        }
        return $entityData;
    }
}
