<?php

/*
 * This file is part of the Arnapou GW2 API Client package.
 *
 * (c) Arnaud Buathier <arnaud@arnapou.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arnapou\GW2Api\Model;

use Arnapou\GW2Api\Exception\Exception;
use Arnapou\GW2Api\SimpleClient;

/**
 *
 */
class PvpStats extends AbstractObject {

    /**
     *
     * @var array
     */
    protected $data;

    /**
     *
     * @var integer
     */
    protected $total;

    /**
     * 
     * @param SimpleClient $client
     * @param array $data
     */
    public function __construct(SimpleClient $client, $data) {
        parent::__construct($client);

        $this->data = $data;
    }

    /**
     * 
     * @return integer
     */
    public function getWins() {
        return $this->data['wins'];
    }

    /**
     * 
     * @return integer
     */
    public function getLosses() {
        return $this->data['losses'];
    }

    /**
     * 
     * @return float
     */
    public function getWinRate() {
        $wins   = $this->getWins();
        $losses = $this->getLosses();
        if ($losses + $wins > 0) {
            return round(100 * $wins / ($losses + $wins), 2);
        }
        return null;
    }

    /**
     * 
     * @return integer
     */
    public function getDesertions() {
        return $this->data['desertions'];
    }

    /**
     * 
     * @return integer
     */
    public function getByes() {
        return $this->data['byes'];
    }

    /**
     * 
     * @return integer
     */
    public function getForfeits() {
        return $this->data['forfeits'];
    }

    /**
     * 
     * @return integer
     */
    public function getTotal() {
        if (!isset($this->total)) {
            $this->total = $this->getWins() + $this->getLosses() + $this->getDesertions() + $this->getByes() + $this->getForfeits();
        }
        return $this->total;
    }

}