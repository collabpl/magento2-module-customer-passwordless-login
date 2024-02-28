/**
 * @category  Collab
 * @package   Collab\CustomerPasswordLessLogin
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

define([
    'jquery',
    'Magento_Ui/js/form/form'
], function ($, Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Collab_CustomerPasswordLessLogin/checkout/quick-login-placeholder'
        }
    });
});
