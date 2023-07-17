<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | All cache options in seconds.
    */
    'cache' => [
        'incidents_count' => 7200,  // 2 hours
        'maintenances_count' => 7200,
        'parts_count' => 7200,
        'graph_maintenance_incident' => 7200,
        'graph_lots' => 7200,
        'production_count' => 7200,
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | All pagination settings used to paginate the queries.
    */
    'pagination' => [

    ],
];
