<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class AddAffiliateLinksOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropForeign(['affiliate_id']);
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropForeign(['affiliate_id']);
        });
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->foreign('affiliate_id')->references('id')->on('affiliates');
        });        
    }
}
