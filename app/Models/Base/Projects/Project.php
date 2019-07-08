<?php
/**
 * @SWG\Definition(definition="Project",required={"name", "status"})
 *
 * @SWG\Property(
 *     property="name",
 *     type="string",
 *     example="Project"
 * )
 * @SWG\Property(
 *     property="status",
 *     type="string",
 *     example="NEW"
 * )
 * @SWG\Property(
 *     property="description",
 *     type="string",
 *     example="бла бла бла"
 * )

 */
namespace App\Models\Base\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const ALL_STATUS = [
        self::STATUS_NEW,
        self::STATUS_OLD,
    ];

    const STATUS_NEW = 'NEW';
    const STATUS_OLD = 'OLD';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
