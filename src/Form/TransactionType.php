<?php

namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('method', ChoiceType::class, [
                'choices' => [
                    'bank'   => 'bank',
                    'card'   => 'card',
                    'paypal' => 'paypal',
                    'other'  => 'other'
                ],
                'placeholder' => false,
                'label' => 'Method',
            ])
            ->add('tr_type', ChoiceType::class, [
                'choices' => [
                    'deposit'    => 'deposit',
                    'withdrawal' => 'withdrawal',
                    'other'      => 'other',
                ],
                'placeholder' => false,
                'label' => 'Type',
            ])
            ->add('bcurr', ChoiceType::class, [
                'choices' => [
                    'Australian Dollar' => 'AUD',
                    'Brazilian Real' => 'BRL',
                    'British Pound Sterline' => 'GBP',
                    'Bulgarian Lev' => 'BGN',
                    'Canadian Dollar' => 'CAD',
                    'Chinese Yuan Renminbi' => 'CNY',
                    'Croatian Kuna' => 'HRK',
                    'Czech Koruna' => 'CZK',
                    'Danish Krone' => 'DKK',
                    'Euro' => 'EUR',
                    'Hong Kong Dollar' => 'HKD',
                    'Hungarian Forint' => 'HUF',
                    'Icelandic Krona' => 'ISK',
                    'Indonesian Rupiah' => 'IDR',
                    'Indian Rupee' => 'INR',
                    'Israeli Shekel' => 'ILS',
                    'Japanese Yen' => 'JPY',
                    'Malaysian Ringgit' => 'MYR',
                    'Mexican Peso' => 'MXN',
                    'New Zealand Dollar' => 'NZD',
                    'Norwegian Krone' => 'NOK',
                    'Philippine Peso' => 'PHP',
                    'Polish Zloty' => 'PLN',
                    'Romanian Leu' => 'RON',
                    'Russian Rouble' => 'RUB',
                    'Singapore Dollar' => 'SGD',
                    'South African Rand' => 'ZAR',
                    'South Korean Won' => 'KRW',
                    'Swedish Krona' => 'SEK',
                    'Swiss Franc' => 'CHF',
                    'Thai Baht' => 'THB',
                    'Turkish Lira' => 'TRY',
                    'US Dollar' => 'USD'
                ],
                'placeholder' => false,
                'required' => true,
                'label'=> 'Base currency',
            ])
            ->add('bamount', NumberType::class, [
                'required' => true,
                'html5' => true,
                'label' => 'Base amount',
            ])
            ->add('tcurr', ChoiceType::class, [
                'choices' => [
                    'Australian Dollar' => 'AUD',
                    'Brazilian Real' => 'BRL',
                    'British Pound Sterline' => 'GBP',
                    'Bulgarian Lev' => 'BGN',
                    'Canadian Dollar' => 'CAD',
                    'Chinese Yuan Renminbi' => 'CNY',
                    'Croatian Kuna' => 'HRK',
                    'Czech Koruna' => 'CZK',
                    'Danish Krone' => 'DKK',
                    'Euro' => 'EUR',
                    'Hong Kong Dollar' => 'HKD',
                    'Hungarian Forint' => 'HUF',
                    'Icelandic Krona' => 'ISK',
                    'Indonesian Rupiah' => 'IDR',
                    'Indian Rupee' => 'INR',
                    'Israeli Shekel' => 'ILS',
                    'Japanese Yen' => 'JPY',
                    'Malaysian Ringgit' => 'MYR',
                    'Mexican Peso' => 'MXN',
                    'New Zealand Dollar' => 'NZD',
                    'Norwegian Krone' => 'NOK',
                    'Philippine Peso' => 'PHP',
                    'Polish Zloty' => 'PLN',
                    'Romanian Leu' => 'RON',
                    'Russian Rouble' => 'RUB',
                    'Singapore Dollar' => 'SGD',
                    'South African Rand' => 'ZAR',
                    'South Korean Won' => 'KRW',
                    'Swedish Krona' => 'SEK',
                    'Swiss Franc' => 'CHF',
                    'Thai Baht' => 'THB',
                    'Turkish Lira' => 'TRY',
                    'US Dollar' => 'USD'
                ],
                'placeholder' => false,
                'required' => true,
                'label'=> 'Target currency',
            ])
            ->add('tamount', NumberType::class, [
                'attr' => ['readonly' => 'true'],
                'required' => true,
                'html5' => true,
                'label' => 'Target amount',
            ])
            ->add('xrate', NumberType::class, [
                'attr' => ['readonly' => 'true'],
                'label' => 'Exchange rate',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
