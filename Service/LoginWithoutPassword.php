<?php
/**
 * @category  Collab
 * @package   Collab\CustomerPasswordLessLogin
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\CustomerPasswordLessLogin\Service;

use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validator\EmailAddress as EmailValidator;

class LoginWithoutPassword
{
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected Session $customerSession,
        protected AccountManagement $accountManagement,
        protected CustomerInterfaceFactory $customerFactory,
        protected EmailValidator $emailValidator
    ) {
    }

    public function login(array $data): void
    {
        try {
            $customer = $this->customerRepository->get($data['email']);
        } catch (NoSuchEntityException|LocalizedException $e) {
            $customer = $this->customerFactory->create();
            $customer->setEmail($data['email']);
            $customer->setFirstname($data['firstName']);
            $customer->setLastname($data['lastName']);
            try {
                $this->validateEmailFormat($data['email']);
                $customer = $this->accountManagement->createAccount($customer);
            } catch (LocalizedException $e) {
            }
        }
        $this->customerSession->setCustomerDataAsLoggedIn($customer);
    }

    /**
     * @throws LocalizedException
     */
    protected function validateEmailFormat($email): void
    {
        if (!$this->emailValidator->isValid($email)) {
            throw new LocalizedException(__('Please enter a valid email address.'));
        }
    }
}
