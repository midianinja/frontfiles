<?php

namespace FrontFiles\Utility;
use WindowsAzure\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Blob\Models\{ CreateContainerOptions, PublicAccessType };
use MicrosoftAzure\Storage\Common\ServiceException;

class Helper
{
    /**
     * Generates a pseudo-random alpha-numeric string.
     *
     * @param int $length
     * @return string
     */
    public static function generateRandomAlphaNumericString(int $length = 8) : string
    {
        $output = '';
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($chars) - 1;

        for($i = 0; $i < $length; $i++)
            $output .= $chars[random_int(0, $max)];

        return $output;
    }

    /**
     * Stores the user avatar in the azure blob storage and returns its URL.
     *
     * @param string $name
     * @return string
     */
    public static function storeUserAvatarAndReturnUrl(string $name) : string
    {
        $container = 'user-avatars';
        $config = config('filesystems.default');

        if($config === 'azure')
            static::createContainerIfNeeded($container);

        return config('filesystems.disks.' . $config . '.url') .
            request()
                ->file('avatar')
                ->storeAs($container, $name, $config);
    }

    /**
     * Checks if the container exists in the azure blob storage
     * If it does not exist, he creates it.
     *
     * @param string $container
     */
    protected static function createContainerIfNeeded(string $container)
    {
        //BLOBS_ONLY means that its public
        $containerOptions = new CreateContainerOptions();
        $containerOptions->setPublicAccess(PublicAccessType::BLOBS_ONLY);

        try{
            ServicesBuilder::getInstance()
                ->createBlobService(config('filesystems.disks.azure.endpoint'))
                ->createContainer($container, $containerOptions);
        }catch(ServiceException $e){
            //If there's an exception, it means that the container (folder) already exists
        }
    }
}