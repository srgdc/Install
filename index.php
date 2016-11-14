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
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../phpOMS/Autoloader.php';

$dbHOBJ = new \phpOMS\DataStorage\Database\Pool();
$dbHOBJ->create('core', $CONFIG['db']['core']['masters'][0]);
$instHOBJ = new \Install\Installer($dbHOBJ);

/**
 * Array with all modules to install.
 *
 * @var array toInstall
 */
$toInstall = [
    'Admin',
    'Accounting',
    'AccountsPayable',
    'AccountsReceivable',
    'AreaManager',
    'Arrival',
    'AssemblyManagement',
    'Backup',
    'Balance',
    'BankAccounting',
    'Billing',
    'BudgetManagement',
    'Organization',
    'BusinessPlanningSimulation',
    'Calendar',
    'CapacityPlanning',
    'CashManagement',
    'Chat',
    'Chart',
    'Checklist',
    'ClientEvaluation',
    'ClientManagement',
    'Comments',
    'Controlling',
    'CostCenterAccounting',
    'CostObjectAccounting',
    'CreditManagement',
    'Dashboard',
    'Database',
    'Draw',
    'Editor',
    'EmployeeEvaluation',
    'EventManagement',
    'HumanResourceManagement',
    'InventoryManagement',
    'InvoiceManagement',
    'ItemManagement',
    'Job',
    'Logistics',
    'LotTracking',
    'Marketing',
    'Media',
    'Messages',
    'Monitoring',
    'MyPrivate',
    'Navigation',
    'News',
    'PaymentInformation',
    'Payroll',
    'PersonalCostPlanning',
    'PersonnelTimeManagement',
    'PL',
    'ProductCostControlling',
    'Production',
    'ProductionOrders',
    'ProductionPlanning',
    'Profile',
    'ProfitabilityAnalysis',
    'ProfitCenterAccounting',
    'ProjectManagement',
    'Purchase',
    'PurchaseAnalysis',
    'QualityManagement',
    'ReceiptManagement',
    'Reporter',
    'ResearchDevelopment',
    'RiskManagement',
    'Sales',
    'SalesAnalysis',
    'ShiftExchange',
    'ShiftPlanning',
    'Shipping',
    'SupplierEvaluation',
    'SupplierManagement',
    'SupplyChainManagement',
    'Support',
    'Surveys',
    'Tasks',
    'Tools',
    'TravelExpenses',
    'WarehouseManagement',
    'Workflow',
];

$instHOBJ->cleanupPrevious();
$instHOBJ->installCore();
$instHOBJ->installModules($toInstall);
$instHOBJ->installGroups();
$instHOBJ->installUsers(); /* TODO: create user 1 = Guest -> 2 = Admin */
$instHOBJ->installSettings();
$instHOBJ->error();

echo 'ALPHA successfully installed!';
