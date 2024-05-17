<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyOrganisationEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;


use App\Models\User;
use Laravel\Sanctum\HasApiTokens;

class Organisation extends Authenticatable implements MustVerifyEmail,  CanResetPassword
{
    use HasFactory, SoftDeletes, HasUlids, HasApiTokens, Notifiable, CanResetPasswordTrait;

    // protected $guard = 'organisation';

    
    // table this model points to
    protected $table = 'organisations';

    /**
     * mass assignable attributes
     * @var array <string, string>
     * 
     */

    protected $fillable = [
        'firstname',
        'lastname',
        'business_name',
        'business_email_verified_at',
        'business_email',
        'business_phone',
        'business_industry',
        'password',
        'country',
        'state',
        'city',
        'address',
        'postal_code',
        'status',
    ];


    /**
     * attributes that should be hidden from serialization
    * @var array<int, string>
    */

    protected $hidden = [
        'password',
    ];


    /**
     * attributes that should be casted
     * 
     * @var array <string, string>
     */

     protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime', 
     ];

     
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyOrganisationEmail);
    }

        /**
     * Get the email address where password reset links are sent.
     *
     * @return string
     */
    // public function getEmailForPasswordReset()
    // {
    //     return $this->business_email;
    // }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getEmailForPasswordReset()
    {
        return $this->business_email;
    }

    // /**
    //  * Find the user instance for the given email.
    //  *
    //  * @param  string  $email
    //  * @return \App\Models\Organisation
    //  */
    // public function findForPassport($email)
    // {
    //     return $this->where('business_email', $email)->first();
    // }



    public function dataCollections(){
        return $this->hasMany(User::class, 'organisation_id');
    }
}
