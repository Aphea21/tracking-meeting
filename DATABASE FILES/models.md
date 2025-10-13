Perfect — here’s the **complete model code** set for your *Organization Meeting & Action Tracking Tool* (Laravel + MySQL).
All models use Eloquent relationships, timestamps, and soft deletes for traceability.

---

## 🧱 `app/Models/User.php`

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'created_by');
    }

    public function concerns()
    {
        return $this->hasMany(Concern::class, 'responsible_person_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
```

---

## 🧱 `app/Models/Agenda.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'agendas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'date',
        'created_by',
        'notes',
        'file_path',
        'status',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function concerns()
    {
        return $this->hasMany(Concern::class, 'agenda_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'agenda_id');
    }
}
```

---

## 🧱 `app/Models/Concern.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concern extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'concerns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
        'description',
        'responsible_person_id',
        'status',
        'due_date',
        'comments',
        'file_path',
    ];

    // Relationships
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_person_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'concern_id');
    }

    public function commentList()
    {
        return $this->hasMany(Comment::class, 'concern_id');
    }
}
```

---

## 🧱 `app/Models/Comment.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'concern_id',
        'user_id',
        'content',
    ];

    // Relationships
    public function concern()
    {
        return $this->belongsTo(Concern::class, 'concern_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
```

---

## 🧱 `app/Models/Attachment.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
        'concern_id',
        'uploaded_by',
        'file_name',
        'file_path',
    ];

    // Relationships
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function concern()
    {
        return $this->belongsTo(Concern::class, 'concern_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
```

---

## 🧱 `app/Models/ActivityLog.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'old_value',
        'new_value',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
```

---

## ✅ Summary of Relationships

| Model                | Relationship                                   |
| -------------------- | ---------------------------------------------- |
| User → Agenda        | 1-to-Many (User creates many Agendas)          |
| Agenda → Concern     | 1-to-Many (Agenda has many Concerns)           |
| Concern → Comment    | 1-to-Many (Concern has many Comments)          |
| Concern → Attachment | 1-to-Many (Concern has many Attachments)       |
| User → Concern       | 1-to-Many (User responsible for many Concerns) |
| User → Comment       | 1-to-Many (User writes many Comments)          |
| User → ActivityLog   | 1-to-Many (User triggers many activities)      |

---

Would you like me to generate the **migration files** next (so these models match your database structure)?
