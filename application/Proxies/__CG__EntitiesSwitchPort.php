<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class SwitchPort extends \Entities\SwitchPort implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setType($type)
    {
        $this->__load();
        return parent::setType($type);
    }

    public function getType()
    {
        $this->__load();
        return parent::getType();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setPhysicalInterface(\Entities\PhysicalInterface $physicalInterface = NULL)
    {
        $this->__load();
        return parent::setPhysicalInterface($physicalInterface);
    }

    public function getPhysicalInterface()
    {
        $this->__load();
        return parent::getPhysicalInterface();
    }

    public function setSwitcher(\Entities\Switcher $switcher = NULL)
    {
        $this->__load();
        return parent::setSwitcher($switcher);
    }

    public function getSwitcher()
    {
        $this->__load();
        return parent::getSwitcher();
    }

    public function addSecEvent(\Entities\SecEvent $secEvents)
    {
        $this->__load();
        return parent::addSecEvent($secEvents);
    }

    public function removeSecEvent(\Entities\SecEvent $secEvents)
    {
        $this->__load();
        return parent::removeSecEvent($secEvents);
    }

    public function getSecEvents()
    {
        $this->__load();
        return parent::getSecEvents();
    }

    public function setIfName($ifName)
    {
        $this->__load();
        return parent::setIfName($ifName);
    }

    public function getIfName()
    {
        $this->__load();
        return parent::getIfName();
    }

    public function setIfAlias($ifAlias)
    {
        $this->__load();
        return parent::setIfAlias($ifAlias);
    }

    public function getIfAlias()
    {
        $this->__load();
        return parent::getIfAlias();
    }

    public function setIfHighSpeed($ifHighSpeed)
    {
        $this->__load();
        return parent::setIfHighSpeed($ifHighSpeed);
    }

    public function getIfHighSpeed()
    {
        $this->__load();
        return parent::getIfHighSpeed();
    }

    public function setIfMtu($ifMtu)
    {
        $this->__load();
        return parent::setIfMtu($ifMtu);
    }

    public function getIfMtu()
    {
        $this->__load();
        return parent::getIfMtu();
    }

    public function setIfPhysAddress($ifPhysAddress)
    {
        $this->__load();
        return parent::setIfPhysAddress($ifPhysAddress);
    }

    public function getIfPhysAddress()
    {
        $this->__load();
        return parent::getIfPhysAddress();
    }

    public function setIfAdminStatus($ifAdminStatus)
    {
        $this->__load();
        return parent::setIfAdminStatus($ifAdminStatus);
    }

    public function getIfAdminStatus()
    {
        $this->__load();
        return parent::getIfAdminStatus();
    }

    public function setIfOperStatus($ifOperStatus)
    {
        $this->__load();
        return parent::setIfOperStatus($ifOperStatus);
    }

    public function getIfOperStatus()
    {
        $this->__load();
        return parent::getIfOperStatus();
    }

    public function setIfLastChange($ifLastChange)
    {
        $this->__load();
        return parent::setIfLastChange($ifLastChange);
    }

    public function getIfLastChange()
    {
        $this->__load();
        return parent::getIfLastChange();
    }

    public function setLastSnmpPoll($lastSnmpPoll)
    {
        $this->__load();
        return parent::setLastSnmpPoll($lastSnmpPoll);
    }

    public function getLastSnmpPoll()
    {
        $this->__load();
        return parent::getLastSnmpPoll();
    }

    public function setIfIndex($ifIndex)
    {
        $this->__load();
        return parent::setIfIndex($ifIndex);
    }

    public function getIfIndex()
    {
        $this->__load();
        return parent::getIfIndex();
    }

    public function setActive($active)
    {
        $this->__load();
        return parent::setActive($active);
    }

    public function getActive()
    {
        $this->__load();
        return parent::getActive();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'type', 'name', 'ifIndex', 'ifName', 'ifAlias', 'ifHighSpeed', 'ifMtu', 'ifPhysAddress', 'ifAdminStatus', 'ifOperStatus', 'ifLastChange', 'lastSnmpPoll', 'active', 'id', 'PhysicalInterface', 'SecEvents', 'Switcher');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}