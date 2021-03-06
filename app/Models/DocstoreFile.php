<?php

namespace IXP\Models;

/*
 * Copyright (C) 2009 - 2020 Internet Neutral Exchange Association Company Limited By Guarantee.
 * All Rights Reserved.
 *
 * This file is part of IXP Manager.
 *
 * IXP Manager is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, version v2.0 of the License.
 *
 * IXP Manager is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License v2.0
 * along with IXP Manager.  If not, see:
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
*/

use DB, Eloquent;

use Entities\User as UserEntity;

use Illuminate\Database\Eloquent\{
    Builder,
    Collection,
    Model
};

use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};

use Illuminate\Support\Carbon;
use Storage;


/**
 * IXP\Models\DocstoreFile
 *
 * @property int $id
 * @property int|null $docstore_directory_id
 * @property string $name
 * @property string $disk
 * @property string $path
 * @property string|null $sha256
 * @property string|null $description
 * @property int $min_privs
 * @property \Illuminate\Support\Carbon $file_last_updated
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \IXP\Models\DocstoreDirectory|null $directory
 * @property-read \Illuminate\Database\Eloquent\Collection|\IXP\Models\DocstoreLog[] $logs
 * @property-read int|null $logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereDocstoreDirectoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereFileLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereMinPrivs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereSha256($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IXP\Models\DocstoreFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class DocstoreFile extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name',
        'description',
        'docstore_directory_id',
        'path',
        'sha256',
        'min_privs',
        'file_last_updated',
        'created_by',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'file_last_updated',
    ];


    /**
     * File extension allowed to be viewed
     *
     * @var array
     */
    public static $extensionViewable = [ '.txt', '.md' ];

    /**
     * File extension allowed to be edited
     *
     * @var array
     */
    public static $extensionEditable = [ '.txt', '.md' ];

    /**
     * Get the directory that owns the file.
     */
    public function directory(): BelongsTo
    {
        return $this->belongsTo(DocstoreDirectory::class, 'docstore_directory_id' );
    }

    /**
     * Get the access logs for this file
     */
    public function logs(): HasMany
    {
        return $this->hasMany('IXP\Models\DocstoreLog');
    }

    /**
     * Can we view that file?
     *
     * @return bool
     */
    public function isViewable(): bool
    {
        return in_array( '.' . pathinfo( Storage::disk( $this->disk )->url( $this->path ), PATHINFO_EXTENSION ), self::$extensionViewable );
    }

    /**
     * Can we edit that file?
     *
     * @return bool
     */
    public function isEditable(): bool
    {
        return in_array( '.' . pathinfo( Storage::disk( $this->disk )->url( $this->path ), PATHINFO_EXTENSION ), self::$extensionEditable );
    }

    /**
     * Get the extension of the file
     *
     * @return string
     */
    public function extension(): string
    {
        return pathinfo( Storage::disk( $this->disk )->url( $this->path ), PATHINFO_EXTENSION );
    }

    /**
     * Gets a directory listing of files for the given (or root) directory and as
     * appropriate for the user (or public access)
     *
     * @param DocstoreDirectory|null $dir
     * @param UserEntity|null $user
     *
     * @return Collection
     */
    public static function getListing( ?DocstoreDirectory $dir = null, ?UserEntity $user = null )
    {
        return self::where('min_privs', '<=', $user ? $user->getPrivs() : UserEntity::AUTH_PUBLIC )
            ->where('docstore_directory_id', $dir ? $dir->id : null )
            ->withCount([ 'logs as downloads_count', 'logs as unique_downloads_count' => function( Builder $query ) {
                $query->select( DB::raw('COUNT( DISTINCT downloaded_by )' ) );
            }])
            ->orderBy('name')->get();
    }
}
