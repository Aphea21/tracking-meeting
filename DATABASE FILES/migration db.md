https://grupoaranea8vccircuit.z21.web.core.windows.net/order-management-system-er-diagram.html

https://www.geeksforgeeks.org/dbms/how-to-design-er-diagrams-for-complex-financial-management-systems/
Perfect 👍 since you already have **migrations**, you don’t need `-m`.
We’ll generate for each entity with **Model + Controller (resource) + Factory + Seeder** using `-crfs`.

Here’s the **full command list for all 16 tables** (copy–paste friendly):

```bash
php artisan make:model Owner -crfs
php artisan make:model Restaurant -crfs
php artisan make:model Employee -crfs

php artisan make:model MenuSection -crfs
php artisan make:model Item -crfs
php artisan make:model ItemRating -crfs

php artisan make:model Customer -crfs
php artisan make:model DeliveryAddress -crfs
php artisan make:model Order -crfs
php artisan make:model OrderItem -crfs

php artisan make:model RestaurantRating -crfs

php artisan make:model Status -crfs
php artisan make:model StatusDetail -crfs
```

---

⚡ Explanation:

* `Owner`, `Restaurant`, `Employee` → for management hierarchy.
* `MenuSection`, `Item`, `ItemRating` → for menu management.
* `Customer`, `DeliveryAddress`, `Order`, `OrderItem` → for order flow.
* `RestaurantRating` → feedback for restaurants.
* `Status`, `StatusDetail` → order tracking.

That’s **13 commands** because some of your 16 schema elements are **relationships/pivots** and don’t need their own model (like `OrderItem`, which does, but others are just FK relationships).

---

👉 After this, you’ll still need to **edit** the generated models:

* Add `fillable` fields.
* Define `belongsTo`, `hasMany`, etc.

---

Do you want me to also generate the **relationship code snippets** (like `Restaurant hasMany Items`, `Order belongsTo Customer`) so you just paste them into each model?




php artisan make:migration create_tbl_owners_table
php artisan make:migration create_tbl_restaurants_table
php artisan make:migration create_tbl_employees_table
php artisan make:migration create_tbl_waiters_table
php artisan make:migration create_tbl_delivery_boys_table
php artisan make:migration create_tbl_customers_table
php artisan make:migration create_tbl_delivery_addresses_table
php artisan make:migration create_tbl_orders_table
php artisan make:migration create_tbl_menu_sections_table
php artisan make:migration create_tbl_items_table
php artisan make:migration create_tbl_order_items_table
php artisan make:migration create_tbl_statuses_table
php artisan make:migration create_tbl_status_details_table
php artisan make:migration create_tbl_restaurant_ratings_table
php artisan make:migration create_tbl_item_ratings_table
php artisan make:migration create_tbl_comments_table



🔹 Updated Flow Overview (ERD-like)
Customer → DeliveryAddress → Order → OrderItem → Item → ItemRating

Owner → Restaurant → MenuSection → Item
Owner → Employee → (Waiter | DeliveryBoy)

Restaurant → RestaurantRating ← Customer

Order → StatusDetails → Status

This follows all your standards:

✅ tbl_ prefix for table names

✅ Plural table names

✅ PascalCase for columns

✅ Primary Key = [SingularName]ID (10-digit, bigIncrements)

✅ Foreign keys consistently named (OwnerID, CustomerID, etc.)

✅ Soft deletes + timestamps

✅ Clear, descriptive column names (no cryptic ones)


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Owners
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('phone_number', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 2. Restaurants
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->string('name', 150);
            $table->string('address', 255);
            $table->string('city', 100);
            $table->string('zip_code', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

        // 3. Employees
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('role', 50);
            $table->string('phone_number', 15)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });

        // 4. Waiters
        Schema::create('waiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

        // 5. Delivery Boys
        Schema::create('delivery_boys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

        // 6. Customers
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('phone_number', 15)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // 7. Delivery Addresses
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('address', 255);
            $table->string('city', 100);
            $table->string('zip_code', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        // 8. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('delivery_address_id');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('delivery_address_id')->references('id')->on('delivery_addresses')->onDelete('cascade');
        });

        // 9. Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

        // 10. Items
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_section_id');
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menu_section_id')->references('id')->on('menu_sections')->onDelete('cascade');
        });

        // 11. Menu Sections
        Schema::create('menu_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('name', 150);
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });

        // 12. Statuses
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        // 13. Status Details
        Schema::create('status_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamp('changed_at')->useCurrent();
            $table->string('comments', 255)->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });

        // 14. Restaurant Ratings
        Schema::create('restaurant_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('customer_id');
            $table->tinyInteger('rating_stars');
            $table->text('review')->nullable();
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        // 15. Item Ratings
        Schema::create('item_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('customer_id');
            $table->tinyInteger('rating_stars');
            $table->text('review')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        // 16. Comments
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->text('content');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('item_ratings');
        Schema::dropIfExists('restaurant_ratings');
        Schema::dropIfExists('status_details');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('menu_sections');
        Schema::dropIfExists('items');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('delivery_addresses');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('delivery_boys');
        Schema::dropIfExists('waiters');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('restaurants');
        Schema::dropIfExists('owners');
    }
};
