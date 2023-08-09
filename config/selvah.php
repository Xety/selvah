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
        //Dashboard
        'incidents_count' => 7200,  // 2 hours
        'maintenances_count' => 7200,
        'parts_count' => 7200,
        'graph_maintenance_incident' => 7200,
        'graph_lots' => 7200,
        'production_count' => 7200,

        // Parts
        'parts' => [
            'price_total_all_part_in_stock' => 3600,
            'price_total_all_part_exits' => 3600,
            'price_total_all_part_entries' => 3600,
            'total_part_in_stock' => 3600,
            'total_part_out_of_stock' => 3600,
            'total_part_get_in_stock' => 3600
        ]
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
