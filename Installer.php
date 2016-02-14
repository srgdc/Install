<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Install;

use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\ModuleManager;

/**
 * Installer class.
 *
 * @category   Install
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Installer extends ApplicationAbstract
{

    /**
     * Database object.
     *
     * @var Pool
     * @since 1.0.0
     */
    public $dbPool = null;

    /**
     * Constructor.
     *
     * @param Pool $dbPool Database instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(Pool $dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Install core tables.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installCore()
    {
        try {
            /* Create module table */
            $this->dbPool->get('core')->con->prepare(
                'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'module` (
                            `module_id` varchar(255) NOT NULL,
                            `module_theme` varchar(100) DEFAULT NULL,
                            `module_path` varchar(50) NOT NULL,
                            `module_active` tinyint(1) NOT NULL DEFAULT 1,
                            `module_version` varchar(10) DEFAULT NULL,
                            PRIMARY KEY (`module_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
            )->execute();

            /* Create module load table */
            $this->dbPool->get('core')->con->prepare(
                'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'module_load` (
                            `module_load_id` int(11) NOT NULL AUTO_INCREMENT,
                            `module_load_pid` varchar(40) NOT NULL,
                            `module_load_type` tinyint(1) NOT NULL,
                            `module_load_from` varchar(255) DEFAULT NULL,
                            `module_load_for` varchar(255) DEFAULT NULL,
                            `module_load_file` varchar(255) NOT NULL,
                            PRIMARY KEY (`module_load_id`),
                            KEY `module_load_from` (`module_load_from`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
            )->execute();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Install the core module.
     *
     * @param array $modules Array of all module to install
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installModules($modules)
    {
        try {
            $moduleManager = new ModuleManager($this);

            foreach ($modules as $module) {
                $moduleManager->install($module);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Setup the core group.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installGroups()
    {
        try {
            switch ($this->dbPool->get('core')->getType()) {
                case DatabaseType::MYSQL:
                    $this->dbPool->get('core')->con->beginTransaction();

                    $this->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`, `group_name`, `group_desc`) VALUES
                            (1000000000, \'guest\', NULL),
                            (1000101000, \'user\', NULL),
                            (1000102000, \'admin\', NULL),
                            (1000103000, \'support\', NULL),
                            (1000104000, \'backend\', NULL),
                            (1000105000, \'suspended\', NULL);'
                    )->execute();

                    $this->dbPool->get('core')->con->commit();
                    break;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Setup the admin user.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installUsers()
    {
        try {
            $date = new \DateTime('NOW', new \DateTimeZone('UTC'));

            switch ($this->dbPool->get('core')->getType()) {
                case DatabaseType::MYSQL:
                    $this->dbPool->get('core')->con->beginTransaction();

                    $this->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'account` (`account_id`, `account_status`, `account_type`, `account_lactive`, `account_created_at`, `account_login`, `account_name1`, `account_name2`, `account_name3`, `account_password`, `account_email`, `account_tries`) VALUES
                            (1, 0, 0, \'0000-00-00 00:00:00\', \'' . $date->format('Y-m-d H:i:s') . '\', \'admin\', \'Cherry\', \'Orange\', \'Orange Management\', \'' . password_hash('orange', PASSWORD_DEFAULT) . '\', \'admin@email.com\', 5);'
                    )->execute();

                    $this->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'account_group` (`account_group_id`, `account_group_group`, `account_group_account`) VALUES
                            (1, 1000101000, 1),
                            (2, 1000104000, 1);'
                    )->execute();

                    $this->dbPool->get('core')->con->commit();
                    break;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Set all settings.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installSettings()
    {
        try {
            switch ($this->dbPool->get('core')->getType()) {
                case DatabaseType::MYSQL:
                    $this->dbPool->get('core')->con->beginTransaction();

                    $this->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'settings` (`settings_id`, `settings_module`, `settings_name`, `settings_content`, `settings_group`) VALUES
                            (1000000001, NULL, \'username_length_max\', \'20\', NULL),
                            (1000000002, NULL, \'username_length_min\', \'5\', NULL),
                            (1000000003, NULL, \'password_length_max\', \'50\', NULL),
                            (1000000004, NULL, \'password_length_min\', \'5\', NULL),
                            (1000000005, NULL, \'login_tries\', \'3\', NULL),
                            (1000000006, NULL, \'pass_special\', \'1\', NULL),
                            (1000000007, NULL, \'pass_upper\', \'0\', NULL),
                            (1000000008, NULL, \'pass_numeric\', \'1\', NULL),
                            (1000000009, NULL, \'oname\', \'Orange Management\', NULL),
                            (1000000010, NULL, \'theme\', \'oms-slim\', NULL),
                            (1000000011, NULL, \'theme_path\', \'/oms-slim\', NULL),
                            (1000000012, NULL, \'changed\', \'1\', NULL),
                            (1000000013, NULL, \'login_status\', \'1\', NULL),
                            (1000000014, NULL, \'login_msg\', \'Maintenance scheduled for tomorrow from 11:00 am to 1:00 pm.\', NULL),
                            (1000000015, NULL, \'use_cache\', \'0\', NULL),
                            (1000000016, NULL, \'last_recache\', \'0000-00-00 00:00:00\', NULL),
                            (1000000017, NULL, \'public_access\', \'0\', NULL),
                            (1000000018, NULL, \'rewrite\', \'0\', NULL),
                            (1000000019, NULL, \'country\', \'DE\', NULL),
                            (1000000020, NULL, \'language\', \'en\', NULL),
                            (1000000021, NULL, \'timezone\', \'Europe/Berlin\', NULL),
                            (1000000022, NULL, \'timeformat\', \'DD.MM.YYYY hh:mm:ss\', NULL),
                            (1000000023, NULL, \'currency\', \'USD\', NULL),
                            (1000000024, NULL, \'pass_lower\', \'1\', NULL),
                            (1000000025, NULL, \'mail_admin\', \'mail@admin.com\', NULL),
                            (1000000026, NULL, \'login_name\', \'1\', NULL),
                            (1000000027, NULL, \'decimal_point\', \'.\', NULL),
                            (1000000028, NULL, \'thousands_sep\', \',\', NULL),
                            (1000000029, NULL, \'server_language\', \'en\', NULL)'
                    )->execute();

                    $this->dbPool->get('core')->con->commit();
                    break;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
