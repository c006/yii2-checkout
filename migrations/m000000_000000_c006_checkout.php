<?php
use yii\db\Migration;

class m000000_000000_c006_checkout extends Migration
{

    public function up()
    {
        self::down();


        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('checkout_item', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_item}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'order_id' => 'INT(10) UNSIGNED NOT NULL',
                    'product_id' => 'INT(10) UNSIGNED NOT NULL',
                    'product_shipping_id' => 'SMALLINT(6) NULL',
                    'quantity' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'discount' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'price' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_link', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_link}}', [
                    'order_id' => 'INT(10) UNSIGNED NOT NULL',
                    0 => 'PRIMARY KEY (`order_id`)',
                    'item_id' => 'INT(10) UNSIGNED NOT NULL',
                    1 => 'KEY (`item_id`)',
                    'shipping_id' => 'INT(10) UNSIGNED NOT NULL',
                    2 => 'KEY (`shipping_id`)',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_order', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_order}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'session_id' => 'CHAR(26) NOT NULL',
                    'user_id' => 'INT(10) UNSIGNED NULL',
                    'subtotal' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'shipping' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'tax' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'total' => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_shipping', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_shipping}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'order_id' => 'INT(10) UNSIGNED NOT NULL',
                    'first_name' => 'VARCHAR(45) NOT NULL',
                    'last_name' => 'VARCHAR(45) NOT NULL',
                    'address' => 'VARCHAR(100) NOT NULL',
                    'address2' => 'VARCHAR(45) NULL',
                    'city' => 'VARCHAR(60) NOT NULL',
                    'state' => 'VARCHAR(60) NOT NULL',
                    'postal_code' => 'VARCHAR(13) NOT NULL',
                    'country' => 'SMALLINT(5) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_transaction', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_transaction}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'order_id' => 'INT(10) UNSIGNED NOT NULL',
                    'transaction_id' => 'VARCHAR(100) NULL',
                    'transaction_type_id' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'fee' => 'DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\'',
                    'amount' => 'DECIMAL(10,2) NOT NULL',
                    'description' => 'VARCHAR(500) NULL',
                    'timestamp' => 'INT(10) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_transaction_type', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_transaction_type}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(100) NOT NULL',
                ], $tableOptions_mysql);
            }
        }


    }

    public function down()
    {

        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_link`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_order`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_shipping`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_transaction`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_transaction_type`');
        $this->execute('SET foreign_key_checks = 1;');

    }
}




