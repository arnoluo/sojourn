<?php

require_once(__DIR__ .  "/../vendor/autoload.php");
use ChainSql\Table;

Table::register([
    'engine' => 'innoDB',
    'charset' => 'utf8',
    'filename' => __DIR__ . '/Tables/table.sql'
]);

Table::create('articles', function ($table) {
    $table->int('id', 11)->unsigned()->primaryKey()->autoIncrement();
    $table->varchar('uniqueId', 255)->uniqueKey();
    $table->text('content');
    $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
    $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
})->tableComment('Create Table Article');

Table::create('tags', function ($table) {
    $table->int('id', 11)->unsigned()->primaryKey()->autoIncrement();
    $table->varchar('typeGroup', 255);
    $table->varchar('type', 255)->default("''");
    $table->varchar('name', 255);
    $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
    $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
})->tableComment('Create Table Tag');


Table::create('article_tags', function ($table) {
    $table->int('id', 11)->unsigned()->primaryKey()->autoIncrement();
    $table->varchar('docId', 255);
    $table->varchar('tagId', 255);
    $table->int('score', 3)->default(0);
    $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
    $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
})->tableComment('Create Table article_tags');

