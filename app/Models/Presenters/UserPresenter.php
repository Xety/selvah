<?php

namespace Selvah\Models\Presenters;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Selvah\Models\Session;

trait UserPresenter
{
    /**
     * The default avatar used when there is no avatar for the user.
     *
     * @var string
     */
    protected string $defaultAvatar = '/images/avatar.png';

    /**
     * Get the user's avatar.
     *
     * @return Attribute
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->defaultAvatar
        );
    }

    /**
     * Get the status of the user : online or offline
     *
     * @return Attribute
     */
    protected function online(): Attribute
    {
        $online = Session::expires()->where('user_id', $this->id)->first();

        return Attribute::make(
            get: fn () => !is_null($online)
        );
    }

    /**
     * Get the account full name. Return the username if the user
     * has not set his first name and last name.
     *
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $fullName = $this->first_name . ' ' . $this->last_name;

                if (empty(trim($fullName))) {
                    return $this->username;
                }

                return $fullName;
            }
        );
    }
}
