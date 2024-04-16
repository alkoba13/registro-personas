<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="person",
 *     type="object",
 *     required={"mobile_no"},
 *     @OA\Property(property="name", type="string", example="myName"),
 *     @OA\Property(property="surname", type="string", example="mySurname"),
 *     @OA\Property(property="second_surname", type="string", example="mySecondSurname"),
 *     @OA\Property(property="email", type="string", example="email@email.com"),
 *     @OA\Property(property="phone_number", type="string", example="8712345678"),
 *     @OA\Property(property="postal_code", type="string", example="27000"),
 *     @OA\Property(property="state", type="string", example="Coahuila de Zaragoza"),
 * )
 */

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'second_surname',
        'email',
        'phone_number',
        'postal_code',
        'state'
    ];
}
