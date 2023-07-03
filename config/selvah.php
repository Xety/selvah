<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | All pagination settings used to paginate the queries.
    */
    'pagination' => [
        'blog' => [
            'article_per_page' => 15,
            'comment_per_page' => 10
        ],
        'notification' => [
            'notification_per_page' => 10
        ],
        'user' => [
            'user_per_page' => 15,
            'comments_profile_page' => 5,
            'articles_profile_page' => 5,
            'posts_profile_page' => 10
        ],
        'discuss' => [
            'conversation_per_page' => 15,
            'post_per_page' => 10
        ]
    ],
];
