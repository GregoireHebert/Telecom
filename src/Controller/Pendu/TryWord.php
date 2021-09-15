<?php

declare(strict_types=1);

namespace App\Controller\Pendu;

use App\Pendu\GameMechanics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @Route(name="try_word", path="/pendu/word")
 */
class TryWord extends AbstractController
{
    public function __invoke(Request $request, GameMechanics $gameMechanics): Response
    {
        $formBuilder = $this->createFormBuilder()
            ->add('word', TextType::class, ['constraints' => [new Length(['min'=> 3])]])
            ->add('submit', SubmitType::class);

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && !$form->isValid()) {
            // do cool stuff
            return $this->render('pendu.html.twig', ['gameMechanics' => $gameMechanics, 'formulaire' => $form->createView()]);
        }

        return $this->forward(Pendu::class.'::getGame');
    }
}
