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
    protected $defaultAvatar = '/images/avatar.png';

    /**
     * Get the user's username.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->trashed() ? 'Deleted' : $value
        );
    }

    /**
     * Get the user's avatar.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
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
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function online(): Attribute
    {
        $online = Session::expires()->where('user_id', $this->id)->first();

        return Attribute::make(
            get: fn () => is_null($online) ? false : true
        );
    }

    /**
     * Get the account full name. Return the username if the user
     * has not set his first name and last name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if ($this->trashed()) {
                    return $this->username;
                }

                $fullName = $this->first_name . ' ' . $this->last_name;

                if (empty(trim($fullName))) {
                    return $this->username;
                }

                return $fullName;
            }
        );
    }
}
