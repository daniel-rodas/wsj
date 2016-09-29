<?php

namespace Authentication;

class Model_Users_Providers extends \Orm\Model
{
    // list of properties for this model
    protected static $_properties = array(
        'id', // primary key
        'parent_id'	,
        'provider',
        'uid',
        'access_token',
        'secret',
        'expires',
        'refresh_token',
        'created_at',

    );

    protected static $_table_name = 'users_providers';
    // set up the patient relation the usual way
    protected static $_belongs_to = array(
        'user' => array(
            'key_from' => 'parent_id',
            'model_to' => 'Authentication\Model_User',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );
}
