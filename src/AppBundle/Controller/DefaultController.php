<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/article", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class);
        $articles = $article->findAll();


        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/create", name="create")
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('homepage');
        };

        return $this->render('default/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/update/{id}", name="update")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     *
     * @Route("/article/delete/{id}", name="delete")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $delete = $em->getRepository(Article::class)->find($id);
        $em->remove($delete);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}
