<?php

declare(strict_types=1);

namespace App\Controller\Pendu;

use App\Pendu\GameMechanics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Constraints\Length;

class Pendu extends AbstractController
{
    /**
     * @Route(name="pendu", path="/pendu")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function getGame(GameMechanics $gameMechanics, RouterInterface $router): Response
    {
        $this->denyAccessUnlessGranted('GAME_IS_ON', $gameMechanics);

        $formBuilder = $this->createFormBuilder()
            ->setAction($router->generate('try_word'))
            ->add('word', TextType::class, ['constraints' => [new Length(null, 2)]])
            ->add('submit', SubmitType::class);

        $form = $formBuilder->getForm();

        return $this->render('pendu.html.twig', ['gameMechanics' => $gameMechanics, 'formulaire' => $form->createView()]);
    }
}
