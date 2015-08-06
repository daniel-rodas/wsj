<?php

namespace Media;

class Model_Gallery extends \Orm\Model_Soft
{
    public static function _init()
    {
        Module::load('blog');
    }
    protected static $_properties = array(
		'id',
		'name',
		'post_id',
		'asset_id',
		'deleted_at',
		'created_at',
		'updated_at',
	);

    protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

    protected static $_soft_delete = array(
		'mysql_timestamp' => false,
	);

    protected static $_table_name = 'galleries';

    /**
     * Gallery Belongs to Post
     * Gallery Belongs to Asset
     *
     *
     * @var array
     */
    protected static $_belongs_to = array(
        'asset' => array(
            'key_from' => 'asset_id',
            'model_to' => '\Model_Asset',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
        'post' => array(
            'key_from' => 'post_id',
            'model_to' => 'Blog\Model_Post',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );
}
