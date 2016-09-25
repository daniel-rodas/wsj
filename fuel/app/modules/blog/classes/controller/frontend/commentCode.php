<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 9/24/2016
 * Time: 9:25 PM
 */

else
{

    // Prepare comment form fieldset
    $form = \Fieldset::forge('post_comment');
    $form->add_model('Blog\Model_Comment');
    $form->add('submit', '', array(
            'type' => 'submit',
            'value' => __('submit'),
            'class' => 'btn btn-primary')
    );

    // If submit comment
    if (\Input::post('submit'))
    {
        $form->validation()->run();

        if ( ! $form->validation()->error())
        {
            // Create and populate the comment object
            $comment = Model_Comment::forge();
            $comment->from_array(array(
                'username' => $form->validated('username'),
                'mail' => $form->validated('mail'),
                'content' => $form->validated('content'),
                'post_id' => $post->id,
            ));

            if ($comment->save())
            {
                \Messages::success(__('frontend.comment.added'));
                \Response::redirect_back(\Router::get('show_post', array('segment' => $post->slug)));
            }
            else
            {
                \Messages::error(__('error'));
            }
        }
        else
        {
            // Output validation errors
            foreach ($form->validation()->error() as $error)
            {
                \Messages::error($error);
            }
        }
    }
    $form->repopulate();
    $this->data['form'] = $form;
    return \Response::forge( \View::forge('frontend/post/show')->set($this->data, null, false) );
}
