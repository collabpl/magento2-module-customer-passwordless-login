<?php
/**
 * @category  Collab
 * @package   Collab\CustomerPasswordLessLogin
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\CustomerPasswordLessLogin\Block\LayoutProcessor\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class Onepage implements LayoutProcessorInterface
{
    public function __construct(
        protected ArrayManager $arrayManager
    ) {
    }

    public function process($jsLayout): array
    {
        return $this->createQuickLoginPlaceholder($jsLayout);
    }

    private function createQuickLoginPlaceholder(array $jsLayout): array
    {
        $paths = $this->arrayManager->findPaths('before-form', $jsLayout);
        foreach ($paths as $path) {
            $jsLayout = $this->arrayManager->set(
                $path . '/children/quick-login-placeholder',
                $jsLayout,
                [
                    'component' => 'Collab_CustomerPasswordLessLogin/js/view/checkout/quick-login-placeholder',
                    'displayArea' => 'before-form',
                    'config' => [
                        'additionalClasses' => 'quick-login-placeholder'
                    ]
                ]
            );
        }

        return $jsLayout;
    }
}
