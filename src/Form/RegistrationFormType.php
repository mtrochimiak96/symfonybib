<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
				'label' => 'Nazwa'
			])
            ->add('affiliation', TextType::class, [
				'label' => 'Afiliacja'
			])
            ->add('email', TextType::class, [
				'label' => 'Email'
			]);
			if($options['edit'] === null) {
				$builder->add('agreeTerms', CheckboxType::class, [
					'mapped' => false,
					'constraints' => [
						new IsTrue([
							'message' => 'You should agree to our terms.',
						]),
					]
				]);
			}else{
				$builder->add('agreeTerms', CheckboxType::class, [
					'mapped' => false,
					'required' => false
				]);
			}
			
			if($options['edit'] !== null) {
				$builder->add('role', ChoiceType::class, [
					'choices' => [
						'Admin' => 'admin',
						'User' => 'user',
					],
					'data' => $options['role'],
				]);
			}
			
			if($options['edit'] === null){
				$builder->add('plainPassword', PasswordType::class, [
					// instead of being set onto the object directly,
					// this is read and encoded in the controller
					'mapped' => false,
					'constraints' => [
						new NotBlank([
							'message' => 'Please enter a password',
						]),
						new Length([
							'min' => 6,
							'minMessage' => 'Your password should be at least {{ limit }} characters',
							// max length allowed by Symfony for security reasons
							'max' => 4096,
						]),
					],
				]);
			}else{
				$builder->add('plainPassword', PasswordType::class, [
					// instead of being set onto the object directly,
					// this is read and encoded in the controller
					'mapped' => false,
					'constraints' => [
						new Length([
							'min' => 6,
							'minMessage' => 'Your password should be at least {{ limit }} characters',
							// max length allowed by Symfony for security reasons
							'max' => 4096,
						]),
					],
					'required' => false
				]);
			}
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
			'edit' => null,
			'role' => 'user'
        ]);
    }
}
