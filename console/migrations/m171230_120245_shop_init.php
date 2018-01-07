<?php

use yii\db\Schema;
use yii\db\Migration;

class m171230_120245_shop_init extends Migration
{
    public function up()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		
		//category table
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(30) NOT NULL',
            'descrition' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->addForeignKey('fk-category-parent_id-category-id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');
		
		
		//product table
        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
			'category_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(30) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'price' => Schema::TYPE_MONEY,
			'quantity' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->addForeignKey('fk-product-category_id-category_id', '{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');
        
		
		
		
		//order table
        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_DATE,
            'updated_at' => Schema::TYPE_DATE,
			'customer_type' => Schema::TYPE_STRING . '(6) NOT NULL DEFAULT "guest"',
			'first_name' => Schema::TYPE_STRING,
			'last_name' => Schema::TYPE_STRING,
			'country' => Schema::TYPE_STRING,
			'region' => Schema::TYPE_STRING,
			'city' => Schema::TYPE_STRING,
			'address' => Schema::TYPE_TEXT,
			'zip_code' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

		//order_item table
        $this->createTable('{{%order_item1}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(25)',
			'price' => Schema::TYPE_MONEY,
            'quantity' => Schema::TYPE_INTEGER,
        ], $tableOptions);
		
		$this->addForeignKey('fk-order_item1-order_id-order-id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
		
		

    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%product}}');;
        $this->dropTable('{{%category}}');
    }

    
}
