<?php

namespace Media;

class Model_Image extends Model_Media
{
	protected static $_properties = array(
        'id',
        'name',
        'content'=> array(
            'null' => true
        ),
		'type' => array(
             'null' => true
        ),
		'uri'=> array(
             'null' => true
        ),
		'deleted_at',
		'created_at',
		'updated_at',
	);
}
