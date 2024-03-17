<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use PingCAP\{Constants};

class SubscribeForm implements IComponent
{
    public array $form_classes = [];
    public string $portal_id = '';
    public string $form_id = '';
    public string $name_field = '';
    public string $email_field = '';

    public function __construct(array $params)
    {
        $this->form_classes = Arrays::get_value_as_array($params, 'form_classes');
        $this->portal_id = Arrays::get_value_as_string($params, 'portal_id');
        $this->form_id = Arrays::get_value_as_string($params, 'form_id');
        $this->name_field = Arrays::get_value_as_string($params, 'name_field');
        $this->email_field = Arrays::get_value_as_string($params, 'email_field');

        if (!$this->portal_id) {
            $this->message = 'portal id for hubspot form must be specified';
        } elseif (!$this->form_id) {
            $this->message = 'form id for hubspot form must be specified';
        }
    }

    public function render(): void
    {
?>
        <div class="block-cta">
            <form class="<?php echo esc_attr(implode(' ', $this->form_classes)); ?>" method="POST" action="<?php echo esc_url(home_url()); ?>" data-hs-portal-id="<?php echo esc_attr($this->portal_id); ?>" data-hs-form-id="<?php echo esc_attr($this->form_id); ?>" data-hs-name-field="<?php echo esc_attr($this->name_field); ?>" data-hs-email-field="<?php echo esc_attr($this->email_field); ?>">
                <input type="text" name="cta_name" placeholder="<?php _e('Name', Constants\TextDomains::DEFAULT); ?>" aria-label="<?php _e('Enter your name', Constants\TextDomains::DEFAULT); ?>">
                <input type="email" name="cta_email" placeholder="<?php _e('Email Address', Constants\TextDomains::DEFAULT); ?>" aria-label="<?php _e('Enter your email address', Constants\TextDomains::DEFAULT); ?>">
                <button class="button" type="submit" aria-label="<?php _e('Subscribe', Constants\TextDomains::DEFAULT); ?>">
                    SUBSCRIBE
                </button>
            </form>
        </div>
<?php
    }
}
