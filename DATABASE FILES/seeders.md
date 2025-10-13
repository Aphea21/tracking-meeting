Perfect 👍 You want **seeders** (or factories + seeders) that insert demo/test data with:

* Passwords always `1Qwertyu` (hashed in DB).
* Phone numbers like `09237718247` but randomized.
* Emails based on **first name only** → e.g. `wen@gmail.com`.

Here’s how I’d set it up:

---

### **OwnerSeeder.php**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        $owners = [
            ['FirstName' => 'Wen', 'LastName' => 'Lee'],
            ['FirstName' => 'Mark', 'LastName' => 'Smith'],
            ['FirstName' => 'Liza', 'LastName' => 'Jones'],
        ];

        foreach ($owners as $o) {
            Owner::create([
                'FirstName'   => $o['FirstName'],
                'LastName'    => $o['LastName'],
                'Email'       => strtolower($o['FirstName']) . '@gmail.com',
                'Password'    => Hash::make('1Qwertyu'),
                'PhoneNumber' => '09' . rand(200000000, 999999999),
            ]);
        }
    }
}
```

---

### **CustomerSeeder.php**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['FirstName' => 'Anna', 'LastName' => 'Reyes'],
            ['FirstName' => 'John', 'LastName' => 'Doe'],
            ['FirstName' => 'Maria', 'LastName' => 'Lopez'],
        ];

        foreach ($customers as $c) {
            Customer::create([
                'FirstName'   => $c['FirstName'],
                'LastName'    => $c['LastName'],
                'Email'       => strtolower($c['FirstName']) . '@gmail.com',
                'Password'    => Hash::make('1Qwertyu'),
                'PhoneNumber' => '09' . rand(200000000, 999999999),
                'IsActive'    => true,
            ]);
        }
    }
}
```

---

### **EmployeeSeeder.php**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['FirstName' => 'Alex', 'LastName' => 'Chan', 'Role' => 'waiter'],
            ['FirstName' => 'Jane', 'LastName' => 'Lim', 'Role' => 'delivery_boy'],
            ['FirstName' => 'Carl', 'LastName' => 'Tan', 'Role' => 'cashier'],
        ];

        foreach ($employees as $e) {
            Employee::create([
                'OwnerID'     => 1, // adjust as per existing owner
                'RestaurantID'=> 1, // adjust as per existing restaurant
                'FirstName'   => $e['FirstName'],
                'LastName'    => $e['LastName'],
                'Role'        => $e['Role'],
                'PhoneNumber' => '09' . rand(200000000, 999999999),
                'IsActive'    => true,
            ]);
        }
    }
}
```

---

### **How to hook them in**

In `DatabaseSeeder.php`:

```php
public function run(): void
{
    $this->call([
        OwnerSeeder::class,
        CustomerSeeder::class,
        EmployeeSeeder::class,
    ]);
}
```

Then run:

```bash
php artisan db:seed
```

---

⚡ That will give you **real records** with:

* Emails like `wen@gmail.com` / `anna@gmail.com`.
* Passwords all `1Qwertyu` (securely hashed).
* Phone numbers randomized `09XXXXXXXXX`.

👉 Do you want me to also **extend this seeding setup to Restaurants, Items, and Orders** so you have a full working dataset to test relationships (orders with items, ratings, etc.)?
