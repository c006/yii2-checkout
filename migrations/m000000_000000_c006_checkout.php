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
        if (!in_array('checkout_coupon', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_coupon}}', [
                    'id'        => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0           => 'PRIMARY KEY (`id`)',
                    'order_id'  => 'INT(11) UNSIGNED NOT NULL',
                    'coupon_id' => 'INT(10) UNSIGNED NOT NULL',
                    'code'      => 'VARCHAR(45) NOT NULL',
                    'amount'    => 'DECIMAL(10,2) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_item', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_item}}', [
                    'id'                  => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                     => 'PRIMARY KEY (`id`)',
                    'order_id'            => 'INT(10) UNSIGNED NOT NULL',
                    'product_id'          => 'INT(10) UNSIGNED NOT NULL',
                    'product_shipping_id' => 'SMALLINT(6) NULL',
                    'quantity'            => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'discount'            => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'price'               => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'name'                => 'VARCHAR(45) NULL',
                    'sku'                 => 'VARCHAR(30) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_order', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_order}}', [
                    'id'         => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0            => 'PRIMARY KEY (`id`)',
                    'session_id' => 'CHAR(26) NOT NULL',
                    'user_id'    => 'INT(10) UNSIGNED NULL',
                    'status_id'  => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'subtotal'   => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'discount'   => 'DECIMAL(10,2) UNSIGNED NULL DEFAULT \'0.00\'',
                    'shipping'   => 'DECIMAL(10,2) UNSIGNED NULL DEFAULT \'0.00\'',
                    'tax'        => 'DECIMAL(10,2) UNSIGNED NULL DEFAULT \'0.00\'',
                    'total'      => 'DECIMAL(10,2) UNSIGNED NOT NULL',
                    'timestamp'  => 'INT(11) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_shipping', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_shipping}}', [
                    'id'          => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0             => 'PRIMARY KEY (`id`)',
                    'order_id'    => 'INT(10) UNSIGNED NOT NULL',
                    'first_name'  => 'VARCHAR(45) NOT NULL',
                    'last_name'   => 'VARCHAR(45) NOT NULL',
                    'address'     => 'VARCHAR(100) NOT NULL',
                    'address2'    => 'VARCHAR(45) NULL',
                    'city'        => 'VARCHAR(60) NOT NULL',
                    'state'       => 'VARCHAR(60) NOT NULL',
                    'postal_code' => 'VARCHAR(13) NOT NULL',
                    'country'     => 'SMALLINT(5) NOT NULL',
                    'shipping'     => 'varchar(45) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_status_type', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_status_type}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(45) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_transaction', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_transaction}}', [
                    'id'                  => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                     => 'PRIMARY KEY (`id`)',
                    'order_id'            => 'INT(10) UNSIGNED NOT NULL',
                    'transaction_id'      => 'VARCHAR(100) NULL',
                    'transaction_type_id' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'auth'                => 'VARCHAR(20) NULL',
                    'fee'                 => 'DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT \'0.00\'',
                    'amount'              => 'DECIMAL(10,2) NOT NULL',
                    'description'         => 'VARCHAR(500) NULL',
                    'timestamp'           => 'INT(10) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('checkout_transaction_type', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%checkout_transaction_type}}', [
                    'id'   => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(100) NOT NULL',
                ], $tableOptions_mysql);
            }
        }


        $this->createIndex('idx_coupon_id_0796_00', 'checkout_coupon', 'coupon_id', 0);
        $this->createIndex('idx_order_id_0796_01', 'checkout_coupon', 'order_id', 0);
        $this->createIndex('idx_order_id_0819_02', 'checkout_item', 'order_id', 0);
        $this->createIndex('idx_status_id_0842_03', 'checkout_order', 'status_id', 0);
        $this->createIndex('idx_order_id_0865_04', 'checkout_shipping', 'order_id', 0);
        $this->createIndex('idx_order_id_0904_05', 'checkout_transaction', 'order_id', 0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_coupon_0791_00', '{{%checkout_coupon}}', 'coupon_id', '{{%coupon}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_checkout_order_0792_01', '{{%checkout_coupon}}', 'order_id', '{{%checkout_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_checkout_order_0816_02', '{{%checkout_item}}', 'order_id', '{{%checkout_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_checkout_order_0861_03', '{{%checkout_shipping}}', 'order_id', '{{%checkout_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_checkout_order_0901_04', '{{%checkout_transaction}}', 'order_id', '{{%checkout_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->execute('SET foreign_key_checks = 1;');

        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%checkout_status_type}}', ['id' => '1', 'name' => 'Processing']);
        $this->insert('{{%checkout_status_type}}', ['id' => '2', 'name' => 'Charged']);
        $this->insert('{{%checkout_status_type}}', ['id' => '3', 'name' => 'Shipped']);
        $this->insert('{{%checkout_status_type}}', ['id' => '4', 'name' => 'Complete']);
        $this->insert('{{%checkout_status_type}}', ['id' => '5', 'name' => 'Partial Refund']);
        $this->insert('{{%checkout_status_type}}', ['id' => '6', 'name' => 'Canceled']);
        $this->insert('{{%checkout_status_type}}', ['id' => '7', 'name' => 'Void']);
        $this->insert('{{%checkout_transaction_type}}', ['id' => '1', 'name' => 'Credit Card']);
        $this->insert('{{%checkout_transaction_type}}', ['id' => '2', 'name' => 'Bank Transfer']);
        $this->execute('SET foreign_key_checks = 1;');

    }

    public function down()
    {

        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_coupon`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_order`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_shipping`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_status_type`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_transaction`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `checkout_transaction_type`');
        $this->execute('SET foreign_key_checks = 1;');

    }
}




