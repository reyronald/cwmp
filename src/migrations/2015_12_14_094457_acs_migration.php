<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ACSMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informs', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique();

            $table->string('inform_header_id');
            $table->string('manufacturer');
            $table->string('oui');
            $table->string('product_class');
            $table->string('serial_number');
            $table->string('event_code');
            $table->string('max_envelopes');
            $table->string('current_time');
            $table->string('retry_count');
            $table->string('hardware_version');
            $table->string('software_version');
            $table->string('spec_version');
            $table->string('provisioning_code');
            $table->string('parameter_key');
            $table->string('connection_request_url');
            $table->string('external_ip_address');
            $table->string('allow_ping_from_wan')->nullable();
            $table->timestamps();
            $table->text('soap_envelope');

            $table->index('oui');
            $table->index('serial_number');
        });  

        Schema::create('parameter_lists', function(Blueprint $table) {
            $table->increments('id')->unsigned()->unique();
            $table->integer('inform_id')->unsigned();
            $table->text('imsi', 16);
            $table->string('wan_mac', 16);
            $table->string('model_id');
            $table->string('model_name');
            $table->string('state', 16);
            $table->string('connect_time');
            $table->string('device_up_time');
            $table->string('dl_frequency');
            $table->string('ul_frequency');
            $table->string('bandwidth');
            $table->string('rsrp0');
            $table->string('rsrp1');
            $table->string('rsrq');
            $table->string('cinr0');
            $table->string('cinr1');
            $table->string('txpower');
            $table->string('cell_id');
            $table->string('pci');
            $table->timestamps();
            $table->text('soap_envelope');

            $table->index('inform_id');
            $table->index('cell_id');
            $table->index('imsi');
            $table->index('wan_mac');
            $table->foreign('inform_id')->references('id')->on('informs');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parameter_lists');
        Schema::drop('informs');
    }
}
