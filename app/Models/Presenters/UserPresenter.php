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
     * The default primary color used when there is no primary color defined.
     *
     * @var string
     */
    protected $defaultAvatarPrimaryColor = '#B4AEA4';

    /**
     * Get the user's username.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function username(): Attribute
    {
        return Attribute::make(
            //get: fn ($value) => $this->trashed() ? 'Deleted' : $value
            get: fn ($value) => $value
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
     * Get the account full name. Return the username if the user
     * has not set his first name and last name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        /*if ($this->trashed()) {
            return $this->username;
        }*/

        $fullName = $this->first_name . ' ' . $this->last_name;

        if (empty(trim($fullName))) {
            return $this->username;
        }

        return $fullName;
    }
}
