<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Announcement extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_announcements';
    protected $fillable = [
        'announcement_text', 'announcement_date', 'create_id',
    ];

    /**
      * select all announcements
      *
      * @param string $sort
      * @return Collection
      */
    public function findAllAnnouncements(string $sort): Collection
    {
        return DB::table($this->table)
            ->select('announcement_id', 'announcement_text', 'announcement_date')
            ->selectRaw('WEEKDAY(announcement_date) AS announcement_weekday')
            ->orderBy('announcement_date', $sort)
            ->get();
    }

    /**
     * insert new announcement
     *
     * @param array $param
     * @return boolean
     */
    public function insertAnnouncement(array $param): bool
    {
        return $this->fill($param)->save();
    }

    /**
     * delete announcement
     *
     * @param integer $announcementId
     * @return integer
     */
    public function deleteAnnouncement(int $announcementId): int
    {
        return DB::table($this->table)
            ->where('announcement_id', $announcementId)
            ->delete();
    }
}
