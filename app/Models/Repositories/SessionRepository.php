<?php

namespace Selvah\Models\Repositories;

use Selvah\Models\Session;

class SessionRepository
{
    /**
     * Update the session and save it.
     *
     * @param array $data The data used to update the session.
     * @param \Selvah\Models\Session $session The session to update.
     *
     * @return \Selvah\Models\Session
     */
    public static function update(array $data, Session $session): Session
    {
        $session->method =  $data['method'];
        $session->url =  $data['url'];

        if (isset($data['created_at'])) {
            $session->created_at =  $data['created_at'];
        }

        $session->save();

        return $session;
    }
}
