<?php
namespace Ackintosh\Ganesha;

use Ackintosh\Ganesha\Storage\AdapterInterface;

class Configuration
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @var callable
     */
    private $adapterSetupFunction;

    /**
     * @var int
     */
    private $failureThreshold = 10;

    /**
     * @var int
     */
    private $intervalToHalfOpen = 5;

    /**
     * @var int
     */
    private $countTTL = 60;

    /**
     * @throws \LogicException
     * @return void
     */
    public function validate()
    {
        if (!$this->adapter instanceof AdapterInterface && is_null($this->adapterSetupFunction)) {
            throw new \LogicException();
        }
    }

    /**
     * @param int $failureThreshold
     * @return void
     */
    public function setFailureThreshold($failureThreshold)
    {
        $this->failureThreshold = $failureThreshold;
    }

    /**
     * @return int
     */
    public function getFailureThreshold()
    {
        return $this->failureThreshold;
    }

    /**
     * @param AdapterInterface $adapter
     * @return
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param  callable $function
     * @return void
     */
    public function setAdapterSetupFunction(callable $function)
    {
        $this->adapterSetupFunction = $function;
    }

    /**
     * @return callable|\Closure
     */
    public function getAdapterSetupFunction()
    {
        if ($adapter = $this->adapter) {
            return function () use ($adapter) {
                return $adapter;
            };
        }

        return $this->adapterSetupFunction;
    }

    /**
     * @param int $interval
     * @return void
     */
    public function setIntervalToHalfOpen($interval)
    {
        $this->intervalToHalfOpen = $interval;
    }

    /**
     * @return int
     */
    public function getIntervalToHalfOpen()
    {
        return $this->intervalToHalfOpen;
    }

    /**
     * @param $countTTL
     * @return void
     */
    public function setCountTTL($countTTL)
    {
        $this->countTTL = $countTTL;
    }

    /**
     * @return int
     */
    public function getCountTTL()
    {
        return $this->countTTL;
    }
}
