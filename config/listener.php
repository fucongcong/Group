<?php
return [

    'services' => [

        //like
        [
            'eventName' => 'kernal.response',
            'listener'  => 'core\Group\Listeners\KernalResponseListener',
            'priority'  => 0,
         ]

    ]
];
