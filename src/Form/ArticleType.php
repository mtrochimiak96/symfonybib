<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('title', TextType::class, [
				'label' => 'Tytuł'
			])
			->add('doi', TextType::class, [
				'label' => 'DOI'
			])
			->add('minipoint', NumberType::class, [
				'label' => 'Punkty'
			])
			->add('conftype', TextType::class, [
				'label' => 'Conference'
			])
			->add('confvalue', TextType::class, [
				'label' => 'Magazyn'
			])
			->add('publicdate', DateType::class, [
				'label' => 'Data publikacji'
			])
			->add('shares', TextType::class, [
				'label' => 'Udziały'
			])
			->add('author', TextType::class, [
				'label' => 'Autor'
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
