    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_no');
            $table->string('address_st');
            $table->string('address_town');
            $table->string('electoral_div');
            $table->string('electoral_area');
            $table->string('postcode');
            $table->string('eircode');
            $table->string('check');

            $table->integer('box_id')->index();
            $table->integer('voter_id')->index();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('addresses');
    }
}
