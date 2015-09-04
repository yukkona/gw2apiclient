<?php

/*
 * This file is part of the Arnapou GW2 API Client package.
 *
 * (c) Arnaud Buathier <arnaud@arnapou.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arnapou\GW2Api\Cache;

class MemoryCacheDecorator implements CacheInterface {

    /**
     *
     * @var CacheInterface
     */
    protected $cache;

    /**
     *
     * @var array
     */
    protected $memory = [];

    /**
     * 
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache) {
        $this->cache = $cache;
    }

    public function exists($key) {
        if (array_key_exists($key, $this->memory)) {
            return true;
        }
        return $this->cache->exists($key);
    }

    public function get($key) {
        if (array_key_exists($key, $this->memory)) {
            return $this->memory[$key];
        }
        $value = $this->cache->get($key);
        if ($value !== null) {
            $this->memory[$key] = $value;
        }
        return $value;
    }

    public function remove($key) {
        unset($this->memory[$key]);
        $this->cache->remove($key);
    }

    public function set($key, $value, $expiration = 0) {
        $this->memory[$key] = $value;
        $this->cache->set($key, $value, $expiration);
    }

}
