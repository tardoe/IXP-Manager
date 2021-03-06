<?php

namespace Proxies\__CG__\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Layer2Address extends \Entities\Layer2Address implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'id', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'mac', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'firstseen', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'lastseen', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'created', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'vlanInterface'];
        }

        return ['__isInitialized__', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'id', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'mac', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'firstseen', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'lastseen', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'created', '' . "\0" . 'Entities\\Layer2Address' . "\0" . 'vlanInterface'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Layer2Address $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getMac()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMac', []);

        return parent::getMac();
    }

    /**
     * {@inheritDoc}
     */
    public function getMacFormattedWithColons()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMacFormattedWithColons', []);

        return parent::getMacFormattedWithColons();
    }

    /**
     * {@inheritDoc}
     */
    public function getMacFormattedWithDots()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMacFormattedWithDots', []);

        return parent::getMacFormattedWithDots();
    }

    /**
     * {@inheritDoc}
     */
    public function getMacFormattedWithDashes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMacFormattedWithDashes', []);

        return parent::getMacFormattedWithDashes();
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstSeenAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstSeenAt', []);

        return parent::getFirstSeenAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastSeenAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastSeenAt', []);

        return parent::getLastSeenAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAtFormated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAtFormated', []);

        return parent::getCreatedAtFormated();
    }

    /**
     * {@inheritDoc}
     */
    public function getVlanInterface()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVlanInterface', []);

        return parent::getVlanInterface();
    }

    /**
     * {@inheritDoc}
     */
    public function getSwitchPorts(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSwitchPorts', []);

        return parent::getSwitchPorts();
    }

    /**
     * {@inheritDoc}
     */
    public function setMac($mac): \Entities\Layer2Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMac', [$mac]);

        return parent::setMac($mac);
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstSeenAt($firstSeenAt): \Entities\Layer2Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstSeenAt', [$firstSeenAt]);

        return parent::setFirstSeenAt($firstSeenAt);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastSeenAt($lastSeenAt): \Entities\Layer2Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastSeenAt', [$lastSeenAt]);

        return parent::setLastSeenAt($lastSeenAt);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt): \Entities\Layer2Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function setVlanInterface(\Entities\VlanInterface $vlanInterface = NULL): \Entities\Layer2Address
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVlanInterface', [$vlanInterface]);

        return parent::setVlanInterface($vlanInterface);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function jsonArray(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonArray', []);

        return parent::jsonArray();
    }

}
