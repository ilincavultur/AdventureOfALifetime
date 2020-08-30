<?php


namespace App\Controller;


use App\Entity\Adventure;
use App\Form\AdventureType;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CollectionController
 * @package App\Controller
 * @Route("/AdventureOfALifetime/Collection")
 */
class CollectionController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/addAdventure", name="app_new_adventure")
     */
    public function addAdventure(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm( AdventureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($form->getData());

            $em->flush();
            return $this->redirect($this->generateUrl('app_collection'));
        }
        return $this->render(
            'Collection/addAdventure.html.twig',
            [
                'user_form' => $form->createView()
            ]
        );

    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/list", name="app_collection")
     */
    public function listAction(Request $request)
    {
        $productRepository = $this->getDoctrine()->getRepository(Adventure::class);
        $qb = $productRepository->findAdventures($request->get('search'));

        $page = $request->get('page');
        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pager->setCurrentPage($page?$page:1);
        $pager->getNbResults();

        return $this->render(
            'Collection/list.html.twig',
            [
                'pager' => $pager
            ]
        );

    }

    /**
     * @param Adventure $adventure
     * @return RedirectResponse
     * @Route("/delete/{id}", name="app_adventure_delete")
     */
    public function adventureDelete(Adventure $adventure)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($adventure);
        $entityManager->flush();

        return $this->redirectToRoute('app_collection');

    }

    /**
     * @param Request $request
     * @param Adventure $adventure
     * @return RedirectResponse|Response
     * @Route("/edit/{id}", name="app_adventure_edit")
     */
    public function update(Request $request, Adventure $adventure)
    {
        $entityManager = $this->getDoctrine()->getManager();


        $form = $this->createForm(AdventureType::class, $adventure);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->flush();

            return $this->redirectToRoute('app_collection');
        }

        return $this->render(
            'Collection/editAdventure.html.twig',
            [
                'user_form' => $form->createView()
            ]
        );
    }






}