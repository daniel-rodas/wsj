<?php


class Model_Post extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'name' ,
        'slug',
        'content' ,
        'original_url' ,
        'category_id',
        'user_id' ,
        'created_at',
        'updated_at',
        'deleted_at',
    );

    protected static $_conditions = array(
        'order_by' => array('created_at' => 'desc'),
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


    
    protected static $_table_name = 'blog_post';
    
    /**
     * Post BelongsTo Category
     * Post BelongsTo Author
     * 
     * @var array
     */
    protected static $_belongs_to = array(
        'category' => array(
            'key_from' => 'category_id',
            'model_to' => 'Model_Category',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
        'author' => array(
            'key_from' => 'user_id',
            'model_to' => 'Model_Author',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

    /**
     * Post HasMany Comments
     * @var array
     * Post HasMany Galleries
     * @var array
     */
    protected static $_has_many = array(
        'comments' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Comment',
            'key_to' => 'post_id',
            'cascade_save' => false,
            'cascade_delete' => true,  // We delete all comments from the post deleted
        ),
        'galleries' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Gallery',
            'key_to' => 'post_id',
            'cascade_save' => false,
            'cascade_delete' => false,  // We do NOT delete all assests from the gallery deleted
        ),
    );

    public static function set_form_fields($form, $instance = null)
    {

        // Call parent for create the fieldset and set default value
        parent::set_form_fields($form, $instance);

        // Set authors
        foreach(Model_Author::find('all') as $user)
            $form->field('user_id')->set_options($user->id, $user->username);

        // Set categories
        foreach(Model_Category::find('all') as $category)
            $form->field('category_id')->set_options($category->id, $category->name);

    }    

}
