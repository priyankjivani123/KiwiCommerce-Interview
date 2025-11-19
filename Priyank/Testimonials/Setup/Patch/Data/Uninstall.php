<?php
namespace Priyank\Testimonials\Setup\Patch\Data;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Data patch to uninstall testimonial module data.
 * Drops custom table and removes custom product attribute.
 */
class Uninstall implements DataPatchInterface
{
    /**
     * Factory to manage EAV attributes for products.
     *
     * @var EavSetupFactory
     */
    private EavSetupFactory $_eavSetupFactory;

    /**
     * Provides setup context for module data operations.
     *
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $_moduleDataSetup;

    /**
     * Schema setup
     *
     * @var SchemaSetupInterface
     */
    private SchemaSetupInterface $setup;

    /**
     * Constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param SchemaSetupInterface $setup
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        SchemaSetupInterface $setup
    ) {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->setup = $setup;
    }

    /**
     * Apply uninstall changes
     */
    public function apply(): void
    {
        $this->setup->startSetup();

        /** @var AdapterInterface $connection */
        $connection = $this->setup->getConnection();
        $connection->dropTable($this->setup->getTable('wk_test'));

        $this->setup->endSetup();

        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'test_uninstall');
    }

    /**
     * Get patch dependencies
     *
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get patch aliases
     *
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}
