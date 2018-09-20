<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class User extends Authenticatable
{
    protected $table = 'users';

    use Notifiable;
    use EntrustRoleTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function add($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);
    }


    /*
     * 修改
     */
    public function edit($data)
    {
        $re = self::find($data['id']);
        if ($re){
            $re->name = $data['name'];
            $re->email = $data['email'];
            if ($data['new_password']){
                $re->password = \Hash::make($data['new_password']);
            }
            return $re->save();
        }
        return false;

    }
}
