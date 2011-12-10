<?php
/**
 * Expand out objects and values based on an object+path pairing
 *
 */
namespace Lib\Utility;

class ExpandObject
{
    /**
     * Expand out an object based on a path, can use callbacks
     *
     * $config[0] should always be the path
     * $config[1] can be the method to call
     *
     * @param object $object Object to expand on
     * @param array $config Configuration options
     * @param mixed $value Value to apply if callback is used
     * @return object $object Object with value attached
     */
    public function expand($object,$config,$value=null,$operator='->')
    {
        if (!is_object($object)) {
            throw new Exception('Invalid object given - cannot expand!');
        }

        $callback = null;
        if (is_array($config)) {
            $path       = $config[0];
            $callback   = $config[1];
        }else{
            $path = $config;
        }

        $pathParts      = explode($operator, $path);
        $pcount         = count($pathParts);
        $ct             = 1;
        $originalObj    = $object;

        foreach($pathParts as $path){
            if (!isset($object->$path)) {
                // what a hack! it just prevents notices from being thrown
                @$object = $object->$path;
            }else{
                $object = $object->$path;
            }
            if ($ct == $pcount && $callback != null) {
                call_user_func_array(array($object, $callback), $value);
            }
            $ct++;
        }

        return $object;
    }

    /**
     * Apply a value to a property on an object
     *
     * @param object $object Object to apply property on
     * @param string $path Path for property
     * @param mixed $value[optional] Property value
     * @return void
     */
    public function apply($object, $path, $value=null, $operator='->')
    {
        if (!is_object($object)) {
            throw new Exception('Invalid object given - cannot apply!');
        }

        $pathParts  = explode($operator, $path);
        $ref        = $object;
        $pathCount  = count($pathParts);
        $ct         = 1;

        foreach($pathParts as $pathKey => $path){
            if ($pathCount==$ct) {
                $object->{$path} = $value;
            }else{
                if (!isset($object->{$path})) {
                    $object->{$path} = new stdClass();
                }
                if (is_array($object->{$path})) {
                    $assoc = $pathParts[$pathKey+1];
                    //get the next part of the path for the key, then return
                    $object->{$path}[$assoc] = $value;
                    break;
                }
                $object = $object->{$path};
            }
                $ct++;
        }
    }

    /**
     * Find a value on a given path
     *
     * @param object $object Object to search on
     * @param string $path Path to locate
     * @static
     * @return object Found value (or as far down the path as it could get)
     */
    public static function find($object, $path, $operator='->')
    {
        if (!is_object($object)) {
            throw new Exception('Invalid object given - cannot find!');
        }

        $pathParts  = explode($operator, $path);
        $ct         = 1;
        foreach($pathParts as $path){
            if (isset($object->$path)) {
                $object = $object->$path;
            }else{
                // we've hit something we couldn't find
                if ($ct<=count($pathParts)) {
                    return null;
                }
            }
            $ct++;
        }
        return $object;
    }

    /**
     * Given the path, remove the value
     *
     * @param  object $object Object to remove value from
     * @param  string $path Object path (Ex. "foo->bar->baz")
     * @static
     * @return object Object minus value
     */
    public static function remove($object,$path,$operator='->')
    {
        if (!is_object($object)) {
            throw new Exception('Invalid object given - cannot find!');
        }
        $pathParts  = explode($operator, $path);
        $ct         = 1;
        foreach($pathParts as $path){
            if (isset($object->$path)) {
                $ct++;
                if (count($pathParts) == $ct) {
                    // remove the value
                    unset($object->$path);
                }else{
                    $object = $object->$path;
                }
            }
        }
        return $object;
    }

    /**
     * Make a copy of the given object
     * This makes a true copy instead of the reference like "clone" makes
     *
     * @param object $object Object to copy
     * @static
     * @return mixed Copy of object
     */
    public static function makeCopy($object)
    {
        if (!is_object($object)) {
            throw new Exception('Invalid object given - cannot find!');
        }else{
            return unserialize(serialize($object));
        }
    }

    /// LEGACY
    /**
    * Map the properties from one object to the other based on the property list
    * toObject is passed by reference so values are directly applied
    *
    * @param object $fromObject Object to pull the values from
    * @param object $toObject Object to apply the values to
    * @param array $propertyList a toObject->property to fromObject->map array list
    * @static
    * @return void
    */
    public static function mapProperties($fromObject, &$toObject, $propertyList)
    {
        // for each of the properties
        foreach($propertyList as $fromProperty => $toPath){
            $toObject->$fromProperty = self::expand($fromObject, $toPath);
        }
    }

}
?>
