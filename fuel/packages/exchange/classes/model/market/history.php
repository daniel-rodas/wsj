<?php

namespace Exchange\Model\Market;

class History extends \Orm\Model_Soft
{
    protected static $_properties = array(
        'id',
        'market',
        'coin_id',
        'last_price',
        'api_url',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        ),
    );

    public static function validate($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('market', 'Market', 'required|max_length[255]');
        $val->add_field('coin_id', 'Coin Id', 'required|valid_string[numeric]');
        $val->add_field('last_price', 'Last Price', 'required|valid_string[numeric]');
        $val->add_field('api_url', 'Api Url', 'required');

        return $val;
    }

    public function getPriceHistory($coinId, $timeFrameInSecondsX3)
    {
        try {
            return $this->find('all', array(
                'where' => array(
                    array('coin_id', '=', $coinId),
                    array('created_at', '>', $timeFrameInSecondsX3),
                ),
                'order_by' => array('created_at' => 'desc'),
            ));
        } catch (Database_Exception $e) {
            echo $e->getMessage();
        }

    }

}
