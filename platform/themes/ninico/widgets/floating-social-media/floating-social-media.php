<?php

use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\CheckboxField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;

class FloatingSocialMediaWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Floating Social Media'),
            'description' => __('Display floating social media icons with help text'),
            'enabled' => true,
            'help_text' => 'للمساعدة',
            'whatsapp_number' => '+201019831970',
            'whatsapp_enabled' => true,
            'facebook_url' => 'https://facebook.com',
            'facebook_enabled' => true,
            'instagram_url' => 'https://instagram.com',
            'instagram_enabled' => true,
        ]);
    }

    protected function settingForm(): WidgetForm|string|null
    {
        return WidgetForm::createFromArray($this->getConfig())
            ->add(
                'enabled',
                CheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(__('Enable floating social media'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'help_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Help text'))
                    ->defaultValue('للمساعدة')
                    ->helperText(__('Text displayed above the social icons'))
                    ->toArray()
            )
            ->add(
                'whatsapp_enabled',
                CheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(__('Enable WhatsApp'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'whatsapp_number',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('WhatsApp Number'))
                    ->defaultValue('+201019831970')
                    ->helperText(__('WhatsApp number with country code'))
                    ->toArray()
            )
            ->add(
                'facebook_enabled',
                CheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(__('Enable Facebook'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'facebook_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Facebook URL'))
                    ->defaultValue('https://facebook.com')
                    ->toArray()
            )
            ->add(
                'instagram_enabled',
                CheckboxField::class,
                CheckboxFieldOption::make()
                    ->label(__('Enable Instagram'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'instagram_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Instagram URL'))
                    ->defaultValue('https://instagram.com')
                    ->toArray()
            );
    }

    public function data(): array
    {
        $config = $this->getConfig();
        
        return [
            'enabled' => $config['enabled'] ?? true,
            'help_text' => $config['help_text'] ?? 'للمساعدة',
            'social_links' => [
                'whatsapp' => [
                    'enabled' => $config['whatsapp_enabled'] ?? true,
                    'url' => 'https://wa.me/' . str_replace(['+', ' ', '-'], '', $config['whatsapp_number'] ?? '+201019831970'),
                    'icon' => 'fab fa-whatsapp',
                    'color' => '#25D366',
                    'title' => 'WhatsApp'
                ],
                'facebook' => [
                    'enabled' => $config['facebook_enabled'] ?? true,
                    'url' => $config['facebook_url'] ?? 'https://facebook.com',
                    'icon' => 'fab fa-facebook-f',
                    'color' => '#1877F2',
                    'title' => 'Facebook'
                ],
                'instagram' => [
                    'enabled' => $config['instagram_enabled'] ?? true,
                    'url' => $config['instagram_url'] ?? 'https://instagram.com',
                    'icon' => 'fab fa-instagram',
                    'color' => '#E4405F',
                    'title' => 'Instagram'
                ]
            ]
        ];
    }
}
